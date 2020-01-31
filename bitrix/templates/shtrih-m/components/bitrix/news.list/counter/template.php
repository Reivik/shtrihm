<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	$date = MakeTimeStamp($arItem["DATE_ACTIVE_TO"], "DD.MM.YYYY");
	$year = FormatDate("Y", $date);
	$month = FormatDate("m", $date) - 1;
	$day = FormatDate("d", $date);
	?>
	<div class="count_block" style="background:url(<?=$arItem['PREVIEW_PICTURE']['SRC']?>) no-repeat scroll center center;background-size:cover;">
		<div class="count_line">
			<div class="mini_logo">
			</div>
			<div class="count_name"><?=$arItem["DISPLAY_PROPERTIES"]["DATES"]["VALUE"]?><br>
				<?=$arItem["NAME"]?>
			</div>
		</div>
		<div class="count_line second_line">
			<div class="count_info">
				<?=$arItem["PREVIEW_TEXT"]?>
			</div>
			<div class="counter">
			</div>
			<div class="count_reg">
				<a href="<?=$arItem["DISPLAY_PROPERTIES"]["LINK"]["VALUE"]?>" target="_blank">Регистрация</a>
			</div>
		</div>
	</div>
<script>
var endDate = new Date(); 
endDate = new Date(<?=$year?>, <?=$month?>, <?=$day?>); 
$('.counter').countdown({until: endDate, 
						 layout: '<div>{dn}</div><span>д</span> <div>{hn}</div><span>ч</span> <div>{mn}</div><span>м</span> <div>{sn}</div><span>c</span>'});
</script>
<?endforeach;?>


