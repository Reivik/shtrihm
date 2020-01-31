<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<a name="filter"></a>
<form name="event_filter" class="filter_form" action="<?=$APPLICATION->GetCurPage()?>#filter" method="get">
	<div class="two_input_container">
		<div class="field">
			<select name="region" class="region" title="region_partner">
				<option value="0" <?if($arResult["SELECTED_REGION"] == 0):?> selected="selected" <?endif;?> ><?=GetMessage("REGION")?></option>
				<?foreach($arResult["REGIONS"][$arResult["SELECTED_COUNTRY"]] as $key => $region):?>
					<option value="<?=$key?>" <?if($arResult["SELECTED_REGION"] == $key):?> selected="selected" <?endif;?> ><?=$region?></option>
				<?endforeach;?>
			</select>
		</div>		
		<div class="field last">
			<select name="town" class="town" id="region_partner">
				<option value="0" <?if($arResult["SELECTED_TOWN"] == 0):?> selected="selected" <?endif;?> ><?=GetMessage("TOWN")?></option>
				<?foreach($arResult["TOWNS"][$arResult["SELECTED_REGION"]] as $k => $town):?>
					<option value="<?=$k?>" <?if($arResult["SELECTED_TOWN"] == $k):?> selected="selected" <?endif;?> ><?=$town?></option>
				<?endforeach;?>
			</select>	
		</div>
		<div class="clear"></div>
	</div>
	<div class="field">
		<select name="type">
			<option value="0"><?=GetMessage("TYPE")?></option>
			<?foreach($arResult["TYPE"] as $type):?>
				<option value="<?=$type?>" <?if($_REQUEST["type"] == $type):?> selected="selected" <?endif;?> ><?=$type?></option>
			<?endforeach;?>
		</select>	
	</div>
	<div class="clear"></div>
	<div class="section_registration">
		<div id="name_section_reg">
			<?=GetMessage("SECTION")?>
			<img src="/design/images/selectR-new.png" title="Открыть" alt="Открыть" width="30" height="30" />
		</div>
		<div id="section_detail_reg" class="event">
			<?$n = 0;?>
			<?foreach($arResult["SECTION"] as $key => $section):?>
				<label class="label_check<?if(($n+1)%3 == 0):?> last<?endif;?>" for="checkbox_<?=$key?>">
					<input name="section[]" id="checkbox_<?=$item["ID"]?>" value="<?=$key?>" <?if(in_array($key, $_REQUEST["section"])):?> checked="checked" <?endif;?> type="checkbox"><?=$section?>
				</label>
				<?$n++;?>
			<?endforeach;?>
			<div class="clear"></div>
		</div>
	</div>
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
						<?for($i = date("Y"); $i < date("Y")+5; $i++) {?>
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
						<?for($i = date("Y"); $i < date("Y")+5; $i++) {?>
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
			<input type="text" name="search_name" placeholder="<?=GetMessage("SEARCH")?>" value="<?=htmlspecialcharsEx($_REQUEST["search_name"])?>" />
		</div>
		<button type="submit" name="submit" class="btn"><i></i> <?=GetMessage("FIND")?></button>
	</div>
	<div class="clear"></div>
</form>