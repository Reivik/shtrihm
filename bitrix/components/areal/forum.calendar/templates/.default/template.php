<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<?
function numberFormat($digit, $width) {
    while(strlen($digit) < $width)
      $digit = '0' . $digit;
      return $digit;
}
?>
<div class="dates search">
	<div class="date from">
		<span class="label"><?=GetMessage("FROM")?></span>
		<div class="day">
			<select id="day_from">
				<option value="0">-</option>
				<?for($i = 1; $i <= 31; $i++) {?>
					<option value="<?=numberFormat($i,2)?>" <?if($arResult['START_DAY'] == numberFormat($i,2)):?> selected="selected" <?endif;?> ><?=$i?></option>
				<?}?>
			</select>
		</div>
		<div class="month">
			<select id="month_from">
				<option value="0">-</option>
				<?foreach($arResult["MONTH"] as $key => $month):?>
					<option value="<?=$key?>" <?if($arResult['START_MONTH'] == $key):?>selected="selected"<?endif;?>><?=$month?></option>
				<?endforeach;?>
			</select>
		</div>
		<div class="year">
			<select id="year_from">
				<option value="0">-</option>
				<?for($i = 2013; $i < date("Y")+5; $i++) {?>
					<option value="<?=$i?>" <?if($arResult['START_YEAR'] == $i):?> selected="selected" <?endif;?> ><?=$i?></option>
				<?}?>
			</select>
		</div>
		<div class="clear"></div>
	</div>
	<div class="date to">
		<span class="label"><?=GetMessage("TO")?></span>
		<div class="day">
			<select id="day_to">
				<option value="0">-</option>
				<?for($i = 1; $i < 32; $i++) {?>
					<option value="<?=numberFormat($i,2)?>" <?if($arResult['FINISH_DAY'] == numberFormat($i,2)):?> selected="selected" <?endif;?> ><?=$i?></option>
				<?}?>
			</select>
		</div>
		<div class="month">
			<select id="month_to">
				<option value="0">-</option>
				<?foreach($arResult["MONTH"] as $key => $month):?>
					<option value="<?=$key?>" <?if($arResult['FINISH_MONTH'] == $key):?> selected="selected" <?endif;?> ><?=$month?></option>
				<?endforeach;?>
			</select>
		</div>
		<div class="year">
			<select id="year_to">
				<option value="0">-</option>
				<?for($i = 2013; $i < date("Y")+5; $i++) {?>
					<option value="<?=$i?>" <?if($arResult['FINISH_YEAR'] == $i):?> selected="selected" <?endif;?> ><?=$i?></option>
				<?}?>
			</select>
		</div>
		<div class="clear"></div>
	</div>
	<?//pr($arParams['INPUT_NAME']);?>
</div>
<input id="from_date" name="<?=$arParams['INPUT_NAME']?>" type="hidden" value=""/>
<input id="to_date" name="<?=$arParams['INPUT_NAME_FINISH']?>" type="hidden" value=""/>