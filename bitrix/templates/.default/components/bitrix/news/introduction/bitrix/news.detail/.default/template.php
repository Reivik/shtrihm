<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="product">
	<?if(!empty($arResult["PICTURES"]["0"]["M"]["src"])):?>
		<div class="productPhotosInfo right">
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
			<?if(count($arResult["PICTURES"]) > 1):?>
				<div class="carousel main no_margin">
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
				</div>
				<div class="clear"></div>
			<?endif;?>
		</div>
	<?endif;?>
	<h3>Внедрение выполнено</h3>
	<p>
		<?if($arResult["PROPERTIES"]["PARTNER"]["VALUE"]):?>
			<strong>Партнер: </strong><a href="<?=$arResult["PROPERTIES"]["PARTNER"]["VALUE"]["DETAIL_PAGE_URL"]?>" title="<?=$arResult["PROPERTIES"]["PARTNER"]["VALUE"]["NAME"]?>">
				<?=$arResult["PROPERTIES"]["PARTNER"]["VALUE"]["NAME"]?></a><br/>
		<?endif;?>
		<?if($arResult["PROPERTIES"]["CLIENT"]["VALUE"]):?>
			<strong>Клиент: </strong><a href="<?=$arResult["PROPERTIES"]["CLIENT"]["VALUE"]["DETAIL_PAGE_URL"]?>" title="<?=$arResult["PROPERTIES"]["CLIENT"]["VALUE"]["NAME"]?>">
				<?=$arResult["PROPERTIES"]["CLIENT"]["VALUE"]["NAME"]?></a><br/>
		<?endif;?>		
		<?if($arResult["PROPERTIES"]["REGION"]["VALUE"]):?>
			<strong>Регион: </strong><?=$arResult["PROPERTIES"]["REGION"]["VALUE"]?><br/>
		<?endif;?>
		<?if($arResult["PROPERTIES"]["CITY"]["VALUE"]):?>
			<strong>Город: </strong><?=$arResult["PROPERTIES"]["CITY"]["VALUE"]?><br/>
		<?endif;?>
		<?if($arResult["PROPERTIES"]["ADDRESS"]["VALUE"]):?>
			<strong>Адрес: </strong><?=$arResult["PROPERTIES"]["ADDRESS"]["VALUE"]?><br/>
		<?endif;?>
		<?if($arResult["PROPERTIES"]["CLIENT"]["VALUE"]["PROPERTY_SITE_VALUE"]):?>
			<strong>Сайт: </strong><a href="http://<?=$arResult["PROPERTIES"]["CLIENT"]["VALUE"]["PROPERTY_SITE_VALUE"]?>" title="<?=$arResult["PROPERTIES"]["CLIENT"]["VALUE"]["NAME"]?>">
				<?=$arResult["PROPERTIES"]["CLIENT"]["VALUE"]["PROPERTY_SITE_VALUE"]?></a><br/>
		<?endif;?>	
	</p>
	<h3>Контактное лицо</h3>
	<p>
		<?if($arResult["PROPERTIES"]["CONTACT_FIO"]["VALUE"]):?>
			<strong>ФИО: </strong><?=$arResult["PROPERTIES"]["CONTACT_FIO"]["VALUE"]?><br/>
		<?endif;?>
		<?if($arResult["PROPERTIES"]["CONTACT_POSITION"]["VALUE"]):?>
			<strong>Должность: </strong><?=$arResult["PROPERTIES"]["CONTACT_POSITION"]["VALUE"]?><br/>
		<?endif;?>		
		<?if($arResult["PROPERTIES"]["CONTACT_PHONE"]["VALUE"]):?>
			<strong>Телефон: </strong><?=$arResult["PROPERTIES"]["CONTACT_PHONE"]["VALUE"]?><br/>
		<?endif;?>
		<?if($arResult["PROPERTIES"]["CONTACT_EMAIL"]["VALUE"]):?>
			<strong>Email: </strong><?=$arResult["PROPERTIES"]["CONTACT_EMAIL"]["VALUE"]?><br/>
		<?endif;?>
	</p>
	<p>
		<?if($arResult["PROPERTIES"]["TYPE_ACTIVITY"]["VALUE"]):?>
			<strong>Вид деятельности: </strong><?=$arResult["PROPERTIES"]["TYPE_ACTIVITY"]["VALUE"]?><br />
		<?endif;?>	
		<?if($arResult["PROPERTIES"]["TYPE"]["VALUE"]):?>
			<strong>Тип объекта: </strong><?=$arResult["PROPERTIES"]["TYPE"]["VALUE"]?><br />
		<?endif;?>	
		<?if($arResult["DISPLAY_ACTIVE_FROM"]):?>
			<strong>Дата открытия объекта: </strong><?=date_convert($arResult["DISPLAY_ACTIVE_FROM"],0,1)?><br />
		<?endif;?>
		<?if($arResult["PROPERTIES"]["LOCATION"]["VALUE"]):?>
			<strong>Расположение: </strong><?=$arResult["PROPERTIES"]["LOCATION"]["VALUE"]?><br />
		<?endif;?>	
		<?if($arResult["PROPERTIES"]["SQUARE"]["VALUE"]):?>
			<strong>Площадь кв.м: </strong><?=$arResult["PROPERTIES"]["SQUARE"]["VALUE"]?><br />
		<?endif;?>
		<?if($arResult["PROPERTIES"]["NUMBER_OF_CHECKS"]["VALUE"]):?>
			<strong>Количество чеков за смену: </strong><?=$arResult["PROPERTIES"]["NUMBER_OF_CHECKS"]["VALUE"]?>
		<?endif;?>
	</p>
	<?if(!empty($arResult["PROPERTIES"]["DOP_CHARS"]["VALUE"])):?>
		<h3>Дополнительные характеристики</h3>
		<table>
			<tr>
				<th>Характеристика</th>
				<th>Значение</th>
			</tr>			
			<?foreach($arResult["PROPERTIES"]["DOP_CHARS"]["DESCRIPTION"] as $key => $dop_char):?>
				<tr>
					<td><?=$arResult["PROPERTIES"]["DOP_CHARS"]["VALUE"][$key]?></td>
					<td><?=$dop_char?></td>
				</tr>
			<?endforeach;?>
		</table>
	<?endif;?>
	
	<?if($arResult["NAV_RESULT"]):?>
		<?if($arParams["DISPLAY_TOP_PAGER"]):?><?=$arResult["NAV_STRING"]?><br /><?endif;?>
		<?echo $arResult["NAV_TEXT"];?>
		<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?><br /><?=$arResult["NAV_STRING"]?><?endif;?>
	<?elseif(strlen($arResult["DETAIL_TEXT"])>0):?>
		<?echo $arResult["DETAIL_TEXT"];?>
	<?else:?>
		<?echo $arResult["PREVIEW_TEXT"];?>
	<?endif?>
	<br/>
	<?if($arResult["PROPERTIES"]["SERVICES"]["~VALUE"]):?>
		<div class="services_intro">
			<h3>Оказанные услуги</h3>
			<?=$arResult["PROPERTIES"]["SERVICES"]["~VALUE"]["TEXT"]?>
		</div>
	<?endif;?>
	
	<?if(!empty($arResult["EQUIPMENT"])):?>
		<h3>Установленное оборудование</h3>
		<?/* <table class="itroduction_software">
			<tr>
				<th>Продукт</th>
				<th>Описание</th>
				<th></th>
			</tr>
			<?foreach($arResult["EQUIPMENT"] as $item):?>
				<tr>
					<td class="photo">
						<a href="<?=$item["DETAIL_PAGE_URL"]?>">
							<img src="<?=$item["PREVIEW_PICTURE"]["src"]?>" width="<?=$item["PREVIEW_PICTURE"]["width"]?>" height="<?=$item["PREVIEW_PICTURE"]["height"]?>" alt="<?=$item["NAME"]?>"/>
						</a>
					</td>
					<td>
						<h2><a href="<?=$item["DETAIL_PAGE_URL"]?>"><?=$item["NAME"]?></a></h2>
						<p class='nomargin'><?=(strlen(strip_tags($item['PREVIEW_TEXT'])) > 200 ? substr(washString($item['PREVIEW_TEXT']), 0, 200)."..." : washString($item['PREVIEW_TEXT']))?></p>
					</td>
					<td class="show_more">
						<a href="<?=$item["DETAIL_PAGE_URL"]?>" class="btn" title="<?=$item["NAME"]?>">Подробнее</a>
					</td>
				</tr>
			<?endforeach;?>
		</table> */?>
		<?foreach($arResult["EQUIPMENT"] as $item):?>
			<div class="item_list_catalog">
				<div class="photo">
					<table class="photo">
						<tr>
							<td>
								<a href="<?=$item["DETAIL_PAGE_URL"]?>" title="<?=$item["NAME"]?>">
									<?if(!empty($item["PREVIEW_PICTURE"]["src"])):?>
										<img src="<?=$item["PREVIEW_PICTURE"]["src"]?>" width="<?=$item["PREVIEW_PICTURE"]["WIDTH"]?>" height="<?=$item["PREVIEW_PICTURE"]["HEIGHT"]?>" alt="<?=$item["NAME"]?>" title="<?=$item["NAME"]?>" />
									<?else:?>
										<img src="/design/images/no-photo/pic102x102.png" width="102" height="102" alt="<?=$item["NAME"]?>" title="<?=$item["NAME"]?>" />
									<?endif;?>
								</a>
							</td>
						</tr>
					</table>
				</div>
				<div class="text">
					<h2><a href="<?=$item["DETAIL_PAGE_URL"]?>"><?=$item["NAME"]?></a></h2>
					<p><?=(strlen(strip_tags($item['PREVIEW_TEXT'])) > 200 ? substr(washString($item['PREVIEW_TEXT']), 0, 200)."..." : washString($item['PREVIEW_TEXT']))?></p>
				</div>			
				<div class="show">				
					<a href="<?=$item["DETAIL_PAGE_URL"]?>" class="view">Смотреть</a>
				</div>
				<div class="clear"></div>
			</div>
		<?endforeach;?> 
	<?endif;?>
	<?if(!empty($arResult["SOFTWARE"])):?>
		<h3>Установленное программное обеспечение</h3>
		<?foreach($arResult["SOFTWARE"] as $item):?>
			<div class="item_list_catalog">
				<div class="photo">
					<table class="photo">
						<tr>
							<td>
								<a href="<?=$item["DETAIL_PAGE_URL"]?>" title="<?=$item["NAME"]?>">
									<?if(!empty($item["PREVIEW_PICTURE"]["src"])):?>
										<img src="<?=$item["PREVIEW_PICTURE"]["src"]?>" width="<?=$item["PREVIEW_PICTURE"]["WIDTH"]?>" height="<?=$item["PREVIEW_PICTURE"]["HEIGHT"]?>" alt="<?=$item["NAME"]?>" title="<?=$item["NAME"]?>" />
									<?else:?>
										<img src="/design/images/no-photo/pic102x102.png" width="102" height="102" alt="<?=$item["NAME"]?>" title="<?=$item["NAME"]?>" />
									<?endif;?>
								</a>
							</td>
						</tr>
					</table>
				</div>
				<div class="text">
					<h2><a href="<?=$item["DETAIL_PAGE_URL"]?>"><?=$item["NAME"]?></a></h2>
					<p><?=(strlen(strip_tags($item['PREVIEW_TEXT'])) > 200 ? substr(washString($item['PREVIEW_TEXT']), 0, 200)."..." : washString($item['PREVIEW_TEXT']))?></p>
				</div>			
				<div class="show">				
					<a href="<?=$item["DETAIL_PAGE_URL"]?>" class="view">Смотреть</a>
				</div>
				<div class="clear"></div>
			</div>
		<?endforeach;?> 
	<?endif;?>
</div>