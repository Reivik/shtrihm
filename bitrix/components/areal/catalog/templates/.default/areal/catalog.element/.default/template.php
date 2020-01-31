<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="video_modal">
    <div class="video_modal_inner">
        <div class="video_modal_close"></div>
        <iframe width="100%" height="506.25" src="" frameborder="0" allow="encrypted-media" allowfullscreen></iframe>
    </div>
</div>
<div class="product">
	<?if(!empty($arResult["PICTURES"]["0"]["M"]["src"])):?>
		<div class="productPhotosInfo">
		<?foreach($arResult["PICTURES"] as $key => $pic):?>
			<a class="gallery <?if($key == 0):?> main_image <?endif;?>" name="pic_<?=$key?>" rel="pict" href="<?=$pic["L"]["src"]?>" <?if($key != 0):?> style="display: none;" <?endif;?>>
				<table>
					<tr>
						<td>
							<img src="<?=$pic["M"]["src"]?>" width="<?=$pic["M"]["width"]?>" height="<?=$pic["M"]["height"]?>" />
						</td>
					</tr>
				</table>
				<img class="zoom" src="/design/images/zoom.png" />
			</a>
		<?endforeach;?>
		</div>	
	<?endif;?>
	<?if($arResult["PREVIEW_TEXT"]):?>
		<p <?if(!empty($arResult["PICTURES"]["0"]["M"]["src"])):?> class="description_text_products" <?endif;?>><?=strip_tags($arResult["PREVIEW_TEXT"]);?></p>
	<?endif;?>
	<?if ($arResult["PROPERTIES"]["ONLINE_IN"]["VALUE"]) {?>
		<?if ($arResult["PROPERTIES"]["PRICE_IN"]["VALUE"]) {?>
		<div class="main_info right_info">
			<span style="display: inline-block;
    white-space: nowrap;
    padding: 12px 33px;
    background: #90be5b;
    -webkit-border-radius: 3px;
    border-radius: 3px;
    line-height: 1.2;
	color: #fff;
	width: auto;
	font-size: 18px;
	margin-bottom: -47px;
    font-weight: normal;">*Цена без ФН</span><span> <?=$arResult["PROPERTIES"]["PRICE_IN"]["VALUE"]?> р</span>
		</div>
		<?}?>
	<a onclick="OpenForm<?if ($arResult["PROPERTIES"]["SPEC_LINK"]["VALUE"]) {?>New<?}?>();" class="right_but cat_button">Заказать</a>
		<script>
		var array_product = [
		<?$name = str_replace('"', '', $arResult["NAME"]);?>
		<?$price = str_replace(' ', '', $arResult["PROPERTIES"]["PRICE_IN"]["VALUE"]);?>['<?=$name?>', '<?=$price?>']];
		function OpenForm() {
		$('form[name=ONLINE_BILL]').addClass('js-form-address');
		$("body").addClass('body_stop');
		$('#modal').css('display', 'block');
		product_online_till_add('<?=$arResult["NAME"]?>');
		}
		function OpenFormNew() {
		$('form[name=ONLINE_BILL]').addClass('js-form-address');
		$('form[name=ONLINE_BILL]').attr('action', '/catalog/send.php');
		$('.send_button').attr('name', '');
		$("body").addClass('body_stop');
		$('#modal').css('display', 'block');
		product_online_till_add('<?=$arResult["NAME"]?>');
		}
		</script>
<?
$utm_source = htmlspecialchars($_GET["utm_source"]);
$utm_medium = htmlspecialchars($_GET["utm_medium"]);
$utm_campaign = htmlspecialchars($_GET["utm_campaign"]);
$utm_content = htmlspecialchars($_GET["utm_content"]);
$utm_term = htmlspecialchars($_GET["utm_term"]);
?>
<script>
$(document).ready(function(){
	$('input[name=form_text_175]').addClass('hidden');
	$('input[name=form_text_176]').addClass('hidden');
	$('input[name=form_text_177]').addClass('hidden');
	$('input[name=form_text_178]').addClass('hidden');
	$('input[name=form_text_179]').addClass('hidden');
	$('input[name=form_text_173]').removeAttr('required');
	$('input[name=form_text_175]').removeAttr('required');
	$('input[name=form_text_176]').removeAttr('required');
	$('input[name=form_text_177]').removeAttr('required');
	$('input[name=form_text_178]').removeAttr('required');
	$('input[name=form_text_179]').removeAttr('required');
	$('input[name=form_text_175]').val('<?=$utm_source?>');
	$('input[name=form_text_176]').val('<?=$utm_medium?>');
	$('input[name=form_text_177]').val('<?=$utm_campaign?>');
	$('input[name=form_text_178]').val('<?=$utm_content?>');
	$('input[name=form_text_179]').val('<?=$utm_term?>');
});
</script>
	<?}?>
		<div class="carousel main">
		<?if(count($arResult["PICTURES"]) > 1):?>
			<a href="#" class="pPrev"></a>
			<div class="jCarouselLite">
				<ul>
					<?foreach($arResult["PICTURES"] as $p => $pic):?>
					<li>
						<table class="carousel_img">
							<tr>
								<td>
									<a class="for_fancy" name="pic_<?=$p?>" href="<?=$pic["L"]["src"]?>" rel="src: '<?=$pic["M"]["src"]?>', width: '<?=$pic["M"]["width"]?>', height: '<?=$pic["M"]["height"]?>'">
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
		<?endif;?>
		</div>
	<div class="show">
		<?if($arResult["ISSET_PROPERTY"]):?>
		<div class="compare_detail"></div>
		<?endif?>
	</div>
	<div class="clear"></div>
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
<a name="tabs"></a>
<div id="product_detail" class="list_item_tabs">
	<ul class="FloatAuto">
		<li class="list_item_tab"><a href="#description"><span>Описание</span></a></li>
		<?/*<li class="list_item_tab"><a href="#reviews"><span>Отзывы</span></a></li>*/?>
		<li class="list_item_tab"><a href="#goods"><span>Сопутствующие товары</span></a></li>
		<?if($arResult["PROPERTIES"]["buy"]["VALUE"]=="N") {?><?}else{?><li class="list_item_tab"><a href="#introduction"><span>Внедрения</span></a></li> <?}?>
		<li class="list_item_tab"><a href="#download"><span>Скачать</span></a></li>
        <?if ($arResult["PROPERTIES"]["POSM"]["VALUE"]) {?>
        <li class="list_item_tab"><a href="#posm"><span>POS</span></a></li>
        <?}?>
        <?if ($arResult["PROPERTIES"]["LISTS"]["VALUE"]) {?>
        <li class="list_item_tab"><a href="#lists"><span>Листовки</span></a></li>
        <?}?>
        <?if ($arResult["PROPERTIES"]["ONLINE_IN"]["VALUE"]) {?>
        <li class="list_item_tab"><a href="#videos"><span>Видео</span></a></li>
        <?}?>
	</ul>
	<div class="clear"></div>
	<div id="description">
		<div>
			<div class="textDecor">
				<?if(!empty($arResult["PREVIEW_TEXT"]) || !empty($arResult["DETAIL_TEXT"]) || !empty($arResult["NAV_TEXT"])):?>
					<?if(!empty($arResult["NAV_RESULT"])):?>
						<?if($arParams["DISPLAY_TOP_PAGER"] == "Y"):?><?=$arResult["NAV_STRING"]?><br /><?endif;?>
						<?echo $arResult["NAV_TEXT"];?>
						<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?><br /><?=$arResult["NAV_STRING"]?><?endif;?>
					<?elseif(!empty($arResult["DETAIL_TEXT"])):?>
						<?echo $arResult["DETAIL_TEXT"];?>
					<?else:?>
						<?echo $arResult["PREVIEW_TEXT"];?>
					<?endif?>
				<?else:?>
					<p>Подробное описание отсутствует.</p>
				<?endif;?>
			</div>
			<?
			if(!empty($arResult["PROPERTIES"])) {
				foreach($arResult["PROPERTIES"] as $key => $pr) {
					if($pr["VALUE"] && $pr["PROPERTY_TYPE"] != "F" && $key != 'MORE_PHOTO' && $key != 'other_product' && $key != 'dop_chars' && $key != 'type' && $key != 'keywords' && $key != 'description' && $key != 'seo_title' && $key != 'accreditation' && $key != 'PRICE_IN' && $key != 'SPEC_LINK' && $key != 'ONLINE_IN' && $key != 'FZ54_IN') {
						$arResult["TTH"][] = $pr;
					}
				}
			}
			if(!empty($arResult["PROPERTIES"]["dop_chars"]["DESCRIPTION"])) {
				foreach($arResult["PROPERTIES"]["dop_chars"]["DESCRIPTION"] as $key => $dop_char) {
					if(!empty($arResult["PROPERTIES"]["dop_chars"]["VALUE"][$key]) && !empty($dop_char)) {
						$arResult["DOP_CHARS"][] = array("DESCRIPTION" => $arResult["PROPERTIES"]["dop_chars"]["VALUE"][$key], "VALUE" => $dop_char);
					}
				}
			}?>
			<?if(!empty($arResult["TTH"]) || !empty($arResult["DOP_CHARS"])):?>
				<h3>Технические характеристики</h3>
				<table class="table tex_characteristic">
					<tbody>
						<?if(!empty($arResult["TTH"])):?>
							<?foreach($arResult["TTH"] as $pr):?>
								<? if($pr["CODE"]!="buy"): ?>
								<tr>
									<td><strong><?=$pr["NAME"]?></strong></td>
									<td>
										<?if($pr["PROPERTY_TYPE"] == "S" && ($pr["VALUE"]["TYPE"] == "text" || $pr["VALUE"]["TYPE"] == "html")):?>
											<?=$pr["~VALUE"]["TEXT"]?>
										<?else:?>
											<?= (is_array($pr["VALUE"]) ? implode(", ", $pr["VALUE"]) : $pr["VALUE"])?>
										<?endif;?>
									</td>
								</tr>
								<? endif; ?>
							<?endforeach;?>
						<?endif;?>
						<?if(!empty($arResult["DOP_CHARS"])):?>
							<?foreach($arResult["DOP_CHARS"] as $key => $dop_char):?>
								<tr>
									<td><strong><?=$dop_char["DESCRIPTION"]?></strong></td>
									<td><?=$dop_char["VALUE"]?></td>
								</tr>
							<?endforeach;?>
						<?endif;?>
					</tbody>
				</table>
			<?endif;?>
		</div>
	</div>

<? //function is_online_kassy() {
	//  global $APPLICATION;	
	//  return strpos ($APPLICATION->GetCurDir(),  "/catalog/onlayn-kassy/") === 0;
	//}
?>