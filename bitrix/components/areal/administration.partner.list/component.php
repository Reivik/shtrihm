<?
if(CModule::IncludeModule("iblock"))
{
	if($USER->IsAuthorized()) {
		if(in_array(UG_AKP, CUser::GetUserGroup($USER->GetID())) || in_array(UG_ADMIN, CUser::GetUserGroup($USER->GetID()))) {
			$res = CIBlockElement::GetList(array("SORT" => "ASC"), array("IBLOCK_ID" => IB_COMPANY), false, false, array("ID", "NAME", "PREVIEW_PICTURE", "PROPERTY_DIRECTION", "PROPERTY_PARTNERS_LEVELS", "PROPERTY_STATUS", "PROPERTY_CONTACT_USER"));
			while($company = $res->GetNext()) {
				unset($main_office);
				unset($offices);
				unset($office);
				unset($rsUsers);
				unset($arUsers);
				$offices = CIBlockElement::GetList(array(), array("IBLOCK_ID" => IB_FILIALS, "PROPERTY_company" => $company["ID"], "!PROPERTY_main" => false), false, false, array("PROPERTY_company", "PROPERTY_main", "PROPERTY_region.NAME", "PROPERTY_town.NAME", "PROPERTY_address", "PROPERTY_phone", "PROPERTY_email"));
				if($office = $offices->GetNext()) {
					$main_office = array(
						"REGION" => $office["PROPERTY_REGION_NAME"],
						"TOWN" => $office["PROPERTY_TOWN_NAME"],
						"ADDRESS" => $office["PROPERTY_ADDRESS_VALUE"],
						"PHONE" => $office["PROPERTY_PHONE_VALUE"],
						"EMAIL" => $office["PROPERTY_EMAIL_VALUE"]
					);
				}
				if(!empty($company["PROPERTY_CONTACT_USER_VALUE"])) {
					$rsUsers = CUser::GetList(($by="id"), ($order="desc"), array("ID" => $company["PROPERTY_CONTACT_USER_VALUE"], "UF_COMPANY" => $company["ID"]), array("SELECT" => array("UF_*")));
					$arUsers = $rsUsers->GetNext();
					if($arUsers["UF_PEOPLE"] && $arUsers["EMAIL"]) {
						$people = CIBlockElement::GetList(array(), array("IBLOCK_ID" => IB_PEOPLES, "ID" => $arUsers["UF_PEOPLE"]), false, false, array("NAME", "PROPERTY_", "PROPERTY_", "PROPERTY_"));
					}
					pr($arUsers["EMAIL"]);
					pr($arUsers["UF_PEOPLE"]);
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