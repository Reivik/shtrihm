<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="block">
<div class="news-list"  style="padding: 9px;
    border: 1px solid #c6c6c6;">
		<div class="slider-pro" id="my-slider" style="margin:0!important;">
<div class="sp-slides">
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	<div class="sp-slide" style="background:url(<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>) no-repeat scroll center center;background-size:cover;" >
		<a style="display:block;position:absolute;width:100%;height:100%;" href="<?=$arItem["DISPLAY_PROPERTIES"]["LINK"]["VALUE"]?>"></a>
			<div class="slideText">
				<h2 class="sp-layer" style="padding:10px;max-height: 100px;line-height:1.2;"><?echo $arItem["NAME"]?></h2>
				<div style="padding:10px;"><?echo $arItem["PREVIEW_TEXT"]?></div>
			</div>
		<div class="sp-thumbnail" style="width:100%;background:#f5f5f5;">
				<div style="width:30%;height:80px;float:left;background:url(<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>) no-repeat scroll center center;background-size:cover;"></div>
			<p style="width:60%;float:left;padding:10px;line-height: 20px;"class="sp-thumbnail-text"><?echo $arItem["NAME"]?></p>
            </div>
	</div>

<?endforeach;?>
	</div>
</div>
</div>
</div>
<script>
$( '#my-slider' ).sliderPro({
				width: 680,
				height: 333,
				orientation: 'horizontal',
				loop: false,
				arrows: true,
				buttons: false,
				thumbnailsPosition: 'right',
				thumbnailPointer: true,
				thumbnailWidth: 253,
	autoplay:true,
	autoplayDelay:3000,

});
</script>