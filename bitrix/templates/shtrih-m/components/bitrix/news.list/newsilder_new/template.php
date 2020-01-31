<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="block" style="    margin-bottom: 25px;">
<div class="news-list"  style="padding: 0px;
    border: 1px solid #c6c6c6;">
		<div class="slider-pro" id="my-slider" style="margin:0!important;">
<div class="sp-slides">
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	<div class="sp-slide" style="background:url(<?=$arItem["DETAIL_PICTURE"]["SRC"]?>) no-repeat scroll center center;background-size:cover;" >
		<a style="display:block;position:absolute;width:100%;height:100%;" href="<?=$arItem["DISPLAY_PROPERTIES"]["LINK"]["VALUE"]?>" target="_blank"></a>


	</div>

<?endforeach;?>
	</div>
</div>
</div>
</div>
<script>
$( '#my-slider' ).sliderPro({
				width: 940,
				height: 353,
				orientation: 'horizontal',
				loop: true,
				arrows: true,
				buttons: false,
				thumbnailPointer: false,
	autoplay:true,
	autoplayDelay:15000,

});
</script>