<?
define("NO_KEEP_STATISTIC", true);
define("NO_AGENT_STATISTIC", true);
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

$result = array();

/* $arSelect = Array();
$arFilter = Array();
$res = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter, false, false, $arSelect);
while($ob = $res->GetNext())
{
	
} */

/* echo json_encode($result); */

require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");
?>