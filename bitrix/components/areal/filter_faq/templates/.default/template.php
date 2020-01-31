<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<a name="filter"></a>
<form name="faq_partner" class="filter_form" action="<?=$APPLICATION->GetCurPage()?>#filter" method="get">
	<?if(!empty($arResult["DIRECTIONS"])):?>
		<div class="field">
			<select name="directions">
				<option value="0" <?if($_REQUEST["directions"] == 0):?> selected="selected" <?endif;?> >Все разделы</option>
				<?foreach($arResult["DIRECTIONS"] as $directions):?>
					<option value="<?=$directions["ID"]?>" <?if($directions["ID"] == $_REQUEST["directions"]):?> selected="selected" <?endif;?> ><?=$directions["NAME"]?></option>
				<?endforeach;?>
			</select>
		</div>
	<?endif;?>
	<div class="search">
		<div class="inputContainer">
			<input type="text" name="search" placeholder="Поиск" value="<?=htmlspecialcharsEx($_REQUEST["search"])?>" />
		</div>
		<button type="submit" name="submit" class="btn"><i></i> Найти</button>
	</div>
	<div class="clear"></div>
</form>