<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?$arNavParams = array(
	"nPageSize" => 1,
	"bShowAll" => "",
);
	
$arNavigation = CDBResult::GetNavParams($arNavParams);

$arResult["NAV_RESULT"] = new CDBResult;

if($arResult["DETAIL_TEXT_TYPE"]=="html" && strstr($arResult["DETAIL_TEXT"], "<BREAK />") !== false)
	$arPages = explode("<BREAK />", $arResult["DETAIL_TEXT"]);
elseif($arResult["DETAIL_TEXT_TYPE"]!="html" && strstr($arResult["DETAIL_TEXT"], "&lt;BREAK /&gt;")!==false)
	$arPages=explode("&lt;BREAK /&gt;", $arResult["DETAIL_TEXT"]);
else
	$arPages=array();


$arResult["DETAIL_TEXT_PAGES"] = $arPages;

$arResult["NAV_RESULT"]->InitFromArray($arPages);
$arResult["NAV_RESULT"]->NavStart($arNavParams);

if(count($arPages) == 0)
	$arResult["NAV_RESULT"] = false;
else
{
	$arResult["NAV_STRING"] = $arResult["NAV_RESULT"]->GetPageNavStringEx($navComponentObject, $arParams["PAGER_TITLE"], $arParams["PAGER_TEMPLATE"], $arParams["PAGER_SHOW_ALWAYS"]);
	$arResult["NAV_CACHED_DATA"] = $navComponentObject->GetTemplateCachedData();
	
	$arResult["NAV_TEXT"] = "";
	while($ar = $arResult["NAV_RESULT"]->Fetch()) 
		$arResult["NAV_TEXT"].=$ar;
}?>
