<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Онлайн-кассы отправка");
?>
<div class="answer">
	<p>Спасибо! Ваша заявка отправлена.<br />
		Наши сотрудники свяжутся с вами в ближайшее время!<br /><br />
		<a href="/catalog/online-till/">Назад в каталог</a>
	</p>
</div>
<?$eventName = 'ONLINE_TILL_FORM';
$arFields = Array(
    "ITEM" => $_POST['form_textarea_174'],
    "NAME" => $_POST['form_text_56'],
    "EMAIL" => $_POST['form_text_67'],
	"COMPANY" => $_POST['form_text_57'],
	"PHONE" => $_POST['form_text_66'],
	"COMMENT" => $_POST['form_textarea_68'],
	"REGION" => $_POST['form_text_172'],
	"CITY" => $_POST['form_text_171'],
    "EMAIL_TO" => 'sales@poscenter.pro'
);
    $event = new CEvent;
    $event->Send($eventName, SITE_ID, $arFields, "N");

?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>