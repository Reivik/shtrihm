<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<a name="filter"></a>
<form name="news_filter" action="<?=$_SERVER["HTTP_X_FORWARDED_PROTO"].'://'.$_SERVER["HTTP_HOST"].$_SERVER["SCRIPT_URL"]; ?>#filter" method="get" class="filter_form">
	<input type="hidden" name="tags" value="<?=$_REQUEST["tags"]?>" />
	<div class="two_input_container">
		<div class="field">
			<select name="sections">
				<option value="0"><?=GetMessage("ALL_SECTION")?></option>
				<?foreach($arResult["SECTIONS"] as $key => $val):?>
					<option value="<?=$val["ID"]?>" <?if(($_REQUEST["sections"] == $val["ID"]) || (!isset($_REQUEST["sections"]) && $val["CODE"] == $arParams["SECTION_CODE"])):?>selected<?endif;?>><?=$val["NAME"]?></option>
				<?endforeach;?>
			</select>			
		</div>	
		<div class="field last">
			<select name="relevance">
				<option value="0"><?=GetMessage("ALL_NEWS")?></option>
				<option value="1" <?if($_REQUEST["relevance"] == "1"):?> selected <?endif;?>><?=GetMessage("ACTUAL")?></option>
				<option value="2" <?if($_REQUEST["relevance"] == "2"):?> selected <?endif;?>><?=GetMessage("ARCHIVE")?></option>
			</select>
			
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
						<?for($i = date("Y")-4; $i < date("Y")+5; $i++) {?>
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
						<?for($i = date("Y")-4; $i < date("Y")+5; $i++) {?>
							<option value="<?=$i?>" <?if($_REQUEST["year_to"] == $i):?> selected="selected" <?endif;?> ><?=$i?></option>
						<?}?>
					</select>
				</div>
				<div class="clear"></div>
			</div>
		</div>
	</div>
	<div class="search">
		<div class="inputContainer">
			<input name="search_text" type="text" value="<?=htmlspecialcharsEx($_REQUEST["search_text"])?>"  placeholder="<?=GetMessage("SEARCH")?>" >
		</div>
		<button type="submit" name="submit" class="btn"><i></i> <?=GetMessage("FIND")?></button>
	</div>
	<div class="clear"></div>
</form>
