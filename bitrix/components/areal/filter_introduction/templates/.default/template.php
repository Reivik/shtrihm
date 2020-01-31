<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<?if(!empty($arResult)):?>	
	<form name="intro_filter" class="filter_form" action="<?=$APPLICATION->GetCurPage(false)?>" method="get">
		<div class="two_input_container">
			<div class="field">				
				<select name="type">
					<option value="0" <?if($_REQUEST["type"] == 0):?> selected="selected" <?endif;?> >Тип объекта</option>
					<?foreach($arResult["TYPE"] as $key_type => $type):?>
						<option value="<?=$key_type?>" <?if($key_type == $_REQUEST["type"]):?> selected="selected" <?endif;?> ><?=$type?></option>
					<?endforeach;?>
				</select>				
			</div>
			<div class="field last">				
				<select name="product">
					<option value="0" <?if($_REQUEST["product"] == 0):?> selected="selected" <?endif;?> >Все продукты</option>
					<?foreach($arResult["PRODUCT"] as $key => $product):?>
						<option value="<?=$key?>" <?if($_REQUEST["product"] == $key):?> selected="selected" <?endif;?> ><?=$product?></option>
					<?endforeach;?>
				</select>
			</div>
			<div class="clear"></div>
		</div>
		<div class="field">
			<select name="company">
				<option value="0" <?if($_REQUEST["company"] == 0):?> selected="selected" <?endif;?> >Все компании</option>
				<?foreach($arResult["COMPANY"] as $key => $company):?>
					<option value="<?=$key?>" <?if($_REQUEST["company"] == $key):?> selected="selected" <?endif;?> ><?=$company?></option>
				<?endforeach;?>
			</select>
		</div>
		<div class="country-region-town">
			<div class="field">
				<select name="country" class="country" title="country_partner">
					<option value="0" <?if($arResult["SELECTED_COUNTRY"] == 0):?> selected="selected" <?endif;?> >Все страны</option>
					<?foreach($arResult["COUNTRIES"] as $keyCon => $country):?>
						<option value="<?=$keyCon?>" <?if($arResult["SELECTED_COUNTRY"] == $keyCon):?> selected="selected" <?endif;?> ><?=$country?></option>
					<?endforeach;?>
				</select>
			</div>
			<div class="two_input_container">
				<div class="field">
					<select name="region" class="region" id="country_partner" title="region_intro">
						<option value="0" <?if($arResult["SELECTED_REGION"] == 0):?> selected="selected" <?endif;?> >Регион</option>
						<?foreach($arResult["REGIONS"][$arResult["SELECTED_COUNTRY"]] as $key => $region):?>
							<option value="<?=$key?>" <?if($arResult["SELECTED_REGION"] == $key):?> selected="selected" <?endif;?> ><?=$region?></option>
						<?endforeach;?>
					</select>
				</div>
				<div class="hidecity">
					<div class="field last">
						<select name="town" class="town" id="region_intro">
							<option value="0" <?if($arResult["SELECTED_TOWN"] == 0):?> selected="selected" <?endif;?> >Город</option>
							<?foreach($arResult["TOWNS"][$arResult["SELECTED_REGION"]] as $k => $town):?>
								<option value="<?=$k?>" <?if($arResult["SELECTED_TOWN"] == $k):?> selected="selected" <?endif;?> ><?=$town?></option>
							<?endforeach;?>
						</select>	
					</div>
				</div>			
				<div class="clear"></div>
			</div>	
		</div>	
		<div class="search">
			<div class="inputContainer">
				<input type="text" name="search" placeholder="Поиск" value="<?=htmlspecialcharsEx($_REQUEST["search"])?>" />
			</div>
			<button type="submit" name="submit" class="btn"><i></i> Найти</button>
		</div>
		<div class="clear"></div>
	</form>
	<div class="clear"></div>
<?endif;?>
