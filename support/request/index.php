<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Обращения");
?> 

<?$APPLICATION->IncludeComponent("bitrix:form.result.new", ".default", array(
	"WEB_FORM_ID" => "2",
	"IGNORE_CUSTOM_TEMPLATE" => "N",
	"USE_EXTENDED_ERRORS" => "Y",
	"SEF_MODE" => "Y",
	"SEF_FOLDER" => "/support/request/",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "3600",
	"LIST_URL" => "result_list.php",
	"EDIT_URL" => "result_edit.php",
	"SUCCESS_URL" => "/support/request/",
	"CHAIN_ITEM_TEXT" => "",
	"CHAIN_ITEM_LINK" => ""
	),
	false
);?>
 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>