<?
if(CModule::IncludeModule("iblock")) {
	if($USER->IsAuthorized()) {
		if(in_array(UG_AKP, CUser::GetUserGroup($USER->GetID())) ||
				in_array(UG_PO, CUser::GetUserGroup($USER->GetID())) ||
					in_array(UG_YC, CUser::GetUserGroup($USER->GetID())))
		{
			if(in_array(UG_AKP, CUser::GetUserGroup($USER->GetID())) && isset($GLOBALS["ADMIN_CHOOSE_COMPANY"]) && $GLOBALS["ADMIN_CHOOSE_COMPANY"] > 0) {
				$company = $GLOBALS["ADMIN_CHOOSE_COMPANY"];
				$componentPage = "editing";
				$arResult["PARTNER_ADMIN"] = "Y";
			}
			elseif(in_array(UG_PO, CUser::GetUserGroup($USER->GetID())) || in_array(UG_PP, CUser::GetUserGroup($USER->GetID())) || in_array(UG_YC, CUser::GetUserGroup($USER->GetID()))) {
				if(in_array(UG_PO, CUser::GetUserGroup($USER->GetID()))) {
					$componentPage = "editing";
					$arResult["PARTNER_ADMIN"] = "Y";
				}
				else {
					$arResult["PARTNER_ADMIN"] = "N";
					$componentPage = "view";
				}
				$rsUsers = CUser::GetList(($by="id"), ($order="desc"), array("ID" => $USER->GetID()), array("SELECT" => array("UF_*")));
				$arUsers = $rsUsers->GetNext();
				$company = $arUsers["UF_COMPANY"];
			}
			if(!$company && in_array(UG_AKP, CUser::GetUserGroup($USER->GetID()))) {
				ShowError(GetMessage("NOT_FILTER"));
				return;
			}
			elseif($company > 0) {
				$comps = CIBlockElement::GetList(array(), array("IBLOCK_ID" => IB_COMPANY, "ID" => $company, "ACTICE" => "Y"), false, false, array("NAME"));
				if($comp = $comps->GetNext()) {
					//название компании
					$COMPANY_NAME = $comp["NAME"];
					
					//уровни партнерства, доступные для сотрудников компании
					$res = CIBlockElement::GetList(	
						array("SORT" => "ASC"), 
						array("IBLOCK_ID" => IB_COMPANY, "ID" => $company), 
						false, 
						false, 
						array("ID", "PROPERTY_PARTNERS_LEVELS", "PROPERTY_FORUM")
					);
					if($element = $res->GetNext()) {
						$levels = $element["PROPERTY_PARTNERS_LEVELS_VALUE"];
						if(count($levels) > 0) {
							$res = CIBlockElement::GetList(array("SORT" => "ASC"), array("IBLOCK_ID" => IB_PARTNER_LEVEL, "ID" => $levels), false, false, array("NAME", "ID", "PROPERTY_ACCESS_GROUP_ID", "PROPERTY_SHORT_NAME"));
							while($el = $res->GetNext()) {
								$arResult["COMPANY"]["LEVELS"][] = array("ID" => $el["ID"], "NAME" => $el["PROPERTY_SHORT_NAME_VALUE"] ? $el["PROPERTY_SHORT_NAME_VALUE"] : $el["NAME"], "GROUP_ID" => $el["PROPERTY_ACCESS_GROUP_ID_VALUE"]);
								$LEVELS_COMPANY[] = $el["PROPERTY_ACCESS_GROUP_ID_VALUE"];
							}
						}
						if($element["PROPERTY_FORUM_VALUE"]) {
							$arResult["COMPANY"]["LEVELS"][] = array("ID" => "", "NAME" => "Партнерский форум", "GROUP_ID" => UG_FORUM);
							$LEVELS_COMPANY[] = UG_FORUM;
						}
							
					}
					
					//сертифицированные специалисты
					$specialists = CIBlockElement::GetList(
						array("DATE_ACTIVE_FROM" => "ASC", "NAME" => "ASC"), 
						array("IBLOCK_ID" => IB_SERTIFIED_SPECIALIES, "ACTIVE" => "Y", "PROPERTY_COMPANY" => $company), 
						false, 
						false, 
						array("NAME", "ID", "DATE_ACTIVE_FROM", "PROPERTY_QUALIFICATION.NAME", "PROPERTY_VALIDITY", "PROPERTY_COMPANY")
					);
					while($specialist = $specialists->GetNext()) {
						$date_array = explode(".", $specialist["DATE_ACTIVE_FROM"]);
						$date_end = mktime(0, 0, 0, $date_array[1], $date_array[0]+$specialist["PROPERTY_VALIDITY_VALUE"], $date_array[2]);
						$curr_date = mktime(0, 0, 0, date("m"), date("d"), date("Y"));
						if($curr_date < $date_end) {						
							$arResult["COMPANY"]["SPECIALISTS"][] = array(
								"ID" => $specialist["ID"],
								"NAME" => $specialist["~NAME"],
								"DATE_START" => date("d.m.Y", mktime(0, 0, 0, $date_array[1], $date_array[0], $date_array[2])),
								"DATE_END" => date("d.m.Y", mktime(0, 0, 0, $date_array[1], $date_array[0]+$specialist["PROPERTY_VALIDITY_VALUE"], $date_array[2])),
								"COURSE" => $specialist["~PROPERTY_QUALIFICATION_NAME"]							
							);
						}
					}
					if(!empty($_REQUEST["COMPANY"]["PEOPLE"]) && $arResult["PARTNER_ADMIN"] == "Y" && bitrix_sessid_post() && !empty($_REQUEST["sessid"]) && !empty($_REQUEST["jssid"]) && $_REQUEST["sessid"] == $_REQUEST["jssid"]) {
						foreach($_REQUEST["COMPANY"]["PEOPLE"] as $key => $people) {
							unset($arPeople);
							unset($id_people);
							$contacts_person = CIBlockPropertyEnum::GetList(
								array("SORT"=>"ASC", "NAME" => "ASC"), 
								array("IBLOCK_ID" => IB_PEOPLES, "CODE" => "CONTACT_PERSON")
							);
							if($main = $contacts_person->GetNext())
								if(!empty($people["contacts_person"])) 
									$people_property["CONTACT_PERSON"] = Array("VALUE" => $main["ID"]);
								else $people_property["CONTACT_PERSON"] = Array("VALUE" => "-1");
								
							if(empty($people["POSITION"]))
								$arResult["ERROR"][] = GetMessage("NO_REQUIRED_PEOPLE_FIELD_POSITION");
							if(empty($people["NAME"]))
								$arResult["ERROR"][] = GetMessage("NO_REQUIRED_PEOPLE_FIELD_NAME");
							if(empty($people["EMAIL"]))
								$arResult["ERROR"][] = GetMessage("NO_REQUIRED_PEOPLE_FIELD_EMAIL_OR_PHONE");
							if(!empty($people["EMAIL"]) && !check_email($people["EMAIL"]))
								$arResult["ERROR"][] = GetMessage("WRONG_EMAIL_PEOPLE");
							
							if(empty($arResult["ERROR"])) {
								//создание сотрудника в инфоблоке сотрудников
								$people_property["COMPANY"] = $company;
								$people_property["POSITION"] = $people["POSITION"];
								$people_property["EMAIL"] = $people["EMAIL"];
								$people_property["PHONE"] = $people["PHONE"];
								$arPeople = Array(
									"IBLOCK_ID"      => IB_PEOPLES,
									"PROPERTY_VALUES"=> $people_property,
									"NAME"           => $people["NAME"]
								);
								
								$el = new CIBlockElement;
								if(isset($people["ID"]) && $people["ID"] > 0) {
									if(!$id_people = $el->Update($people["ID"], $arPeople))
										$arResult["ERROR"][] = $el->LAST_ERROR;
								}
								else {						
									if(!$id_people = $el->Add($arPeople))
										$arResult["ERROR"][] = $el->LAST_ERROR;
									else $_REQUEST["COMPANY"]["PEOPLE"][$key]["ID"] = $id_people;
								}
								$ID_P = $people["ID"] ? $people["ID"] : $id_people;
								unset($rsUsers);
								unset($arUser);
							}
							
							//создание пользователя для сотрудника, если ему предоставлены какие-то уровни доступа							
							if(empty($arResult["ERROR"]) && !empty($people["GROUP"])) {
								$select["SELECT"] = array("UF_PEOPLE", "UF_COMPANY");
								$rsUsers = CUser::GetList(($by="id"), ($order="desc"), array("UF_PEOPLE" => $ID_P, "UF_COMPANY" => $company), $select);
								if($arUser = $rsUsers->Fetch()) {
									$user = new CUser;
									$fields = Array("GROUP_ID" => array_merge(array(UG_PP), $people["GROUP"], array_diff(CUser::GetUserGroup($arUser["ID"]) , array_diff($LEVELS_COMPANY, $people["GROUP"]))), "NAME" => $people["NAME"], "EMAIL" => $people["EMAIL"], "LOGIN" => $people["EMAIL"]);									
									if(!$new_User = $user->Update($arUser["ID"], $fields))
										$arResult["ERROR"][] = $user->LAST_ERROR;
								}
								else {
									unset($person);
									unset($userID);
									unset($arSend);
									$person["PASSWORD"] = randString(8);
									$person["CONFIRM_PASSWORD"] = $person["PASSWORD"];
									$person["LOGIN"] = $people["EMAIL"];
									$person["NAME"] = $people["NAME"];
									$person["EMAIL"] = $people["EMAIL"];
									$person["UF_COMPANY"] = $company;
									$person["UF_PEOPLE"] = $ID_P;
									$person["GROUP_ID"] = array_merge($people["GROUP"]);
									$user = new CUser();
									if(!$userID = $user->Add($person))
										$arResult["ERROR"][] = $user->LAST_ERROR;
									$arSend = array(
										"FULL_NAME" => $person["NAME"],
										"COMPANY_NAME" => $COMPANY_NAME,
										"LOGIN" => $person["LOGIN"],
										"PASSWORD" => $person["PASSWORD"],
										"EMAIL" => $person["EMAIL"]
									);
									$event = new CEvent;
									$event->Send("ADD_USER", SITE_ID, $arSend, "N", 96);
								}
							}
							elseif(!isset($people["GROUP"]) || empty($people["GROUP"])) {
								$rsUsers = CUser::GetList(($by="id"), ($order="desc"), array("UF_PEOPLE" => $ID_P, "UF_COMPANY" => $company), $select);
								if($arUser = $rsUsers->Fetch()) {									
									$user = new CUser;
									$fields = Array("GROUP_ID" => array(), "NAME" => $people["NAME"], "EMAIL" => $people["EMAIL"], "LOGIN" => $people["EMAIL"]);									
									if(!$new_User = $user->Update($arUser["ID"], $fields))
										$arResult["ERROR"][] = $user->LAST_ERROR;
								}
							}
						}
					}
					elseif(!empty($_REQUEST["COMPANY"]["PEOPLE"])) {
						ShowError(GetMessage("NOT_WRITE"));
					}
					
					//сотрудники
					$peoples = CIBlockElement::GetList(
						array("ID" => "ASC"), 
						array("IBLOCK_ID" => IB_PEOPLES, "ACTIVE" => "Y", "PROPERTY_COMPANY" => $company), 
						false, 
						false, 
						array(
							"ID",
							"NAME",
							"PROPERTY_COMPANY", 
							"PROPERTY_CONTACT_PERSON",
							"PROPERTY_PHONE",
							"PROPERTY_EMAIL",
							"PROPERTY_POSITION"
						)
					);
					while($people = $peoples->GetNext()) {
						unset($filter);
						unset($select);
						unset($rsUsers);
						unset($arUser);
						unset($user_group);
						$filter = array("UF_PEOPLE" => $people["ID"], "UF_COMPANY" => $people["PROPERTY_COMPANY_VALUE"]);
						$select["SELECT"] = array("UF_PEOPLE", "UF_COMPANY");
						$rsUsers = CUser::GetList(($by="id"), ($order="desc"), $filter, $select);
						if($arUser = $rsUsers->Fetch()) {
							$user_group = CUser::GetUserGroup($arUser["ID"]);
						}
						
						$arResult["COMPANY"]["PEOPLE"][] = array(
							"ID" => $people["ID"],
							"NAME" => $people["NAME"],
							"CONTACT_PERSON" => $people["PROPERTY_CONTACT_PERSON_VALUE"],
							"PHONE" => $people["PROPERTY_PHONE_VALUE"],
							"EMAIL" => $people["PROPERTY_EMAIL_VALUE"],
							"POSITION" => $people["PROPERTY_POSITION_VALUE"],
							"GROUP" => $user_group
						);
					}
					
					if(!empty($_REQUEST["delete_people"]) && $arResult["PARTNER_ADMIN"] == "Y") {
						foreach($_REQUEST["delete_people"] as $delete) {
							unset($db_props);
							unset($email);
							$db_props = CIBlockElement::GetProperty(IB_PEOPLES, $delete, array("sort" => "asc"), Array("CODE" => "EMAIL"));
							while($edb_props_mail = $db_props->GetNext())
								if(!empty($edb_props_mail["VALUE"]))
									$email = $edb_props_mail["VALUE"];
							unset($res);
							unset($arUser);
							$res = CUser::GetList(($by="id"), ($order="desc"),array('EMAIL' => $email),array());
							if($arUser = $res->GetNext()) {
								CUser::Delete($arUser["ID"]);
								CIBlockElement::Delete($delete);
							}
						}
					}
					elseif(!empty($_REQUEST["delete_people"])) {
						ShowError(GetMessage("NOT_WRITE"));
					}
					
					if(empty($arResult["ERROR"]) && !empty($_REQUEST["COMPANY"])) 
						LocalRedirect($APPLICATION->GetCurPageParam("success=yes"));
				}
				else {
					ShowError(GetMessage("NO_COMPANY"));
					return;
				}
			}
			else {
				ShowError(GetMessage("COMPANTY_NOT_FOUND"));
				return;
			}
		}
		else {
			ShowError(GetMessage("NOT_USER_ACCESS"));
			return;
		}
	}
	else {
		ShowError(GetMessage("NOT_AUTH_USER"));
		return;
	}
	$this->IncludeComponentTemplate($componentPage);
}
?>