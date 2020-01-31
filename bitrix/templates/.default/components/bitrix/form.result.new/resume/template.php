<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>
<?if ($arResult["isFormErrors"] == "Y"):?><?=$arResult["FORM_ERRORS_TEXT"];?><?endif;?>
 

<?=$arResult["FORM_HEADER"]?>

ФИО<span class='form-required starrequired'>*</span>
<input type="text"    name="form_text_16" value="" size="0" /> <span class="error_resume" id="fio"></span> <br>
Город<span class='form-required starrequired'>*</span> 
<input type="text"    name="form_text_17" value="" size="0" /> <span class="error_resume" id="city"></span> <br>
E-mail<span class='form-required starrequired'>*</span>
<input type="text"    name="form_email_19" value="" size="0" /> <span class="error_resume" id="email"></span> <br>
Резюме
<input name="form_file_20"  size="0" type="file" /><span class="bx-input-file-desc"></span><br>
Телефон
<input type="text"  name="form_text_21" value="" size="0" /><br>
О себе<span class='form-required starrequired'>*</span><br>
<textarea name="form_textarea_23" cols="6" rows="2" style="width:200px;" ></textarea><span class="error_resume" id="about"></span><br>
Дополнительтная информация<br>
<textarea name="form_textarea_24" cols="6" rows="2" style="width:200px;" ></textarea><br>
	<input  type="submit" name="web_form_submit" value="Сохранить" />
   <input type="hidden" name="web_form_apply" value="Y" /><input type="submit" name="web_form_apply" value="Применить" />
    <input type="reset" value="Сбросить" />
<?=$arResult["FORM_FOOTER"]?>
<?=$arResult["REQUIRED_SIGN"];?> - <?=GetMessage("FORM_REQUIRED_FIELDS")?>  