<?
if(CModule::IncludeModule("iblock"))
{
	$companies = CIBlockElement::GetList(
		array("SORT" => "ASC"), 
		array("IBLOCK_ID" => IB_COMPANY, "ACTIVE" => "Y", "NAME" => "%".$arParams["SEARCH_TEXT"]."%"),
		false, 
		false, 
		array("NAME", "ID", "PREVIEW_PICTURE")
	);
	while($company = $companies->GetNext())
		$arResult["PARTNERS"][] = array(
			"ID" => $company["ID"],
			"NAME" => $company["NAME"],
			"PREVIEW_PICTURE" => CFile::ResizeImageGet( 
				$company["PREVIEW_PICTURE"], 
				array("width" => 58, "height" => 58), 
				BX_RESIZE_IMAGE_PROPORTIONAL_ALT,
				true 
			)
		);
	$this->IncludeComponentTemplate();
}
?>