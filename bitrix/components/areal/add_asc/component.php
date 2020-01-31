<?
if(CModule::IncludeModule("iblock")) {
	if($USER->IsAuthorized()) {
		if(in_array(UG_AKP, CUser::GetUserGroup($USER->GetID())) ||	in_array(UG_PO, CUser::GetUserGroup($USER->GetID()))) {
			$arResult = GetLocationInformation();
			$directions_activity["DIRECTIONS_ACTIVITY"] = array(
				array("DIRECTIONS" => GetMessage("ASPD_ON_THE_BASIS_OF_KKM"), "QUANTITY" => 0),
				array("DIRECTIONS" => GetMessage("ASPD_ON_THE_BASIS_OF_THE_FR"), "QUANTITY" => 0),
				array("DIRECTIONS" => GetMessage("POS_SYSTEMS"), "QUANTITY" => 0),
				array("DIRECTIONS" => GetMessage("SOFTWARE"), "QUANTITY" => 0),
				array("DIRECTIONS" => GetMessage("COMPLEXES_LABELING"), "QUANTITY" => 0),
				array("DIRECTIONS" => GetMessage("INFORMATION_KIOSKS"), "QUANTITY" => 0),
				array("DIRECTIONS" => GetMessage("PAYMENT_TERMINALS"), "QUANTITY" => 0),
				array("DIRECTIONS" => GetMessage("BANK_TERMINALS"), "QUANTITY" => 0)
			);			
			$rsUsers = CUser::GetList(($by="id"), ($order="desc"), array("ID" => $USER->GetID()), array("SELECT" => array("UF_PEOPLE", "UF_COMPANY")));
			if($arUser = $rsUsers->Fetch()) {
				if(!empty($arUser["UF_PEOPLE"])) {
					$res = CIBlockElement::GetList(array(), array("IBLOCK_ID" => IB_PEOPLES, "ID" => $arUser["UF_PEOPLE"]), false, false, array("NAME", "PROPERTY_POSITION", "PROPERTY_EMAIL", "PROPERTY_PHONE"));
					if($people = $res->GetNext()) {
						$user["CONTACT_PERSON"]["NAME"] = $people["NAME"];
						$user["CONTACT_PERSON"]["EMAIL"] = $people["PROPERTY_EMAIL_VALUE"];
						$user["CONTACT_PERSON"]["PHONE"] = $people["PROPERTY_PHONE_VALUE"];
						$user["CONTACT_PERSON"]["POSITION"] = $people["PROPERTY_POSITION_VALUE"];
					}						
				}
				else {
					$user["CONTACT_PERSON"]["NAME"] = $arUser["NAME"];
					$user["CONTACT_PERSON"]["EMAIL"] = $arUser["EMAIL"];
					$user["CONTACT_PERSON"]["PHONE"] = "";
					$user["CONTACT_PERSON"]["POSITION"] = "";
				}
			}
			if(!empty($arResult) && !empty($directions_activity) && !empty($user))
				$arResult = array_merge($arResult, $directions_activity, $user);
			
			if(!empty($_REQUEST["send"]) && bitrix_sessid_post() && !empty($_REQUEST["sessid"]) && !empty($_REQUEST["jssid"]) && $_REQUEST["sessid"] == $_REQUEST["jssid"]) {
				if(!empty($_REQUEST["RESULT"]["CONTACTS"])) {
					foreach($_REQUEST["RESULT"]["CONTACTS"] as $contact) {
						if(empty($contact["FIO"]))
							$arResult["ERROR"][] = GetMessage("NO_REQUIRED_CONTACT_PERSON_FIELD_NAME");
						if(empty($contact["POSITION"]))
							$arResult["ERROR"][] = GetMessage("NO_REQUIRED_CONTACT_PERSON_FIELD_POSITION");
						if(empty($contact["EMAIL"]) && empty($contact["PHONE"]))
							$arResult["ERROR"][] = GetMessage("NEED_CONTACT_PERSON_PHONE_EMAIL");
						if(!empty($contact["EMAIL"]) && !check_email($contact["EMAIL"]))
							$arResult["ERROR"][] = GetMessage("NEED_CONTACT_PERSON_EMAIL_ERROR");
					}
				}
				else {
					$arResult["ERROR"][] = GetMessage("NEED_CONTACT_PERSON");
				}
				if(!empty($_REQUEST["RESULT"]["DIRECTIONS_OF_ACTIVITY"])) {
					$flag = 0;
					foreach($_REQUEST["RESULT"]["DIRECTIONS_OF_ACTIVITY"] as $directions) {
						if($directions["QUANTITY"] > 0)
							$flag = 1;
					}
					if($flag == 0)
						$arResult["ERROR"][] = GetMessage("NEED_DIRECTIONS_OF_ACTIVITY_EMPTY");
				}
				else {
					$arResult["ERROR"][] = GetMessage("NEED_DIRECTIONS_OF_ACTIVITY");
				}
				if(!empty($_REQUEST["RESULT"]["REGIONS_OF_ACTIVITY"])) {
					$flag = 0;
					foreach($_REQUEST["RESULT"]["REGIONS_OF_ACTIVITY"] as $regions)
						if($regions["REGION"] > 0 && $regions["QUANTITY"] > 0)
							$flag = 1;
					if($flag == 0)
						$arResult["ERROR"][] = GetMessage("NEED_REGIONS_OF_ACTIVITY_EMPTY");
				}
				else {
					$arResult["ERROR"][] = GetMessage("NEED_REGIONS_OF_ACTIVITY");
				}
				if(empty($_REQUEST["RESULT"]["PROPERTY_VALUES"]["CONTACT_NAME"]) || empty($_REQUEST["RESULT"]["PROPERTY_VALUES"]["CONTACT_POSITION"]) || empty($_REQUEST["RESULT"]["PROPERTY_VALUES"]["CONTACT_PHONE"]) || empty($_REQUEST["RESULT"]["PROPERTY_VALUES"]["CONTACT_EMAIL"])) {
					$arResult["ERROR"][] = GetMessage("NEED_CONTACT");
				}
				if(!empty($_REQUEST["RESULT"]["PROPERTY_VALUES"]["CONTACT_EMAIL"]) && !check_email($_REQUEST["RESULT"]["PROPERTY_VALUES"]["CONTACT_EMAIL"])) {
					$arResult["ERROR"][] = GetMessage("NEED_CONTACT_EMAIL_ERROR");
				}
				if(empty($_REQUEST["RESULT"]["PROPERTY_VALUES"]["COMPANY_NAME"]) || empty($_REQUEST["RESULT"]["PROPERTY_VALUES"]["COMPANY_INN"]) || empty($_REQUEST["RESULT"]["PROPERTY_VALUES"]["COMPANY_REGION"]) || empty($_REQUEST["RESULT"]["PROPERTY_VALUES"]["COMPANY_TOWN"]) || empty($_REQUEST["RESULT"]["PROPERTY_VALUES"]["COMPANY_ADDRESS"])) {
					$arResult["ERROR"][] = GetMessage("NEED_COMPANY");
				}
				
				if(empty($_REQUEST["RESULT"]["PROPERTY_VALUES"]["COMPANY_EMAIL"]) && empty($_REQUEST["RESULT"]["PROPERTY_VALUES"]["COMPANY_PHONE"])) {
					$arResult["ERROR"][] = GetMessage("NEED_COMPANY_EMAIL_PHONE");
				}
				if(!empty($_REQUEST["RESULT"]["PROPERTY_VALUES"]["COMPANY_EMAIL"]) && !check_email($_REQUEST["RESULT"]["PROPERTY_VALUES"]["COMPANY_EMAIL"])) {
					$arResult["ERROR"][] = GetMessage("NEED_COMPANY_EMAIL_ERROR");
				}
				if(empty($_REQUEST["RESULT"]["PROPERTY_VALUES"]["CTO_CONTRACT_NUMBER"]))
					$arResult["ERROR"][] = GetMessage("CTO_CONTRACT_NUMBER_ERROR");
				if(empty($_REQUEST["RESULT"]["PROPERTY_VALUES"]["CTO_CONTRACT_DATE"]))
					$arResult["ERROR"][] = GetMessage("CTO_CONTRACT_DATE_ERROR");
				if(empty($_REQUEST["RESULT"]["PROPERTY_VALUES"]["PARTNER_CONTRACT_NUMBER"]))
					$arResult["ERROR"][] = GetMessage("PARTNER_CONTRACT_NUMBER_ERROR");
				if(empty($_REQUEST["RESULT"]["PROPERTY_VALUES"]["PARTNER_CONTRACT_DATE"]))
					$arResult["ERROR"][] = GetMessage("PARTNER_CONTRACT_DATE_ERROR");
				if(empty($arResult["ERROR"])) {
					$result["PROPERTY_VALUES"] = $_REQUEST["RESULT"]["PROPERTY_VALUES"];
					
					foreach($_REQUEST["RESULT"]["CONTACTS"] as $contact) {
						$contacts[] = $contact["FIO"].", ".$contact["POSITION"]." (тел. ".$contact["PHONE"].", email: ".$contact["EMAIL"].")";
					}
					$result["PROPERTY_VALUES"]["CONTACT_PERSONS"] = array("VALUE" => array("TEXT" => implode("\n\r", $contacts), "TYPE" => "text"));
					
					foreach($_REQUEST["RESULT"]["DIRECTIONS_OF_ACTIVITY"] as $dir)
						if($dir["QUANTITY"] > 0)
							$dirs[] = implode(" - ", $dir);
					$result["PROPERTY_VALUES"]["DIRECTION_OF_THE_ACTIVITY"] = array("VALUE" => array("TEXT" => implode("\n\r", $dirs), "TYPE" => "text"));
					
					foreach($_REQUEST["RESULT"]["REGIONS_OF_ACTIVITY"] as $region) {
						if(!empty($region["REGION"]))
							$reg["REGION"] = $arResult["REGIONS"][$region["REGION"]];
						if(!empty($region["TOWN"]))
							$reg["TOWN"] = $arResult["TOWNS"][$region["REGION"]][$region["TOWN"]];
						if(!empty($region["QUANTITY"]))
							$reg["QUANTITY"] = $region["QUANTITY"];
						$regs[] = implode(" - ", $reg);						
					}					
					$result["PROPERTY_VALUES"]["REGIONS_OFFICES"] = array("VALUE" => array("TEXT" => implode("\n\r", $regs), "TYPE" => "text"));
					$result["PROPERTY_VALUES"]["CONTACT_USER"] = $USER->GetID();
					$el = new CIBlockElement;
					$arRes = Array(
						"IBLOCK_ID" => IB_ASC,
						"PROPERTY_VALUES" => $result["PROPERTY_VALUES"],
						"NAME" => date("d.m.y H:i")
					);
					if(!$id_message = $el->Add($arRes))
						$arResult["ERROR"][] = $el->LAST_ERROR;
					else {
						
						//посылаем сообщения
						$content = '<h2>АНКЕТА НА ЗАКЛЮЧЕНИЕ ДОГОВОРА АСЦ</h2>';
						$content .= "\n".'<h3>Перечень необходимых документов</h3>';
						$content .= "\n".'<table style="margin-bottom: 16px; border-collapse: collapse;" border="1" cellspacing="2" cellpadding="10" valign="top">';
						$content .= "\n".'<tr>';
						$content .= "\n".'<td colspan="2" align="center">Договор ЦТО</td>';
						$content .= "\n".'</tr>';
						$content .= "\n".'<tr>';
						$content .= "\n".'<td>Номер договора: '.$arRes["PROPERTY_VALUES"]["CTO_CONTRACT_NUMBER"].'</td>';
						$content .= "\n".'<td>Дата заключения договора: '.$arRes["PROPERTY_VALUES"]["CTO_CONTRACT_DATE"].'</td>';
						$content .= "\n".'</tr>';
						$content .= "\n".'<tr>';
						$content .= "\n".'<td colspan="2" align="center">Партнерский договор</td>';
						$content .= "\n".'</tr>';
						$content .= "\n".'<tr>';
						$content .= "\n".'<td>Номер договора: '.$arRes["PROPERTY_VALUES"]["PARTNER_CONTRACT_NUMBER"].'</td>';
						$content .= "\n".'<td>Дата заключения договора: '.$arRes["PROPERTY_VALUES"]["PARTNER_CONTRACT_DATE"].'</td>';
						$content .= "\n".'</tr>';
						$content .= "\n".'</table>';
						
						$content .= "\n".'<h3>О компании</h3>';
						$content .= "\n".'<table style="margin-bottom: 16px; border-collapse: collapse;" border="1" cellspacing="2" cellpadding="10" valign="top">';
						$content .= "\n".'<tr>';
						$content .= "\n".'<td colspan="3">Название компании: '.$arRes["PROPERTY_VALUES"]["COMPANY_NAME"].'</td>';
						$content .= "\n".'</tr>';
						$content .= "\n".'<tr>';
						$content .= "\n".'<td colspan="3">ИНН: '.$arRes["PROPERTY_VALUES"]["COMPANY_INN"].'</td>';
						$content .= "\n".'</tr>';
						$content .= "\n".'<tr>';
						$content .= "\n".'<td>Регион: '.$arResult["REGIONS"][$arRes["PROPERTY_VALUES"]["COMPANY_REGION"]].'</td>';
						$content .= "\n".'<td>Город: '.$arResult["TOWNS"][$arRes["PROPERTY_VALUES"]["COMPANY_REGION"]][$arRes["PROPERTY_VALUES"]["COMPANY_TOWN"]].'</td>';
						$content .= "\n".'<td>Адрес (без города): '.$arRes["PROPERTY_VALUES"]["COMPANY_ADDRESS"].'</td>';
						$content .= "\n".'</tr>';
						$content .= "\n".'<tr>';
						$content .= "\n".'<td colspan="3">Телефон: '.$arRes["PROPERTY_VALUES"]["COMPANY_PHONE"].'</td>';
						$content .= "\n".'</tr>';
						$content .= "\n".'<tr>';
						$content .= "\n".'<td colspan="3">E-mail: '.$arRes["PROPERTY_VALUES"]["COMPANY_EMAIL"].'</td>';
						$content .= "\n".'</tr>';
						$content .= "\n".'<tr>';
						$content .= "\n".'<td colspan="3">Веб-сайт: '.$arRes["PROPERTY_VALUES"]["COMPANY_SITE"].'</td>';
						$content .= "\n".'</tr>';
						$content .= "\n".'</table>';
						
						$content .= "\n".'<h3>Контактные данные руководителя</h3>';
						$content .= "\n".'<table style="margin-bottom: 16px; border-collapse: collapse;" border="1" cellspacing="2" cellpadding="10" valign="top">';
						$content .= "\n".'<tr>';
						$content .= "\n".'<td>Должность</td>';
						$content .= "\n".'<td>ФИО</td>';
						$content .= "\n".'<td>Телефон</td>';
						$content .= "\n".'<td>E-mail</td>';
						$content .= "\n".'</tr>';
						foreach($_REQUEST["RESULT"]["CONTACTS"] as $contact) {
							$content .= "\n".'<tr>';
							$content .= "\n".'<td>'.$contact["POSITION"].'</td>';
							$content .= "\n".'<td>'.$contact["FIO"].'</td>';
							$content .= "\n".'<td>'.$contact["PHONE"].'</td>';
							$content .= "\n".'<td>'.$contact["EMAIL"].'</td>';
							$content .= "\n".'</tr>';
						}
						$content .= "\n".'</table>';
						
						$content .= "\n".'<h3>Направления деятельности АСЦ</h3>';
						$content .= "\n".'<table style="margin-bottom: 16px; border-collapse: collapse;" border="1" cellspacing="2" cellpadding="10" valign="top">';
						$content .= "\n".'<tr>';
						$content .= "\n".'<td>Направление</td>';
						$content .= "\n".'<td>Количество</td>';
						$content .= "\n".'</tr>';
						foreach($_REQUEST["RESULT"]["DIRECTIONS_OF_ACTIVITY"] as $dir) {
							if($dir["QUANTITY"] > 0) {
								$content .= "\n".'<tr>';
								$content .= "\n".'<td>'.$dir["DIRECTIONS"].'</td>';
								$content .= "\n".'<td>'.$dir["QUANTITY"].'</td>';
								$content .= "\n".'</tr>';
							}
						}
						$content .= "\n".'</table>';
						
						$content .= "\n".'<h3>Регионы осуществления деятельности</h3>';
						$content .= "\n".'<table style="margin-bottom: 16px; border-collapse: collapse;" border="1" cellspacing="2" cellpadding="10" valign="top">';
						$content .= "\n".'<tr>';
						$content .= "\n".'<td>Регион</td>';
						$content .= "\n".'<td>Город</td>';
						$content .= "\n".'<td>Количество</td>';
						$content .= "\n".'</tr>';
						foreach($_REQUEST["RESULT"]["REGIONS_OF_ACTIVITY"] as $regions) {
							if($regions["QUANTITY"] > 0) {
								$content .= "\n".'<tr>';
								$content .= "\n".'<td>'.$arResult["REGIONS"][$regions["REGION"]].'</td>';
								$content .= "\n".'<td>'.$arResult["TOWNS"][$regions["REGION"]][$regions["TOWN"]].'</td>';
								$content .= "\n".'<td>'.$regions["QUANTITY"].'</td>';
								$content .= "\n".'</tr>';
							}
						}
						$content .= "\n".'</table>';
						
						$content .= "\n".'<h3>Контактное лицо, составившее заявку</h3>';
						$content .= "\n".'<table style="margin-bottom: 16px; border-collapse: collapse;" border="1" cellspacing="2" cellpadding="10" valign="top">';
						$content .= "\n".'<tr>';
						$content .= "\n".'<td>ФИО</td>';
						$content .= "\n".'<td>'.$_REQUEST["RESULT"]["PROPERTY_VALUES"]["CONTACT_NAME"].'</td>';
						$content .= "\n".'</tr>';
						$content .= "\n".'<tr>';
						$content .= "\n".'<td>Должность</td>';
						$content .= "\n".'<td>'.$_REQUEST["RESULT"]["PROPERTY_VALUES"]["CONTACT_POSITION"].'</td>';
						$content .= "\n".'</tr>';
						$content .= "\n".'<tr>';
						$content .= "\n".'<td>Телефон</td>';
						$content .= "\n".'<td>'.$_REQUEST["RESULT"]["PROPERTY_VALUES"]["CONTACT_PHONE"].'</td>';
						$content .= "\n".'</tr>';
						$content .= "\n".'<tr>';
						$content .= "\n".'<td>E-mail</td>';
						$content .= "\n".'<td>'.$_REQUEST["RESULT"]["PROPERTY_VALUES"]["CONTACT_EMAIL"].'</td>';
						$content .= "\n".'</tr>';
						$content .= "\n".'</table>';
						$arSend = array(
							"EMAIL" => $arRes["PROPERTY_VALUES"]["CONTACT_EMAIL"],
							"CONTENT" => $content,
							"NAME" => $arRes["PROPERTY_VALUES"]["CONTACT_NAME"]
						);
						CEvent::Send("USER_CERTIFIED_ASC", "s1", $arSend, "Y", 74);
						CEvent::Send("USER_CERTIFIED_ASC", "s1", $arSend, "Y", 73);
						LocalRedirect($APPLICATION->GetCurPageParam("success=yes"));
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
?>