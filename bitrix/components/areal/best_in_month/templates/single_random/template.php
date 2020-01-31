<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if(!empty($arResult["COMPANIES"])):?>
	<div class="block client">
		<div class="blockCont single_best_main">
			<h2>Доска почета</h2>
			<? $key=rand(0, count($arResult["COMPANIES"])-1);
			$company=$arResult["COMPANIES"][$key];?>
			<a href="<?=$company["DETAIL_PAGE_URL"]?>" title="">
				<div class="single_best_image">
					<?$padding=(120-$company["PICTURE"]["height"])/2;?>
					<?if(!empty($company["PICTURE"]["src"])):?>
						<img src="<?=$company["PICTURE"]["src"]?>" width="<?=$company["PICTURE"]["width"]?>" height="<?=$company["PICTURE"]["height"]?>" alt="<?=$company["NAME"]?>" title="<?=$company["NAME"]?>" style="padding-top:<?=$padding?>px;"/>
					<?else:?>
						<img src="/design/images/no-photo/pic118x128.png" width="150" height="150" alt="<?=$company["NAME"]?>" title="<?=$company["NAME"]?>" />
					<?endif;?>
					<?if(!empty($company["NOMINATION"]["src"])):?>
						<img class="nomination" src="<?=$company["NOMINATION"]["src"]?>" width="<?=$company["NOMINATION"]["width"]?>" height="<?=$company["NOMINATION"]["height"]?>">
					<?endif;?>
				</div>
			</a>
			<div class="more">
				<a href="<?=$company["DETAIL_PAGE_URL"]?>" title="">Подробнее</a>
			</div>
			<?/*<div>
				<div class="single_best_name"><?echo strtoupper($company["NAME"]);?></div>
				<span><?=$company["PREVIEW_TEXT"]?></span>
			</div>*/?>
		</div>
	</div>
<?endif;?>