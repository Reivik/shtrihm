<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<a name="filter"></a>
<form name="vebinar_filter" class="filter_form" action="<?=$APPLICATION->GetCurPage()?>#filter" method="get">
	<?if(!empty($arResult["DIRECTIONS"])):?>
		<div class="field">
			<select name="directions">
				<option value="0" <?if($_REQUEST["directions"] == 0):?> selected="selected" <?endif;?> >Темы вебинаров</option>
				<?foreach($arResult["DIRECTIONS"] as $key => $directions):?>
					<option value="<?=$key?>" <?if($key == $_REQUEST["directions"]):?> selected="selected" <?endif;?> ><?=$directions?></option>
				<?endforeach;?>
			</select>
		</div>
		
		<div class="field">
			<select name="categories">
				<option value="0" <?if($_REQUEST["categories"] == 0):?> selected="selected" <?endif;?> >Все категории</option>
				<?foreach($arResult["CATEGORIES"] as $key => $categories):?>
					<option value="<?=$key?>" <?if($key == $_REQUEST["categories"]):?> selected="selected" <?endif;?> ><?=$categories?></option>
				<?endforeach;?>
			</select>
		</div>
	<?endif;?>
	<div class="date_line">
		<?
			$today = explode(".", date("d.m.Y"));
			$weekly = explode(".", date("d.m.Y", mktime(0,0,0,date("m")+1,date("d"),date("Y"))));
		?>
		<div class="dates search">
			<label>Даты:</label>
			<div class="date from">
				<label>с </label>
				<div class="day">
					<select name="day_from">
						<option value="0">-</option>
						<?for($i = 1; $i < 32; $i++) {?>
							<option value="<?=$i?>" <?if($_REQUEST["day_from"] == $i):?> selected="selected" <?endif;?> ><?=$i?></option>
						<?}?>
					</select>
				</div>
				<div class="month">
					<select name="month_from">
						<option value="0">-</option>
						<?foreach($arResult["MONTH"] as $key => $month):?>
							<option value="<?=$key?>" <?if($_REQUEST["month_from"] == $key):?>selected="selected"<?endif;?>><?=$month?></option>
						<?endforeach;?>
					</select>
				</div>
				<div class="year">
					<select name="year_from">
						<option value="0">-</option>
						<?for($i = date("Y")-5; $i < date("Y")+5; $i++) {?>
							<option value="<?=$i?>" <?if($_REQUEST["year_from"] == $i):?> selected="selected" <?endif;?> ><?=$i?></option>
						<?}?>
					</select>
				</div>
				<div class="clear"></div>
			</div>
			<div class="date to">
				<label>по </label>
				<div class="day">
					<select name="day_to">
						<option value="0">-</option>
						<?for($i = 1; $i < 32; $i++) {?>
							<option value="<?=$i?>" <?if($_REQUEST["day_to"] == $i):?> selected="selected" <?endif;?> ><?=$i?></option>
						<?}?>
					</select>
				</div>
				<div class="month">
					<select name="month_to">
						<option value="0">-</option>
						<?foreach($arResult["MONTH"] as $key => $month):?>
							<option value="<?=$key?>" <?if($_REQUEST["month_to"] == $key):?> selected="selected" <?endif;?> ><?=$month?></option>
						<?endforeach;?>
					</select>
				</div>
				<div class="year">
					<select name="year_to">
						<option value="0">-</option>
						<?for($i = date("Y")-5; $i < date("Y")+5; $i++) {?>
							<option value="<?=$i?>" <?if($_REQUEST["year_to"] == $i):?> selected="selected" <?endif;?> ><?=$i?></option>
						<?}?>
					</select>
				</div>
				<div class="clear"></div>
			</div>
		</div>
		<div class="clear"></div>
	</div>
	<div class="search">
		<div class="inputContainer">
			<input type="text" name="search" placeholder="Поиск" value="<?=htmlspecialcharsEx($_REQUEST["search"])?>" />
		</div>
		<button type="submit" name="submit" class="btn" value="Найти"><i></i> Найти</button>
	</div>
	<div class="clear"></div>
</form>