<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?><?
	
	$arResult = GetLocationInformation();
	if(isset($_REQUEST["submit"]) && check_bitrix_sessid())
	{
		if($_REQUEST['fio'])
		{
			$fid = CFile::SaveFile($_FILES["file"], "form/form_vacancy");
			
			if($fid)
			{
				$el = new CIBlockElement;
			
				$property = array(
					"regions" => (int)$_REQUEST["region"],
					"town"    => (int)$_REQUEST["town"],
					"fone"    => (string)$_REQUEST["phone"],
					"mail"    => (string)$_REQUEST["mail"],
					"file"    => $fid,
					"vacancy" => (int)$_REQUEST["vacancy"]
				);
				$element = Array(
				  "IBLOCK_ID"        => IB_REQUEST_VACANCY,
				  "DATE_ACTIVE_FROM" => date("d.m.Y"),
				  "PROPERTY_VALUES"  => $property,
				  "NAME"             => $_REQUEST['fio'],
				  "ACTIVE"           => "Y",
				  "PREVIEW_TEXT"     => $_REQUEST['about'],
				  );
					print_r($_REQUEST);
				if($el->Add($element))
				{
					$arSelect = Array("ID", "NAME");
					$arFilter = Array("IBLOCK_ID"=>IB_VACANCY, "ID"=>$_REQUEST["vacancy"]);
					$res = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter, false, false, $arSelect);
					if($ob = $res->GetNext())
						$nameVacancy = $ob["NAME"];
					
					//письмо соискателю
					$arEventFields = array(
						"EMAIL"      => (string)$_REQUEST["mail"],
						"FIO"        => (string)$_REQUEST["fio"],
						"VACANCY"    => (string)$nameVacancy,
						"EMAIL_FROM" => (string)$_REQUEST["email_manager"],
					);

					CEvent::Send("MY_FORM_VACANCY_USER", "s1", $arEventFields);
					
					//письмо работодателю
					$arEventFields = array(
						"EMAIL"     => (string)$_REQUEST["mail"],
						"FIO"       => (string)$_REQUEST["fio"],
						"VACANCY"   => (string)$nameVacancy,
						"EMAIL_TO"  => (string)$_REQUEST["email_manager"],
						"CITY"      => (string)$_REQUEST["town_text"],
						"PHONE"     => (string)$_REQUEST["fone"],
						"INFOADD"   => (string)$_REQUEST["about"],
						"MY_FILE"   => (string)CFile::GetPath($fid)
					);

					CEvent::Send("MY_FORM_VACANCY_ADMIN", "s1", $arEventFields);
					
					LocalRedirect($APPLICATION->GetCurPageParam("success=Y"));
				}
			}
		}
	}	
	
	$this->IncludeComponentTemplate();
?>