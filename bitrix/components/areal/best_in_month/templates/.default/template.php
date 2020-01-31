<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if(!empty($arResult["COMPANIES"])):?>
	<div class="block sliderInner2">
		<div class="blockCont">
			<?/*<div class="title">лучшие в <?=$arResult["MONTH"]?></div>*/?>
			<div class="title">Доска почета</div>
			<ul class="sliderItemsBest">				
				<?foreach($arResult["COMPANIES"] as $key => $company):?>
					<?if($key == 0 || $key % 5 == 0):?>
						<li><div class="slide-items">
					<?endif;?>
							<a class="item" href="<?=$company["DETAIL_PAGE_URL"]?>">
								<span>
									<?if(!empty($company["PICTURE"]["src"])):?>
										<img src="<?=$company["PICTURE"]["src"]?>" width="<?=$company["PICTURE"]["width"]?>" height="<?=$company["PICTURE"]["height"]?>" alt="<?=$company["NAME"]?>" title="<?=$company["NAME"]?>" />
									<?else:?>
										<img src="/design/images/no-photo/pic118x128.png" width="118" height="128" alt="<?=$company["NAME"]?>" title="<?=$company["NAME"]?>" />
									<?endif;?>
								</span>
							</a>
					<?if(($key+1)%5 == 0 || !isset($arResult["COMPANIES"][$key+1])):?>
						</div></li>
					<?endif;?>
				<?endforeach;?>								
			</ul>		
		</div>
	</div>
<?endif;?>