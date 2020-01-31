<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="congratulations-list">
	<?foreach($arResult["ITEMS"] as $key => $items):?>
		<article <?if(($key+1)%3 == 0):?> class="last" <?endif;?>>
			<a href="#">
				<div class="normal-state">
					<div class="img-wrap">
						<div class="img">
							<img src="<?=$items["PREVIEW_PICTURE"]["src"]?>" width="<?=$items["PREVIEW_PICTURE"]["width"]?>" height="<?=$items["PREVIEW_PICTURE"]["height"]?>" alt="" title="" />
						</div>
					</div>
					<div class="ctext">
						<span>поздравляем</span><?=$items["NAME"]?>
					</div>
				</div>
				<div class="active-state">
					<div class="left">
						<h2>поздравляем <span><?=$items["NAME"]?></span></h2>
						<?=$items["PREVIEW_TEXT"]?>
					</div>
					<div class="right">
						<div class="img-wrap">
							<div class="img">
								<img src="<?=$items["PREVIEW_PICTURE"]["src"]?>" width="<?=$items["PREVIEW_PICTURE"]["width"]?>" height="<?=$items["PREVIEW_PICTURE"]["height"]?>" alt="" title="" />
							</div>
						</div>
					</div>
				</div>
			</a>
		</article>
	<?endforeach;?>
	<div class="clear"></div>
	<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
		<?=$arResult["NAV_STRING"]?>
	<?endif;?>
</div>