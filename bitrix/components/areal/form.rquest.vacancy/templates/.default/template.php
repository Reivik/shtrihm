<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if ($arResult["isFormErrors"] == "Y"):?><?=$arResult["FORM_ERRORS_TEXT"];?><?endif;?>

<h3><?=GetMessage('RESPOND_DESCRIPTION')?></h3>

<div class="messErr" id="empty_fields" style="display:none">Не заполнены обязательные поля</div>
<div class="messErr" id="email_error" style="display:none" >Некорректный E-mail</div>

<form class="filter_form" name="vacancy_form" action="<?=$arParams["PAGE_URL"]?>" method="POST" enctype="multipart/form-data">
	<?=bitrix_sessid_post()?>
	<input type="hidden"  name="email_manager" value="<?=$arParams["EMAIL_MANAGER"]?>" size="0" />
	<input type="hidden"  name="vacancy" value="<?=$arParams["VACANCY"]?>" size="0" />
	<div class="inputContainer">
		<input type="text"    name="fio" value="" size="0" placeholder="Введите ФИО" />
	</div>
	<input type="hidden"  name="region_text"  size="0" />
	<input type="hidden"  name="town_text"  size="0" />
	<div class="two_input_container">
		<div class="field">
			<select name="region" class="region" title="region_partner">
				<option value="0" <?if($arResult["SELECTED_REGION"] == 0):?> selected="selected" <?endif;?> >Регион</option>
				<?foreach($arResult["REGIONS"] as $key => $region):?>
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
	<div class="field">
		<div class="inputContainer">
			<input type="text" placeholder="Телефон"  name="phone" class="phone" value="" size="0" />
		</div>
	</div>
	<div class="field">
		<div class="inputContainer">
			<input type="text" placeholder="E-mail" name="mail" value="" size="0" /> 
		</div>
	</div>
	<div class="field">
		<div class="input file">
			<div class="input-files">
				<input type="text" placeholder="Резюме" />
				<a href="#" class="testr" >Загрузить</a>
				<input type="file" name="file"  size="96" />
			</div>
		</div>
	</div>
	<div class="field">
		<div class="textareaContainer">
			<textarea placeholder="Дополнительно" name="about"></textarea>
		</div>
	</div>
	<div id="button">
		<button href="#thank" type="submit" class="inpBtn" name="submit">Отправить</button>
		<button type="reset" class="inpBtn"  >Сбросить</button>
		<div class="clear"></div>
	</div>
	<input type="hidden" name="web_form_apply" value="Y" />
	<div class="clear"></div>
</form>
