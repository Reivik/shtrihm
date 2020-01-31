<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if (count($arResult["ITEMS"]) < 1):?>
	<?return;?>
<?endif;?>
<div class="headSlider">
	<a class="buttons prev" id="btnPrev" href="javascript:void(0)">left</a>
	<div class="viewport headSliderCont" id="flsGallery">
		<ul class="overview headSliderContIn">
			<?foreach($arResult["ITEMS"] as $key => $arItem):?>
				<li>
					<a href="<?=$arItem["PROPERTIES"]["LINK"]["VALUE"]?>" target="_blank">
						<table class="main_head_slider">
							<tr>
								<td align="right" style="vertical-align: top;">
									<?if(is_array($arItem["PREVIEW_PICTURE"])):?>
										<img src="<?=$arItem["PREVIEW_PICTURE"]["RESIZE_IMG"]["src"]?>" width="<?=$arItem["PREVIEW_PICTURE"]["RESIZE_IMG"]["width"]?>" height="<?=$arItem["PREVIEW_PICTURE"]["RESIZE_IMG"]["height"]?>" title="<?=$arItem["NAME"]?>" alt="<?=$arItem["NAME"]?>" />
									<?else:?>
										<img src="/images/no_photo_59.jpg" />
									<?endif;?>
								</td>
								<td class="text" align="left" style="vertical-align: top;">
									<?=$arItem["NAME"]?>
								</td>
							</tr>
						</table>
					</a>
				</li>
			<?endforeach;?>
		</ul>
	</div>
	<a class="buttons next" id="btnNext" href="javascript:void(0)">right</a>
</div>