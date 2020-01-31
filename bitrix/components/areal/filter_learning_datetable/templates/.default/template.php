<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if(!empty($arResult)):?>
	<a name="filter"></a>
	<form name="learning_contacts_form" class="filter_form" action="<?=$APPLICATION->GetCurPage()?>#filter" method="get">
		<div class="two_input_container">
			<div class="field">
				<select name="region" class="region" title="region_partner">
					<option value="0" <?if(!isset($_REQUEST["region"])):?> selected="selected" <?endif;?> >Регион</option>					
					<option value="738" <?if($_REQUEST["region"] == 738):?> selected="selected" <?endif;?> ><?=$arResult["REGIONS"][738]?></option>
					<?if($arResult["SELECTED_REGION"] != 738):?>
						<option value="<?=$arResult["SELECTED_REGION"]?>"<?if($_REQUEST["region"] == $arResult["SELECTED_REGION"]):?> selected="selected"<?endif;?>><?=$arResult["REGIONS"][$arResult["SELECTED_REGION"]]?></option>
					<?endif;?>
					<?unset($arResult["REGIONS"][738]);?>
					<?unset($arResult["REGIONS"][$arResult["SELECTED_REGION"]]);?>
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
		<?/*<div class="two_input_container">
			<div class="field">
				<select name="type_of_company">
					<option value="0" <?if($_REQUEST["type_of_company"] == 0):?> selected="selected" <?endif;?> >Вид компании</option>
					<?foreach($arResult["FILTER"]["TYPE_OF_COMPANY"] as $type_of_company):?>
						<option value="<?=$type_of_company?>" <?if($_REQUEST["type_of_company"] == $type_of_company):?> selected="selected" <?endif;?> ><?=$type_of_company?></option>
					<?endforeach;?>
				</select>
			</div>	
			<div class="field last">
				<select name="person" id="select_person">
					<option value="0" <?if($_REQUEST["person"] == 0):?> selected="selected" <?endif;?> >Категория специалиста</option>
					<?foreach($arResult["FILTER"]["PERSONA"] as $person):?>
						<option value="<?=$person?>" <?if($_REQUEST["person"] == $person):?> selected="selected" <?endif;?> ><?=$person?></option>
					<?endforeach;?>
				</select>	
			</div>
			<div class="clear"></div>
		</div>*/?>
		<div class="field">
			<select name="theme" id="select_theme">
				<option value="0" <?if(!$_REQUEST["theme"]):?> selected="selected" <?endif;?> >Программа</option>
				<?foreach($arResult["FILTER"]["THEME"] as $theme):?>
					<option value="<?=$theme["ID"]?>" <?if($_REQUEST["theme"] == $theme["ID"]):?> selected="selected" <?endif;?> ><?=$theme["NAME"]?></option>
				<?endforeach;?>
			</select>
		</div>
		<div class="two_input_container">
			<div class="field">
				<select name="month">
					<option value="0" <?if(!$_REQUEST["month"]):?> selected="selected" <?endif;?> >Месяц проведения</option>
					<?foreach($arResult["FILTER"]["MONTH"] as $k => $month):?>
						<option value="<?=$k?>" <?if($_REQUEST["month"] == $k):?> selected="selected" <?endif;?> ><?=$month?></option>
					<?endforeach;?>
				</select>	
			</div>
			<div class="field last">
				<select name="duration">
					<option value="0" <?if(!$_REQUEST["duration"]):?> selected="selected" <?endif;?> >Продолжительность обучения</option>
					<?foreach($arResult["FILTER"]["DURATION"] as $duration):?>
						<option value="<?=$duration?>"<?if($_REQUEST["duration"] == $duration):?> selected="selected"<?endif;?>><?=$duration?></option>
					<?endforeach;?>
				</select>
			</div>	
			<div class="clear"></div>
		</div>
		<div class="two_input_container">
			<div class="field">
				<select name="archive">
					<option value="0" <?if($_REQUEST["archive"] == 0):?> selected="selected" <?endif;?> >Все</option>
					<option value="1" <?if($_REQUEST["archive"] == 1 || !isset($_REQUEST["archive"])):?> selected="selected" <?endif;?> >Актуальные</option>
					<option value="2" <?if($_REQUEST["archive"] == 2):?> selected="selected" <?endif;?> >Архив</option>
				</select>
			</div>	
			<div class="field last">
				<select name="form">
					<option value="0" <?if($_REQUEST["form"] == 0):?> selected="selected" <?endif;?> >Форма обучения</option>
					<?foreach($arResult["FILTER"]["FORM"] as $form):?>
						<option value="<?=$form?>" <?if($_REQUEST["form"] == $form):?> selected="selected" <?endif;?> ><?=$form?></option>
					<?endforeach;?>
				</select>
			</div>	
			<div class="clear"></div>
		</div>
		<div class="search">
			<div class="inputContainer">
				<input type="text" name="search_name" placeholder="Поиск" value="<?=$_REQUEST["search_name"]?>" />
			</div>
			<button type="submit" name="submit" class="btn"><i></i> Найти</button>
		</div>
		<div class="clear"></div>
	</form>
<?endif;?>
<?/*<script type="text/javascript">
	var theme = new Array();
	<?foreach($arResult["FILTER"]["THEME"] as $theme):?>
		theme[theme.length] = {
			"id":'<?=$theme["ID"]?>',
			"name":'<?=$theme["NAME"]?>',
			"type_of_company":'<?=$theme["TYPE_COMPANY"]?>',
			"person":'<?=$theme["PERSON"]?>'
		};
	<?endforeach;?>
	$('select[name="type_of_company"]').on("change", function() {
		var select_id = $(this).find('option:selected').val();
		var objSel_person = document.getElementById("select_person");
		objSel_person.options.length = 0;
		objSel_person.options[objSel_person.options.length] = new Option("Категория специалиста", 0);
		for(var i=0; i < theme.length; i++) {
			if((select_id != 0 && theme[i]["type_of_company"] == select_id) || select_id == 0) {
				var flag = 0;
				for(var j=0; j < objSel_person.options.length; j++) {
					if(objSel_person.options[j].value == theme[i]["person"])
						flag = 1;
				}
				if(flag == 0)
					objSel_person.options[objSel_person.options.length] = new Option(theme[i]["person"], theme[i]["person"]);				
			}
		}
		$("#select_person").selectbox("detach")
		$("#select_person").selectbox("attach");
		changeTheme();
	});
	
	$('select[name="type_of_company"]').on("change", function() {changeTheme();});
	
	function changeTheme() {
		var type_company = $('select[name="type_of_company"]').find('option:selected').val();
		var person = $('select[name="person"]').find('option:selected').val();
		var objSel_person = document.getElementById("select_theme");
		objSel_person.options.length = 0;
		objSel_person.options[objSel_person.options.length] = new Option("Тема программы", 0);
		for(var i=0; i < theme.length; i++) {
			if(((type_company != 0 && theme[i]["type_of_company"] == type_company) || type_company == 0) && ((person != 0 && theme[i]["person"] == person) || person == 0))
				objSel_person.options[objSel_person.options.length] = new Option(theme[i]["name"], theme[i]["name"]);
		}
		$("#select_theme").selectbox("detach")
		$("#select_theme").selectbox("attach");
	}
</script>*/?>