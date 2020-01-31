<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$path = explode("/",$_SERVER["SCRIPT_URL"]);
if(count($path) <= 4) {	
	CModule::IncludeModule("iblock");
	$arFilter = array(
		"IBLOCK_ID" => 4,
		"ACTIVE" => "Y",
		"CODE" => $path[2]
	);
	$obCache = new CPHPCache;
	if($obCache->InitCache(36000, serialize($arFilter), "/iblock/catalog"))
	{
		$arCurSection = $obCache->GetVars();
	}
	else
	{
		$arCurSection = array();
		$dbRes = CIBlockSection::GetList(array(), $arFilter, false, array("ID"));
		$dbRes = new CIBlockResult($dbRes);

		if(defined("BX_COMP_MANAGED_CACHE"))
		{
			global $CACHE_MANAGER;
			$CACHE_MANAGER->StartTagCache("/iblock/catalog");

			if ($arCurSection = $dbRes->GetNext())
			{
				$CACHE_MANAGER->RegisterTag("iblock_id_4");
			}
			$CACHE_MANAGER->EndTagCache();
		}
		else
		{
			if(!$arCurSection = $dbRes->GetNext())
				$arCurSection = array();
		}

		$obCache->EndDataCache($arCurSection);
	}
	$APPLICATION->IncludeComponent("bitrix:catalog.smart.filter", "shtrih-m", array(
		"IBLOCK_TYPE" => "catalog",
		"IBLOCK_ID" => "4",
		"SECTION_ID" => $arCurSection["ID"],
		"FILTER_NAME" => "smartFilter",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_GROUPS" => "Y",
		"SAVE_IN_SESSION" => "N",
		"PRICE_CODE" => array(
		)
		),
		false
	);
}
?> 