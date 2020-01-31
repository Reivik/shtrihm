<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Подать заявку на обучение");?>
<?$APPLICATION->IncludeComponent("areal:apply_for_the_training", ".default");?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>