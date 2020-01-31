<?
if(CModule::IncludeModule("iblock"))
{	
	CityDefinition();	
	$arResult = GetLocationInformation();	
	$this->IncludeComponentTemplate();
}
?>