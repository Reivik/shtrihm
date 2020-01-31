<?
if(CModule::IncludeModule("iblock")) {
	$name = $USER->GetFirstName() ? urlencode($USER->GetFirstName()) : $USER->GetLogin();
	$arFilter = array("IBLOCK_ID" => 49, "ACTIVE" => "Y");
	if(isset($arParams["PRODUCT_ID"]))
		$arFilter = array_merge($arFilter, array("PROPERTY_PRODUCT" => $arParams["PRODUCT_ID"]));
	/*if($USER->IsAdmin())
		pr($arFilter);*/
	$elements = CIBlockElement::GetList(array("PROPERTY_SPECIALITY.SORT" => "asc"), $arFilter, false, false, array("ID", "IBLOCK_ID", "NAME", "PREVIEW_PICTURE", "PROPERTY_MEETING_ID", "PROPERTY_ASIGNEE_PW", "PROPERTY_MODERATOR_PW", "PROPERTY_SPECIALITY", "PROPERTY_PHONE", "PROPERTY_EMAIL", "PROPERTY_SKYPE", "PROPERTY_ICQ"));
	while($element = $elements->GetNext()) {
		unset($checksum);
		unset($HREF_COMMIT);
		unset($checksum_running);
		unset($running);
		unset($running_conf);
		unset($contents);
		$checksum = sha1("joinfullName=".$name."&meetingID=".$element["PROPERTY_MEETING_ID_VALUE"]."&password=".$element["PROPERTY_ASIGNEE_PW_VALUE"].BBB_SALT);
		$HREF_COMMIT = "http://".BBB_IP."/bigbluebutton/api/join?fullName=".$name."&meetingID=".$element["PROPERTY_MEETING_ID_VALUE"]."&password=".$element["PROPERTY_ASIGNEE_PW_VALUE"]."&checksum=".$checksum;
		
		//Get Meeting Info
		
		if(!empty($element["PROPERTY_MEETING_ID_VALUE"])) {
			$checksum_running = sha1("getMeetingInfomeetingID=".$element["PROPERTY_MEETING_ID_VALUE"]."&password=".$element["PROPERTY_MODERATOR_PW_VALUE"].BBB_SALT);
			$running = "http://".BBB_IP."/bigbluebutton/api/getMeetingInfo?meetingID=".$element["PROPERTY_MEETING_ID_VALUE"]."&password=".$element["PROPERTY_MODERATOR_PW_VALUE"]."&checksum=".$checksum_running;
			$ctx = stream_context_create(array('http' => array('timeout' => 3)));
			if($contents = @file_get_contents($running, false, $ctx)){ 
				$data= new SimpleXMLElement($contents);
				if($data->returncode->__toString() == "SUCCESS") {
					if($data->running->__toString() == true) {
						if($data->participantCount->__toString() < $data->maxUsers->__toString())
							$running_descr = true;
						else
							$running_descr = false;
						$running_conf = true;
					}
					else 
						$running_conf = false;
				}
			}
		}
		$arResult[$element["PROPERTY_SPECIALITY_VALUE"]][] = array(
			"NAME" => $element["NAME"],
			"PREVIEW_PICTURE" => CFile::ResizeImageGet($element["PREVIEW_PICTURE"], array("width" => 49, "height" => 49), BX_RESIZE_IMAGE_EXACT, true),
			"MEETING_ID" => $element["PROPERTY_MEETING_ID_VALUE"],
			"ASIGNEE_PW" => $element["PROPERTY_ASIGNEE_PW_VALUE"],
			"PHONE" => $element["PROPERTY_PHONE_VALUE"],
			"EMAIL" => $element["PROPERTY_EMAIL_VALUE"],
			"SKYPE" => $element["PROPERTY_SKYPE_VALUE"],
			"ICQ" => $element["PROPERTY_ICQ_VALUE"],
			"HREF_COMMIT" => $HREF_COMMIT,
			"RUNNING" => $running_conf ? true : false,
			"BUSY" => $running_descr ? true : false
		);
	}
	
	//pr($arResult[$element["PROPERTY_SPECIALITY_VALUE"]]);
	if($contents){
		$this->IncludeComponentTemplate();
	}
}
?>