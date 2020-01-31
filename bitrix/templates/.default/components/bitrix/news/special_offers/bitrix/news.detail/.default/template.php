<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="clients_detail">
	<?if(is_array($arResult["PICTURES"])):?>
		<div class="solutionLogo slid">
			<div class="block slider">
				<div class="blockContSlider">
					<ul class="sliderItems">
						<?foreach($arResult["PICTURES"] as $key => $arItem):?>
							<?if(is_array($arItem["M"])):?>
								<li>
									<table class="photo">
										<tr>
											<td>
												<a class="gallery main_image" rel="pict" href="<?=$arItem["L"]["src"]?>">
													<img src="<?=$arItem["M"]["src"]?>" title="<?=$arResult["NAME"]?>" width="<?=$arItem["M"]["width"]?>" height="<?=$arItem["M"]["height"]?>" alt="<?=$arResult["NAME"]?>" />
												</a>
											</td>
										</tr>
									</table>
								</li>
							<?endif;?>
						<?endforeach;?>
					</ul>
				</div>
			</div>
		</div>
	<?endif?>
	<?if(!empty($arResult["DETAIL_TEXT"])):?>
		<?=$arResult["DETAIL_TEXT"]?>
	<?endif;?>
	<div class="print_article"><a href="/print/?id=<?=$arResult["ID"]?>" title="Распечатать" target="_blank" class="add">Распечатать</a></div>
	<div class="clear"></div>
</div>