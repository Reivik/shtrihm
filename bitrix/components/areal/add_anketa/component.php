<?
if(CModule::IncludeModule("iblock")) {
	$arResult = GetLocationInformation();
	if(!isset($_REQUEST["success"])) {
		$arResult["STEP"] = 1;
	}
	if(!empty($_REQUEST["directions"]) && bitrix_sessid_post() && !empty($_REQUEST["sessid"]) && !empty($_REQUEST["jssid"]) && $_REQUEST["sessid"] == $_REQUEST["jssid"]) {
		if($_REQUEST["directions"] == "next" && $_REQUEST["next_step"] == 2) {
			$required = array(
				"DOGOVOR", 
				"SERVICE_CENTER_NAME", 
				"SERVICE_CENTER_INN",
				"SERVICE_CENTER_REGION",
				"SERVICE_CENTER_TOWN",
				"SERVICE_CENTER_ADDRESS",
				"SERVICE_CENTER_PHONE",
				"SERVICE_CENTER_EMAIL",
				"GENERAL_DIRECTOR_NAME",
				"GENERAL_DIRECTOR_PHONE",
				"GENERAL_DIRECTOR_EMAIL",
				"TECHNICAL_DIRECTOR_NAME",
				"TECHNICAL_DIRECTOR_PHONE",
				"TECHNICAL_DIRECTOR_EMAIL",
				"HEAD_INTRODUCTION_NAME",
				"HEAD_INTRODUCTION_PHONE",
				"HEAD_INTRODUCTION_EMAIL",
				"FIELD_OF_ACTIVITY"
			);
			foreach($_REQUEST["PROPERTY"] as $key => $prop) {
				if(in_array($key, $required) && !$prop)
					$arResult["ERROR"][] = GetMessage("EMPTY_".$key);
			}
			if(empty($_REQUEST["PROPERTY"]["FIELD_OF_ACTIVITY"]))
				$arResult["ERROR"][] = GetMessage("EMPTY_FIELD_OF_ACTIVITY");
			if(empty($arResult["ERROR"])) {
				$arResult["STEP"] = 2;
				if(!isset($_SESSION["FORM"]["PROPERTY"]))
					$_SESSION["FORM"]["PROPERTY"] = array();
				$_SESSION["FORM"]["PROPERTY"] = array_merge($_SESSION["FORM"]["PROPERTY"], $_REQUEST["PROPERTY"]);;
			}
			else {
				$arResult["STEP"] = 1;
			}
		}
		elseif($_REQUEST["directions"] == "next" && $_REQUEST["next_step"] == 3) {
			$flagtoday = 0; $flag2011 = 0;
			foreach($_REQUEST["PROPERTY"]["KKT_QUANTITY"] as $kkt) {
				if(strlen($kkt["2011"]) > 0)
					$flag2011 = 1;
				if(strlen($kkt["today"]) > 0)
					$flagtoday = 1;
			}
			if($flag2011 == 0)
				$arResult["ERROR"][] = GetMessage("EMPTY_KKT_2011");
			if($flagtoday == 0)
				$arResult["ERROR"][] = GetMessage("EMPTY_KKT_TODAY");
			
			if(!isset($_REQUEST["PROPERTY"]["PROIZVODITELI"]) || empty($_REQUEST["PROPERTY"]["PROIZVODITELI"]))
				$arResult["ERROR"][] = GetMessage("EMPTY_PROIZVODITELI_TODAY");
			
			if(empty($arResult["ERROR"])) {
				$arResult["STEP"] = 3;
				$_SESSION["FORM"]["PROPERTY"] = array_merge($_SESSION["FORM"]["PROPERTY"], $_REQUEST["PROPERTY"]);
			}
			else {
				$arResult["STEP"] = 2;
			}
		}
		elseif($_REQUEST["directions"] == "next" && $_REQUEST["next_step"] == 4) {
		
			$flag = 0;
			foreach($_REQUEST["PROPERTY"]["SPECIALITIES"] as $speciality)
				if(!empty($speciality["NAME"]) && !empty($speciality["DATE_LEARNING"]) && !empty($speciality["INN"]) && !empty($speciality["PLACE_LEARNING"]))
					$flag = 1;
			if($flag == 0)
				$arResult["ERROR"][] = GetMessage("EMPTY_SPECIALITIES");
			
			/* if(!$_REQUEST["PROPERTY"]["DOCUMENTS"])
				$arResult["ERROR"][] = GetMessage("EMPTY_DOCUMENTS");
			if(!$_REQUEST["PROPERTY"]["SOFTWARE"])
				$arResult["ERROR"][] = GetMessage("EMPTY_SOFTWARE"); */
			$flag = 0;
			foreach($_REQUEST["PROPERTY"]["LEARNING"] as $learning)
				if(!empty($learning["REGION"]) && !empty($learning["TOWN"]) && !empty($learning["NAME"]))
					$flag = 1;
			if($flag == 0)
				$arResult["ERROR"][] = GetMessage("EMPTY_LEARNING");
			if(empty($arResult["ERROR"])) {
				$arResult["STEP"] = 0;
				$_SESSION["FORM"]["PROPERTY"] = array_merge($_SESSION["FORM"]["PROPERTY"], $_REQUEST["PROPERTY"]);
			}
			else {
				$arResult["STEP"] = 3;
			}
		}
		elseif($_REQUEST["directions"] == "prev" && $_REQUEST["prev_step"]) {
			$arResult["STEP"] = $_REQUEST["prev_step"];
		}
		else {
			$arResult["STEP"] = 1;
		}
		if($arResult["STEP"] == 0) {
			$PROPERTIES = $_SESSION["FORM"];
			if(!empty($PROPERTIES["PROPERTY"]["FIELD_OF_ACTIVITY"])) {
				foreach($PROPERTIES["PROPERTY"]["FIELD_OF_ACTIVITY"] as $key => $FIELD_OF_ACTIVITY)
					$speciality[] = $key." (".implode(", ", $FIELD_OF_ACTIVITY).")";
				if(!empty($speciality))
					$spec = implode("\n\r", $speciality);
			}
			unset($PROPERTIES["PROPERTY"]["FIELD_OF_ACTIVITY"]);
			if(strlen($spec) > 0)
				$PROPERTIES["PROPERTY"]["FIELD_OF_ACTIVITY"] = array("VALUE" => array("TEXT" => $spec, "TYPE" => "text"));
			if(!empty($PROPERTIES["PROPERTY"]["KKT_QUANTITY"])) {
				foreach($PROPERTIES["PROPERTY"]["KKT_QUANTITY"] as $key => $KKT_QUANTITY) {
					if(!empty($KKT_QUANTITY[2011]) || !empty($KKT_QUANTITY[today]))
						$KKT_QUANTITIES[] = $key.":\n\r-".GetMessage("REALIZ_2011")." - ".($KKT_QUANTITY[2011] ? $KKT_QUANTITY[2011] : 0)."\n\r -".GetMessage("REALIZ_TODAY")." - ".($KKT_QUANTITY["today"] ? $KKT_QUANTITY["today"] : 0);
				}
				if(!empty($KKT_QUANTITIES))	
					$KKT = implode("\n\r", $KKT_QUANTITIES);
			}
			unset($PROPERTIES["PROPERTY"]["KKT_QUANTITY"]);
			if(strlen($KKT) > 0)
				$PROPERTIES["PROPERTY"]["KKT_QUANTITY"] = array("VALUE" => array("TEXT" => $KKT, "TYPE" => "text"));
			if(!empty($PROPERTIES["PROPERTY"]["SPECIALITIES"])) {
				foreach($PROPERTIES["PROPERTY"]["SPECIALITIES"] as $key => $SPECIALITIES) {
					$SPECIALITY[] = $SPECIALITIES["NAME"].", ".$SPECIALITIES["INN"]." (".GetMessage("DATE").$SPECIALITIES["DATE_LEARNING"].", ".GetMessage("PLACE").$SPECIALITIES["PLACE_LEARNING"];
				}
			}
			unset($PROPERTIES["PROPERTY"]["SPECIALITIES"]);			
			$PROPERTIES["PROPERTY"]["SPECIALITIES"] = array("VALUE" => array("TEXT" => implode("\n\r", $SPECIALITY), "TYPE" => "text"));
				
			if(!empty($PROPERTIES["PROPERTY"]["LEARNING"])) {
				foreach($PROPERTIES["PROPERTY"]["LEARNING"] as $key => $LEARNING) {
					$LEARNY[] = $LEARNING["NAME"]."(".$arResult["REGIONS"][$LEARNING["REGION"]].", ".$arResult["TOWNS"][$LEARNING["REGION"]][$LEARNING["TOWN"]].")";
				}
			}
			unset($PROPERTIES["PROPERTY"]["LEARNING"]);
			$PROPERTIES["PROPERTY"]["LEARNING"] = array("VALUE" => array("TEXT" => implode("\n\r", $LEARNY), "TYPE" => "text"));
			
			if(!empty($PROPERTIES["PROPERTY"]["PROIZVODITELI"]))
				$PROPERTIES["PROPERTY"]["PROIZVODITELI"] = array("VALUE" => array("TEXT" => implode("\n\r", $PROPERTIES["PROPERTY"]["PROIZVODITELI"])), "TYPE" => "text");
			/* if(!empty($PROPERTIES["PROPERTY"]["DOCUMENTS"]))
				$PROPERTIES["PROPERTY"]["DOCUMENTS"] = array("VALUE" => array("TEXT" => implode("\n\r", $PROPERTIES["PROPERTY"]["DOCUMENTS"])), "TYPE" => "text");
			if(!empty($PROPERTIES["PROPERTY"]["SOFTWARE"]))
				$PROPERTIES["PROPERTY"]["SOFTWARE"] = array("VALUE" => array("TEXT" => implode("\n\r", $PROPERTIES["PROPERTY"]["SOFTWARE"])), "TYPE" => "text"); */
			$el = new CIBlockElement;
			$arRes = Array(
				"IBLOCK_ID" => IB_APP_PROLONGATION,
				"PROPERTY_VALUES" => $PROPERTIES["PROPERTY"],
				"NAME" => $PROPERTIES["PROPERTY"]["DOGOVOR"]
			);
			if(!$id_message = $el->Add($arRes))
				$arResult["ERROR"][] = $el->LAST_ERROR;
			else {	
				$content = "\n".'<h2>'.GetMessage("APP_NAME").'</h2>';
				
				$content .= "\n".'<p><strong>'.GetMessage("DOGOVOR").': </strong>'.$PROPERTIES["PROPERTY"]["DOGOVOR"].'</p>';
				$content .= "\n".'<h3>'.GetMessage("SERVICE_CENTER").'</h3>';
				$content .= "\n".'<p><strong>'.GetMessage("SERVICE_CENTER_NAME").': </strong>'.$PROPERTIES["PROPERTY"]["SERVICE_CENTER_NAME"].'<br />';
				$content .= "\n".'<strong>'.GetMessage("SERVICE_CENTER_INN").': </strong>'.$PROPERTIES["PROPERTY"]["SERVICE_CENTER_INN"].'<br />';
				$content .= "\n".'<strong>'.GetMessage("SERVICE_CENTER_REGION").': </strong>'.$arResult["REGIONS"][$PROPERTIES["PROPERTY"]["SERVICE_CENTER_REGION"]].'<br />';
				$content .= "\n".'<strong>'.GetMessage("SERVICE_CENTER_TOWN").': </strong>'.$arResult["TOWNS"][$PROPERTIES["PROPERTY"]["SERVICE_CENTER_REGION"]][$PROPERTIES["PROPERTY"]["SERVICE_CENTER_TOWN"]].'<br />';
				$content .= "\n".'<strong>'.GetMessage("SERVICE_CENTER_ADDRESS").': </strong>'.$PROPERTIES["PROPERTY"]["SERVICE_CENTER_ADDRESS"].'<br />';
				$content .= "\n".'<strong>'.GetMessage("SERVICE_CENTER_PHONE").': </strong>'.$PROPERTIES["PROPERTY"]["SERVICE_CENTER_PHONE"].'<br />';
				$content .= "\n".'<strong>'.GetMessage("SERVICE_CENTER_EMAIL").': </strong>'.$PROPERTIES["PROPERTY"]["SERVICE_CENTER_EMAIL"].'</p>';				
				$content .= "\n".'<h3>'.GetMessage("HEAD").'</h3>';
				$content .= "\n".'<p><strong>'.GetMessage("GENERAL_DIRECTOR").': </strong>'.$PROPERTIES["PROPERTY"]["GENERAL_DIRECTOR_NAME"];
				if(!empty($PROPERTIES["PROPERTY"]["GENERAL_DIRECTOR_PHONE"]))
					$content .= "\n".'<br />'.GetMessage("SERVICE_CENTER_PHONE").": ".$PROPERTIES["PROPERTY"]["GENERAL_DIRECTOR_PHONE"];
				if(!empty($PROPERTIES["PROPERTY"]["GENERAL_DIRECTOR_EMAIL"]))
					$content .= "\n".'<br />'.GetMessage("SERVICE_CENTER_EMAIL").": ".$PROPERTIES["PROPERTY"]["GENERAL_DIRECTOR_EMAIL"];
				$content .= "\n".'</p>';
				
				$content .= "\n".'<p><strong>'.GetMessage("TECHNICAL_DIRECTOR").': </strong>'.$PROPERTIES["PROPERTY"]["TECHNICAL_DIRECTOR_NAME"];
				if(!empty($PROPERTIES["PROPERTY"]["TECHNICAL_DIRECTOR_PHONE"]))
					$content .= "\n".'<br />'.GetMessage("SERVICE_CENTER_PHONE").": ".$PROPERTIES["PROPERTY"]["TECHNICAL_DIRECTOR_PHONE"];
				if(!empty($PROPERTIES["PROPERTY"]["TECHNICAL_DIRECTOR_EMAIL"]))
					$content .= "\n".'<br />'.GetMessage("SERVICE_CENTER_EMAIL").": ".$PROPERTIES["PROPERTY"]["TECHNICAL_DIRECTOR_EMAIL"];
				$content .= "\n".'</p>';
				
				$content .= "\n".'<p><strong>'.GetMessage("HEAD_INTRODUCTION").': </strong>'.$PROPERTIES["PROPERTY"]["HEAD_INTRODUCTION_NAME"];
				if(!empty($PROPERTIES["PROPERTY"]["HEAD_INTRODUCTION_PHONE"]))
					$content .= "\n".'<br />'.GetMessage("SERVICE_CENTER_PHONE").": ".$PROPERTIES["PROPERTY"]["HEAD_INTRODUCTION_PHONE"];
				if(!empty($PROPERTIES["PROPERTY"]["HEAD_INTRODUCTION_EMAIL"]))
					$content .= "\n".'<br />'.GetMessage("SERVICE_CENTER_EMAIL").": ".$PROPERTIES["PROPERTY"]["HEAD_INTRODUCTION_EMAIL"];
				$content .= "\n".'</p>';
				
				$content .= "\n".'<h3>'.GetMessage("FIELD_OF_ACTIVITY").'</h3>';
				$content .= "\n".'<p>'.str_replace("\n\r", "<br />", $PROPERTIES["PROPERTY"]["FIELD_OF_ACTIVITY"]["VALUE"]["TEXT"]).'</p>';
				$content .= "\n".'<h3>'.GetMessage("KKT").'</h3>';
				$content .= "\n".'<p>'.str_replace("\n\r", "<br />", $PROPERTIES["PROPERTY"]["KKT_QUANTITY"]["VALUE"]["TEXT"]).'</p>';
				$content .= "\n".'<h3>'.GetMessage("PROIZVODITELI").'</h3>';
				$content .= "\n".'<p> - '.str_replace("\n\r", "<br /> - ", $PROPERTIES["PROPERTY"]["PROIZVODITELI"]["VALUE"]["TEXT"]).'</p>';
				$content .= "\n".'<h3>'.GetMessage("SPECIALITIES").'</h3>';
				$content .= "\n".'<p> - '.str_replace("\n\r", "<br /> - ", $PROPERTIES["PROPERTY"]["SPECIALITIES"]["VALUE"]["TEXT"]).'</p>';
				/*$content .= "\n".'<h3 style="font-family: "Arial Black", "Arial Bold", "Gadget", sans-serif; font-size: 14px; font-weight: 700; line-height: 16px; margin-bottom: 14px;">'.GetMessage("DOCUMENTS").'</h3>';
				$content .= "\n".'<p> - '.str_replace("\n\r", "<br /> - ", $PROPERTIES["PROPERTY"]["DOCUMENTS"]["VALUE"]["TEXT"]).'</p>';
				$content .= "\n".'<h3 style="font-family: "Arial Black", "Arial Bold", "Gadget", sans-serif; font-size: 14px; font-weight: 700; line-height: 16px; margin-bottom: 14px;">'.GetMessage("SOFTWARE").'</h3>';
				$content .= "\n".'<p> - '.str_replace("\n\r", "<br /> - ", $PROPERTIES["PROPERTY"]["SOFTWARE"]["VALUE"]["TEXT"]).'</p>'; */
				$content .= "\n".'<h3>'.GetMessage("LEARNING").'</h3>';
				$content .= "\n".'<p> - '.str_replace("\n\r", "<br /> - ", $PROPERTIES["PROPERTY"]["LEARNING"]["VALUE"]["TEXT"]).'</p>';
				
				$arSend = array(
					"EMAIL" => $arRes["PROPERTY_VALUES"]["CONTACT_EMAIL"],
					"CONTENT" => $content,
					"NAME" => $arRes["PROPERTY_VALUES"]["CONTACT_NAME"]
				);
				if(!empty($arRes["PROPERTY_VALUES"]["CONTACT_EMAIL"]) && check_email($arRes["PROPERTY_VALUES"]["CONTACT_EMAIL"]))
					CEvent::Send("USER_PROLONGATION", "s1", $arSend, "Y", 83);
				CEvent::Send("USER_PROLONGATION", "s1", $arSend, "Y", 82);
				
				//AddMessage2Log(print_r($arRes, true));
				
				unset($_SESSION["FORM"]);
				LocalRedirect($APPLICATION->GetCurPageParam("success=yes"));
			}
		}
	}
	$this->IncludeComponentTemplate();
}
?>