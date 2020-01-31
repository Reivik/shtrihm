<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if(!empty($arResult)):?>
	<div class="item_top">
		<?if(!empty($arResult["PICTURE"]["src"])):?>
			<div class="img">
				<img src="<?=$arResult["PICTURE"]["src"]?>" width="<?=$arResult["PICTURE"]["width"]?>" height="<?=$arResult["PICTURE"]["height"]?>" alt="Лидеры продаж &laquo;Штрих-М&raquo; по итогам <?=$arResult["NAME"]?> года" title="Лидеры продаж &laquo;Штрих-М&raquo; по итогам <?=$arResult["NAME"]?> года" />
			</div>
		<?endif;?>
		<div class="top_description">
			<h2>Лидеры продаж &laquo;Штрих-М&raquo; по итогам <?=$arResult["NAME"]?> года</h2>
			<?=$arResult["DESCRIPTION"]?>			
			<?foreach($arResult["SECTIONS"] as $k => $section):?>
				<p>
					<strong><?=$section["NAME"]?></strong>
					<?if(!empty($section["ITEMS"])):?>
						<ul>
							<?foreach($section["ITEMS"] as $v => $item):?>
								<li><?=($v+1)?> место: <a href="<?=$item["DETAIL_PAGE_URL"]?>" title="<?=$item["NAME"]?>"><?=$item["NAME"]?></a></li>
							<?endforeach;?>
						</ul>
					<?else:?>
						<p>Лучший партнер не определен.</p>
					<?endif;?>
				</p>					
			<?endforeach;?>
		</div>
		<div class="clear"></div>
	</div>
<?else:?>
	<p>Итоги года еще не подведены.</p>
<?endif;?>