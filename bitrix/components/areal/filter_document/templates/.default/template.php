<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if(!empty($arResult)):?>
	<a name="filter"></a>
	<form name="documents_filter" class="filter_form" action="<?=$APPLICATION->GetCurPage()?>#filter" method="get">
		<div class="field">
			<select name="direction">
				<option value="0">Раздел</option>
				<?foreach($arResult["DIRECTIONS"] as $direction):?>
					<option value="<?=$direction["ID"]?>" <?if($_REQUEST["direction"] == $direction["ID"]):?> selected="selected" <?endif;?> ><?=$direction["NAME"]?></option>
				<?endforeach;?>
			</select>	
		</div>		
		<div class="two_input_container">
			<div class="field">
				<select name="type">
					<option value="0">Тип принявшего органа</option>
					<?foreach($arResult["TYPE_CONTROL"] as $type):?>
						<option value="<?=$type?>" <?if($_REQUEST["type"] == $type):?> selected="selected" <?endif;?> ><?=$type?></option>
					<?endforeach;?>
				</select>	
			</div>
			<div class="field last">			
				<select name="actual">
					<option value="1">Актуальные</option>
					<option value="0">Архив</option>					
				</select>
			</div>
			<div class="clear"></div>
		</div>
		<div class="date_line">
			<?
				$today = explode(".", date("d.m.Y"));
				$weekly = explode(".", date("d.m.Y", mktime(0,0,0,date("m")+1,date("d"),date("Y"))));
			?>
			<div class="dates search">
				<label>Даты: </label>
				<div class="date from">
					<label>с</label>
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
					<label>по</label>
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
				<input type="text" name="search_name" placeholder="Поиск" value="<?=htmlspecialcharsEx($_REQUEST["search_name"])?>" />
			</div>
			<button type="submit" name="submit" class="btn"><i></i> Найти</button>
		</div>
		<div class="clear"></div>
	</form>
<?endif;?>