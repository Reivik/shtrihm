<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if(!empty($arResult)):?>
	<a name="filter"></a>
	<p><?=GetMessage("DESCRIPTION_P");?></p>
	<form name="clients_filter" class="filter_form" action="<?=$APPLICATION->GetCurPage()?>#filter" method="get">
		<div class="two_input_container">
			<div class="field">
				<select name="type">
					<option value="0"><?=GetMessage("ALL_TYPE")?></option>
					<?foreach($arResult["TYPE"] as $type):?>
						<option <?if(isset($_REQUEST["type"]) && $_REQUEST["type"] == $type["NAME"]):?> selected="selected" <?endif;?> value="<?=$type["NAME"]?>"><?=$type["NAME"]?></option>
					<?endforeach;?>
				</select>
			</div>		
			<div class="field last">			
				<select name="directions">
					<option value="0"><?=GetMessage("ALL_DIRECTIONS")?></option>
					<?foreach($arResult["DIRECTIONS"] as $directions):?>
						<option <?if(isset($_REQUEST["directions"]) && $_REQUEST["directions"] == $directions["ID"]):?> selected="selected" <?endif;?> value="<?=$directions["ID"]?>"><?=$directions["NAME"]?></option>
					<?endforeach;?>
				</select>
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
<?endif;?>