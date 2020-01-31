<?
if(CModule::IncludeModule("iblock"))
{
	if(!empty($arParams["ID"])) {
		$elements = CIBlockElement::GetList(array(), array("ID" => $arParams["ID"]), false, false, array("ID", "NAME", "DETAIL_TEXT", "DETAIL_PICTURE"));
		if($element = $elements->GetNext())
			$arResult = array(
				"NAME" => $element["NAME"],
				"DETAIL_TEXT" => $element["DETAIL_TEXT"],
				"DETAIL_PICTURE" => CFile::ResizeImageGet( 
					$element["DETAIL_PICTURE"], 
					array("width" => 345, "height" => 458), 
					BX_RESIZE_IMAGE_PROPORTIONAL_ALT,
					true 
				)
			);
	}
	$APPLICATION->SetTitle($arResult["NAME"]);
	$this->IncludeComponentTemplate();
}
?>