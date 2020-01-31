<?
if(CModule::IncludeModule("iblock")) {
	if($USER->IsAuthorized()) {
		if(in_array(UG_AKP, CUser::GetUserGroup($USER->GetID())) || 
			in_array(UG_PP, CUser::GetUserGroup($USER->GetID())) ||
				in_array(UG_PO, CUser::GetUserGroup($USER->GetID())) ||
					in_array(UG_YC, CUser::GetUserGroup($USER->GetID())) ||
						in_array(UG_TP, CUser::GetUserGroup($USER->GetID()))
		) {
			$APPLICATION->SetPageProperty("SHOW_BANNERS", "Y");
			$arResult["MONTH"] = array(
				"01" => "январь",
				"02" => "февраль",
				"03" => "март",
				"04" => "апрель",
				"05" => "май",
				"06" => "июнь",
				"07" => "июль",
				"08" => "август",
				"09" => "сентябрь",
				"10" => "октябрь",
				"11" => "ноябрь",
				"12" => "декабрь"
			);
			$property_enums = CIBlockPropertyEnum::GetList(
				array("DEF"=>"DESC", "SORT"=>"ASC"), 
				array("IBLOCK_ID" => IB_INTRO, "CODE" => "LOCATION")
			);
			while($enum_fields = $property_enums->GetNext())
				$arResult["LOCATION"][] = array("ID" => $enum_fields["ID"], "NAME" => $enum_fields["VALUE"]);
			
			$types_intro = CIBlockPropertyEnum::GetList(
				array("DEF"=>"DESC", "SORT"=>"ASC"), 
				array("IBLOCK_ID" => IB_INTRO, "CODE" => "TYPE")
			);
			while($type_intro = $types_intro->GetNext())
				$arResult["TYPE_INTRO"][] = array("ID" => $type_intro["ID"], "NAME" => $type_intro["VALUE"]);
			$types_intro = CIBlockPropertyEnum::GetList(
				array("DEF"=>"DESC", "SORT"=>"ASC"), 
				array("IBLOCK_ID" => IB_INTRO, "CODE" => "TYPE_ACTIVITY")
			);
			while($type_intro = $types_intro->GetNext())
				$arResult["TYPE_ACTIVITY"][] = array("ID" => $type_intro["ID"], "NAME" => $type_intro["VALUE"]);
			$arResult = array_merge($arResult, GetLocationInformation());
			$rsUsers = CUser::GetList(($by="id"), ($order="desc"), array("ID" => $USER->GetID()), array("SELECT" => array("UF_*")));
			$arUsers = $rsUsers->GetNext();
			$arResult["PARTNER"] = $arUsers["UF_COMPANY"];			
			$arResult["COMPANY_PEOPLE"] = $arUsers["UF_PEOPLE"];
			if($arResult["COMPANY_PEOPLE"]) {
				$peoples = CIBlockElement::GetList(array(), array("IBLOCK_ID" => IB_PEOPLES, "ID" => $arResult["COMPANY_PEOPLE"], "ACTICE" => "Y"), false, false, array("NAME", "PROPERTY_POSITION", "PROPERTY_EMAIL", "PROPERTY_PHONE"));
				if($people = $peoples->GetNext()) {
					$arResult["COMPANY_PARTNER"] = array(
						"NAME" => $people["NAME"],
						"POSITION" => $people["PROPERTY_POSITION_VALUE"],
						"EMAIL" => $people["PROPERTY_EMAIL_VALUE"],
						"PHONE" => $people["PROPERTY_PHONE_VALUE"]
					);
				}
			}
			
			// построение списка разделов и продуктов
			$types = CIBlockPropertyEnum::GetList(
				array("DEF"=>"DESC", "SORT"=>"ASC"), 
				array("IBLOCK_ID" => IB_PRODUCTS, "CODE" => "type")
			);
			while($type = $types->GetNext()) {
				unset($sects);
				unset($sect);
				unset($sections);
				$sects = CIBlockSection::GetList(array("SORT" => "ASC", "NAME" => "ASC"), array("IBLOCK_ID" =>IB_PRODUCTS, "ACTIVE" => "Y"), true, array("NAME", "ID", "DEPTH_LEVEL", "IBLOCK_SECTION_ID"));
				while($sect = $sects->GetNext()) {
					unset($lists);
					$lists = CIBlockElement::GetList(array(), array("IBLOCK_ID" => IB_PRODUCTS, "ACTIVE" => "Y", "INCLUDE_SUBSECTIONS" => "Y", "SECTION_ID" => $sect["ID"], "PROPERTY_TYPE_VALUE" => $type["VALUE"]), array(), false, array());		
					if($lists > 0)
						$sections[] = $sect;
				}
				$arResult["PRODUCTS"][$type["EXTERNAL_ID"]] = getTreeList($sections, $type["VALUE"]);
				$arResult["TYPES"][$type["EXTERNAL_ID"]] = $type["VALUE"];
			}			
			//компании-партнеры
			$companies = CIBlockElement::GetList(
				array("SORT" => "ASC"), 
				array("IBLOCK_ID" => IB_COMPANY, "ACTIVE" => "Y"),
				false, 
				false, 
				array("NAME", "ID", "PREVIEW_PICTURE")
			);
			while($company = $companies->GetNext())
				$arResult["PARTNERS"][] = array(
					"ID" => $company["ID"],
					"NAME" => $company["NAME"],
					"PREVIEW_PICTURE" => CFile::ResizeImageGet( 
						$company["PREVIEW_PICTURE"], 
						array("width" => 58, "height" => 58), 
						BX_RESIZE_IMAGE_PROPORTIONAL_ALT,
						true 
					)
				);
			//клиенты
			$clients = CIBlockElement::GetList(
				array("NAME" => "ASC"), 
				array("IBLOCK_ID" => IB_CLIENTS, "ACTIVE" => "Y"),
				false, 
				false, 
				array("NAME", "ID")
			);
			while($client = $clients->GetNext())
				$arResult["CLIENTS"][] = array("ID" => $client["ID"], "NAME" => $client["NAME"]);
			//решения
			$solutions = CIBlockElement::GetList(
				array("NAME" => "ASC"), 
				array("IBLOCK_ID" => IB_SOLUTIONS, "ACTIVE" => "Y"),
				false, 
				false, 
				array("NAME", "ID")
			);
			while($solution = $solutions->GetNext())
				$arResult["SOLUTIONS"][] = array("ID" => $solution["ID"], "NAME" => $solution["NAME"]);
				
			if(!empty($_REQUEST["submit"]) && bitrix_sessid_post() && !empty($_REQUEST["sessid"]) && !empty($_REQUEST["jssid"]) && $_REQUEST["sessid"] == $_REQUEST["jssid"]) {
				$require_properties = array(
					"TYPE",
					"COUNTRY",
					"REGION",
					"CITY",
					"ADDRESS",
					"LOCATION",
					//"CLIENT",
					"SOLUTION",
					"SERVICES",
					"CONTACT_FIO",
					"CONTACT_POSITION",
					"CONTACT_PHONE",
					"CONTACT_EMAIL",
				);
				foreach($require_properties as $prop)
					if(!$_REQUEST["INTRODUCTION"]["PROPERTY"][$prop])
						$arResult["ERROR"][] = GetMessage("EMPTY_".$prop);
				if(!$_REQUEST["INTRODUCTION"]["NAME"])
					$arResult["ERROR"][] = GetMessage("EMPTY_NAME");
				if(!$_REQUEST["INTRODUCTION"]["PREVIEW_TEXT"])
					$arResult["ERROR"][] = GetMessage("EMPTY_PREVIEW_TEXT");
				$flag = 0;
				foreach($arResult["TYPES"] as $t => $type)
					if(count($_REQUEST["INTRODUCTION"]["PROPERTY"][$t]) > 0)
						$flag = 1;
				if($flag == 0)
					$arResult["ERROR"][] = GetMessage("EMPTY_PRODUCT");
				
				
				//фото
				if($_FILES["PREVIEW_PHOTO"]["error"] != 0)
					$arResult["ERROR"][] = GetMessage("EMPTY_PHOTO");
					
				if(!$_REQUEST["day_from"] && !$_REQUEST["month_from"] && !$_REQUEST["year_from"])
					$arResult["ERROR"][] = GetMessage("EMPTY_DATE");
				
				
				$property = $_REQUEST["INTRODUCTION"]["PROPERTY"];
				$dop_chars = $property["DOP_CHARS"];
				unset($property["DOP_CHARS"]);
				$n = 0;
				if(!empty($dop_chars)) {
					foreach($dop_chars as $key => $dc) {
						$n++;
						$property["DOP_CHARS"]["n".$n] = Array("VALUE" => $dc["DESC"], "DESCRIPTION" => $dc["VALUE"]);
					}
				}
				$SERVICES = $property["SERVICES"];
				unset($property["SERVICES"]);
				$property["SERVICES"] = array("VALUE" => array("TEXT" => $SERVICES, "TYPE" => "text"));	
				
				foreach($_FILES as $key => $file) {
					if (strpos($key, "PHOTO") === false || $key == "PREVIEW_PHOTO") {
						$flag = 1;
					}
					else {
						$property["MORE_PHOTO"][] = $file;
					}
				}
				
				if(!empty($_REQUEST["INTRODUCTION"]["PROPERTY"]["CONTACT_EMAIL"]) && !check_email($_REQUEST["INTRODUCTION"]["PROPERTY"]["CONTACT_EMAIL"]))
					$arResult["ERROR"][] = GetMessage("WRONG_EMAIL");
					
				if(empty($arResult["ERROR"])) {
					$params = Array(
						"max_len" => "100",
						"change_case" => "L",
						"replace_space" => "_",
						"replace_other" => "_",
						"delete_repeat_replace" => "true",
						"use_google" => "false"
					);
					$el = new CIBlockElement;
					$arIntro = Array(
						"IBLOCK_ID" => IB_INTRO,
						"PROPERTY_VALUES" => $property,
						"ACTIVE" => "N",
						"DATE_ACTIVE_FROM" => ConvertDateTime($_REQUEST["day_from"].".".$_REQUEST["month_from"].".".$_REQUEST["year_from"], "DD.MM.YYYY", "ru"),
						"NAME" => $_REQUEST["INTRODUCTION"]["NAME"],
						"CODE" => CUtil::translit($_REQUEST["INTRODUCTION"]["NAME"], "ru", $params),
						"PREVIEW_TEXT" => $_REQUEST["INTRODUCTION"]["PREVIEW_TEXT"],
						"DETAIL_TEXT" => $_REQUEST["INTRODUCTION"]["DETAIL_TEXT"],
						"PREVIEW_PICTURE" => !empty($_FILES["PREVIEW_PHOTO"]) ? $_FILES["PREVIEW_PHOTO"] : ""
					);
					if(!$id_intro = $el->Add($arIntro)) {
						$arResult["ERROR"][] = $el->LAST_ERROR;
					}
					else {
						foreach($arResult["PARTNERS"] as $partner)
							if($partner["ID"] == $arIntro["PROPERTY_VALUES"]["PARTNER"])
								$partner_name = $partner["NAME"];
						$arSend = array(
							"NAME" => $arIntro["PROPERTY_VALUES"]["CONTACT_FIO"],
							"EMAIL" => $arIntro["PROPERTY_VALUES"]["CONTACT_EMAIL"],
							"INTRO_NAME" => $_REQUEST["INTRODUCTION"]["NAME"],
							"COMPANY_NAME" => $partner_name,
							"HREF_INTRO" => "http://".$_SERVER["SERVER_NAME"]."/bitrix/admin/iblock_element_edit.php?WF=Y&amp;ID=".$id_intro."&amp;type=clients&amp;lang=ru&amp;IBLOCK_ID=".IB_INTRO."&amp;find_section_section=0"
						);
						$event = new CEvent;
						$event->Send("ADD_INTRODUCTION", SITE_ID, $arSend, "Y", 79);
						$event->Send("ADD_INTRODUCTION", SITE_ID, $arSend, "Y", 80);
						LocalRedirect($APPLICATION->GetCurPageParam("success=Y"));
					}
				}
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
	$this->IncludeComponentTemplate();
}
?>