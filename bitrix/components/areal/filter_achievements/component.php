<?
if(CModule::IncludeModule("iblock"))
{
	$arResult = GetLocationInformation();
	//сброс геотаргетинга
	$arResult["SELECTED_REGION"]=0;
	$arResult["SELECTED_TOWN"]=0;

	if(isset($_REQUEST["region"]))
		$arResult["SELECTED_REGION"] = $_REQUEST["region"];	
	if(isset($_REQUEST["town"]))
		$arResult["SELECTED_TOWN"] = $_REQUEST["town"];	

	$GLOBALS["arrFilter"] = $filter;
	if($arResult["SELECTED_REGION"] > 0)
		$GLOBALS["arrFilter"]["PROPERTY_REGION"] = $arResult["SELECTED_REGION"];
	if($arResult["SELECTED_TOWN"] > 0)
		$GLOBALS["arrFilter"]["PROPERTY_CITY"] = $arResult["SELECTED_TOWN"];	
	if(!empty($_REQUEST["search_name"]))
		$GLOBALS["arrFilter"]["NAME"] = "%".$_REQUEST["search_name"]."%";
	$this->IncludeComponentTemplate();
}
?>