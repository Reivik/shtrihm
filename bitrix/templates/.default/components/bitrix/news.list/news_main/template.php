<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if(count($arResult["ITEMS"]) > 0):?>
<div class="block articles <?if($arParams["IBLOCK_ID"]==7):?>news_block<?endif?>" <?if($arParams["IBLOCK_ID"]==8):?>style="display:none;"<?endif?> > 
	<div class="main_block">
		<div class='ap_main_items'>
			<h2 style="font-family: Roboto Light;font-size: 24px;margin-top: -26px;margin-bottom: 55px;font-weight: 100;"><?=$arResult["NAME"]?></h2>
			<div class="all">
				<a style="font-family: Roboto Light;font-size: 16px;" href="<?=GetMessage("HREF_".$arParams["IBLOCK_TYPE"]."_".$arParams["IBLOCK_ID"])?>"><?=GetMessage("ALL_".$arParams["IBLOCK_TYPE"]."_".$arParams["IBLOCK_ID"])?></a>
			</div>
			<?foreach($arResult["ITEMS"] as $key => $arItem):?>
				<div class="news <?if(($key+1)%2 == 0):?> last <?endif;?>">
					<div class="photo">
						<a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
						<?if(is_array($arItem["PREVIEW_PICTURE"])):?>
							<img src="<?=$arItem["PREVIEW_PICTURE"]["src"]?>" width="<?=$arItem["PREVIEW_PICTURE"]["width"]?>" height="<?=$arItem["PREVIEW_PICTURE"]["height"]?>" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" />
						<?else:?>
							<img src="/design/images/no-photo/pic62x62.png" width="62" height="62" title="<?=$arItem["NAME"]?>" alt="<?=$arItem["NAME"]?>"/>
						<?endif;?>
						</a>
					</div>
					<div class="descr">
						<a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
							<?if(!empty($arItem["DISPLAY_ACTIVE_FROM"])):?>
								<?$arDates=explode(' ',$arItem["DISPLAY_ACTIVE_FROM"]);?> 
								<time><?='<span>'.$arDates[0].' '.$arDates[1].'</span> '.$arDates[2]?></time><br />
							<?endif;?>
							<p><?=$arItem["NAME"]?></p>
						</a>
					</div>
				</div>
			<?endforeach;?>
		</div>
		<div class="clear"></div>
	</div>
</div>
<?endif;?>