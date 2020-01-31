<?
$APPLICATION->SetPageProperty('NO_LEFT_MENU', "N");
if(CModule::IncludeModule("iblock")) {
	global $USER;
	if($USER->IsAuthorized()) {
		if(in_array(UG_VEBINAR_CREATOR, CUser::GetUserGroup($USER->GetID()))) {
			$res_el = CIBlockElement::GetList(array(), array("IBLOCK_ID" => $arParams["IBLOCK_ID"], "CODE" => $arParams["ELEMENT_CODE"], "PROPERTY_ARCHIVE" => false, ">=DATE_ACTIVE_FROM" => ConvertTimeStamp()), false, false, array("ID"));
			if($el = $res_el->GetNext())
				$ID_VEBINAR = $el["ID"];
			if(!empty($_REQUEST) && $_REQUEST["save"]) {
				//обновление информации о вебинаре
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
				
				if(empty($arResult["ERROR"])) {
					$el = new CIBlockElement;
					$property = $_REQUEST["RESULT"]["PROPERTY"];
					if($_REQUEST["RESULT"]["NO_INVITE"] == 1) {
						$property["NO_INVITE"] = array(array("VALUE" => 188));
					}
					else $property["NO_INVITE"] = array(array("VALUE" => "-1"));
					if($_REQUEST["RESULT"]["TOP"] == 1) {
						$property["TOP"] = array(array("VALUE" => 29));
					}
					else $property["TOP"] = array(array("VALUE" => "-1"));
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
						"IBLOCK_SECTION_ID" => $_REQUEST["RESULT"]["IBLOCK_SECTION_ID"],
						"NAME" => $_REQUEST["RESULT"]["NAME"],
						"PREVIEW_TEXT" => str_replace("<br />", "\n\r", $_REQUEST["RESULT"]["PREVIEW_TEXT"]),
						"PREVIEW_PICTURE" => $_FILES["COMPANY_LOGO"]["error"] == 0 ? $_FILES["COMPANY_LOGO"] : "",
						"DATE_ACTIVE_FROM" => $DATE_ACTIVE_FROM,
						"DATE_ACTIVE_TO" => $DATE_ACTIVE_TO,
						"ACTIVE" => ($_REQUEST["RESULT"]["ACTIVE"] == 1) ? "Y":"N"
					);
					if(!$el->Update($ID_VEBINAR, $arRes))
						$arResult["ERROR"][] = $el->LAST_ERROR;
					CIBlockElement::SetPropertyValuesEx($ID_VEBINAR, false, $property);
				}
				
				//вновь приглашенные участники. Проверка на существование записей в БД
				if(!empty($_REQUEST["PARTICIPANT"]) && bitrix_sessid_post() && !empty($_REQUEST["sessid"]) && !empty($_REQUEST["jssid"]) && $_REQUEST["sessid"] == $_REQUEST["jssid"]) {
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
						$users[$arUsers["ID"]] = array("ID" => $arUsers["ID"], "NAME" => $arUsers["NAME"], "EMAIL" => $arUsers["EMAIL"]);
					}
					$db_res=$DB->Query("SELECT * FROM  `VEBINARS` WHERE `VEBINAR`='".$ID_VEBINAR."'");
					while($arElem=$db_res->Fetch())
					{
						unset($ar_users);
						unset($rs_userc);
						if($arElem["PARTICIPANT"] > 0) {
							$ar_users = CUser::GetByID($arElem["PARTICIPANT"]);
							$rs_userc = $ar_users->Fetch();
							$users_in_DB[$rs_userc["ID"]] = array("ID" => $rs_userc["ID"], "NAME" => $rs_userc["NAME"], "EMAIL" => $rs_userc["EMAIL"]);
						}
					}
					foreach($users_in_DB as $key => $us_DB)
						if(is_array($users[$key]))
							unset($users[$key]);
							
					foreach($users as $user) {
						unset($db_res);
						unset($res_db);
						$db_res=$DB->Query("SELECT * FROM  `VEBINARS` WHERE `VEBINAR`='".$ID_VEBINAR."' AND `PARTICIPANT`='".$user["IF"]."'");
						if(!$res_db = $db_res->Fetch()) {
							$DB->Query("INSERT INTO `VEBINARS`(`VEBINAR`, `PARTICIPANT`, `DATE`, `INVITED`, `STATUS`) VALUES ('".$ID_VEBINAR."', '".$user["ID"]."', '".date("d.m.Y H:i")."', '1', '".(($_REQUEST["RESULT"]["NO_INVITE"] == 1) ? "registered" : "application")."')");
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
				}


				//если кого-то отклонили из тех, кто оставлял заявку
				if(!empty($_REQUEST["PARTICIPANTS"]["REFUSAL"]))
					foreach($_REQUEST["PARTICIPANTS"]["REFUSAL"] as $refusal) {
						$DB->Query("UPDATE `VEBINARS` SET `STATUS`='refusal', `DATE`='".date("d.m.Y H:i")."' WHERE `VEBINAR`='".$ID_VEBINAR."' AND `PARTICIPANT`='".$refusal."'");
						$arSend = array(
							"NAME" => $user["NAME"] ? $user["NAME"] : $user["LOGIN"],
							"EMAIL" => $user["EMAIL"],
							"VEBINAR_NAME" => $_REQUEST["RESULT"]["NAME"]							
						);
						$event = new CEvent;
						$event->Send("VEBINAR", SITE_ID, $arSend, "N", 89);
					}
				//если кого-то пригласили на вебинар
				if(!empty($_REQUEST["PARTICIPANTS"]["INVITING"]))
					foreach($_REQUEST["PARTICIPANTS"]["INVITING"] as $invite) {
						$DB->Query("UPDATE `VEBINARS` SET `STATUS`='registered', `DATE`='".date("d.m.Y H:i")."', `INVITED`='1' WHERE `VEBINAR`='".$ID_VEBINAR."' AND `PARTICIPANT`='".$invite."'");
						$arSend = array(
							"NAME" => $user["NAME"] ? $user["NAME"] : $user["LOGIN"],
							"EMAIL" => $user["EMAIL"],
							"VEBINAR_NAME" => $_REQUEST["RESULT"]["NAME"]							
						);
						$event = new CEvent;
						$event->Send("VEBINAR", SITE_ID, $arSend, "N", 89);
					} 
			}
			
			
			//группы пользователей
			$levels = CIBlockElement::GetList(array(), array("IBLOCK_ID" => IB_PARTNER_LEVEL, "ACTIVE" => "Y"), false, false, array("ID", "NAME", "PROPERTY_ACCESS_GROUP_ID"));
			while($level = $levels->GetNext()) {
				$arResult["LEVELS"][$level["PROPERTY_ACCESS_GROUP_ID_VALUE"]] = $level["NAME"];
			}
			//информация о вебинаре
			$res = CIBlockElement::GetList(array(), array("IBLOCK_ID" => $arParams["IBLOCK_ID"], "CODE" => $arParams["ELEMENT_CODE"], "PROPERTY_ARCHIVE" => false, ">=DATE_ACTIVE_FROM" => ConvertTimeStamp()), false, false, array("ID", "CODE", "NAME", "PREVIEW_PICTURE", "PREVIEW_TEXT", "IBLOCK_SECTION_ID", "DATE_ACTIVE_FROM", "ACTIVE", "PROPERTY_DURATION", "PROPERTY_LEADING", "PROPERTY_CATEGORY", "PROPERTY_NO_INVITE", "PROPERTY_TOP", "PROPERTY_MODERATOR_USER", "PROPERTY_MODERATOR_PW", "PROPERTY_ATTENDEE_PW"));
			if($element = $res->GetNext()) {				
				if($USER->GetID() == $element["PROPERTY_MODERATOR_USER_VALUE"]) {
					$arResult["VEBINAR"] = array(
						"ID" => $element["ID"],
						"NAME" => $element["NAME"],
						"PREVIEW_PICTURE" => CFile::ResizeImageGet( 
							$element["PREVIEW_PICTURE"], 
							array("width" => 185, "height" => 185), 
							BX_RESIZE_IMAGE_PROPORTIONAL_ALT,
							true 
						),
						"PREVIEW_TEXT" => str_replace("<br />", "\n\r", $element["PREVIEW_TEXT"]),
						"DATE_ACTIVE_FROM" => $element["DATE_ACTIVE_FROM"],
						"IBLOCK_SECTION_ID" => $element["IBLOCK_SECTION_ID"],
						"DURATION" => $element["PROPERTY_DURATION_VALUE"],
						"CATEGORY" => $element["PROPERTY_CATEGORY_VALUE"],
						"LEADING" => $element["PROPERTY_LEADING_VALUE"],
						"NO_INVITE" => $element["PROPERTY_NO_INVITE_VALUE"] ? 1 : 0,
						"TOP" => $element["PROPERTY_TOP_VALUE"] ? 1 : 0,
						"ACTIVE" => $element["ACTIVE"],
						"MODERATOR_PW" => $element["PROPERTY_MODERATOR_PW_VALUE"],
						"ATTENDEE_PW" => $element["PROPERTY_ATTENDEE_PW_VALUE"]
					);
					
					//направления
					$directions = GetDirections();
					if(!empty($directions))
						$arResult = array_merge($arResult, $directions);
					
					//разделы вебинаров
					$sec = CIBlockSection::GetList(array("SORT" => "ASC"), array("IBLOCK_ID" => IB_WEBINAR, "DEPTH_LEVEL" => 1, "ACTIVE" => "Y"), false);
					while($section = $sec->GetNext())
						$sections["DIRECTIONS"][$section["ID"]] = $section["NAME"];
					if(!empty($sections["DIRECTIONS"]))
						$arResult = array_merge($arResult, $sections);
					else unset($arResult["DIRECTIONS"]);
					
					//участники
					$db_res=$DB->Query("SELECT * FROM  `VEBINARS` WHERE `VEBINAR`='".$element["ID"]."'");
					while($arElem=$db_res->Fetch()) {
						unset($users);
						unset($aruser);
						unset($peoples);
						unset($people);
						$users = CUser::GetByID($arElem["PARTICIPANT"]);
						if($aruser = $users->Fetch()) {
							if($aruser["UF_PEOPLE"] > 0)	{
								$peoples = CIBlockElement::GetList(array(), array("IBLOCK_ID" => IB_PEOPLES, "ID" => $aruser["UF_PEOPLE"], "ACTIVE" => "Y"), false, false, array("NAME", "PROPERTY_POSITION", "PROPERTY_COMPANY.NAME"));
								if($people = $peoples->GetNext())
									$PARTICIPANTS[] = array(
										"ID" => $aruser["ID"],
										"NAME" => $people["NAME"],
										"COMPANY" => $people["PROPERTY_COMPANY_NAME"],
										"POSITION" => $people["PROPERTY_POSITION_VALUE"],
										"DATE" => $arElem["DATE"],
										"INVITED" => $arElem["INVITED"],
										"STATUS" => $arElem["STATUS"]
									);
								else 
									$PARTICIPANTS[] = array(
										"ID" => $aruser["ID"],
										"NAME" => $aruser["NAME"] ? $aruser["NAME"] : $aruser["LOGIN"],
										"COMPANY" => "",
										"POSITION" => "",
										"DATE" => $arElem["DATE"],
										"INVITED" => $arElem["INVITED"],
										"STATUS" => $arElem["STATUS"]
									);
							}
							else {
								$PARTICIPANTS[] = array(
									"ID" => $aruser["ID"],
									"NAME" => $aruser["NAME"] ? $aruser["NAME"] : $aruser["LOGIN"],
									"COMPANY" => "",
									"POSITION" => "",
									"DATE" => $arElem["DATE"],
									"INVITED" => $arElem["INVITED"],
									"STATUS" => $arElem["STATUS"]
								);
							}
						}
					}
					if(count($PARTICIPANTS) > 0) {
						$arResult["PARTICIPANTS"] = array();
						foreach($PARTICIPANTS as $partic) {
							if($partic["STATUS"] == "registered")
								$arResult["PARTICIPANTS"]["registered"][] = $partic;
							if($partic["STATUS"] == "application")
								$arResult["PARTICIPANTS"]["application"][] = $partic;
							if($partic["STATUS"] == "refusal")
								$arResult["PARTICIPANTS"]["refusal"][] = $partic;
						}
					}
				}
				else {
					ShowError(GetMessage("NOT_VEBINAR_CREATOR"));
					return;
				}
			}
					
			//проверка, запущена ли конференция
			$VEBINAR = $arResult["VEBINAR"]["ID"];
			$VEBINAR_NAME = $arResult["VEBINAR"]["NAME"];
			$ATTENDEE_PW = $arResult["VEBINAR"]["ATTENDEE_PW"];
			$MODERATOR_PW = $arResult["VEBINAR"]["MODERATOR_PW"];
			
			$url = "http://".BBB_IP."/bigbluebutton/api/isMeetingRunning?meetingID=".$VEBINAR."&checksum=".sha1("isMeetingRunningmeetingID=".$VEBINAR.BBB_SALT);
			$ctx = stream_context_create(array('http' => array('timeout' => 3)));
			$contents = @file_get_contents($url, false, $ctx);
			$data= new SimpleXMLElement($contents);
			if($data->returncode->__toString() == "SUCCESS") {
				if(strlen($data->messageKey->__toString()) > 1)
					$arResult["ERROR"][] = $data->message->__toString();
				else {
					$rsUser = CUser::GetByID($USER->GetID());
					$arUser = $rsUser->Fetch();
					$full_name = ($arUser["NAME"] ? urlencode($arUser["NAME"]) : $arUser["LOGIN"]);				
					if($data->running->__toString() == "true")
					{
						//выводим кнопку подключения к конференции
						$checksum_join = sha1("joinfullName=".$full_name."&meetingID=".$VEBINAR."&password=".$MODERATOR_PW.BBB_SALT);
						$arResult["HREF_COMMIT"] = "http://".BBB_IP."/bigbluebutton/api/join?fullName=".$full_name."&meetingID=".$VEBINAR."&password=".$MODERATOR_PW."&checksum=".$checksum_join;
					}
					elseif($data->running->__toString() == "false")
					{						
						//создание конференции в системе BBB
						$checksum_create = sha1("createname=".urlencode($VEBINAR_NAME)."&meetingID=".$VEBINAR."&attendeePW=".$ATTENDEE_PW."&moderatorPW=".$MODERATOR_PW.BBB_SALT);
						$url = "http://".BBB_IP."/bigbluebutton/api/create?name=".urlencode($VEBINAR_NAME)."&meetingID=".$VEBINAR."&attendeePW=".$ATTENDEE_PW."&moderatorPW=".$MODERATOR_PW."&checksum=".$checksum_create;
						$ctx = stream_context_create(array('http' => array('timeout' => 3)));
						$contents = @file_get_contents($url, false, $ctx);
						$data= new SimpleXMLElement($contents);						
						
						if($data->returncode->__toString() == "SUCCESS") {
							$checksum_join = sha1("joinfullName=".$full_name."&meetingID=".$VEBINAR."&password=".$MODERATOR_PW.BBB_SALT);							
							$arResult["HREF_COMMIT"] = "http://".BBB_IP."/bigbluebutton/api/join?fullName=".$full_name."&meetingID=".$VEBINAR."&password=".$MODERATOR_PW."&checksum=".$checksum_join;
						}
						elseif($data->returncode->__toString() == "FAILED")
							$arResult["ERROR"][] = $data->message->__toString();
					}
				}
			}
			elseif($data->returncode->__toString() == "FAILED")
				$arResult["ERROR"][] = $data->message->__toString();
			$APPLICATION->SetTitle($arResult["VEBINAR"]["NAME"]);
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