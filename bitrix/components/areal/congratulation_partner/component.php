<?
if(CModule::IncludeModule("iblock"))
{
	$res = CIBlockElement::GetList(
		array("DATE_ACTIVE_FROM" => "DESC", "PROPERTY_COMPANY.RATING" => "DESC"),
		array("IBLOCK_ID" => IB_CONGRATULATIONS, "ACTIVE" => "Y", "<=DATE_ACTIVE_FROM" => ConvertTimeStamp(), ">=DATE_ACTIVE_TO" => ConvertTimeStamp()),
		false,
		array("nTopCount" => 1),
		array("NAME", "PREVIEW_PICTURE", "PREVIEW_TEXT", "PROPERTY_COMPANY", "DATE_ACTIVE_FROM", "DATE_ACTIVE_TO")
	);
	if($element = $res->GetNext()) {
		$arResult = array(
			"NAME" => $element["NAME"],
			"PREVIEW_PICTURE" => CFile::ResizeImageGet( 
				$element["PREVIEW_PICTURE"], 
				array("width" => 183, "height" => 172), 
				BX_RESIZE_IMAGE_PROPORTIONAL_ALT,
				true 
			),
			"PREVIEW_TEXT" => $element["PREVIEW_TEXT"]
		);
	}
	$this->IncludeComponentTemplate();
}
?>