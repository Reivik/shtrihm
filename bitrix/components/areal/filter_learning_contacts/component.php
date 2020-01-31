<?
if(CModule::IncludeModule("iblock"))
{
	$arResult = GetLocationInformation();

	$GLOBALS["arrFilter"] = $filter;
	if((isset($_REQUEST["region"]) && $_REQUEST["region"] > 0))
		$GLOBALS["arrFilter"]["PROPERTY_REGION"] = $_REQUEST["region"];
	if((isset($_REQUEST["town"]) && $_REQUEST["town"] > 0))
		$GLOBALS["arrFilter"]["PROPERTY_CITY"] = $_REQUEST["town"];	
	if(!empty($_REQUEST["search_name"]))
		$GLOBALS["arrFilter"]["NAME"] = "%".$_REQUEST["search_name"]."%";
	
	$this->IncludeComponentTemplate();	
}
?>