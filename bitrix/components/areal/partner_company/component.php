<?
if(CModule::IncludeModule("iblock")) {
	if($USER->IsAuthorized()) {
		if(in_array(UG_AKP, CUser::GetUserGroup($USER->GetID())) || 
			in_array(UG_PP, CUser::GetUserGroup($USER->GetID())) ||
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
				if(!empty($_REQUEST["COMPANY"]) && $arResult["PARTNER_ADMIN"] == "Y" && bitrix_sessid_post() && !empty($_REQUEST["sessid"]) && !empty($_REQUEST["jssid"]) && $_REQUEST["sessid"] == $_REQUEST["jssid"]) {
					if(empty($_REQUEST["COMPANY"]["NAME"]))
						$arResult["ERROR"][] = GetMessage("NO_REQUIRED_FIELD_NAME");
					if(empty($_REQUEST["COMPANY"]["PROPERTY_VALUES"]["DIRECTION"]))
						$arResult["ERROR"][] = GetMessage("NO_REQUIRED_FIELD_DIRECTION");
					if(empty($_REQUEST["COMPANY"]["PREVIEW_TEXT"]))
						$arResult["ERROR"][] = GetMessage("NO_REQUIRED_FIELD_PREVIEW_TEXT");
					if(strlen($_REQUEST["COMPANY"]["PREVIEW_TEXT"]) > 200)
						$arResult["ERROR"][] = GetMessage("LONG_FIELD_PREVIEW_TEXT");
					if(empty($_REQUEST["COMPANY"]["DETAIL_TEXT"]))
						$arResult["ERROR"][] = GetMessage("NO_REQUIRED_FIELD_DETAIL_TEXT");
					if($_REQUEST["COMPANY"]["FILIALS"]["main"]["status"] == 0)
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
					foreach($_REQUEST["COMPANY"]["FILIALS"] as $key => $fil) {
						if($key != "main") {
							if($fil["status"] == 0)
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
					if($status_error) $arResult["ERROR"][] = $status_error;
					if($region_error) $arResult["ERROR"][] = $region_error;
					if($town_error) $arResult["ERROR"][] = $town_error;
					if($address_error) $arResult["ERROR"][] = $address_error;
					if($phone_email_error) $arResult["ERROR"][] = $phone_email_error;
					if($email_error) $arResult["ERROR"][] = $email_error;
					
					if(empty($arResult["ERROR"]) && !empty($_REQUEST["COMPANY"])) {
						$el = new CIBlockElement;
						$arCompany = Array(
							"IBLOCK_ID" => IB_COMPANY,
							//"PROPERTY_VALUES" => $_REQUEST["COMPANY"]["PROPERTY_VALUES"],
							"NAME" => $_REQUEST["COMPANY"]["NAME"],
							"PREVIEW_TEXT" => str_replace("\n\r", "<br />", $_REQUEST["COMPANY"]["PREVIEW_TEXT"]),
							"DETAIL_TEXT" => str_replace("\n\r", "<br />", $_REQUEST["COMPANY"]["DETAIL_TEXT"]),
							"PREVIEW_PICTURE" => !empty($_FILES["COMPANY_LOGO"]) ? $_FILES["COMPANY_LOGO"] : ""
						);
						if(!$id_company = $el->Update($company, $arCompany)) {
							$arResult["ERROR"][] = $el->LAST_ERROR;
						}
						else {
							CIBlockElement::SetPropertyValuesEx($company, false, $_REQUEST["COMPANY"]["PROPERTY_VALUES"]);
							if(!empty($_REQUEST["COMPANY"]["FILIALS"])) {
								foreach($_REQUEST["COMPANY"]["FILIALS"] as $key => $fil) {
									unset($arFilial);
									unset($mains);
									unset($main);
									$el = new CIBlockElement;

									if($key == "main") {										
										$mains = CIBlockPropertyEnum::GetList(array("SORT"=>"ASC", "NAME" => "ASC"), array("IBLOCK_ID" => IB_FILIALS, "CODE" => "main"));
										if($main = $mains->GetNext())
											$fil["main"] = Array("VALUE" => $main["ID"]);
									}
									
									$offices = CIBlockPropertyEnum::GetList(array("SORT"=>"ASC", "NAME" => "ASC"), array("IBLOCK_ID" => IB_FILIALS, "CODE" => "office"));
									while($office = $offices->GetNext())
										if($office["VALUE"] == $fil["office"])
											$fil["office"] = Array("VALUE" => $office["ID"]);
									$fil["company"] = $company;
									
									$arFilial = Array(
										"IBLOCK_ID"      => IB_FILIALS,
										"PROPERTY_VALUES"=> $fil,
										"NAME"           => $fil["address"],
										"ACTIVE"         => "Y"
									);
									if(isset($fil["id"]) && $fil["id"] > 0) {
										if(!$id_company = $el->Update($fil["id"], $arFilial))
											$arResult["ERROR"][] = $el->LAST_ERROR;
									}
									else {
										if(!$PRODUCT_ID = $el->Add($arFilial))
											$arResult["ERROR"][] = $el->LAST_ERROR;
									}
								}
							}
						}
						if(!empty($_REQUEST["delete_filial"])) {
							foreach($_REQUEST["delete_filial"] as $delete) {
								CIBlockElement::Delete($delete);
							}
						}
					}
				}
				if(empty($arResult["ERROR"]) && !empty($_REQUEST["COMPANY"]) && $arResult["PARTNER_ADMIN"] == "Y")
					LocalRedirect($APPLICATION->GetCurPageParam("success=yes", array("success"), false));
				
				$res = CIBlockElement::GetList(	
					array(), 
					array("IBLOCK_ID" => IB_COMPANY, "ID" => $company), 
					false, 
					false, 
					array(
						"ID",
						"NAME", 
						"PREVIEW_TEXT",
						"PREVIEW_PICTURE",
						"DETAIL_TEXT",
						"PROPERTY_DIRECTION",
						"PROPERTY_SLOGAN",
						"PROPERTY_NUMBER_OF_STAFF",
						"PROPERTY_OBOROT",
						"PROPERTY_SITE",
						"PROPERTY_PHOTO",
						"PROPERTY_LEGAL_ADDRESS",
						"PROPERTY_INN",
						"PROPERTY_KPP",
						"PROPERTY_PAYMENT_ACCOUNT",
						"PROPERTY_CORR_ACCOUN",
						"PROPERTY_BIK",
						"PROPERTY_BANK",
						"PROPERTY_PARTNERS_LEVELS"
					)
				);
				if($element = $res->GetNext()) {
					//уровни партнерства
					$levels = CIBlockElement::GetList(array(), array("IBLOCK_ID" => IB_PARTNER_LEVEL, "ACTIVE" => "Y"), false, false, array("ID", "NAME", "PROPERTY_EMAIL"));
					while($level = $levels->GetNext())
						$arResult["LEVELS"][$level["ID"]] = array("NAME" => $level["NAME"], "EMAIL" => $level["PROPERTY_EMAIL_VALUE"]);
					
					//статусы партнеров
					$statuses = CIBlockElement::GetList(Array("PROPERTY_RATING" => "ASC"), Array("IBLOCK_ID" => IB_STATUS_COMPANY, "ACTIVE"=>"Y"), false, false, Array("ID", "NAME"));
					while($status = $statuses->GetNext())
					  $arResult["STATUS"][$status["ID"]] = $status["NAME"];

					//получение списка городов и областей
					$arResult = array_merge($arResult, GetLocationInformation());
					
					//варианты для филиалов
					$offises = CIBlockPropertyEnum::GetList(array("SORT"=>"ASC", "NAME" => "ASC"), array("IBLOCK_ID" => IB_FILIALS, "CODE" => "office"));
					while($offise = $offises->GetNext())
						$arResult["OFFICE"][] = $offise["VALUE"];
						if(!empty($element["PROPERTY_PARTNERS_LEVELS_VALUE"])) {
							foreach($element["PROPERTY_PARTNERS_LEVELS_VALUE"] as $level) {
								unset($levels);
								unset($lev);
								$levels = CIBlockElement::GetList(array(), array("IBLOCK_ID" => IB_PARTNER_LEVEL, "ID" => $level), false, false, array("ID", "NAME"));
								if($lev = $levels->GetNext())
									$Levels_company[$lev["ID"]] = $lev["NAME"];
							}
						}
					$arResult["COMPANY"] = array(
						"NAME" => $element["NAME"],
						"PREVIEW_TEXT" => $element["PREVIEW_TEXT"],
						"DETAIL_TEXT" => $element["DETAIL_TEXT"],
						"PREVIEW_PICTURE" => CFile::ResizeImageGet( 
							$element["PREVIEW_PICTURE"], 
							array("width" => 164, "height" => 166),
							BX_RESIZE_IMAGE_PROPORTIONAL_ALT,
							true 
						),
						"SLOGAN" => $element["PROPERTY_SLOGAN_VALUE"],
						"NUMBER_OF_STAFF" => $element["PROPERTY_NUMBER_OF_STAFF_VALUE"],
						"OBOROT" => $element["PROPERTY_OBOROT_VALUE"],
						"SITE" => $element["PROPERTY_SITE_VALUE"],
						"LEGAL_ADDRESS" => $element["PROPERTY_LEGAL_ADDRESS_VALUE"],
						"INN" => $element["PROPERTY_INN_VALUE"],
						"KPP" => $element["PROPERTY_KPP_VALUE"],
						"PAYMENT_ACCOUNT" => $element["PROPERTY_PAYMENT_ACCOUNT_VALUE"],
						"CORR_ACCOUN" => $element["PROPERTY_CORR_ACCOUN_VALUE"],
						"BIK" => $element["PROPERTY_BIK_VALUE"],
						"BANK" => $element["PROPERTY_BANK_VALUE"],
						"PARTNERS_LEVELS" => $Levels_company,
						"DIRECTION" => $element["PROPERTY_DIRECTION_VALUE"]
					);
					$filials = CIBlockElement::GetList(
						array("ID" => "ASC"), 
						array("IBLOCK_ID" => IB_FILIALS, "ACTIVE" => "Y", "PROPERTY_company" => $company), 
						false, 
						false, 
						array(
							"ID",
							"PROPERTY_company", 
							"PROPERTY_region",
							"PROPERTY_town",
							"PROPERTY_address",
							"PROPERTY_status",
							"PROPERTY_phone",
							"PROPERTY_email",
							"PROPERTY_office",
							"PROPERTY_main",
						)
					);
					while($filial = $filials->GetNext()) {
						if($filial["PROPERTY_MAIN_VALUE"])
							$arResult["COMPANY"]["FILIALS"]["main"] = array(
								"id" => $filial["ID"],
								"status" => $filial["PROPERTY_STATUS_VALUE"],
								"region" => $filial["PROPERTY_REGION_VALUE"],
								"town" => $filial["PROPERTY_TOWN_VALUE"],
								"address" => $filial["PROPERTY_ADDRESS_VALUE"],
								"phone" => $filial["PROPERTY_PHONE_VALUE"],
								"email" => $filial["PROPERTY_EMAIL_VALUE"],
								"office" => $filial["PROPERTY_OFFICE_VALUE"]
							);
						else
							$arResult["COMPANY"]["FILIALS"][$filial["ID"]] = array(
								"id" => $filial["ID"],
								"status" => $filial["PROPERTY_STATUS_VALUE"],
								"region" => $filial["PROPERTY_REGION_VALUE"],
								"town" => $filial["PROPERTY_TOWN_VALUE"],
								"address" => $filial["PROPERTY_ADDRESS_VALUE"],
								"phone" => $filial["PROPERTY_PHONE_VALUE"],
								"email" => $filial["PROPERTY_EMAIL_VALUE"],
								"office" => $filial["PROPERTY_OFFICE_VALUE"]
							);
					}
					
					/*//направления
					$sections = CIBlockSection::GetList(array("SORT" => "ASC"), array("IBLOCK_ID" => IB_PRODUCTS, "ACTIVE" => "Y"), false);
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
					*/			
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
				}
				else {
					ShowError(GetMessage("NO_COMPANY"));
					return;
				}
			}
		}
		else {
			ShowError(GetMessage("NOT_USER_ACCESS"));
			$APPLICATION->SetTitle("Авторизация");
			$APPLICATION->IncludeComponent(
				"bitrix:system.auth.form",
				"",
				Array(
					"REGISTER_URL" => "/partners_info/registration/",
					"FORGOT_PASSWORD_URL" => "/login/change_password.php",
					"PROFILE_URL" => "/personal/",
					"SHOW_ERRORS" => "Y"
				),
				false
			);
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