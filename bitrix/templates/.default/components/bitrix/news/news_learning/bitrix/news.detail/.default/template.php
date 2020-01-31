<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="clients_detail">
	<?if(is_array($arResult["SMALL_PREVIEW_PICTURE"])):?>
		<div class="solutionLogo">
			<a href="<?=$arResult["PREVIEW_PICTURE"]["SRC"]?>" class="main_image">	
				<img src="<?=$arResult["SMALL_PREVIEW_PICTURE"]["src"]?>" width="<?=$arResult["SMALL_PREVIEW_PICTURE"]["width"]?>" height="<?=$arResult["SMALL_PREVIEW_PICTURE"]["height"]?>" alt="<?=$arResult["NAME"]?>" title="<?=$arResult["NAME"]?>"  />
				<span class="zoom" title="<?=GetMessage("OPEN_BIG_PICTURE")?>"></span>
			</a>
		</div>
	<?endif?>
	<?if(!empty($arResult["DETAIL_TEXT"])):?>
		<?=$arResult["DETAIL_TEXT"]?>
	<?endif;?>
</div>