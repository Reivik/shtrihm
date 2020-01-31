<?
if(CModule::IncludeModule("iblock"))
{
	$res = CIBlockElement::GetList(array("SORT" => "ASC"), array("IBLOCK_ID" => IB_PRINTING_PRODUCTS, "ACTIVE" => "Y"), false, false, array("NAME", "PROPERTY_FILE", "PREVIEW_TEXT"));
	while($element = $res->GetNext()) {
		$rsFile = CFile::GetByID($element["PROPERTY_FILE_VALUE"]);
		$arFile = $rsFile->Fetch();		
		$extension = substr(strrchr($arFile["FILE_NAME"], '.'), 1);
		$arResult["FILES"][] = array(
			"NAME" => $element["~NAME"],
			"LINK" => "/upload/".$arFile["SUBDIR"]."/".$arFile["FILE_NAME"],
			"EXT" => $extension,
			"PREVIEW_TEXT" => $element["PREVIEW_TEXT"]
		);
	}	
	$this->IncludeComponentTemplate();
}
?>