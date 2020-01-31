<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>
<?if ($arResult["isFormErrors"] == "Y"):?><?=$arResult["FORM_ERRORS_TEXT"];?><?endif;?>

<?if($_REQUEST['formresult']=='addok'):?>
	<div class="messCheck">Спасибо! Ваша заявка принята!</div>
	<?return;?>
<?endif;?>

<?if ($arResult["isFormNote"] != "Y"){?>
	<?=$arResult["FORM_HEADER"]?>
	<h2><?=$arResult["FORM_TITLE"]?></h2>
	<div class="default_forms">
	<?
	/***********************************************************************************
							form questions
	***********************************************************************************/
	?>
		<?foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion){
			if ($arQuestion['STRUCTURE'][0]['FIELD_TYPE'] == 'hidden')
			{
				echo $arQuestion["HTML_CODE"];
			}
			else
			{
				if(strpos($arQuestion["HTML_CODE"],"<select")===0){	
					$class="selectContainer";
				}
				if(strpos($arQuestion["HTML_CODE"],'type="text"')){
					$class="inputContainer";
				}
				if(strpos($arQuestion["HTML_CODE"],"<textarea")===0){	
					$class="textareaContainer";
				}?>
				<div class="field last">
					<label class="field_label"><?=$arQuestion["CAPTION"]?></label>
					<div class="<?=$class?>">
					<?
						echo $arQuestion["HTML_CODE"];
					?>
					</div>
				</div>
		<?	}
		} //endwhile?>

	<div class="requestFormBtns">
		<input <?=(intval($arResult["F_RIGHT"]) < 10 ? "disabled=\"disabled\"" : "");?> type="submit" name="web_form_submit" value="<?=htmlspecialcharsbx(strlen(trim($arResult["arForm"]["BUTTON"])) <= 0 ? GetMessage("FORM_ADD") : $arResult["arForm"]["BUTTON"]);?>" class="inputBtn formBtn"/>
		<?if ($arResult["F_RIGHT"] >= 15):?>
		&nbsp;<input type="hidden" name="web_form_apply" value="Y" />
		<?endif;?>
		&nbsp;<input type="reset" value="<?=GetMessage("FORM_RESET");?>" class="inputBtn formBtn"/>
	</div>

	<?=$arResult["FORM_FOOTER"]?>
<?} //endif (isFormNote)?>
</div>