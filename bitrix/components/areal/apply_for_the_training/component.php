<?
if(CModule::IncludeModule("iblock")) {
	/* if($USER->IsAuthorized()) {
		if(in_array(UG_AKP, CUser::GetUserGroup($USER->GetID())) ||
				in_array(UG_PO, CUser::GetUserGroup($USER->GetID())) ||
					in_array(UG_YC, CUser::GetUserGroup($USER->GetID())))
		{ */
			$company=0;
			$people=0;
			$arResult = GetLocationInformation();		
			if($USER->IsAuthorized()){
				$rsUsers = CUser::GetList(($by="id"), ($order="desc"), array("ID" => $USER->GetID()), array("SELECT" => array("UF_*")));
				$arUsers = $rsUsers->GetNext();
				$company = ($arUsers["UF_COMPANY"]=='') ? 0 : $arUsers["UF_COMPANY"];
				$people  = ($arUsers["UF_PEOPLE"]=='')  ? 0 : $arUsers["UF_PEOPLE"];
			}
			
			$comps = CIBlockElement::GetList(array(), array("IBLOCK_ID" => IB_COMPANY, "ID" => $company, "ACTICE" => "Y"), false, false, array("NAME"));
			if($comp = $comps->GetNext()) {
				//название компании
				$arResult["COMPANY_NAME"] = $comp["NAME"];
				$filials = CIBlockElement::GetList(
					array(), 
					array(
						"IBLOCK_ID" => IB_FILIALS, 
						"PROPERTY_company" => $company, 
						"!PROPERTY_main" => false, 
						"ACTIVE" => "Y"
					),
					false, 
					false, 
					array(
						"ID", 
						"PROPERTY_company", 
						"PROPERTY_main", 
						"PROPERTY_country",
						"PROPERTY_region",
						"PROPERTY_town", 
						"PROPERTY_address", 
						"PROPERTY_phone", 
						"PROPERTY_email"
					)
				);
				if($filial = $filials->GetNext()) {
					$arResult["COMPANY_COUNTRY"] = $filial["PROPERTY_COUNTRY_VALUE"];				
					$arResult["COMPANY_REGION"] = $filial["PROPERTY_REGION_VALUE"];
					$arResult["COMPANY_TOWN"] = $filial["PROPERTY_TOWN_VALUE"];
					$arResult["COMPANY_ADDRESS"] = $filial["PROPERTY_ADDRESS_VALUE"];
					$arResult["COMPANY_PHONE"] = $filial["PROPERTY_PHONE_VALUE"];
					$arResult["COMPANY_EMAIL"] = $filial["PROPERTY_EMAIL_VALUE"];
				}
			}
			$persons = CIBlockElement::GetList(array(), array("IBLOCK_ID" => IB_PEOPLES, "ACTIVE" => "Y", "ID" => $people, "PROPERTY_COMPANY" => $company), false, false, array("NAME", "PROPERTY_POSITION", "PROPERTY_EMAIL", "PROPERTY_PHONE", "PROPERTY_COMPANY"));
			if($person = $persons->GetNext()) {
				$arResult["CONTACT_NAME"] = $person["NAME"];
				$arResult["CONTACT_POSITION"] = $person["PROPERTY_POSITION_VALUE"];
				$arResult["CONTACT_PHONE"] = $person["PROPERTY_PHONE_VALUE"];
				$arResult["CONTACT_EMAIL"] = $person["PROPERTY_EMAIL_VALUE"];
			}
			
		/*	$types = CIBlockPropertyEnum::GetList(	
				array("DEF"=>"DESC", "SORT"=>"ASC"), 
				array("IBLOCK_ID" => IB_PROGRAMMS, "CODE" => "TYPE_COMPANY")
			);
			while($type = $types->GetNext())
				$arResult["FILTER"]["TYPE_OF_COMPANY"][] = $type["VALUE"];*/
			
			/*$persons = CIBlockPropertyEnum::GetList(	
				array("DEF"=>"DESC", "SORT"=>"ASC"), 
				array("IBLOCK_ID" => IB_PROGRAMMS, "CODE" => "PERSON")
			);
			while($person = $persons->GetNext())
				$arResult["FILTER"]["PERSON"][] = $person["VALUE"];*/

		//	foreach($arResult["FILTER"]["TYPE_OF_COMPANY"] as $type_comp) {
				//foreach($arResult["FILTER"]["PERSON"] as $pers) {
					/*unset($programs);
					unset($program);*/
					$programs = CIBlockElement::GetList(
						array(),
						array("IBLOCK_ID" => IB_PROGRAMMS, "ACTIVE" => "Y"),
						false,
						false,
						array("NAME", "ID", "PROPERTY_PERSON", "PROPERTY_TYPE_COMPANY", "PROPERTY_DURATION")
					);
					while($program = $programs->GetNext()) {
						$arResult["FILTER"]["THEME"][] = array("ID" => $program["ID"], "NAME" => $program["~NAME"], /*"TYPE_COMPANY" => $type_comp, "PERSON" => $pers*/);
					}
				//}
		//	}

			if(!empty($_REQUEST) && $_REQUEST["send"] == 1) {
				if(empty($_REQUEST["theme"]))
					$arResult["ERROR"][] = GetMessage("NO_THEME");
				/*if(empty($_REQUEST["person"]))
					$arResult["ERROR"][] = GetMessage("NO_PERSON");*/
				/*if(empty($_REQUEST["type_company"]))
					$arResult["ERROR"][] = GetMessage("NO_TYPE_COMPANY");*/
				if(empty($_REQUEST["COMPANY_NAME"]))
					$arResult["ERROR"][] = GetMessage("NO_COMPANY_NAME");
				if(empty($_REQUEST["COMPANY_REGION"]))
					$arResult["ERROR"][] = GetMessage("NO_COMPANY_REGION");
				if(empty($_REQUEST["COMPANY_TOWN"]))
					$arResult["ERROR"][] = GetMessage("NO_COMPANY_TOWN");
				if(empty($_REQUEST["COMPANY_ADDRESS"]))
					$arResult["ERROR"][] = GetMessage("NO_COMPANY_ADDRESS");
				if(empty($_REQUEST["COMPANY_PHONE"]))
					$arResult["ERROR"][] = GetMessage("NO_COMPANY_PHONE");
				if(empty($_REQUEST["COMPANY_EMAIL"]))
					$arResult["ERROR"][] = GetMessage("NO_COMPANY_EMAIL");
				if(empty($_REQUEST["CONTACT_NAME"]))
					$arResult["ERROR"][] = GetMessage("NO_CONTACT_NAME");
				if(empty($_REQUEST["CONTACT_POSITION"]))
					$arResult["ERROR"][] = GetMessage("NO_CONTACT_POSITION");
				if(empty($_REQUEST["CONTACT_PHONE"]))
					$arResult["ERROR"][] = GetMessage("NO_CONTACT_PHONE");
				if(empty($_REQUEST["CONTACT_EMAIL"]))
					$arResult["ERROR"][] = GetMessage("NO_CONTACT_EMAIL");
				if(!empty($_REQUEST["COMPANY_EMAIL"]) && !check_email($_REQUEST["COMPANY_EMAIL"]))
					$arResult["ERROR"][] = GetMessage("WRONG_CONTACT_EMAIL");
				if(!empty($_REQUEST["LISTENER"])) {
					foreach($_REQUEST["LISTENER"] as $listener) {
						if(empty($listener["NAME"]))
							$arResult["ERROR"][] = GetMessage("NO_REQUIRED_CONTACT_PERSON_FIELD_NAME");
						if(empty($listener["POSITION"]))
							$arResult["ERROR"][] = GetMessage("NO_REQUIRED_CONTACT_PERSON_FIELD_POSITION");
						if(empty($listener["EMAIL"]) && empty($listener["PHONE"]))
							$arResult["ERROR"][] = GetMessage("NEED_CONTACT_PERSON_PHONE_EMAIL");
						if(!empty($listener["EMAIL"]) && !check_email($listener["EMAIL"]))
							$arResult["ERROR"][] = GetMessage("NEED_CONTACT_PERSON_EMAIL_ERROR");
					}
				}
				if(empty($arResult["ERROR"])) {
					//создаем элемент в инфоблоке "Заяки на обучение"
					//$result["PROPERTY_VALUES"]["TYPE_COMPANY"] = $_REQUEST["type_company"];
					//$result["PROPERTY_VALUES"]["PERSON"] = $_REQUEST["person"];
					$result["PROPERTY_VALUES"]["THEME"] = $_REQUEST["theme"];
					$result["PROPERTY_VALUES"]["COMPANY_NAME"] = $_REQUEST["COMPANY_NAME"];
					$result["PROPERTY_VALUES"]["COMPANY_COUNTRY"] = $_REQUEST["COMPANY_COUNTRY"];
					$result["PROPERTY_VALUES"]["COMPANY_REGION"] = $_REQUEST["COMPANY_REGION"];
					$result["PROPERTY_VALUES"]["COMPANY_TOWN"] = $_REQUEST["COMPANY_TOWN"];
					$result["PROPERTY_VALUES"]["COMPANY_ADDRESS"] = $_REQUEST["COMPANY_ADDRESS"];
					$result["PROPERTY_VALUES"]["COMPANY_PHONE"] = $_REQUEST["COMPANY_PHONE"];
					$result["PROPERTY_VALUES"]["COMPANY_EMAIL"] = $_REQUEST["COMPANY_EMAIL"];
					$result["PROPERTY_VALUES"]["COMPANY"] = $company;
					$result["PROPERTY_VALUES"]["CONTACT_NAME"] = $_REQUEST["CONTACT_NAME"];
					$result["PROPERTY_VALUES"]["CONTACT_POSITION"] = $_REQUEST["CONTACT_POSITION"];
					$result["PROPERTY_VALUES"]["CONTACT_EMAIL"] = $_REQUEST["CONTACT_EMAIL"];
					$result["PROPERTY_VALUES"]["CONTACT_PHONE"] = $_REQUEST["CONTACT_PHONE"];
					$result["PROPERTY_VALUES"]["CONTACT"] = $USER->GetID();
					if(!empty($_REQUEST["LISTENER"])) {
						foreach($_REQUEST["LISTENER"] as $listener) {
							$list = $listener["NAME"];
							$list .= "\n\r".GetMessage("POSITION").$listener["POSITION"];
							if(!empty($listener["PHONE"]))
								$list .= "\n\r".GetMessage("PHONE").$listener["PHONE"];
							if(!empty($listener["EMAIL"]))
								$list .= "\n\r".GetMessage("EMAIL").$listener["EMAIL"];
							$list .= "\n\r".GetMessage("CHANGE_BASE").($listener["CHANGE_BASE"] ? "Да" : "Нет");
							$list .= "\n\r".GetMessage("NEED_RECOMENTED").($listener["NEED_RECOMENTED"] ? "Да" : "Нет");
							$list .= "\n\r".GetMessage("TEXT").($listener["TEXT"] ? $listener["TEXT"] : "Нет");
							$listeners[] = $list;
						}
					}					
					$result["PROPERTY_VALUES"]["LISTENERS"] = array("VALUE" => array("TEXT" => implode("\n\r\n\r", $listeners), "TYPE" => "text"));
					$el = new CIBlockElement;
					$arRes = Array(
						"IBLOCK_ID" => IB_LEARNING_APPLICATION,
						"PROPERTY_VALUES" => $result["PROPERTY_VALUES"],
						"NAME" => date("d.m.y H:i")
					);
					if(!$application = $el->Add($arRes))
						$arResult["ERROR"][] = $el->LAST_ERROR;
					else {
						//посылаем сообщение
						$content = "\n".'<h2>ЗАЯВКА НА ОБУЧЕНИЕ</h2>';
						
						$content .= "\n".'<table style="margin-bottom: 16px; border-collapse: collapse;" border="1" cellspacing="2" cellpadding="10" valign="top">';
						
					/*	$content .= '<tr>';
						$content .= '<td style="background: #F1F1F1; border-bottom: none; border-left: 1px solid #EAEAEA; border-right: none; border-top: 1px solid #EAEAEA; line-height: 16px; padding: 4px 22px; vertical-align: top;">Вид компании</td>';
						$content .= '<td style="background: #F1F1F1; border-bottom: none; border-left: 1px solid #EAEAEA; border-right: none; border-top: 1px solid #EAEAEA; line-height: 16px; padding: 4px 22px; vertical-align: top;">'.$arRes["PROPERTY_VALUES"]["TYPE_COMPANY"].'</td>';
						$content .= '</tr>';	*/					
					
					/*	$content .= '<tr>';
						$content .= '<td style="border-bottom: none; border-left: 1px solid #EAEAEA; border-right: none; border-top: 1px solid #EAEAEA; line-height: 16px; padding: 4px 22px; vertical-align: top;">Категория специалиста</td>';
						$content .= '<td style="border-bottom: none; border-left: 1px solid #EAEAEA; border-right: none; border-top: 1px solid #EAEAEA; line-height: 16px; padding: 4px 22px; vertical-align: top;">'.$arRes["PROPERTY_VALUES"]["PERSON"].'</td>';
						$content .= '</tr>';*/
						
						$content .= "\n".'<tr>';
						$content .= "\n".'<td>Тема курса</td>';
						foreach($arResult["FILTER"]["THEME"] as $theme)
							if($theme["ID"] == $arRes["PROPERTY_VALUES"]["THEME"])
								$content .= "\n".'<td>'.$theme["NAME"].'</td>';
						$content .= "\n".'</tr>';
						
						$content .= "\n".'<tr>';
						$content .= "\n".'<td>Название компании</td>';
						$content .= "\n".'<td>'.$arRes["PROPERTY_VALUES"]["COMPANY_NAME"].'</td>';
						$content .= "\n".'</tr>';
						
						$content .= "\n".'<tr>';
						$content .= "\n".'<td>Страна</td>';
						$content .= "\n".'<td>'.$arResult["COUNTRIES"][$arRes["PROPERTY_VALUES"]["COMPANY_COUNTRY"]].'</td>';
						$content .= "\n".'</tr>';						
						
						$content .= "\n".'<tr>';
						$content .= "\n".'<td>Регион</td>';
						$content .= "\n".'<td>'.$arResult["REGIONS"][$arRes["PROPERTY_VALUES"]["COMPANY_COUNTRY"]][$arRes["PROPERTY_VALUES"]["COMPANY_REGION"]].'</td>';
						$content .= "\n".'</tr>';
						
						$content .= "\n".'<tr>';
						$content .= "\n".'<td>Город</td>';
						$content .= "\n".'<td>'.$arResult["TOWNS"][$arRes["PROPERTY_VALUES"]["COMPANY_REGION"]][$arRes["PROPERTY_VALUES"]["COMPANY_TOWN"]].'</td>';
						$content .= "\n".'</tr>';
						
						$content .= "\n".'<tr>';
						$content .= "\n".'<td>Адрес (без города)</td>';
						$content .= "\n".'<td>'.$arRes["PROPERTY_VALUES"]["COMPANY_ADDRESS"].'</td>';
						$content .= "\n".'</tr>';						
						
						$content .= "\n".'<tr>';
						$content .= "\n".'<td>Телефон</td>';
						$content .= "\n".'<td>'.$arRes["PROPERTY_VALUES"]["COMPANY_PHONE"].'</td>';
						$content .= "\n".'</tr>';
						
						$content .= "\n".'<tr>';
						$content .= "\n".'<td>Email</td>';
						$content .= "\n".'<td>'.$arRes["PROPERTY_VALUES"]["COMPANY_EMAIL"].'</td>';
						$content .= "\n".'</tr>';
						
						$content .= "\n".'</table>';
						
						$content .= "\n".'<h3>Контактное лицо, оставившее заявку на обучение</h3>';
						
						$content .= "\n".'<table style="margin-bottom: 16px; border-collapse: collapse;" border="1" cellspacing="2" cellpadding="10" valign="top">';
						
						$content .= "\n".'<tr>';
						$content .= "\n".'<td>ФИО специалиста</td>';
						$content .= "\n".'<td>'.$arRes["PROPERTY_VALUES"]["CONTACT_NAME"].'</td>';
						$content .= "\n".'</tr>';
						
						$content .= "\n".'<tr>';
						$content .= "\n".'<td>Должность</td>';
						$content .= "\n".'<td>'.$arRes["PROPERTY_VALUES"]["CONTACT_POSITION"].'</td>';
						$content .= "\n".'</tr>';
						
						$content .= "\n".'<tr>';
						$content .= "\n".'<td>Телефон</td>';
						$content .= "\n".'<td>'.$arRes["PROPERTY_VALUES"]["CONTACT_PHONE"].'</td>';
						$content .= "\n".'</tr>';
						
						$content .= "\n".'<tr>';
						$content .= "\n".'<td>Email</td>';
						$content .= "\n".'<td>'.$arRes["PROPERTY_VALUES"]["CONTACT_EMAIL"].'</td>';
						$content .= "\n".'</tr>';
						
						$content .= "\n".'</table>';
						
						if(!empty($arRes["PROPERTY_VALUES"]["LISTENERS"])) {
							$content .= "\n".'<h3>Информация о потенциальных слушателях</h3>';
							
							$content .= "\n".'<table style="margin-bottom: 16px; border-collapse: collapse;" border="1" cellspacing="2" cellpadding="10" valign="top">';
							
							$content .= "\n".'<tr>';
							$content .= "\n".'<td>ФИО специалиста</td>';
							$content .= "\n".'<td>Должность</td>';
							$content .= "\n".'<td>Телефон</td>';
							$content .= "\n".'<td>E-mail</td>';
							//$content .= "\n".'<td>Базовый блок будет меняться на углубленный</td>';
							//$content .= "\n".'<td>Необходима рекомендация Учебного центра</td>';
							$content .= "\n".'<td>Примечание</td>';
							$content .= "\n".'</tr>';
							
							foreach($_REQUEST["LISTENER"] as $contact) {
								$content .= "\n".'<tr>';
								$content .= "\n".'<td>'.$contact["NAME"].'</td>';
								$content .= "\n".'<td>'.$contact["POSITION"].'</td>';
								$content .= "\n".'<td>'.$contact["PHONE"].'</td>';
								$content .= "\n".'<td>'.$contact["EMAIL"].'</td>';
								//$content .= "\n".'<td>'.($contact["CHANGE_BASE"] ? "Да" : "Нет").'</td>';
								//$content .= "\n".'<td>'.($contact["NEED_RECOMENTED"] ? "Да" : "Нет").'</td>';
								$content .= "\n".'<td>'.$contact["TEXT"].'</td>';
								$content .= "\n".'</tr>';
							}
							$content .= "\n".'</table>';
						}
						$arSend = array(
							"EMAIL" => $arRes["PROPERTY_VALUES"]["CONTACT_EMAIL"],
							"CONTENT" => $content,
							"NAME" => $arRes["PROPERTY_VALUES"]["CONTACT_NAME"]
						);
						CEvent::Send("USER_LEARNING_APPLICATION", "s1", $arSend, "Y", 75);
						CEvent::Send("USER_LEARNING_APPLICATION", "s1", $arSend, "Y", 76);
						LocalRedirect($APPLICATION->GetCurPageParam("success=yes"));
					}					
 				}
			}
		/* }
		else {
			ShowError(GetMessage("NOT_USER_ACCESS"));
			return;
		}
	}
	else {
		ShowError(GetMessage("NOT_AUTH_USER"));
		return;
	} */
	$this->IncludeComponentTemplate($componentPage);
}
?>