<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if(!$arResult["NavShowAlways"])
{
	if ($arResult["NavRecordCount"] == 0 || ($arResult["NavPageCount"] == 1 && $arResult["NavShowAll"] == false))
		return;
}

?>
<ul class="pages">
<?
$strNavQueryString = ($arResult["NavQueryString"] != "" ? $arResult["NavQueryString"]."&amp;" : "");
$strNavQueryStringFull = ($arResult["NavQueryString"] != "" ? "?".$arResult["NavQueryString"] : "");
?>
<?
$path = explode("/", $_SERVER["REQUEST_URI"]);
	$bFirst = true;
	if ($arResult["NavPageNomer"] > 1):
		if($arResult["bSavePage"]):
?>
			<li><a class="prevLi <?if(count($path) > 3 && $path[1] == "catalog"):?> catalog_hash <?endif;?>" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>"><?=GetMessage("nav_prev")?></a></li>
<?
		else:
			if ($arResult["NavPageNomer"] > 2):
?>
			<li><a class="prevLi <?if(count($path) > 3 && $path[1] == "catalog"):?> catalog_hash <?endif;?>" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>"><?=GetMessage("nav_prev")?></a></li>
<?
			else:
?>
			<li><a class="prevLi <?if(count($path) > 3 && $path[1] == "catalog"):?> catalog_hash <?endif;?>" href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"><?=GetMessage("nav_prev")?></a></li>
<?
			endif;
		
		endif;
		
		if ($arResult["nStartPage"] > 1):
			$bFirst = false;
			if($arResult["bSavePage"]):
?>
			<li><a <?if(count($path) > 3 && $path[1] == "catalog"):?> class="catalog_hash" <?endif;?> href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=1">1</a></li>
<?
			else:
?>
			<li><a  <?if(count($path) > 3 && $path[1] == "catalog"):?> class="catalog_hash" <?endif;?>href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>">1</a></li>
<?
			endif;
			if ($arResult["nStartPage"] > 2):
?>
			<li><span>...</span></li>
<?
			endif;
		endif;
	endif;

	do
	{
		if ($arResult["nStartPage"] == $arResult["NavPageNomer"]):
?>
		<li class="active"><a  <?if(count($path) > 3 && $path[1] == "catalog"):?> class="catalog_hash" <?endif;?>href = "#tabs"><?=$arResult["nStartPage"]?></a></li>
<?
		elseif($arResult["nStartPage"] == 1 && $arResult["bSavePage"] == false):
?>
		<li><a  <?if(count($path) > 3 && $path[1] == "catalog"):?> class="catalog_hash" <?endif;?>href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>#tabs"><?=$arResult["nStartPage"]?></a></li>
<?
		else:
?>
		<li><a  <?if(count($path) > 3 && $path[1] == "catalog"):?> class="catalog_hash" <?endif;?>href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["nStartPage"]?>#tabs"<?
			?> ><?=$arResult["nStartPage"]?></a></li>
<?
		endif;
		$arResult["nStartPage"]++;
		$bFirst = false;
	} while($arResult["nStartPage"] <= $arResult["nEndPage"]);
	
	if($arResult["NavPageNomer"] < $arResult["NavPageCount"]):
		if ($arResult["nEndPage"] < $arResult["NavPageCount"]):
			if ($arResult["nEndPage"] < ($arResult["NavPageCount"] - 1)):
?>
		<li><span>...</span></li>
<?
			endif;
?>
		<li><a  <?if(count($path) > 3 && $path[1] == "catalog"):?> class="catalog_hash" <?endif;?>href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["NavPageCount"]?>#tabs"><?=$arResult["NavPageCount"]?></a></li>
<?
		endif;
?>
		<li><a  <?if(count($path) > 3 && $path[1] == "catalog"):?> class="catalog_hash" <?endif;?>class="nextLi" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>#tabs"><?=GetMessage("nav_next")?></a></li>
<?
	endif;

?>
</ul>
