<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if ($arResult["isFormErrors"] == "Y"):?><?=$arResult["FORM_ERRORS_TEXT"];?><?endif;?>
<?/*<b class="b_email"><?=GetMessage('RESPOND_DESCRIPTION')?></b>*/?>
<h3><h3><?=GetMessage('RESPOND_DESCRIPTION')?></h3>
<div class="messErr" id="empty_fields" style="display:none">Не заполнены обязательные поля</div>
<div class="messErr" id="email_error" style="display:none" >Некорректный E-mail</div>
<?=$arResult["FORM_HEADER"]?>
<input type="hidden"  name="form_text_26" value="<?=$arParams["EMAIL_MANAGER"]?>" size="0" />
<input type="hidden"  name="form_text_27" value="<?=$arParams["VACANCY"]?>" size="0" />
<div class="inputContainer">
<input type="text"    name="form_text_16" value="" size="0" placeholder="Введите ФИО" />  </div>
<input type="hidden"  name="form_text_28"  size="0" />
<input type="hidden"  name="form_text_17"  size="0" />
<div class="select_location">
	<select name="region" class="region" title="region_partner" id="select_region">
		<option value="0" <?if($arResult["SELECTED_REGION"] == 0):?> selected="selected" <?endif;?> >Все регионы</option>
		<?foreach($arResult["REGIONS"] as $key => $region):?>
			<option value="<?=$key?>" <?if($arResult["SELECTED_REGION"] == $key):?> selected="selected" <?endif;?> ><?=$region?></option>
		<?endforeach;?>
	</select>
</div>
<div class="select_location marginRight0">
	<select name="town" class="town" id="region_partner">
		<option  value="0" <?if($arResult["SELECTED_TOWN"] == 0):?> selected="selected" <?endif;?> >Все населенные пункты</option>
		<?foreach($arResult["TOWNS"][$arResult["SELECTED_REGION"]] as $k => $town):?>
			<option  value="<?=$key?>" <?if($arResult["SELECTED_TOWN"] == $k):?> selected="selected" <?endif;?> ><?=$town?></option>
		<?endforeach;?>
	</select>
</div>
<div class="inputContainer">
	<input type="text" placeholder="Телефон"  name="form_text_21" value="" size="0" />
</div>
<div class="inputContainer">
	<input type="text" placeholder="E-mail" name="form_email_19" value="" size="0" /> 
</div>
<div class="input file">
	<div class="input-files">
		<input type="text" placeholder="Резюме" />
		<a href="#" class="testr" >Загрузить</a>
		<input type="file" name="form_file_20"  size="96" />
	</div>
</div>
<?/*<div class="textareaContainer">
	<textarea placeholder="О себе" name="form_textarea_23" ></textarea><span class="error_resume" id="about"></span>
</div>*/?>
<div class="textareaContainer">
	<textarea placeholder="Дополнительно" name="form_textarea_24"></textarea>
</div>
<div id="button">
	<button href="#thank" type="submit" class="inpBtn"  >Отправить</button>
	<button type="reset" class="inpBtn"  >Сбросить</button>
	<div class="clear"></div>
</div>
<input type="hidden" name="web_form_apply" value="Y" />
<div class="clear"></div>
<?=$arResult["FORM_FOOTER"]?>
