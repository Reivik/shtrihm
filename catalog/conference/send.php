<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Конференции и семинары");
CModule::IncludeModule('iblock');
?>
<?
if (!empty($_POST) && empty($_POST['no_bot'])) {
$el = new CIBlockElement;
//Свойства
$PROP = array();
$PROP['CONF'] = $_POST['conf'];
$PROP['COMPANY'] = $_POST['company'];
$PROP['PHONE'] = $_POST['phone'];
$PROP['EMAIL'] = $_POST['email'];
$PROP['CITY'] = $_POST['city'];

$fields = array(
    "IBLOCK_SECTION_ID" => false,
    "MODIFIED_BY" => $GLOBALS['USER']->GetID(),
    "DATE_ACTIVE_FROM" => date("d.m.Y"),
    "IBLOCK_ID" => 76,
    "PROPERTY_VALUES" => $PROP,
    "NAME" => strip_tags($_POST['name']),
    "ACTIVE" => "Y",
);


$eventName = 'CONF_REG';

$arFields = Array(
	"CONFERENCE" => $_POST['conf'],
    "COMPANY" => $_POST['company'],
	"NAME" => $_POST['name'],
    "PHONE" => $_POST['phone'],
    "EMAIL" => $_POST['email'],
	"CITY" => $_POST['city'],
	"EMAIL_TO" => 'npichugina@shtrih-m.ru'
);
    $event = new CEvent;
if($event->Send($eventName, SITE_ID, $arFields, "N")) {
$el->Add($fields);
$result['status'] = 'success';
?>
<p>Спасибо, ваша заявка отправлена, мы свяжемся с вами в ближайшее время!</p><p><a href="<?=SITE_DIR?>">На главную</a></p>
<?
}else{
?>
<p>Произошла ошибка, попробуйте еще раз!</p><p><a href="/catalog/conference/">Страница регистрации</a></p>
<?}?>

<?}else{?>
<p>Произошла ошибка, попробуйте еще раз!</p><p><a href="/catalog/conference/">Страница регистрации</a></p>
<?}?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>