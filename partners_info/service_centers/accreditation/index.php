<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Заявка на аккредитацию");?>
<?$APPLICATION->IncludeComponent("areal:add_accreditation", ".default");?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>