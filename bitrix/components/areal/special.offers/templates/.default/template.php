<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<?if(count($arResult["SPECIALS"]) > 0):?>
	<div class="block special miniSpecial">
		<div class="blockCont">
			<h2><?=GetMessage("OFFER_TITLE")?></h2>			
				<?foreach($arResult["SPECIALS"] as $key => $item):?>
					<?if($key < $arParams["COUNT_IN_LINE"]):?>
						<div class="special_offer count_<?=$arParams["COUNT_IN_LINE"]?>">
							<table class="photo">
								<tr>
									<td>
										<a href="<?=$item["DETAIL_PAGE_URL"]?>">
										<?if($item["PREVIEW_PICTURE"]):?>
											<img src="<?=$item["PREVIEW_PICTURE"]["src"]?>" width="<?=$item["PREVIEW_PICTURE"]["width"]?>" height="<?=$item["PREVIEW_PICTURE"]["height"]?>" alt="<?=$item["NAME"]?>" title="<?=$item["NAME"]?>" />
										<?else:?>
											<img src="/design/images/no-photo/pic62x62.png" alt="<?=$item["NAME"]?>" title="<?=$item["NAME"]?>" />
										<?endif;?>
										</a>
									</td>
								</tr>
							</table>
							<div>
								<div class="div_title_h3">
									<h3><a href="<?=$item["DETAIL_PAGE_URL"]?>"><?=$item["NAME"]?></a></h3>
								</div>
								<?if(strlen($item["PREVIEW_TEXT"]) < 80)
									$preview = $item["PREVIEW_TEXT"];
								else 
									$preview = substr($item["PREVIEW_TEXT"], 0, 80)."...";?>
								<p><?=$preview?></p>
							</div>
						</div>
					<?endif;?>
				<?endforeach;?>
				<div class="clear"></div>
				<?if(isset($arResult["SPECIALS"][$arParams["COUNT_IN_LINE"]])):?>
					<div class="more_special">
						<?for($i = $arParams["COUNT_IN_LINE"]; $i < count($arResult["SPECIALS"]); $i++) {?>
							<div class="special_offer count_<?=$arParams["COUNT_IN_LINE"]?>">
								<table class="photo">
									<tr>
										<td>
											<a href="<?=$arResult["SPECIALS"][$i]["DETAIL_PAGE_URL"]?>">
											<?if($arResult["SPECIALS"][$i]["PREVIEW_PICTURE"]):?>
												<img src="<?=$arResult["SPECIALS"][$i]["PREVIEW_PICTURE"]["src"]?>" width="<?=$arResult["SPECIALS"][$i]["PREVIEW_PICTURE"]["width"]?>" height="<?=$arResult["SPECIALS"][$i]["PREVIEW_PICTURE"]["height"]?>" alt="<?=$arResult["SPECIALS"][$i]["NAME"]?>" title="<?=$arResult["SPECIALS"][$i]["NAME"]?>" />
											<?else:?>
												<img src="/images/no_photo_59.jpg" alt="<?=$arResult["SPECIALS"][$i]["NAME"]?>" title="<?=$arResult["SPECIALS"][$i]["NAME"]?>" />
											<?endif;?>
											</a>
										</td>
									</tr>
								</table>
								<div>
									<div class="div_title_h3">
										<h3><a href="<?=$arResult["SPECIALS"][$i]["DETAIL_PAGE_URL"]?>"><?=$arResult["SPECIALS"][$i]["NAME"]?></a></h3>
									</div>
									<?if(strlen($arResult["SPECIALS"][$i]["PREVIEW_TEXT"]) < 80)
										$preview = $arResult["SPECIALS"][$i]["PREVIEW_TEXT"];
									else 
										$preview = substr($arResult["SPECIALS"][$i]["PREVIEW_TEXT"], 0, 80)."...";?>
									<p><?=$preview?></p>									
								</div>
							</div>
						<?}?>
						<div class="clear"></div>
					</div>
				<?endif;?>
			<div class="clear"></div>
			<?if($arParams["SHOW_ALL"] == "Y"):?>
				<a href="/press_center/special_offers/" title="<?=GetMessage("ALL_OFFERS")?>"><?=GetMessage("ALL_OFFERS")?></a>
			<?endif;?>
			<?if(count($arResult["SPECIALS"]) > $arParams["COUNT_IN_LINE"]):?>
				<div class="showMore"><a class="showMoreLink"><?=GetMessage("SHOW_MORE")?></a></div>
			<?endif;?>
		</div>
	</div>
	<div class="clear"></div>
<?endif;?>