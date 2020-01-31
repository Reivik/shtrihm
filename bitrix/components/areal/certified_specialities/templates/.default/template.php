<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<a name="filter"></a>
<form name="event_filter" class="filter_form" action="<?=$APPLICATION->GetCurPage()?>#filter" method="get">
	<div class="date_line">
		<?
			$today = explode(".", date("d.m.Y"));
			$weekly = explode(".", date("d.m.Y", mktime(0,0,0,date("m")+1,date("d"),date("Y"))));
		?>
		<div class="dates search">
			<label><?=GetMessage("DATES")?></label>
			<div class="date from">
				<label><?=GetMessage("FROM")?></label>
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
						<?for($i = 2000; $i < 2051; $i++) {?>
							<option value="<?=$i?>" <?if($_REQUEST["year_from"] == $i):?> selected="selected" <?endif;?> ><?=$i?></option>
						<?}?>
					</select>
				</div>
				<div class="clear"></div>
			</div>
			<div class="date to">
				<label><?=GetMessage("TO")?></label>
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
						<?for($i = 2000; $i < 2051; $i++) {?>
							<option value="<?=$i?>" <?if($_REQUEST["year_to"] == $i):?> selected="selected" <?endif;?> ><?=$i?></option>
						<?}?>
					</select>
				</div>
				<div class="clear"></div>
			</div>
		</div>
		<div class="clear"></div>
	</div>
	<div class="field">
		<select name="programm">
			<option value="0"><?=GetMessage("ALL_PROGRAMM");?></option>
			<?foreach($arResult["PROGRAMMS"] as $key => $programm):?>
				<option value="<?=$key?>" <?if($_REQUEST["programm"] == $key):?> selected="selected" <?endif;?> ><?=$programm?></option>
			<?endforeach;?>
		</select>
	</div>
	<div class="search">
		<div class="inputContainer">
			<input type="text" name="search_name" placeholder="<?=GetMessage("SEARCH")?>" value="<?=$_REQUEST["search_name"]?>" />
		</div>
		<button type="submit" name="submit" class="btn"><i></i> <?=GetMessage("FIND")?></button>
	</div>
	<div class="clear"></div>
</form>
<?if(!empty($arResult["ITEMS"])):?>
	<table class="sertified_spec">
		<tr>
			<th><?=GetMessage("FULL_NAME")?></th>
			<th><?=GetMessage("POSITION")?></th>
			<th><?=GetMessage("COMPANY_NAME")?></th>
			<th><?=GetMessage("PROGRAMMA")?></th>
			<th><?=GetMessage("DATE_OF_INSERT")?></th>
			<th><?=GetMessage("RIGHT")?></th>
		</tr>
		<?foreach($arResult["ITEMS"] as $arItem):?>
			<tr>
				<td><?=$arItem["NAME"]?></td>
				<td><?=$arItem["POSITION"]?></td>
				<td><?=$arItem["COMPANY"]?></td>
				<td>
					<a href="<?=$arItem["QUALIFICATION"]["DETAIL_PAGE_URL"]?>" title="<?=$arItem["QUALIFICATION"]["NAME"]?>"><?=$arItem["QUALIFICATION"]["NAME"]?></a>
				</td>
				<td><?=$arItem["DATE_START"]?></td>
				<td><?=GetMessage("DATE_END")?> <?=$arItem["DATE_END"]?></td>
			</tr>
		<?endforeach;?>
	</table>
<?else:?>
	<p>По вашему запросу ничего не найдено.</p>
<?endif;?>