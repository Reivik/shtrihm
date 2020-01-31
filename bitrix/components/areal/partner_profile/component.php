<?
if(CModule::IncludeModule("iblock")) {
	if($USER->IsAuthorized()) {
		if(isset($_REQUEST["delete"]) && $_REQUEST["delete"] == "yes") {
			ShowError(GetMessage("DELETING_COMPANY"));
			return;
		}
		else {
			if(in_array(UG_AKP, CUser::GetUserGroup($USER->GetID())) || in_array(UG_PO, CUser::GetUserGroup($USER->GetID()))) {
				if(in_array(UG_AKP, CUser::GetUserGroup($USER->GetID())) && isset($GLOBALS["ADMIN_CHOOSE_COMPANY"]) && $GLOBALS["ADMIN_CHOOSE_COMPANY"] > 0) {
					$company = $GLOBALS["ADMIN_CHOOSE_COMPANY"];
					$arResult["PARTNER_ADMIN"] = "Y";
					$componentPage = "editing";
				}
				elseif(in_array(UG_PO, CUser::GetUserGroup($USER->GetID()))) {
					$rsUsers = CUser::GetList(($by="id"), ($order="desc"), array("ID" => $USER->GetID()), array("SELECT" => array("UF_*")));
					$arUsers = $rsUsers->GetNext();
					$company = $arUsers["UF_COMPANY"];
					$componentPage = "view";
				}
				if(!$company && in_array(UG_AKP, CUser::GetUserGroup($USER->GetID()))) {
					ShowError(GetMessage("NOT_FILTER"));
					return;
				}
				elseif($company > 0) {
					if(in_array(UG_AKP, CUser::GetUserGroup($USER->GetID())) && isset($GLOBALS["ADMIN_CHOOSE_COMPANY"]) && $GLOBALS["ADMIN_CHOOSE_COMPANY"] > 0) 
					{
						$res = CIBlockElement::GetList(
							array(), 
							array("IBLOCK_ID" => IB_COMPANY, "ID" => $company), 
							false, 
							false, 
							array(
								"ID",
								"NAME",
								"PROPERTY_REGIONAL_MANAGER",
								"PROPERTY_REGIONAL_MANAGER.NAME",
								"PROPERTY_SALES_MANAGER",
								"PROPERTY_PARTNER_AGREEMENT",
								"PROPERTY_TERM_AGREEMENT",
								"PROPERTY_SUPPLY_AGREEMENT",
								"PROPERTY_TERM_SUPP_AGR",
								"PROPERTY_LICENSE_AGREEMENT",
								"PROPERTY_TERM_LICENSE_AGR",
								"PROPERTY_PARTNERS_LEVELS",
								"PROPERTY_STATUS",
								"PROPERTY_FORUM_DESIRE",
								"PROPERTY_FORUM",
								"PROPERTY_CONTACT_USER",
								"ACTIVE"
							)
						);
						if($element = $res->GetNext()) {
							//менеджеры
							$managers = CIBlockElement::GetList(array("NAME" => "ASC"), array("IBLOCK_ID" => IB_MANAGERS, "ACTIVE" => "Y"), false, false, array("ID", "NAME", "PROPERTY_PHONE", "PROPERTY_EMAIL", "PROPERTY_SKYPE", "PROPERTY_ICQ"));
							while($manager = $managers->GetNext()) {
								$arResult['MANAGERS'][] = array("ID" => $manager["ID"], "NAME" => $manager["NAME"].", email: ".($manager["PROPERTY_EMAIL_VALUE"] ? $manager["PROPERTY_EMAIL_VALUE"] : "не указан").", тел.: ".($manager["PROPERTY_PHONE_VALUE"] ? $manager["PROPERTY_PHONE_VALUE"] : "не указан"));
							}
							//уровни партнерства
							$levels = CIBlockElement::GetList(array("SORT" => "ASC"), array("IBLOCK_ID" => IB_PARTNER_LEVEL, "ACTIVE" => "Y"), false, false, array("ID", "NAME", "PROPERTY_EMAIL"));
							while($level = $levels->GetNext())
								$arResult["LEVELS"][$level["ID"]] = $level["NAME"];
						
							$levels = CIBlockElement::GetList(array("SORT" => "ASC"), array("IBLOCK_ID" => IB_PARTNER_LEVEL, "ACTIVE" => "Y"), false, false, array("IBLOCK_ID", "ID", "NAME"));
							while($lev = $levels->GetNext())
								$Levels_company[$lev["ID"]] = $lev["NAME"];
										
							if(!empty($element["PROPERTY_STATUS_VALUE"])) {
								foreach($element["PROPERTY_STATUS_VALUE"] as $status) {
									unset($statuses);
									unset($sta);
									$statuses = CIBlockElement::GetList(array(), array("IBLOCK_ID" => IB_STATUS_COMPANY, "ID" => $status, "ACTIVE" => "Y"), false, false, array("IBLOCK_ID", "ID", "NAME", "PREVIEW_PICTURE"));
									if($sta = $statuses->GetNext())
										$Status_company[$sta["ID"]] = $sta["NAME"];
								}
							}
							$arResult["COMPANY"] = array(
								"NAME" => $element["NAME"],
								"ACTIVE" => $element["ACTIVE"],
								"REGIONAL_MANAGER" => $element["PROPERTY_REGIONAL_MANAGER_VALUE"],
								"SALES_MANAGER" => $element["PROPERTY_SALES_MANAGER_VALUE"],
								"PARTNER_AGREEMENT" => $element["PROPERTY_PARTNER_AGREEMENT_VALUE"],
								"TERM_AGREEMENT" => $element["PROPERTY_TERM_AGREEMENT_VALUE"],
								"SUPPLY_AGREEMENT" => $element["PROPERTY_SUPPLY_AGREEMENT_VALUE"],
								"TERM_SUPP_AGR" => $element["PROPERTY_TERM_SUPP_AGR_VALUE"],
								"LICENSE_AGREEMENT" => $element["PROPERTY_LICENSE_AGREEMENT_VALUE"],
								"TERM_LICENSE_AGR" => $element["PROPERTY_TERM_LICENSE_AGR_VALUE"],
								"PARTNER_LEVELS" => $Levels_company,
								"STATUS" => $Status_company,
								"FORUM" => $element["PROPERTY_FORUM_VALUE"],
								"FORUM_DESIRE" => $element["PROPERTY_FORUM_DESIRE_VALUE"],
								"CONTACT_USER" => $element["PROPERTY_CONTACT_USER_VALUE"],
								"PARTNER_LEVELS_VALUES" => $element["PROPERTY_PARTNERS_LEVELS_VALUE"],
							);
							//получаем контактное лицо данной компании
							$rsUsers = CUser::GetList(($by="id"), ($order="desc"), array("UF_COMPANY" => $company), array("SELECT" => array("UF_*")));
							while($arUsers = $rsUsers->GetNext()) {
								unset($arGroups);
								$arGroups = CUser::GetUserGroup($arUsers["ID"]);
								if(in_array(UG_PO, $arGroups)) {
									$users_contact_person[] = array(
										"NAME" => $arUsers["NAME"] ? $arUsers["NAME"] : $arUsers["LOGIN"],
										"EMAIL" => $arUsers["EMAIL"]								
									);
								}
							}
						}
						else {
							ShowError(GetMessage("NO_COMPANY"));
							return;
						}
						
						
						if(!empty($_REQUEST["changeCompany"]) && $_REQUEST["changeCompany"] == "send" && bitrix_sessid_post() && !empty($_REQUEST["sessid"]) && !empty($_REQUEST["jssid"]) && $_REQUEST["sessid"] == $_REQUEST["jssid"]) {
							
							$el = new CIBlockElement;
							if(isset($_REQUEST["delete"]) && $_REQUEST["delete"] == 1) {
								//удалить все филиалы
								$offises = CIBlockElement::GetList(array(), array("IBLOCK_ID" => IB_FILIALS, "PROPERTY_COMPANY" => $company), false, false, array("ID", "PROPERTY_COMPANY"));
								while($offise = $offises->GetNext()) {
									//pr($offise);
									CIBlockElement::Delete($offise["ID"]);
								}
								//удалить сотрудников
								$peoples = CIBlockElement::GetList(array(), array("IBLOCK_ID" => IB_PEOPLES, "PROPERTY_COMPANY" => $company), false, false,	array("ID", "PROPERTY_COMPANY"));
								while($people = $peoples->GetNext()) {
									//pr($people);
									CIBlockElement::Delete($people["ID"]);
								}
								//удалить пользователей сотрудников
								$users = CUser::GetList(($by="id"), ($order="desc"), array("UF_COMPANY" => $company), array(), array("UF_COMPANY"));
								while($user = $users->GetNext()) {
									//pr($user);
									CUser::Delete($user["ID"]);
								}
								CIBlockElement::Delete($company);
								LocalRedirect($APPLICATION->GetCurPageParam("success=yes&delete=yes"));
							}
							else {
								//обновление компании, если партнерство подтверждено
								$arCompany = Array(
									"IBLOCK_ID" => IB_COMPANY,
									"ACTIVE" => ($_REQUEST["confirmed_partner"] == 1 ? "Y" : "N")
								);
								if(!$id_company = $el->Update($company, $arCompany)) {
									$arResult["ERROR"][] = $el->LAST_ERROR;
								}
								else {
									CIBlockElement::SetPropertyValuesEx($company, false, $_REQUEST["PROPERTY"]);
									//активация контактного лица
									$user_id = $arResult["COMPANY"]["CONTACT_USER"];
									$user = new CUser;
									$fields = Array("ACTIVE" => "Y");
									$user->Update($user_id, $fields);
								}
								
								//подтверждение пользователей этой компании
								
								
								$contacts_person = CIBlockPropertyEnum::GetList(
									array("SORT"=>"ASC", "NAME" => "ASC"), 
									array("IBLOCK_ID" => IB_COMPANY, "CODE" => "FORUM")
								);
								if($main = $contacts_person->GetNext())
									if($_REQUEST["partner_forum_yes"] == UG_FORUM) 
										$property["FORUM"] = Array("VALUE" => $main["ID"]);
									elseif($_REQUEST["partner_forum_no"] == UG_FORUM) 
										$property["FORUM"] = Array("VALUE" => "-1");
								
								CIBlockElement::SetPropertyValuesEx($company, false, $property);
								
								if($arResult["COMPANY"]["ACTIVE"] == "N" && $_REQUEST["confirmed_partner"] == 1) {
									
									foreach($users_contact_person as $ucp) {
										$arSend = array(
											"EMAIL" => $ucp["EMAIL"],
											"CONTACT_NAME" => $ucp["NAME"],
											"COMPANY_NAME" => $arResult["COMPANY"]["NAME"]
										);
										$event = new CEvent;
										$event->Send("ADD_USER", SITE_ID, $arSend, "N", 97);
									}
								}
								if(empty($arResult["ERROR"]))
									LocalRedirect($APPLICATION->GetCurPageParam("success=yes"));
							}
						}
					}
					elseif(in_array(UG_PO, CUser::GetUserGroup($USER->GetID()))) {
						$res = CIBlockElement::GetList(
							array(), 
							array("IBLOCK_ID" => IB_COMPANY, "ID" => $company), 
							false, 
							false, 
							array(
								"NAME",
								"PROPERTY_REGIONAL_MANAGER",
								"PROPERTY_REGIONAL_MANAGER.NAME",
								"PROPERTY_REGIONAL_MANAGER.PROPERTY_PHONE",
								"PROPERTY_REGIONAL_MANAGER.PROPERTY_EMAIL",
								"PROPERTY_REGIONAL_MANAGER.PROPERTY_SKYPE",
								"PROPERTY_REGIONAL_MANAGER.PROPERTY_ICQ",
								"PROPERTY_SALES_MANAGER",
								"PROPERTY_SALES_MANAGER.NAME",
								"PROPERTY_SALES_MANAGER.PROPERTY_PHONE",
								"PROPERTY_SALES_MANAGER.PROPERTY_EMAIL",
								"PROPERTY_SALES_MANAGER.PROPERTY_SKYPE",
								"PROPERTY_SALES_MANAGER.PROPERTY_ICQ",
								"PROPERTY_PARTNER_AGREEMENT",
								"PROPERTY_TERM_AGREEMENT",
								"PROPERTY_SUPPLY_AGREEMENT",
								"PROPERTY_TERM_SUPP_AGR",
								"PROPERTY_LICENSE_AGREEMENT",
								"PROPERTY_TERM_LICENSE_AGR"
							)
						);
						if($element = $res->GetNext()) {					
							$arResult["COMPANY"] = array(
								"NAME" => $element["NAME"],
								"REGIONAL_MANAGER" => array(
									"ID" => $element["PROPERTY_REGIONAL_MANAGER_VALUE"],
									"NAME" => $element["PROPERTY_REGIONAL_MANAGER_NAME"],
									"PHONE" => $element["PROPERTY_REGIONAL_MANAGER_PROPERTY_PHONE_VALUE"],
									"EMAIL" => $element["PROPERTY_REGIONAL_MANAGER_PROPERTY_EMAIL_VALUE"],
									"SKYPE" => $element["PROPERTY_REGIONAL_MANAGER_PROPERTY_SKYPE_VALUE"],
									"ICQ" => $element["PROPERTY_REGIONAL_MANAGER_PROPERTY_ICQ_VALUE"]
								),
								"SALES_MANAGER" => array(
									"ID" => $element["PROPERTY_SALES_MANAGER_VALUE"],
									"NAME" => $element["PROPERTY_SALES_MANAGER_NAME"],
									"PHONE" => $element["PROPERTY_SALES_MANAGER_PROPERTY_PHONE_VALUE"],
									"EMAIL" => $element["PROPERTY_SALES_MANAGER_PROPERTY_EMAIL_VALUE"],
									"SKYPE" => $element["PROPERTY_SALES_MANAGER_PROPERTY_SKYPE_VALUE"],
									"ICQ" => $element["PROPERTY_SALES_MANAGER_PROPERTY_ICQ_VALUE"]
								),
								"PARTNER_AGREEMENT" => $element["PROPERTY_PARTNER_AGREEMENT_VALUE"],
								"TERM_AGREEMENT" => $element["PROPERTY_TERM_AGREEMENT_VALUE"],
								"SUPPLY_AGREEMENT" => $element["PROPERTY_SUPPLY_AGREEMENT_VALUE"],
								"TERM_SUPP_AGR" => $element["PROPERTY_TERM_SUPP_AGR_VALUE"],
								"LICENSE_AGREEMENT" => $element["PROPERTY_LICENSE_AGREEMENT_VALUE"],
								"TERM_LICENSE_AGR" => $element["PROPERTY_TERM_LICENSE_AGR_VALUE"]
							);
						}
					}
				}
			}
			else {
				ShowError(GetMessage("NOT_USER_ACCESS"));
				return;
			}
		}
	}
	else {
		ShowError(GetMessage("NOT_AUTH_USER"));
		return;
	}
	$this->IncludeComponentTemplate($componentPage);
}
?>