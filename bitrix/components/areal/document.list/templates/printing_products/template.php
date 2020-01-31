<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if (count($arResult["DOCS"]) > 0):?>
	<div class="implantations">
		<?foreach($arResult["DOCS"] as $key => $arItem):?>
			<article <?if(($key+1)%3 == 0):?> class="last" <?endif;?>>
				<div class="img">
					<?if($arItem["PREVIEW_PICTURE"]):?>
						<a href="<?=$arParams["DOWNLOAD_PATH"]?>?file=<?=$arItem["ID"]?>&iblock=<?=$arParams["IBLOCK_ID"]?>" title="<?=$arItem["NAME"]?>">
							<img src="<?=$arItem["PREVIEW_PICTURE"]["src"]?>" width="<?=$arItem["PREVIEW_PICTURE"]["width"]?>" height="<?=$arItem["PREVIEW_PICTURE"]["height"]?>" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" />
						</a>
					<?else:?>
						<a href="<?=$arParams["DOWNLOAD_PATH"]?>?file=<?=$arItem["ID"]?>&iblock=<?=$arParams["IBLOCK_ID"]?>" title="<?=$arItem["NAME"]?>">
							<img src="/design/images/no-photo/pic201x160.png" title="<?=$arItem["NAME"]?>" width="201" height="160" alt="<?=$arItem["NAME"]?>" />
						</a>
					<?endif;?>						
				</div>
				<h2><a href="<?=$arParams["DOWNLOAD_PATH"]?>?file=<?=$arItem["ID"]?>&iblock=<?=$arParams["IBLOCK_ID"]?>" title="<?=$arItem["NAME"]?>"><?=$arItem["NAME"]?></a></h2>
				<div class="detail">
					<?=$arItem["PREVIEW_TEXT"]?>
				</div>
				<a href="<?=$arParams["DOWNLOAD_PATH"]?>?file=<?=$arItem["ID"]?>&iblock=<?=$arParams["IBLOCK_ID"]?>" title="Скачать"><span class="btn">Скачать</span></a>
			</article>
		<?endforeach;?>
		<div class="clear"></div>
	</div>
	<?if($arParams["DISPLAY_BOTTOM_PAGER"] && $arResult['NAV_RESULT']->NavPageCount!=1):?>
		<br /><?=$arResult["NAV_STRING"]?>
	<?endif;?>
<?else:?>
	<div class="messErr">На данный момент нет доступных файлов.</div>
<?endif;?>