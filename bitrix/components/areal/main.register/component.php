<?
if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();
if(CModule::IncludeModule("iblock")) {
	if($USER->IsAuthorized()) {
		ShowNote(GetMessage("USER_AUTH"));
		return;
	}
	else {
		//уровни партнерства
		$levels = CIBlockElement::GetList(array("SORT" => "ASC"), array("IBLOCK_ID" => IB_PARTNER_LEVEL, "ACTIVE" => "Y"), false, false, array("ID", "NAME", "PROPERTY_EMAIL"));
		while($level = $levels->GetNext())
			$arResult["LEVELS"][$level["ID"]] = array("NAME" => $level["NAME"]);
		
		//статусы партнеров
		$statuses = CIBlockElement::GetList(Array("PROPERTY_RATING" => "ASC"), Array("IBLOCK_ID" => IB_STATUS_COMPANY, "ACTIVE"=>"Y"), false, false, Array("ID", "NAME"));
		while($status = $statuses->GetNext())
		  $arResult["STATUS"][$status["ID"]] = $status["NAME"];

		//получение списка городов и областей
		$arResult = array_merge($arResult, GetLocationInformation());
		
		//варианты для филиалов
		$offises = CIBlockPropertyEnum::GetList(array("SORT"=>"ASC", "NAME" => "ASC"), array("IBLOCK_ID" => IB_FILIALS, "CODE" => "office"));
		while($offise = $offises->GetNext())
			$arResult["OFFICE"][] = array("ID" => $offise["ID"], "NAME" => $offise["VALUE"]);
		
		//направления
		$sections = CIBlockSection::GetList(array("SORT" => "ASC"), array("IBLOCK_ID" => IB_PRODUCTS, "ACTIVE" => "Y", "<=DEPTH_LEVEL" => 3), false);
		while($section = $sections->GetNext())
			$sect[] = array(
				"ID" => $section["ID"],
				"NAME" => $section["NAME"],
				"IBLOCK_SECTION_ID" => $section["IBLOCK_SECTION_ID"],
				"DEPTH_LEVEL" => $section["DEPTH_LEVEL"]
			);
		foreach($sect as $depth1)
			if($depth1["DEPTH_LEVEL"] == 1)
				$arResult["SECTIONS"][] = array("ID" => $depth1["ID"], "NAME" => $depth1["NAME"], "ITEMS" => array());
		foreach($arResult["SECTIONS"] as $key => $item_depth_1)
			foreach($sect as $sec)
				if($sec["DEPTH_LEVEL"] == 2 && $sec["IBLOCK_SECTION_ID"] == $item_depth_1["ID"])
					$arResult["SECTIONS"][$key]["ITEMS"][] = array("ID" => $sec["ID"], "NAME" => $sec["NAME"]);
					
		foreach($arResult["SECTIONS"] as $key_1 => $sect1)
			foreach($sect1["ITEMS"] as $key_2 => $sect2)
				foreach($sect as $sec)
					if($sec["DEPTH_LEVEL"] == 3 && $sec["IBLOCK_SECTION_ID"] == $sect2["ID"])
						$arResult["SECTIONS"][$key_1]["ITEMS"][$key_2]["ITEMS"][] = array("ID" => $sec["ID"], "NAME" => $sec["NAME"]);

		//обязательные поля
		$arResult["REQUIRED_FILIALS"] = array("status", "region", "town", "address", "office");

		$arResult["VALUES"] = array();
		$arResult["ERRORS"] = array();

		$register_done = false;

		if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_REQUEST["register_submit_button"]) && !$USER->IsAuthorized() && bitrix_sessid_post() && !empty($_REQUEST["sessid"]) && !empty($_REQUEST["jssid"]) && $_REQUEST["sessid"] == $_REQUEST["jssid"] && !empty($_REQUEST["user"])) {
			if(COption::GetOptionString('main', 'use_encrypted_auth', 'N') == 'Y')
			{
				$sec = new CRsaSecurity();
				if(($arKeys = $sec->LoadKeys()))
				{
					$sec->SetKeys($arKeys);
					$errno = $sec->AcceptFromForm(array('REGISTER'));
					if($errno == CRsaSecurity::ERROR_SESS_CHECK)
						$arResult["ERROR"][] = GetMessage("main_register_sess_expired");
					elseif($errno < 0)
						$arResult["ERROR"][] = GetMessage("main_register_decode_err", array("#ERRCODE#"=>$errno));
				}
			}
			if($_REQUEST["user"] == "user") {
				if(empty($_REQUEST["PERSON"]["NAME"]))
					$arResult["ERROR"][] = GetMessage("NO_PERSON_NAME");
				if(empty($_REQUEST["PERSON"]["EMAIL"]) && empty($_REQUEST["PERSON"]["PHONE"]))
					$arResult["ERROR"][] = GetMessage("NO_PERSON_EMAIL_OR_PHONE");
				if(!empty($_REQUEST["PERSON"]["EMAIL"]) && !check_email($_REQUEST["PERSON"]["EMAIL"]))
					$arResult["ERROR"][] = GetMessage("NO_PERSON_EMAIL_WRONG");
			
				$rsUser = CUser::GetByLogin($_REQUEST["PERSON"]["EMAIL"]);
				if($arUser = $rsUser->Fetch())
					$arResult["ERROR"][] = GetMessage("CONTACT_PERSON_CREATED");
				if(empty($arResult["ERROR"])) {
					//создаем аккаунт для контактного лица
					$arResult["USER_VALUES"]["PASSWORD"] = randString(8);
					$arResult["USER_VALUES"]["CONFIRM_PASSWORD"] = $arResult["USER_VALUES"]["PASSWORD"];
					$arResult["USER_VALUES"]["LOGIN"] = $_REQUEST["PERSON"]["EMAIL"];
					$arResult["USER_VALUES"]["NAME"] = $_REQUEST["PERSON"]["NAME"];
					$arResult["USER_VALUES"]["EMAIL"] = $_REQUEST["PERSON"]["EMAIL"];
					$arResult["USER_VALUES"]["ACTIVE"] = "Y";
					$arResult["USER_VALUES"]["PERSONAL_PHONE"] = $_REQUEST["PERSON"]["PHONE"];
					$user = new CUser();
					$userID = $user->Add($arResult["USER_VALUES"]);
					if (intval($userID) > 0) {
						$arSend = array(
							"FULL_NAME" => $arResult["USER_VALUES"]["NAME"],
							"LOGIN" => $arResult["USER_VALUES"]["LOGIN"],
							"PASSWORD" => $arResult["USER_VALUES"]["PASSWORD"],
							"EMAIL" => $arResult["USER_VALUES"]["EMAIL"]
						);
						$event = new CEvent;
						$event->Send("ADD_USER", SITE_ID, $arSend, "Y", 93);
					
						$arSend = array(
							"USER_NAME" => $arResult["USER_VALUES"]["NAME"] ? $arResult["USER_VALUES"]["NAME"] : $arResult["USER_VALUES"]["LOGIN"],
							"USER_EMAIL" => $arResult["USER_VALUES"]["EMAIL"],
							"USER_PHONE" => $arResult["USER_VALUES"]["PERSONAL_PHONE"] ? $arResult["USER_VALUES"]["PERSONAL_PHONE"] : "Телефон не указан"
						);
						$event = new CEvent;
						$event->Send("ADD_USER", SITE_ID, $arSend, "Y", 98);
							
						LocalRedirect($APPLICATION->GetCurPageParam("success_user=Y"));
					}
					else $arResult["ERROR"][] = $user->LAST_ERROR;
				}
			}
			elseif($_REQUEST["user"] == "partner") {
				if(empty($_REQUEST["COMPANY"]["NAME"]))
					$arResult["ERROR"][] = GetMessage("NO_REQUIRED_FIELD_NAME");
				if(empty($_FILES["COMPANY_LOGO"]['name']))
					$arResult["ERROR"][] = GetMessage("NO_REQUIRED_FIELD_LOGO");
				if(empty($_REQUEST["COMPANY"]["PREVIEW_TEXT"]))
					$arResult["ERROR"][] = GetMessage("NO_REQUIRED_FIELD_PREVIEW_TEXT");
				if(strlen($_REQUEST["COMPANY"]["PREVIEW_TEXT"]) > 200)
					$arResult["ERROR"][] = GetMessage("LONG_FIELD_PREVIEW_TEXT");
				if(empty($_REQUEST["COMPANY"]["DETAIL_TEXT"]))
					$arResult["ERROR"][] = GetMessage("NO_REQUIRED_FIELD_DETAIL_TEXT");
				if(empty($_REQUEST["COMPANY"]["FILIALS"]["main"]["status"]) && count($_REQUEST["COMPANY"]["FILIALS"]["main"]["status"]) <= 0)
					$arResult["ERROR"][] = GetMessage("NO_REQUIRED_FIELD_STATUS");
				if($_REQUEST["COMPANY"]["FILIALS"]["main"]["region"] == 0)
					$arResult["ERROR"][] = GetMessage("NO_REQUIRED_FIELD_REGION");
				if($_REQUEST["COMPANY"]["FILIALS"]["main"]["town"] == 0)
					$arResult["ERROR"][] = GetMessage("NO_REQUIRED_FIELD_TOWN");
				if(empty($_REQUEST["COMPANY"]["FILIALS"]["main"]["address"]))
					$arResult["ERROR"][] = GetMessage("NO_REQUIRED_FIELD_ADDRESS");
				if(empty($_REQUEST["COMPANY"]["FILIALS"]["main"]["email"]) && empty($_REQUEST["COMPANY"]["FILIALS"]["main"]["phone"]))
					$arResult["ERROR"][] = GetMessage("NO_REQUIRED_FIELD_PHONE_EMAIL");
				if(!empty($_REQUEST["COMPANY"]["FILIALS"]["main"]["email"]) && !check_email($_REQUEST["COMPANY"]["FILIALS"]["main"]["email"]))
					$arResult["ERROR"][] = GetMessage("WRONG_FIELD_EMAIL");
				if(!empty($_REQUEST["COMPANY"]["FILIALS"]) && $_REQUEST["COMPANY"]['FILIALS_ON']!='') {
					foreach($_REQUEST["COMPANY"]["FILIALS"] as $key => $fil) {
						if($key != "main") {
							if(empty($fil["status"]) && $fil["region"] == 0 && $fil["town"] == 0 && empty($fil["address"]))
								unset($_REQUEST["COMPANY"]["FILIALS"][$key]);
							else {
								if(empty($fil["status"]))
									$status_error = GetMessage("NO_REQUIRED_FILIAL_FIELD_STATUS");
								if($fil["region"] == 0)
									$region_error = GetMessage("NO_REQUIRED_FILIAL_FIELD_REGION");
								if($fil["town"] == 0)
									$town_error = GetMessage("NO_REQUIRED_FILIAL_FIELD_TOWN");
								if(empty($fil["address"]))
									$address_error = GetMessage("NO_REQUIRED_FILIAL_FIELD_ADDRESS");
								if(empty($fil["email"]) && empty($fil["phone"]))
									$phone_email_error = GetMessage("NO_REQUIRED_FILIAL_FIELD_PHONE_EMAIL");
								if(!empty($fil["email"]) && !check_email($fil["email"]))
									$email_error = GetMessage("WRONG_FIELD_EMAIL");
							}
						}
					}
				}	
				if($status_error) $arResult["ERROR"][] = $status_error;
				if($region_error) $arResult["ERROR"][] = $region_error;
				if($town_error) $arResult["ERROR"][] = $town_error;
				if($address_error) $arResult["ERROR"][] = $address_error;
				if($phone_email_error) $arResult["ERROR"][] = $phone_email_error;
				if($email_error) $arResult["ERROR"][] = $email_error;
				if(!empty($_REQUEST["COMPANY"]["PEOPLE"]))
					foreach($_REQUEST["COMPANY"]["PEOPLE"] as $key => $people) {
						if(empty($people["PROPERTY_VALUES"]["POSITION"]) && empty($people["NAME"]) && empty($people["PROPERTY_VALUES"]["EMAIL"]) && empty($people["PROPERTY_VALUES"]["PHONE"]))
							unset($_REQUEST["COMPANY"]["PEOPLE"][$key]);
						else {
							if(empty($people["PROPERTY_VALUES"]["POSITION"]))
								$position_people_error = GetMessage("NO_REQUIRED_PEOPLE_FIELD_POSITION");
							if(empty($people["NAME"]))
								$name_people_error = GetMessage("NO_REQUIRED_PEOPLE_FIELD_NAME");
							if(empty($people["PROPERTY_VALUES"]["EMAIL"]) && empty($people["PROPERTY_VALUES"]["PHONE"]))
								$email_or_phone_people_error = GetMessage("NO_REQUIRED_PEOPLE_FIELD_EMAIL_OR_PHONE");
							if(!empty($people["PROPERTY_VALUES"]["EMAIL"]) && !check_email($people["PROPERTY_VALUES"]["EMAIL"]))
								$email_people_error = GetMessage("WRONG_EMAIL_PEOPLE");
						}
					}
				if(isset($_REQUEST["COMPANY"]["people_forum"]) && $_REQUEST["COMPANY"]["people_forum"] == 1) {
						$forums = CIBlockPropertyEnum::GetList(
							array("SORT"=>"ASC", "NAME" => "ASC"), 
							array("IBLOCK_ID" => IB_COMPANY, "CODE" => "FORUM_DESIRE")
						);
						if($forum = $forums->GetNext())
							$_REQUEST["COMPANY"]["PROPERTY_VALUES"]["FORUM_DESIRE"] = Array("VALUE" => $forum["ID"]);
					
				}
				if($position_people_error) $arResult["ERROR"][] = $position_people_error;
				if($name_people_error) $arResult["ERROR"][] = $name_people_error;
				if($email_or_phone_people_error) $arResult["ERROR"][] = $email_or_phone_people_error;
				if($email_people_error) $arResult["ERROR"][] = $email_people_error;
					
				if(empty($_REQUEST["COMPANY"]["CONTACT_PERSON"]["NAME"]))
					$arResult["ERROR"][] = GetMessage("NO_CONTACT_PERSON_NAME");
				if(empty($_REQUEST["COMPANY"]["CONTACT_PERSON"]["POSITION"]))
					$arResult["ERROR"][] = GetMessage("NO_CONTACT_PERSON_POSITION");
				if(empty($_REQUEST["COMPANY"]["CONTACT_PERSON"]["EMAIL"]))
					$arResult["ERROR"][] = GetMessage("NO_CONTACT_PERSON_EMAIL");
				if(empty($_REQUEST["COMPANY"]["CONTACT_PERSON"]["PHONE"]))
					$arResult["ERROR"][] = GetMessage("NO_CONTACT_PERSON_PHONE");
				if(!empty($_REQUEST["COMPANY"]["CONTACT_PERSON"]["EMAIL"]) && !check_email($_REQUEST["COMPANY"]["CONTACT_PERSON"]["EMAIL"]))
					$arResult["ERROR"][] = GetMessage("NO_CONTACT_PERSON_EMAIL_WRONG");
				$rsUser = CUser::GetByLogin($_REQUEST["COMPANY"]["CONTACT_PERSON"]["EMAIL"]);
				if($arUser = $rsUser->Fetch())
					$arResult["ERROR"][] = GetMessage("CONTACT_PERSON_CREATED");
				if(empty($arResult["ERROR"])) {
					$company = CIBlockElement::GetList(array(), array("IBLOCK_ID" => IB_COMPANY, "NAME" => $_REQUEST["COMPANY"]["NAME"]), false, false, array("NAME"));
					if($comp = $company->GetNext())
						$arResult["ERROR"][] = GetMessage("FOUND_COMPANY");
					else {
											
						$el = new CIBlockElement;
						$companyProps = array();
						$params = Array(
							"max_len" => "100",
							"change_case" => "L",
							"replace_space" => "_",
							"replace_other" => "_",
							"delete_repeat_replace" => "true",
							"use_google" => "false"
						);
						$arCompany = Array(
							"IBLOCK_ID" => IB_COMPANY,
							"PROPERTY_VALUES" => $_REQUEST["COMPANY"]["PROPERTY_VALUES"],
							"NAME" => $_REQUEST["COMPANY"]["NAME"],
							"CODE" => CUtil::translit($_REQUEST["COMPANY"]["NAME"], "ru", $params),
							"ACTIVE" => "N",
							"PREVIEW_PICTURE" => !empty($_FILES["COMPANY_LOGO"]) ? $_FILES["COMPANY_LOGO"] : "",
							"PREVIEW_TEXT" => $_REQUEST["COMPANY"]["PREVIEW_TEXT"],
							"PREVIEW_TEXT_TYPE" => 'text',
							"DETAIL_TEXT" => str_replace("\n\r", "<br />", $_REQUEST["COMPANY"]["DETAIL_TEXT"]),
							"DETAIL_TEXT_TYPE" => 'html'
						);
						if($id_company = $el->Add($arCompany))
						{
							if(is_array($_REQUEST["COMPANY"]["FILIALS"])) {
								foreach($_REQUEST["COMPANY"]["FILIALS"] as $key => $fil) {
									unset($arFilial);
									unset($offices);
									unset($office);
									unset($mains);
									unset($main);
									$el = new CIBlockElement;
									if($key == "main") {										
										$mains = CIBlockPropertyEnum::GetList(array("SORT"=>"ASC", "NAME" => "ASC"), array("IBLOCK_ID" => IB_FILIALS, "CODE" => "main"));
										if($main = $mains->GetNext())
											$fil["main"] = Array("VALUE" => $main["ID"]);
									}
									/*$offices = CIBlockPropertyEnum::GetList(array("SORT"=>"ASC", "NAME" => "ASC"), array("IBLOCK_ID" => IB_FILIALS, "CODE" => "office"));
									while($office = $offices->GetNext()) {
										pr($office);
										if($office["VALUE"] == $fil["office"]) {
											unset($fil["office"]);
											$fil["office"] = array("VALUE" => $office["ID"]);
											pr($fil["office"]);
										}
									}*/
									$fil["office"] = array("VALUE" => $fil["office_VALUE"]);
									$fil["company"] = $id_company;
									$arFilial = Array(
										"IBLOCK_ID"      => IB_FILIALS,
										"PROPERTY_VALUES"=> $fil,
										"NAME"           => $fil["address"],
										"ACTIVE"         => "Y"
									);
									if(!$PRODUCT_ID = $el->Add($arFilial))
										$arResult["ERROR"][] = $el->LAST_ERROR;
								}
							}
							if(empty($arResult["ERROR"])) {
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
									$people_property["COMPANY"] = $id_company;
									$people_property["POSITION"] = $people["PROPERTY_VALUES"]["POSITION"];
									$people_property["EMAIL"] = $people["PROPERTY_VALUES"]["EMAIL"];
									$people_property["PHONE"] = $people["PROPERTY_VALUES"]["PHONE"];
									$arPeople = Array(
										"IBLOCK_ID"      => IB_PEOPLES,
										"PROPERTY_VALUES"=> $people_property,
										"NAME"           => $people["NAME"]
									);
									$el = new CIBlockElement;						
									if(!$id_people = $el->Add($arPeople))
										$arResult["ERROR"][] = $el->LAST_ERROR;
								}
							}
						}
						else
							$arResult["ERROR"][] = $el->LAST_ERROR;
					}
					if(empty($arResult["ERROR"]))
						$arResult["SUCCESS"] = true;
				}

				if($arResult["SUCCESS"] == true && !empty($_REQUEST["register_submit_button"]))
				{

					$res_town = CIBlockElement::GetByID($_REQUEST["COMPANY"]["FILIALS"]["main"]["town"]);
						if($town_res = $res_town->GetNext())
  						$main_town = $town_res['NAME'];
					$res_reg = CIBlockElement::GetByID($_REQUEST["COMPANY"]["FILIALS"]["main"]["region"]);
						if($reg_res = $res_reg->GetNext())
  						$main_reg = $reg_res['NAME'];

					$people_property["COMPANY"] = $id_company;
					$people_property["POSITION"] = $_REQUEST["COMPANY"]["CONTACT_PERSON"]["POSITION"];
					$people_property["EMAIL"] = $_REQUEST["COMPANY"]["CONTACT_PERSON"]["EMAIL"];
					$people_property["PHONE"] = $_REQUEST["COMPANY"]["CONTACT_PERSON"]["PHONE"];
					$contacts_person = CIBlockPropertyEnum::GetList(
						array("SORT"=>"ASC", "NAME" => "ASC"), 
						array("IBLOCK_ID" => IB_PEOPLES, "CODE" => "CONTACT_PERSON")
					);
					if($main = $contacts_person->GetNext())				
						$people_property["CONTACT_PERSON"] = Array("VALUE" => $main["ID"]);
					$arUserContact = Array(
						"IBLOCK_ID"      => IB_PEOPLES,
						"PROPERTY_VALUES"=> $people_property,
						"NAME"           => $_REQUEST["COMPANY"]["CONTACT_PERSON"]["NAME"]
					);
					$el = new CIBlockElement;						
					if(!$id_arUserContact = $el->Add($arUserContact))
						$arResult["ERROR"][] = $el->LAST_ERROR;
					
					//создаем аккаунт для контактного лица
					$arResult["USER_VALUES"]["PASSWORD"] = randString(8);
					$arResult["USER_VALUES"]["CONFIRM_PASSWORD"] = $arResult["USER_VALUES"]["PASSWORD"];
					$arResult["USER_VALUES"]["LOGIN"] = $_REQUEST["COMPANY"]["CONTACT_PERSON"]["EMAIL"];
					$arResult["USER_VALUES"]["NAME"] = $_REQUEST["COMPANY"]["CONTACT_PERSON"]["NAME"];
					$arResult["USER_VALUES"]["EMAIL"] = $_REQUEST["COMPANY"]["CONTACT_PERSON"]["EMAIL"];
					$arResult["USER_VALUES"]["UF_COMPANY"] = $id_company;
					$arResult["USER_VALUES"]["UF_PEOPLE"] = $id_arUserContact;
					$arResult["USER_VALUES"]["ACTIVE"] = "N";
					$arResult["USER_VALUES"]["GROUP_ID"] = array(UG_PO);
					$user = new CUser();
					$userID = $user->Add($arResult["USER_VALUES"]);
					if(intval($userID) > 0) {
						//обновляем поле для контактного лица в данных о компании
						CIBlockElement::SetPropertyValuesEx($id_company, IB_COMPANY, array("CONTACT_USER" => $userID));						
						
						$register_done = true;				
						//посылаем сообщения		
						$arSend = array(
							"FULL_NAME" => $_REQUEST["COMPANY"]["CONTACT_PERSON"]["NAME"],
							"COMPANY_NAME" => $_REQUEST["COMPANY"]["NAME"],
							"LOGIN" => $arResult["USER_VALUES"]["LOGIN"],
							"PASSWORD" => $arResult["USER_VALUES"]["PASSWORD"],
							"EMAIL" => $arResult["USER_VALUES"]["EMAIL"]
						);
						$event = new CEvent;
						$event->Send("ADD_USER", SITE_ID, $arSend, "Y", 95);
						//находим всех администраторов компании ШТРИХ-М и посылаем им письма о регистрации нового партнера
						$filter = Array("GROUPS_ID" => Array(UG_AKP));
						$rsUsers = CUser::GetList(($by="name"), ($order="desc"), $filter);
						while($arUsers = $rsUsers->GetNext()) {
							if(!empty($arUsers["EMAIL"])) {
								$arSend = array(
									"FULL_NAME" => $arUsers["NAME"] ? $arUsers["NAME"] : $arUsers["LOGIN"],
									"COMPANY_NAME" => $_REQUEST["COMPANY"]["NAME"],
									"USER_NAME" => $_REQUEST["COMPANY"]["CONTACT_PERSON"]["NAME"],
									"EMAIL" => $arUsers["EMAIL"],
									"COMPANY_ID" => $id_company,
									"GOL_FIL" => $_REQUEST["COMPANY"]["FILIALS"]["main"]["address"],
									"REGION" => $main_reg,
									"CITY" => $main_town,
									"FORUM" => $_REQUEST["COMPANY"]["people_forum"] ? GetMessage("UCHASTIE_V_FORUME") : ""
								);
								$event = new CEvent;
								$event->Send("ADD_USER", SITE_ID, $arSend, "Y", 94);
							}					
						}
						
						//посылаем на email, указанный по умолчанию, сообщение о регистрации нового партнера
						$arSend = array(
							"COMPANY_NAME" => $_REQUEST["COMPANY"]["NAME"],
							"USER_NAME" => $_REQUEST["COMPANY"]["CONTACT_PERSON"]["NAME"],
							"COMPANY_ID" => $id_company,
							"GOL_FIL" => $_REQUEST["COMPANY"]["FILIALS"]["main"]["address"],
							"REGION" => $main_reg,
							"CITY" => $main_town,
							"FORUM" => $_REQUEST["COMPANY"]["people_forum"] ? GetMessage("UCHASTIE_V_FORUME") : ""
						);
						$event = new CEvent;
						$event->Send("ADD_USER", SITE_ID, $arSend, "Y", 99);
						LocalRedirect($APPLICATION->GetCurPageParam("success_partner=Y"));
						
					}
					else $arResult["ERROR"][] = $user->LAST_ERROR;
				}
			}
		}
		
		$this->IncludeComponentTemplate();
	}
}
?>