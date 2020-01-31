<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if(!empty($arResult["UF_LINK"])):?>
	<?$APPLICATION->SetPageProperty("SHOW_BANNERS", "N");?>
	<div class="clients_detail">
		<?if(is_array($arResult["SMALL_PICTURE"])):?>
			<div class="solutionLogo">
				<a href="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>" class="main_image">	
					<img src="<?=$arResult["SMALL_PICTURE"]["src"]?>" width="<?=$arResult["SMALL_PICTURE"]["width"]?>" height="<?=$arResult["SMALL_PICTURE"]["height"]?>" alt="<?=$arResult["NAME"]?>" title="<?=$arResult["NAME"]?>"  />
					<span class="zoom" title="Увеличить картинку"></span>
				</a>
			</div>
		<?endif?>
		<?if(!empty($arResult["DESCRIPTION"])):?>
			<?=$arResult["DESCRIPTION"]?>
		<?endif;?>
		<div class="show">
			<a class="view perehod" target="_blank" href="<?=$arResult["UF_LINK"]?>" title="Перейти на сайт">Перейти на сайт</a>
		</div>
	</div>
<?else:?>
	<?if(count($arResult['ITEMS']) > 0):?>
		<?foreach ($arResult['ITEMS'] as $key => $arElement):
			$bHasPicture = is_array($arElement['PREVIEW_IMG']);
			$sticker = "";
			if (array_key_exists("PROPERTIES", $arElement) && is_array($arElement["PROPERTIES"]))
			{
				foreach (Array("SPECIALOFFER", "NEWPRODUCT", "SALELEADER") as $propertyCode)
					if (array_key_exists($propertyCode, $arElement["PROPERTIES"]) && intval($arElement["PROPERTIES"][$propertyCode]["PROPERTY_VALUE_ID"]) > 0)
						$sticker .= "&nbsp;<span class=\"sticker\">".$arElement["PROPERTIES"][$propertyCode]["NAME"]."</span>";
			}?>
			<div class="item_list_catalog">
				<div class="photo">
					<table class="photo">
						<tr>
							<td>
								<a href="<?=$arElement["DETAIL_PAGE_URL"]?>" title="<?=$arElement["NAME"]?>">
									<?if(!empty($arElement["PREVIEW_IMG"]["SRC"])):?>
										<img src="<?=$arElement["PREVIEW_IMG"]["SRC"]?>" width="<?=$arElement["PREVIEW_IMG"]["WIDTH"]?>" height="<?=$arElement["PREVIEW_IMG"]["HEIGHT"]?>" alt="<?=$arElement["NAME"]?>" title="<?=$arElement["NAME"]?>" />
									<?else:?>
										<img src="/design/images/no-photo/pic102x102.png" width="102" height="102" alt="<?=$arElement["NAME"]?>" title="<?=$arElement["NAME"]?>" />
									<?endif;?>
								</a>
							</td>
						</tr>
					</table>
				</div>
				<div class="text">
					<h2><a href="<?=$arElement["DETAIL_PAGE_URL"]?>"><?=$arElement["NAME"]?></a></h2>
					<p><?=(strlen(strip_tags($arElement['PREVIEW_TEXT'])) > 200 ? substr(strip_tags($arElement['PREVIEW_TEXT']), 0, 200)."..." : strip_tags($arElement['PREVIEW_TEXT']))?></p>
					<?/*<ul class="additional_properties">
						<?$i=0; $prop = false;
						foreach($arElement["PROPERTIES"] as $key => $pr) {
							if($i == 3) break;
							if($pr["VALUE"] && $pr["PROPERTY_TYPE"] != "F" && $key != 'MORE_PHOTO' && $key != 'other_product' && $key != 'dop_chars' && $key != 'type' && $key != 'keywords' && $key != 'description' && $key != 'seo_title' && $key != 'accreditation') {
								$i++; $prop = true;?>
								<li><?=$pr["NAME"]?>: <?= (is_array($pr["VALUE"]) ? implode(", ", $pr["VALUE"]) : $pr["VALUE"])?></li>
						<?}
						}?>
					</ul>*/?>
				</div>			
				<div class="show">				
					<a href="<?=$arElement["DETAIL_PAGE_URL"]?>" class="view">Смотреть</a>
					<?
					$prop=false;
					foreach($arElement["PROPERTIES"] as $key => $pr) {
						if($pr["VALUE"] && $pr["PROPERTY_TYPE"] != "F" && $key != 'MORE_PHOTO' && $key != 'other_product' && $key != 'dop_chars' && $key != 'type' && $key != 'keywords' && $key != 'description' && $key != 'seo_title' && $key != 'accreditation') {
							$prop = true;
							break;
						}
					}
					?>
					<?if($prop):?>
						<div class="compare_id_<?=$arElement['ID']?>"></div>
					<?endif?>
				</div>
				<div class="clear"></div>
			</div>
		<?endforeach?>
		<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
			<?=$arResult["NAV_STRING"];?>
		<?endif;?>
	<?else:?>
		<p>В настоящий момент в этом разделе нет продуктов.</p>
	<?endif;?>
<?endif;?>