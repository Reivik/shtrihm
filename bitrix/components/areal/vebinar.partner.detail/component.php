<?
if(CModule::IncludeModule("iblock")) {
	if($USER->IsAuthorized()) {
		if(in_array(UG_AKP, CUser::GetUserGroup($USER->GetID())) || in_array(UG_PP, CUser::GetUserGroup($USER->GetID())) || in_array(UG_PO, CUser::GetUserGroup($USER->GetID())) || in_array(UG_YC, CUser::GetUserGroup($USER->GetID())) || in_array(UG_TP, CUser::GetUserGroup($USER->GetID()))) {
			//информация о вебинаре
			$res = CIBlockElement::GetList(array(), array("IBLOCK_ID" => $arParams["IBLOCK_ID"], "CODE" => $arParams["ELEMENT_CODE"], "ACTIVE" => "Y", "PROPERTY_ARCHIVE" => false, ">=DATE_ACTIVE_FROM" => ConvertTimeStamp()), false, false, array("ID", "CODE", "NAME", "PREVIEW_PICTURE", "PREVIEW_TEXT", "DATE_ACTIVE_FROM", "DATE_ACTIVE_TO", "PROPERTY_DURATION", "PROPERTY_LEADING", "PROPERTY_NO_INVITE", "PROPERTY_MODERATOR_USER", "PROPERTY_ATTENDEE_PW", "PROPERTY_MODERATOR_PW"));
			if($element = $res->GetNext()) {
				$arUser = CUser::GetByID($element["PROPERTY_MODERATOR_USER_VALUE"]);
				$rsUser = $arUser->Fetch();
				$arResult["VEBINAR"] = array(
					"ID" => $element["ID"],
					"NAME" => $element["NAME"],
					"PREVIEW_PICTURE" => CFile::ResizeImageGet( 
						$element["PREVIEW_PICTURE"], 
						array("width" => 200, "height" => 200), 
						BX_RESIZE_IMAGE_PROPORTIONAL_ALT,
						true 
					),
					"PREVIEW_TEXT" => $element["PREVIEW_TEXT"],
					"DATE_ACTIVE_FROM" => $element["DATE_ACTIVE_FROM"],
					"DATE_ACTIVE_TO" => $element["DATE_ACTIVE_TO"],
					"DURATION" => $element["PROPERTY_DURATION_VALUE"],
					"LEADING" => $element["PROPERTY_LEADING_VALUE"],
					"ATTENDEE_PW" => $element["PROPERTY_ATTENDEE_PW_VALUE"],
					"MODERATOR_PW" => $element["PROPERTY_MODERATOR_PW_VALUE"],
					"NO_INVITE" => $element["PROPERTY_NO_INVITE_VALUE"] ? 1 : 0,
					"MODERATOR" => array(
						"NAME" => $rsUser["NAME"] ? $rsUser["NAME"] : $rsUser["LOGIN"],
						"EMAIL" => $rsUser["EMAIL"]
					)				
				);
			}
			
			//проверка, запущена ли конференция
			$VEBINAR = $arResult["VEBINAR"]["ID"];
			$VEBINAR_NAME = $arResult["VEBINAR"]["NAME"];
			$MODERATOR_PW = $arResult["VEBINAR"]["MODERATOR_PW"];			
			$ATTENDEE_PW = $arResult["VEBINAR"]["ATTENDEE_PW"];
			
			$url = "http://".BBB_IP."/bigbluebutton/api/getMeetingInfo?meetingID=".$VEBINAR."&password=".$MODERATOR_PW."&checksum=".sha1("getMeetingInfomeetingID=".$VEBINAR."&password=".$MODERATOR_PW.BBB_SALT);
			
			$ctx = stream_context_create(array('http' => array('timeout' => 3)));
			$contents = @file_get_contents($url, false, $ctx);
			$data= new SimpleXMLElement($contents);
			
			if($data->returncode->__toString() == "SUCCESS") {
				if($data->running->__toString() == "true")
				{
					//выводим кнопку подключения к конференции
					$checksum_join = sha1("joinfullName=".($USER->GetFirstName() ? urlencode($USER->GetFirstName()) : urlencode($USER->GetLogin()))."&meetingID=".$arResult["VEBINAR"]["ID"]."&password=".$arResult["VEBINAR"]["ATTENDEE_PW"].BBB_SALT);
					$arResult["HREF_COMMIT"] = "http://".BBB_IP."/bigbluebutton/api/join?fullName=".($USER->GetFirstName() ? urlencode($USER->GetFirstName()) : urlencode($USER->GetLogin()))."&meetingID=".$arResult["VEBINAR"]["ID"]."&password=".$arResult["VEBINAR"]["ATTENDEE_PW"]."&checksum=".$checksum_join;
					
					$date = strtotime($arResult["VEBINAR"]["DATE_ACTIVE_FROM"]);
					$DATE_ACTIVE_FROM = strtotime(date('d.m.Y H:i:s', $date - 60*60));
					$DATE_ACTIVE_TO = strtotime($arResult["VEBINAR"]["DATE_ACTIVE_TO"]);
					$TODAY = strtotime(date("d.m.Y H:i:s"));
					
					if($DATE_ACTIVE_FROM <= $TODAY)
						$arResult["HREF_COMMIT_SHOW"] = true;
					else
						$arResult["HREF_COMMIT_SHOW"] = false;
				}
				elseif($data->running->__toString() == "false")
				{						
					$arResult["ERROR"][] = "В данный момент подключение к вебинару недоступно.";
				}
			}
			elseif($data->returncode->__toString() == "FAILED")
				$arResult["ERROR"][] = $data->message->__toString();
				
		
			
			if($_REQUEST["confirm"] == "y") {
				$DB->Query("UPDATE `VEBINARS` SET `STATUS`='registered', `DATE`='".date("d.m.Y H:i")."' WHERE `PARTICIPANT`='".$USER->GetID()."' AND `VEBINAR`='".$arResult["VEBINAR"]["ID"]."'");
				$arSend = array(
					"NAME" => $arResult["VEBINAR"]["MODERATOR"]["NAME"],
					"EMAIL" => $arResult["VEBINAR"]["MODERATOR"]["EMAIL"],
					"USER_NAME" => $USER->GetFirstName() ? $USER->GetFirstName() : $USER->GetLogin(),
					"USER_EMAIL" => $USER->GetEmail(),
					"VEBINAR_NAME" => $arResult["VEBINAR"]["NAME"],
					"VEBINAR_DATE" => getDatewithTime($arResult["VEBINAR"]["DATE_ACTIVE_FROM"])
				);
				$event = new CEvent;
				$event->Send("VEBINAR", SITE_ID, $arSend, "N", 87);
				LocalRedirect($APPLICATION->GetCurPageParam("success_confirm=y", array("confirm", "application"), false));
			}
			if($_REQUEST["application"] == "y") {
				$DB->Query("INSERT INTO `VEBINARS`(`VEBINAR`, `PARTICIPANT`, `DATE`, `INVITED`, `STATUS`) VALUES ('".$arResult["VEBINAR"]["ID"]."', '".$USER->GetID()."', '".date("d.m.Y H:i")."', '0', '".(($arResult["VEBINAR"]["NO_INVITE"] == 1) ? "registered" : "application")."')");
				if($arResult["VEBINAR"]["NO_INVITE"] == 0) {
					$arSend = array(
						"NAME" => $arResult["VEBINAR"]["MODERATOR"]["NAME"],
						"EMAIL" => $arResult["VEBINAR"]["MODERATOR"]["EMAIL"],
						"USER_NAME" => $USER->GetFirstName() ? $USER->GetFirstName() : $USER->GetLogin(),
						"USER_EMAIL" => $USER->GetEmail(),
						"VEBINAR_NAME" => $arResult["VEBINAR"]["NAME"],
						"VEBINAR_DATE" => getDatewithTime($arResult["VEBINAR"]["DATE_ACTIVE_FROM"]),
						"VEBINAR_LINK" => $APPLICATION->GetCurPage(false)
					);
					$event = new CEvent;
					$event->Send("VEBINAR", SITE_ID, $arSend, "N", 88);
					LocalRedirect($APPLICATION->GetCurPageParam("success_application=y", array("confirm", "application"), false));
				}
				else 
					LocalRedirect($APPLICATION->GetCurPageParam("success_confirm=y", array("confirm", "application"), false));
			}
			
			$arResult["INVITED"] = 0;
			$db_res=$DB->Query("SELECT * FROM  `VEBINARS` WHERE `VEBINAR`='".$arResult["VEBINAR"]["ID"]."' AND `PARTICIPANT`='".$USER->GetID()."'");
			while($arElem=$db_res->Fetch())
			{
				if($arElem["INVITED"] == 1)
					$arResult["INVITED"] = 1;
				$arResult["STATUS"] = $arElem["STATUS"];				
			}
			
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