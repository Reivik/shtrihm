<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
//delayed function must return a string

__IncludeLang(dirname(__FILE__).'/lang/'.LANGUAGE_ID.'/'.basename(__FILE__));

$curPage = $GLOBALS['APPLICATION']->GetCurPage($get_index_page=false);

if ($curPage != SITE_DIR)
{
	if (empty($arResult) || $curPage != $arResult[count($arResult)-1]['LINK'])
		$arResult[] = array('TITLE' =>  htmlspecialcharsback($GLOBALS['APPLICATION']->GetTitle(false, true)), 'LINK' => $curPage);
}

if(empty($arResult))
	return "";

$strReturn = '';
$path = explode("/",$_SERVER["REQUEST_URI"]);

if(($path[2] == "news" && count($path) == 6) || $path[1] == "catalog")
	unset($arResult[count($arResult)-1]);
for($index = 0, $itemSize = count($arResult); $index < $itemSize; $index++)
{
	//$strReturn .= '<i>&ndash;</i>';
	if($arResult[$index]["LINK"] != '/')
		$strReturn .= ' / ';

	$title = htmlspecialcharsex($arResult[$index]["TITLE"]);
	
	if($arResult[$index]["LINK"] <> "" && $index + 1 < count($arResult))
		$strReturn .= '<a href="'.$arResult[$index]["LINK"].'" title="'.$title.'">'.$title.'</a>';
	elseif($path[1] == "catalog")
		$strReturn .= '<a href="'.$arResult[$index]["LINK"].'" title="'.$title.'">'.$title.'</a> /';
	elseif($path[2] == "news" && count($path) == 6) 
		$strReturn .= '<a href="'.$arResult[$index]["LINK"].'" title="'.$title.'">'.$title.'</a> /';
	else
		$strReturn .= '<span>'.$title.'</span>';
}
//echo $APPLICATION->GetProperty("NOT_SHOW_LAST_NAV_CHAIN");
return $strReturn;
?>