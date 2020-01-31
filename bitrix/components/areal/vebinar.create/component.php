<?
if(CModule::IncludeModule("iblock")) {
	if($USER->IsAuthorized()) {
		if(in_array(UG_VEBINAR_CREATOR, CUser::GetUserGroup($USER->GetID())))
		{
			$APPLICATION->SetTitle(GetMessage("TITLE"));
			
			//направления
			$directions = GetDirections();
			//pr($directions);
			if(!empty($directions))
				$arResult = $directions;
			
			//разделы вебинаров
			$sec = CIBlockSection::GetList(array("SORT" => "ASC"), array("IBLOCK_ID" => IB_WEBINAR, "DEPTH_LEVEL" => 1, "ACTIVE" => "Y"), false);
			while($section = $sec->GetNext())
				$sections["DIRECTIONS"][$section["ID"]] = $section["NAME"];
			if(!empty($sections["DIRECTIONS"]))
				$arResult = array_merge($arResult, $sections);
			else unset($arResult["DIRECTIONS"]);
			
			//группы пользователей
			$levels = CIBlockElement::GetList(array(), array("IBLOCK_ID" => IB_PARTNER_LEVEL, "ACTIVE" => "Y"), false, false, array("ID", "NAME", "PROPERTY_ACCESS_GROUP_ID"));
			while($level = $levels->GetNext()) {
				$arResult["LEVELS"][$level["PROPERTY_ACCESS_GROUP_ID_VALUE"]] = $level["NAME"];
			}
			if(isset($_REQUEST["save"]) && strlen($_REQUEST["save"]) > 1 && bitrix_sessid_post() && !empty($_REQUEST["sessid"]) && !empty($_REQUEST["jssid"]) && $_REQUEST["sessid"] == $_REQUEST["jssid"]) {
				if(empty($_REQUEST["RESULT"]["NAME"]))
					$arResult["ERROR"][] = GetMessage("EMPTY_NAME");
				if(empty($_REQUEST["RESULT"]["DATE_ACTIVE_FROM"]))
					$arResult["ERROR"][] = GetMessage("EMPTY_DATE_ACTIVE_FROM");
				$parts = explode(" ", $_REQUEST["RESULT"]["DATE_ACTIVE_FROM"]);
				$part_1 = explode(".", $parts[0]);
				$new_en_date = $part_1[2]."-".$part_1[1]."-".$part_1[0]." ".$parts[1];
				
				$date = strtotime($new_en_date);
				$DATE_ACTIVE_FROM = date('d.m.Y H:i:s', $date);
				$DATE_ACTIVE_TO = date('d.m.Y H:i:s', $date + 60*$_REQUEST["RESULT"]["PROPERTY"]["DURATION"]);
				
				if(strtotime($new_en_date) < strtotime("now"))
					$arResult["ERROR"][] = GetMessage("DATE_ACTIVE_FROM_WRONG");
				if(empty($_REQUEST["RESULT"]["PROPERTY"]["LEADING"]))
					$arResult["ERROR"][] = GetMessage("EMPTY_LEADING");
				if(empty($_REQUEST["RESULT"]["PROPERTY"]["DURATION"]))
					$arResult["ERROR"][] = GetMessage("EMPTY_DURATION");
				if(!empty($arResult["DIRECTIONS"]) && empty($_REQUEST["RESULT"]["IBLOCK_SECTION_ID"]))
					$arResult["ERROR"][] = GetMessage("EMPTY_CATEGORY");
				
				if(empty($arResult["ERROR"])) {
					if(!empty($_REQUEST["PARTICIPANT"])) {
						$filter = array();
						
						if(!empty($_REQUEST["PARTICIPANT"]["DIRECTION"])) {
							$companies = CIBlockElement::GetList(array(), array("IBLOCK_ID" => IB_COMPANY, "ACTIVE" => "Y", "PROPERTY_DIRECTION" => $_REQUEST["PARTICIPANT"]["DIRECTION"]), false, false, array("ID", "PROPERTY_DIRECTION"));
							while($company = $companies->GetNext()) {
								$company_id[] = $company["ID"];
							}
							if(empty($company_id))
								$company_id = array("-1");
							$filter = array_merge($filter, array("UF_COMPANY" => $company_id));
						}
						if(!empty($_REQUEST["PARTICIPANT"]["GROUP"])) {
							foreach($_REQUEST["PARTICIPANT"]["GROUP"] as $key => $group)
								$groups[] = $key;
							$filter = array_merge($filter, array("GROUPS_ID" => $groups));
						}
						if($_REQUEST["PARTICIPANT"]["ALL"] == 1) {
							foreach($arResult["LEVELS"] as $key => $group)
								$groups[] = $key;
							$filter = array_merge($filter, array("GROUPS_ID" => $groups));
						}
						if(!empty($filter["UF_COMPANY"]) && !empty($filter["GROUPS_ID"]))
							$arFilter = array("ACTIVE" => "Y", array("LOGIC" => "OR", "GROUPS_ID" => $filter["GROUPS_ID"], "UF_COMPANY" => $filter["UF_COMPANY"]));
						elseif(!empty($filter["UF_COMPANY"]))
							$arFilter = array("ACTIVE" => "Y", "UF_COMPANY" => $filter["UF_COMPANY"]);
						elseif(!empty($filter["GROUPS_ID"]))
							$arFilter = array("ACTIVE" => "Y", "GROUPS_ID" => $filter["GROUPS_ID"]);
						
						$rsUsers = CUser::GetList(($by="id"), ($order="desc"), $arFilter, array("SELECT" => array("UF_*")));
						while($arUsers = $rsUsers->GetNext()) {
							$users[] = array("ID" => $arUsers["ID"], "NAME" => $arUsers["NAME"], "EMAIL" => $arUsers["EMAIL"]);
						}
					}	
			
					
					$el = new CIBlockElement;
					$property = $_REQUEST["RESULT"]["PROPERTY"];
					if($_REQUEST["RESULT"]["NO_INVITE"] == 1) {
						$property["NO_INVITE"] = array(array("VALUE" => 188));
					}
					if($_REQUEST["RESULT"]["TOP"] == 1) {
						$property["TOP"] = array(array("VALUE" => 29));
					}
					$property["ATTENDEE_PW"] = randString(8);
					$property["MODERATOR_PW"] = randString(8);
					$property["MODERATOR_USER"] = $USER->GetID();
					$params = Array(
						"max_len" => "100",
						"change_case" => "L",
						"replace_space" => "_",
						"replace_other" => "_",
						"delete_repeat_replace" => "true",
						"use_google" => "false"
					);
					$arRes = Array(
						"IBLOCK_ID" => IB_WEBINAR,
						"PROPERTY_VALUES" => $property,
						"IBLOCK_SECTION_ID" => $_REQUEST["RESULT"]["IBLOCK_SECTION_ID"],
						"NAME" => $_REQUEST["RESULT"]["NAME"],
						"CODE" => CUtil::translit($_REQUEST["RESULT"]["NAME"].rand(0, 1000), "ru", $params),
						"PREVIEW_TEXT" => str_replace("<br />", "\n\r",$_REQUEST["RESULT"]["PREVIEW_TEXT"]),
						"PREVIEW_PICTURE" => empty($_FILES["COMPANY_LOGO"]["error"]) ? $_FILES["COMPANY_LOGO"] : "",
						"DATE_ACTIVE_FROM" => $DATE_ACTIVE_FROM,
						"DATE_ACTIVE_TO" => $DATE_ACTIVE_TO,
						"ACTIVE" => ($_REQUEST["RESULT"]["ACTIVE"] == 1) ? "Y":"N"
					);
					if(!$id_vebinar = $el->Add($arRes))
						$arResult["ERROR"][] = $el->LAST_ERROR;
					else {
						//создание конференции в системе BBB
						$checksum = sha1("createname=".urlencode($arRes["NAME"])."&meetingID=".$id_vebinar."&attendeePW=".$arRes["PROPERTY_VALUES"]["ATTENDEE_PW"]."&moderatorPW=".$arRes["PROPERTY_VALUES"]["MODERATOR_PW"].BBB_SALT);
						$url = "http://".BBB_IP."/bigbluebutton/api/create?name=".urlencode($arRes["NAME"])."&meetingID=".$id_vebinar."&attendeePW=".$arRes["PROPERTY_VALUES"]["ATTENDEE_PW"]."&moderatorPW=".$arRes["PROPERTY_VALUES"]["MODERATOR_PW"]."&checksum=".$checksum;
						//file_put_contents("/tmp/t.xt", $url." ".$contents."\n", FILE_APPEND);die;
						$ctx = stream_context_create(array('http' => array('timeout' => 3)));
						$contents = @file_get_contents($url, false, $ctx);
						$data= new SimpleXMLElement($contents);
						if($data->returncode->__toString() == "SUCCESS") {
							if(strlen($data->messageKey->__toString()) > 1)
								$arResult["ERROR"][] = $data->message->__toString();
							else {
								if(!empty($users)) {
									foreach($users as $user) {
										$DB->Query("INSERT INTO `VEBINARS`(`VEBINAR`, `PARTICIPANT`, `DATE`, `INVITED`, `STATUS`) VALUES ('".$id_vebinar."', '".$user["ID"]."', '".date("d.m.Y H:i")."', '1', '".(($_REQUEST["RESULT"]["NO_INVITE"] == 1) ? "registered" : "application")."')");
										$arSend = array(
											"NAME" => $user["NAME"] ? $user["NAME"] : $user["LOGIN"],
											"EMAIL" => $user["EMAIL"],
											"VEBINAR_NAME" => $_REQUEST["RESULT"]["NAME"],
											"VEBINAR_DATE" => $_REQUEST["RESULT"]["DATE_ACTIVE_FROM"],
											"VEBINAR_TEXT" => $_REQUEST["RESULT"]["PREVIEW_TEXT"],
											"VEBINAR_LINK" => ($_REQUEST["RESULT"]["ACTIVE"] == 1) ? "http://".SITE_SERVER_NAME."/partners_info/learning/webinars/".$arRes["CODE"]."/":""
										);
										$event = new CEvent;
										$event->Send("VEBINAR", SITE_ID, $arSend, "N", 86);
									}
								}
								LocalRedirect($APPLICATION->GetCurPageParam("success=Y"));
							}
						}
						elseif($data->returncode->__toString() == "FAILED")
							$arResult["ERROR"][] = $data->message->__toString();
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
	$this->IncludeComponentTemplate($componentPage);
}
