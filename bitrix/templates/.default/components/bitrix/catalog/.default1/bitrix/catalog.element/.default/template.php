<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="product">
	<div class="productPhotosInfo">
		<table>
			<tr>
				<td>
					<a class="main_image" rel="pict" href="<?=$arResult["PICTURES"]["0"]["L"]["src"]?>"> 
						<img src="<?=$arResult["PICTURES"]["0"]["M"]["src"]?>" alt="" width="<?=$arResult["PICTURES"]["0"]["M"]["width"]?>" height="<?=$arResult["PICTURES"]["0"]["M"]["height"]?>" />
					</a>
				</td>
			</tr>
		</table>
		<img class="zoom" src="/design/images/zoom.png" />
	</div>
	<div class="productPreview">
		<p id="preview_text"><?=$arResult["PREVIEW_TEXT"];?></p>
		<?if(count($arResult["PICTURES"]) > 1):?>
			<div class="carousel main">
				<a href="#" class="pPrev"></a>
				<div class="jCarouselLite">
					<ul>
						<?foreach($arResult["PICTURES"] as $pic):?>
						<li>
							<table class="carousel_img">
								<tr>
									<td>
										<a class="for_fancy" href="<?=$pic["L"]["src"]?>" rel="src: '<?=$pic["M"]["src"]?>', width: '<?=$pic["M"]["width"]?>', height: '<?=$pic["M"]["height"]?>'">
											<img src="<?=$pic["S"]["src"]?>" width="<?=$pic["S"]["width"]?>" height="<?=$pic["S"]["height"]?>" />
										</a>
									</td>
								</tr>
							</table>
						</li>	
						<?endforeach;?>
					</ul>
				</div>
				<a href="#" class="pNext"></a>
				<div class="clear"></div>
			</div>
		<?endif;?>
	</div>
</div>
<?$APPLICATION->IncludeComponent(
	"areal:special.offers", 
	".default", 
	array(
		"SECTION_ID" => $arResult["IBLOCK_SECTION_ID"], 
		"COUNT_IN_LINE" => 2,
		"SHOW_ALL" => "Y"
	)
);?>
222
<div id="product_detail" class="list_item_tabs">
	<ul class="FloatAuto">
		<li class="list_item_tab"><a href="#description"><span>Описание</span></a></li>
		<li class="list_item_tab"><a href="#reviews"><span>Отзывы</span></a></li>
		<li class="list_item_tab"><a href="#goods"><span>Сопутствующие товары</span></a></li>
		<li class="list_item_tab"><a href="#introduction"><span>Внедрения</span></a></li>
		<li class="list_item_tab"><a href="#download"><span>Скачать</span></a></li>
	</ul>
	<a href="/partners_info/partners/?directions=<?=$arResult["IBLOCK_SECTION_ID"]?>" class="pay"><span>Где купить?</span></a>
	<div class="clear"></div>
	<div id="description">
		<div class="textDecor">
			<?=$arResult["DETAIL_TEXT"];?>			
		</div>
		<?
			foreach($arResult["PROPERTIES"] as $key => $pr) {
				if($pr["VALUE"] && $pr["PROPERTY_TYPE"] != "F" && $key != 'MORE_PHOTO' && $key != 'other_product' && $key != 'dop_chars' && $key != 'type') {
					$arResult["TTH"][] = $pr;
				}
			}
		?>
		<?if(!empty($arResult["TTH"]) || !empty($arResult["PROPERTIES"]["dop_chars"]["VALUE"])):?>
			<h4>Технические характеристики</h4>
			111<table class="table tex_characteristic">
				<tbody>
					<?if(!empty($arResult["TTH"])):?>
						<?foreach($arResult["TTH"] as $pr):?>
							<tr>
								<td><strong><?=$pr["NAME"]?></strong></td>
								<td><?= (is_array($pr["VALUE"]) ? implode(", ", $pr["VALUE"]) : $pr["VALUE"])?></td>
							</tr>
						<?endforeach;?>
					<?endif;?>
					<?if(!empty($arResult["PROPERTIES"]["dop_chars"]["VALUE"])):?>
						<?foreach($arResult["PROPERTIES"]["dop_chars"]["DESCRIPTION"] as $key => $dop_char):?>
							<tr>
								<td><strong><?=$arResult["PROPERTIES"]["dop_chars"]["VALUE"][$key]?></strong></td>
								<td><?=$dop_char?></td>
							</tr>
						<?endforeach;?>
					<?endif;?>
				</tbody>
			</table>
		<?endif;?>
	</div>
	<div id="reviews">
		<?if(!empty($arResult["REVIEWS"])):?>
			<table>
				<tr>
					<th colspan="2">Продукт</th>
					<th>Отзыв</th>
				</tr>
				<?foreach($arResult["REVIEWS"] as $reviews):?>
					<tr>
						<td>
							<a class="img" href="<?=substr($reviews["CLIENT"]["DETAIL_PAGE_URL"], 1, strlen($reviews["CLIENT"]["DETAIL_PAGE_URL"])-1)?>" title="<?=$reviews["CLIENT"]["NAME"]?>">
								<?if(!empty($reviews["CLIENT"]["PREVIEW_PICTURE"]["src"])):?>
									<img src="<?=$reviews["CLIENT"]["PREVIEW_PICTURE"]["src"]?>" alt="<?=$reviews["CLIENT"]["NAME"]?>" title="<?=$reviews["CLIENT"]["NAME"]?>" width="<?=$reviews["CLIENT"]["PREVIEW_PICTURE"]["width"]?>" height="<?=$reviews["CLIENT"]["PREVIEW_PICTURE"]["height"]?>">
								<?else:?>
									<img src="/design/images/no-photo/pic62x62.png" alt="<?=$reviews["CLIENT"]["NAME"]?>" title="<?=$reviews["CLIENT"]["NAME"]?>" width="62" height="62">											
								<?endif;?>
							</a>
						</td>
						<td>
							<a href="<?=substr($reviews["CLIENT"]["DETAIL_PAGE_URL"], 1, strlen($reviews["CLIENT"]["DETAIL_PAGE_URL"])-1)?>" title="<?=$reviews["CLIENT"]["NAME"]?>"><strong><?=$reviews["CLIENT"]["NAME"]?></strong></a>
						</td>
						<td>
							<?if(strlen($reviews["PREVIEW_TEXT"]) > 90) {
								echo substr($reviews["PREVIEW_TEXT"], 0, 90);
								?><a href="#" class="showMorePreview"><br />Показать</a><span class="moreInfo"><?
								echo substr($reviews["PREVIEW_TEXT"], 90, strlen($reviews["PREVIEW_TEXT"])-90);
								?><a href="#" class="hideMorePreview"><br />Спрятать</a></span><?
							}
							else echo $reviews["PREVIEW_TEXT"];?>
						</td>
					</tr>
				<?endforeach;?>
			</table>
		<?else:?>
			<p>О данном продукте еще нет отзывов.</p>
		<?endif;?>
	</div>
	<div id="goods">
		<?if(!empty($arResult["RECOMENTED_PRODUCTS"])):?>
			<table>
				<tr>
					<th colspan="2">Продукт</th>
					<th>Описание</th>
				</tr>
				<?foreach($arResult["RECOMENTED_PRODUCTS"] as $product):?>
					<tr>
						<td>
							<a class="img" href="<?=$product["DETAIL_PAGE_URL"]?>" title="<?=$product["NAME"]?>">
								<?if(!empty($product["PREVIEW_PICTURE"]["src"])):?>
									<img src="<?=$product["PREVIEW_PICTURE"]["src"]?>" alt="<?=$product["NAME"]?>" title="<?=$product["NAME"]?>" width="<?=$product["PREVIEW_PICTURE"]["width"]?>" height="<?=$product["PREVIEW_PICTURE"]["height"]?>">
								<?else:?>
									<img src="/design/images/no-photo/pic117x117.png" alt="<?=$product["NAME"]?>" title="<?=$product["NAME"]?>" width="117" height="117">											
								<?endif;?>
							</a>
						</td>
						<td>
							<a href="<?=$product["DETAIL_PAGE_URL"]?>" title="<?=$product["NAME"]?>"><?=$product["NAME"]?></a>
						</td>
						<td><?=$product["PREVIEW_TEXT"] ? $product["PREVIEW_TEXT"] : "Нет описания"?></td>
					</tr>
				<?endforeach;?>
			</table>
		<?else:?>
			<p>В сожалению, для данного продукта не указано сопуствующих товаров.</p>
		<?endif;?>
	</div>
	<div id="introduction">
		<?$GLOBALS["introFilter"] = array(array("LOGIC" => "OR", "PROPERTY_EQUIPMENT" => $arResult["ID"], "PROPERTY_SOFTWARE" => $arResult["ID"]));
		$APPLICATION->IncludeComponent("bitrix:news.list", "product", array(
			"IBLOCK_TYPE" => "clients",
			"IBLOCK_ID" => IB_INTRO,
			"NEWS_COUNT" => 5,
			"SORT_BY1" => "SORT",
			"SORT_ORDER1" => "DESC",
			"SORT_BY2" => "NAME",
			"SORT_ORDER2" => "ASC",
			"FILTER_NAME" => "introFilter",
			"FIELD_CODE" => array(
				0 => "",
				1 => "",
			),
			"PROPERTY_CODE" => array(
				0 => "SOLUTION",
				1 => "",
			),
			"CHECK_DATES" => "Y",
			"DETAIL_URL" => "",
			"AJAX_MODE" => "N",
			"AJAX_OPTION_JUMP" => "N",
			"AJAX_OPTION_STYLE" => "Y",
			"AJAX_OPTION_HISTORY" => "N",
			"CACHE_TYPE" => "A",
			"CACHE_TIME" => "36000000",
			"CACHE_FILTER" => "N",
			"CACHE_GROUPS" => "Y",
			"PREVIEW_TRUNCATE_LEN" => "",
			"ACTIVE_DATE_FORMAT" => "d.m.Y",
			"SET_TITLE" => "N",
			"SET_STATUS_404" => "N",
			"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
			"ADD_SECTIONS_CHAIN" => "N",
			"HIDE_LINK_WHEN_NO_DETAIL" => "N",
			"PARENT_SECTION" => "",
			"PARENT_SECTION_CODE" => "",
			"DISPLAY_TOP_PAGER" => "N",
			"DISPLAY_BOTTOM_PAGER" => "Y",
			"PAGER_TITLE" => "Внедрения",
			"PAGER_SHOW_ALWAYS" => "N",
			"PAGER_TEMPLATE" => "",
			"PAGER_DESC_NUMBERING" => "N",
			"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
			"PAGER_SHOW_ALL" => "N",
			"DISPLAY_DATE" => "Y",
			"DISPLAY_NAME" => "Y",
			"DISPLAY_PICTURE" => "Y",
			"DISPLAY_PREVIEW_TEXT" => "Y",
			"AJAX_OPTION_ADDITIONAL" => ""
			),
			false
		);?>		
	</div>
	<div id="download">5</div>
</div>