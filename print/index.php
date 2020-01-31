<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>
<?if(isset($_REQUEST["id"]) && $_REQUEST["id"] > 0):?>
	<?$APPLICATION->IncludeComponent("areal:print_text", ".default", array("ID" => $_REQUEST["id"]));?>
<?else:?>
	<?LocalRedirect("/");?>
<?endif;?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>