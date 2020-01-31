<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if (count($arResult["ITEMS"]) < 1):?>
	<?return;?>
<?endif;?>

<div class="block slider">
	<div class="blockContSlider">
		<ul class="sliderItems">
			<?foreach($arResult["ITEMS"] as $key => $arItem):?>
				<?if(is_array($arItem["PREVIEW_PICTURE"])):?>
					<li>
						<?if($arItem["PROPERTY_LINK_VALUE"]):?>
							<a href="<?=$arItem["PROPERTY_LINK_VALUE"]?>" title="<?=$arItem["NAME"]?>"><img src="<?=$arItem["PREVIEW_PICTURE"]["src"]?>" title="<?=$arItem["NAME"]?>" width="<?=$arItem["PREVIEW_PICTURE"]["width"]?>" height="<?=$arItem["PREVIEW_PICTURE"]["height"]?>" alt="<?=$arItem["NAME"]?>" /></a>
						<?else:?>
							<img src="<?=$arItem["PREVIEW_PICTURE"]["src"]?>" title="<?=$arItem["NAME"]?>" width="<?=$arItem["PREVIEW_PICTURE"]["width"]?>" height="<?=$arItem["PREVIEW_PICTURE"]["height"]?>" alt="<?=$arItem["NAME"]?>" />
						<?endif?>
						<div class="slideText">
							<h2>
								<table>
									<tr>
										<td>
											<?=$arItem["NAME"]?>
										</td>
									</tr>
								</table>
							</h2>
							<?if($arItem["PREVIEW_TEXT"]):?>
								<div class="comment">
									<?=$arItem["PREVIEW_TEXT"]?>
								</div>
							<?endif;?>
						</div>
					</li>
				<?endif;?>
			<?endforeach;?>
		</ul>
	</div>
</div>