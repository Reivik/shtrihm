<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<ul class="catalog">
<?//pr($arResult);
$CURRENT_DEPTH=$arResult["SECTION"]["DEPTH_LEVEL"]+1;
foreach($arResult["SECTIONS"] as $arSection):
	$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_EDIT"));
	$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_DELETE"), array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM')));
	if($CURRENT_DEPTH<$arSection["DEPTH_LEVEL"])
		echo "<ul>";
	elseif($CURRENT_DEPTH>$arSection["DEPTH_LEVEL"])
		echo str_repeat("</ul>", $CURRENT_DEPTH - $arSection["DEPTH_LEVEL"]);
	$CURRENT_DEPTH = $arSection["DEPTH_LEVEL"];
?>
	<li id="<?=$this->GetEditAreaId($arSection['ID']);?>" class="<?if(strlen($arSection["NAME"]) > 25):?> doubleLine <?endif;?> <?if(substr_count($_SERVER["REQUEST_URI"], $arSection["CODE"])):?> current <?endif;?>" >
		<a href="<?=$arSection["SECTION_PAGE_URL"]?>"><?=$arSection["NAME"]?><?if($arParams["COUNT_ELEMENTS"]):?>&nbsp;(<?=$arSection["ELEMENT_CNT"]?>)<?endif;?></a>
	</li>
<?endforeach?>
</ul>
