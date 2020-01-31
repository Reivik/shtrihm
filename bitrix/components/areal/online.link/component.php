<?
if(CModule::IncludeModule("iblock")) {
	$ctx = stream_context_create(array('http' => array('timeout' => 3)));
	$users = CIBlockElement::GetList(array(), array("IBLOCK_ID" => 49, "ACTIVE" => "Y", "PROPERTY_USER" => $USER->GetID()), false, false, array("ID", "NAME", "IBLOCK_ID", "PROPERTY_USER", "PROPERTY_MEETING_ID", "PROPERTY_MODERATOR_PW", "PROPERTY_SPECIALITY"));
	if($user = $users->GetNext()) {
		if(!empty($user["PROPERTY_MEETING_ID_VALUE"])) {
			$checksum = sha1("joinfullName=".urlencode($user["NAME"])."&meetingID=".$user["PROPERTY_MEETING_ID_VALUE"]."&password=".$user["PROPERTY_MODERATOR_PW_VALUE"].BBB_SALT);
			$url_href = "http://".BBB_IP."/bigbluebutton/api/join?fullName=".urlencode($user["NAME"])."&meetingID=".$user["PROPERTY_MEETING_ID_VALUE"]."&password=".$user["PROPERTY_MODERATOR_PW_VALUE"]."&checksum=".$checksum;
			$contents = @file_get_contents($url_href, false, $ctx);
			if(!empty($contents)) {
				$data= new SimpleXMLElement($contents);
				if($data->returncode->__toString() == "SUCCESS") {
					$arResult["HREF_COMMIT"] = $url_href;
				}
			}
		}
		
		if(empty($user["PROPERTY_MEETING_ID_VALUE"]) || empty($arResult["HREF_COMMIT"])) {		
			$meetingID = randString(8);
			$attendeePW = randString(8);
			$moderatorPW = randString(8);
			$checksum = sha1("createname=".urlencode($user["PROPERTY_SPECIALITY_VALUE"])."&meetingID=".$meetingID."&attendeePW=".$attendeePW."&moderatorPW=".$moderatorPW."&maxParticipants=2".BBB_SALT);
			$url = "http://".BBB_IP."/bigbluebutton/api/create?name=".urlencode($user["PROPERTY_SPECIALITY_VALUE"])."&meetingID=".$meetingID."&attendeePW=".$attendeePW."&moderatorPW=".$moderatorPW."&maxParticipants=2"."&checksum=".$checksum;
			$contents = @file_get_contents($url, false, $ctx);
			if(!empty($contents)) {
				$data= new SimpleXMLElement($contents);
				if($data->returncode->__toString() == "SUCCESS") {
					if(!$data->messageKey->__toString()) {
						CIBlockElement::SetPropertyValues($user["ID"], $user["IBLOCK_ID"], $meetingID, "MEETING_ID");				
						CIBlockElement::SetPropertyValues($user["ID"], $user["IBLOCK_ID"], $moderatorPW, "MODERATOR_PW");				
						CIBlockElement::SetPropertyValues($user["ID"], $user["IBLOCK_ID"], $attendeePW, "ASIGNEE_PW");				
					}
				}
				$checksum = sha1("joinfullName=".urlencode($user["NAME"])."&meetingID=".$meetingID."&password=".$moderatorPW.BBB_SALT);
				$arResult["HREF_COMMIT"] = "http://".BBB_IP."/bigbluebutton/api/join?fullName=".urlencode($user["NAME"])."&meetingID=".$meetingID."&password=".$moderatorPW."&checksum=".$checksum;
			}
		}
	}
	$this->IncludeComponentTemplate();
}
?>