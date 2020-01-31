<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if($arResult["SHOW"] == false):
	ShowError(GetMessage("NOT_ACCESS"));
	return false;
else:?>	
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
				<div class="clear"></div>
			</a>
		<?endforeach;?>
	</div>
<?endif;?>
	<div class="productPreview ap_eventsBlock">
		<div class="event_description">
			<strong>Дата проведения: </strong><nobr><?=getDateWithTimeText($arResult["DATE_ACTIVE_FROM"], $arResult["DATE_ACTIVE_TO"])?></nobr><br />
			<strong>Место проведения: </strong><?=$arResult["PROPERTIES"]["TOWN"]["VALUE"]?>, <?=$arResult["PROPERTIES"]["ADDRESS"]["VALUE"]?><br />
			<?if(!empty($arResult["PROPERTIES"]["CONTACT_PERSON"]["VALUE"])):?>
				<strong>Контактное лицо: </strong><?=$arResult["PROPERTIES"]["CONTACT_PERSON"]["VALUE"]?><br />
			<?endif;?>
			<?if(!empty($arResult["PROPERTIES"]["PHONE"]["VALUE"])):?>
				<strong>Телефон: </strong><?=$arResult["PROPERTIES"]["PHONE"]["VALUE"]?><br />
			<?endif;?>
			<?if(!empty($arResult["PROPERTIES"]["FAX"]["VALUE"])):?>
				<strong>Факс: </strong><?=$arResult["PROPERTIES"]["FAX"]["VALUE"]?><br />
			<?endif;?>
			<?if(!empty($arResult["PROPERTIES"]["EMAIL"]["VALUE"])):?>
				<strong>Email: </strong><a href="mailto:<?=$arResult["PROPERTIES"]["EMAIL"]["VALUE"]?>" title="Написать письмо"><?=$arResult["PROPERTIES"]["EMAIL"]["VALUE"]?></a><br />
			<?endif;?>
			<?if(!empty($arResult["PROPERTIES"]["SITE"]["VALUE"])):?>
				<strong>Сайт: </strong><a href="<?=(strpos("http", $arResult["PROPERTIES"]["SITE"]["VALUE"]) === true ? $arResult["PROPERTIES"]["SITE"]["VALUE"] : "http://".$arResult["PROPERTIES"]["SITE"]["VALUE"])?>" title="Перейти на сайт" target="_blank"><?=$arResult["PROPERTIES"]["SITE"]["VALUE"]?></a><br />
			<?endif;?>
		</div>
		<?if(count($arResult["PICTURES"]) > 1):?>
			<div class="carousel main">
				<a href="#" class="pPrev"></a>
				<div class="jCarouselLite">
					<ul>
						<?foreach($arResult["PICTURES"] as $key=>$pic):?>
						<li>
							<table class="carousel_img">
								<tr>
									<td>
										<a class="for_fancy" name='pic_<?=$key?>' href="<?=$pic["L"]["src"]?>" rel="src: '<?=$pic["M"]["src"]?>', width: '<?=$pic["M"]["width"]?>', height: '<?=$pic["M"]["height"]?>'">
											<img src="<?=$pic["S"]["src"]?>"  width="<?=$pic["S"]["width"]?>" height="<?=$pic["S"]["height"]?>" />
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
	<div class="clear"></div>
	<?if(!empty($arResult["PREVIEW_TEXT"])):?>
		<?=$arResult["PREVIEW_TEXT"]?>
	<?endif;?>
<?endif;?>