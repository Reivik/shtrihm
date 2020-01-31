<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if(!empty($arResult["ITEMS"])):?>
	<table>
		<tr>
			<th>Продукт</th>
			<th>Описание</th>
		</tr>
		<?foreach($arResult["ITEMS"] as $product):?>
			<tr>
				<td class="photo">
					<a class="img" href="<?=$product["DETAIL_PAGE_URL"]?>" title="<?=$product["NAME"]?>">
						<?if(!empty($product["PREVIEW_PICTURE"]["src"])):?>
							<img src="<?=$product["PREVIEW_PICTURE"]["src"]?>" alt="<?=$product["NAME"]?>" title="<?=$product["NAME"]?>" width="<?=$product["PREVIEW_PICTURE"]["width"]?>" height="<?=$product["PREVIEW_PICTURE"]["height"]?>" />
						<?else:?>
							<img src="/design/images/no-photo/pic117x117.png" alt="<?=$product["NAME"]?>" title="<?=$product["NAME"]?>" width="117" height="117" />
						<?endif;?>
					</a>
				</td>
				<td>
					<a href="<?=$product["DETAIL_PAGE_URL"]?>" title="<?=$product["NAME"]?>"><b><?=$product["NAME"]?></b></a>
					<?if($product["PREVIEW_TEXT_TYPE"] == "text"):?>
						<p><?=(strlen($product['PREVIEW_TEXT']) > 200 ? substr($product['PREVIEW_TEXT'], 0, 200)."..." : $product['PREVIEW_TEXT'])?></p>
					<?elseif($product["PREVIEW_TEXT_TYPE"] == "html"):?>
						<p><?=(strlen(strip_tags($product['PREVIEW_TEXT'])) > 200 ? substr(strip_tags($product['PREVIEW_TEXT']), 0, 200)."..." : strip_tags($product['PREVIEW_TEXT']))?></p>
					<?else:?>
						<p>Нет описания</p>
					<?endif;?>
				</td>
			</tr>
		<?endforeach;?>
	</table>
	<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
		<?=$arResult["NAV_STRING"]?>
	<?endif;?>
<?else:?>
	<p>В сожалению, для данного продукта не указано сопуствующих товаров.</p>
<?endif;?>
