<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if($_REQUEST["success"] == "yes" && empty($arResult["ERROR"])):?>
	<?ShowNote(GetMessage("SUCCESS_SAVE"));?>
	<?=GetMessage("NEW_APP");?>
<?endif;?>
<?if(!empty($arResult["ERROR"])):?>
	<?ShowError(implode("<br />", $arResult["ERROR"]));?>
<?endif;?>
<form method="post" class="protection" action="<?=POST_FORM_ACTION_URI?>" name="step_1" enctype="multipart/form-data">
	<?=bitrix_sessid_post()?>
	<?if($arResult["STEP"] > 0) include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/step".$arResult["STEP"].".php");?>
</form>