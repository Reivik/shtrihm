<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Аттестованные специалисты");
?>
<?$APPLICATION->IncludeComponent("areal:certified_specialities", ".default");?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>