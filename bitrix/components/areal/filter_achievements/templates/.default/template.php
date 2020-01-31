<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<?if(!empty($arResult)):?>
	<a name="filter"></a>
	<form name="achievements_filter" class="filter_form" action="<?=$APPLICATION->GetCurPage()?>#filter" method="get">
		<div class="two_input_container">
			<div class="field">
				<select name="region" class="region" title="region_partner">
					<option value="0" <?if($arResult["SELECTED_REGION"] == 0):?> selected="selected" <?endif;?> >Регион</option>
					<?foreach($arResult["REGIONS"][$arResult["SELECTED_COUNTRY"]] as $key => $region):?>
						<option value="<?=$key?>" <?if($arResult["SELECTED_REGION"] == $key):?> selected="selected" <?endif;?> ><?=$region?></option>
					<?endforeach;?>
				</select>
			</div>		
			<div class="field last">
				<select name="town" class="town" id="region_partner">
					<option value="0" <?if($arResult["SELECTED_TOWN"] == 0):?> selected="selected" <?endif;?> >Город</option>
					<?foreach($arResult["TOWNS"][$arResult["SELECTED_REGION"]] as $k => $town):?>
						<option value="<?=$k?>" <?if($arResult["SELECTED_TOWN"] == $k):?> selected="selected" <?endif;?> ><?=$town?></option>
					<?endforeach;?>
				</select>	
			</div>
			<div class="clear"></div>
		</div>
		<div class="search">
			<div class="inputContainer">
				<input type="text" name="search_name" placeholder="Поиск" value="<?=htmlspecialcharsEx($_REQUEST["search_name"])?>" />
			</div>
			<button type="submit" name="submit" class="btn"><i></i> Найти</button>
		</div>
		<div class="clear"></div>
	</form>
<?endif;?>
