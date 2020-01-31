<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if(!empty($arResult["REGIONS"])):?>
	<?/*<li id="countries">
		<a class="location" href="#"><span><?=($arResult["COUNTRIES"][$arResult["SELECTED_COUNTRY"]])?($arResult["COUNTRIES"][$arResult["SELECTED_COUNTRY"]]):'Ваша страна'?></span></a>
		<ul id="ul_countries">
			<?foreach($arResult["COUNTRIES"][$arResult["SELECTED_COUNTRY"]] as $keyCon => $country):?>
				<li><a href="#" id="<?=$keyCon?>" title="<?=$country?>"><span><?=$country?></span></a></li>
			<?endforeach;?>		
		</ul>
	</li>*/?>
	<!--<li id="regions">
		<a class="location" href="#"><span><?=($arResult["REGIONS"][$arResult["SELECTED_COUNTRY"]][$arResult["SELECTED_REGION"]])?$arResult["REGIONS"][$arResult["SELECTED_COUNTRY"]][$arResult["SELECTED_REGION"]]:'Ваш регион'?></span></a>
		<ul id="ul_regions">
			<?foreach($arResult["REGIONS"][$arResult["SELECTED_COUNTRY"]] as $key => $region):?>
				<li><a href="#" id="<?=$key?>" title="<?=$region?>"><span><?=$region?></span></a></li>
			<?endforeach;?>
		</ul>
	</li>
	<?if(count($arResult["TOWNS"][$arResult["SELECTED_REGION"]]) > 0):?>
		<li id="towns">
			<a class="location" href="#"><span><?=($arResult["TOWNS"][$arResult["SELECTED_REGION"]][$arResult["SELECTED_TOWN"]])?$arResult["TOWNS"][$arResult["SELECTED_REGION"]][$arResult["SELECTED_TOWN"]]:'Ваш город'?></span></a>
			<ul id="ul_towns">
				<?foreach($arResult["TOWNS"][$arResult["SELECTED_REGION"]] as $k => $town):?>					
					<li><a href="#" id="<?=$k?>" title="<?=$town?>"><span><?=$town?></span></a></li>
				<?endforeach;?>
			</ul>
		</li>-->
<li class="root-item count_1 " style="right: 28px;">
							<a href="https://www.shtrih-m.ru/support/where/">Где купить</a> 
						</li>
	<?endif;?>
<?endif;?>

