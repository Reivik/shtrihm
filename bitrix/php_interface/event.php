<?
//подсчет общего рейтинга компании(сумма рейтингов ее статусов)
AddEventHandler("iblock", "OnAfterIBlockElementUpdate", "OnAfterIBlockElementUpdateHandler");
AddEventHandler("iblock", "OnAfterIBlockElementAdd", "OnAfterIBlockElementUpdateHandler");

function OnAfterIBlockElementUpdateHandler(&$arFields)
{
	if($arFields["RESULT"] == 1 && $arFields["IBLOCK_ID"] == IB_COMPANY) {
		if(CModule::IncludeModule("iblock")) {
			$res = CIBlockElement::GetList(
				array(), 
				array("IBLOCK_ID" => IB_COMPANY, "ID" => $arFields["ID"]), 
				false, 
				false, 
				array("ID", "PROPERTY_STATUS")
			);
			if($element = $res->GetNext()) {
				if(!empty($element["PROPERTY_STATUS_VALUE"])) {
					$rating = 0;
					foreach($element["PROPERTY_STATUS_VALUE"] as $status) {
						unset($statuses);
						unset($stat);
						$statuses = CIBlockElement::GetList(
							array(), 
							array("IBLOCK_ID" => IB_STATUS_COMPANY, "ID" => $status), 
							false, 
							false, 
							array("PROPERTY_RATING")
						);
						if($stat = $statuses->GetNext())
							if($stat["PROPERTY_RATING_VALUE"] > 0)
								$rating = $rating + $stat["PROPERTY_RATING_VALUE"];
					}
				}
				CIBlockElement::SetPropertyValuesEx($element["ID"], false, array("RATING" => $rating));
			}
		}
	}
}
?>