<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<form action="<?=$arResult["FORM_ACTION"]?>" class="search_form">
	<input style="width:406px;" type="text" name="q" value="" size="15" maxlength="50" placeholder="<?=GetMessage("BSF_T_SEARCH_BUTTON")?>" />
	<input name="s" type="submit" value="" />
</form>