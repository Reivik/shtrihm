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
	<br />
	<?foreach($arResult["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>
		<b><?=$arProperty["NAME"]?>:&nbsp;</b>
		<?if(is_array($arProperty["DISPLAY_VALUE"])):?>
			<?=implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]);?>
		<?elseif($arProperty["CODE"] == "SITE" && !empty($arProperty["VALUE"])):?>
			<?if(stripos($arProperty["VALUE"], "http://") === false && stripos($arProperty["VALUE"], "https://") === false):?>			
	<a href="http://<?=$arProperty["VALUE"]?>" title="Перейти на сайт" target="_blank"><?/*=$arProperty["VALUE"]*/?><?=$arResult["NAME"]?></a>
			<?else:?>
				<a href="<?=$arProperty["VALUE"]?>" title="Перейти на сайт" target="_blank"><?=$arResult["NAME"]?></a>
			<?endif;?>
		<?else:?>
			<?=$arProperty["DISPLAY_VALUE"];?>
		<?endif?>
		<br />
	<?endforeach;?>	
	<br />
	<?if(!empty($arResult["REVIEWS"]) || !empty($arResult["INTRODUCTIONS"])):?>
		<div id="clients_table" class="list_item_tabs">
			<ul>
				<li class="list_item_tab"><a href="#reviews"><span><?=GetMessage("REVIEWS")?></span></a></li>
				<li class="list_item_tab"><a href="#introductions"><span><?=GetMessage("INTRODUCTIONS")?></span></a></li>
			</ul>
			<div id="reviews">
				<?if(!empty($arResult["REVIEWS"])):?>
					<table>
						<tr>
							<th colspan="2"><?=GetMessage("PRODUCT")?></th>
							<th><?=GetMessage("REVIEW")?></th>
						</tr>
						<?foreach($arResult["REVIEWS"] as $reviews):?>
							<tr>
								<td>
									<a class="img" href="<?=substr($reviews["PRODUCT"]["DETAIL_PAGE_URL"], 1, strlen($reviews["PRODUCT"]["DETAIL_PAGE_URL"])-1)?>" title="<?=$reviews["PRODUCT"]["NAME"]?>">
										<?if(!empty($reviews["PRODUCT"]["PREVIEW_PICTURE"]["src"])):?>
											<img src="<?=$reviews["PRODUCT"]["PREVIEW_PICTURE"]["src"]?>" alt="<?=$reviews["PRODUCT"]["NAME"]?>" title="<?=$reviews["PRODUCT"]["NAME"]?>" width="<?=$reviews["PRODUCT"]["PREVIEW_PICTURE"]["width"]?>" height="<?=$reviews["PRODUCT"]["PREVIEW_PICTURE"]["height"]?>">
										<?else:?>
											<img src="/design/images/no-photo/pic62x62.png" alt="<?=$reviews["PRODUCT"]["NAME"]?>" title="<?=$reviews["PRODUCT"]["NAME"]?>" width="62" height="62">											
										<?endif;?>
									</a>
								</td>
								<td>
									<a href="<?=substr($reviews["PRODUCT"]["DETAIL_PAGE_URL"], 1, strlen($reviews["PRODUCT"]["DETAIL_PAGE_URL"])-1)?>" title="<?=$reviews["PRODUCT"]["NAME"]?>"><strong><?=$reviews["PRODUCT"]["NAME"]?></strong></a>
								</td>
								<td>
									<div class="preview_news full"><?echo $reviews["PREVIEW_TEXT"];?></div>
									<a href="#" class="showMorePreview"><?=GetMessage("SHOW_MORE")?></a>
									<a href="#" class="hideMorePreview"><?=GetMessage("HIDE_MORE")?></a>
								</td>
							</tr>
						<?endforeach;?>
					</table>
				<?else:?>
					<p><?=GetMessage("NO_REVIEWS")?></p>
				<?endif;?>
			</div>
			<div id="introductions">
				<?if(!empty($arResult["INTRODUCTIONS"])):?>
					<table>
						<tr>
							<th></th>
							<th><?=GetMessage("INTRODUCTION")?></th>
							<th><?=GetMessage("PREVIEW")?></th>
						</tr>
						<?foreach($arResult["INTRODUCTIONS"] as $introduction):?>
							<tr>
								<td>								
									<a class="img" href="<?=$introduction["DETAIL_PAGE_URL"]?>" title="<?=$introduction["NAME"]?>">
										<?if(!empty($introduction["PREVIEW_PICTURE"]["src"])):?>
											<img src="<?=$introduction["PREVIEW_PICTURE"]["src"]?>" alt="<?=$introduction["NAME"]?>" title="<?=$introduction["NAME"]?>" width="<?=$introduction["PREVIEW_PICTURE"]["width"]?>" height="<?=$introduction["PREVIEW_PICTURE"]["height"]?>">
										<?else:?>
											<img src="/design/images/no-photo/pic62x62.png" alt="<?=$introduction["NAME"]?>" title="<?=$introduction["NAME"]?>" width="62" height="62">											
										<?endif;?>
									</a>
								</td>
								<td>
									<a href="<?=$introduction["DETAIL_PAGE_URL"]?>" title="<?=$introduction["NAME"]?>">
										<strong><?=$introduction["NAME"]?></strong>
									</a>
								</td>
								<td>
									<?=$introduction["PREVIEW_TEXT"]?>
								</td>
							</tr>
						<?endforeach;?>
					</table>
				<?else:?>
					<p><?=GetMessage("NO_INTRODUCTION")?></p>
				<?endif;?>
			</div>
		</div>
	<?endif;?>
</div>
