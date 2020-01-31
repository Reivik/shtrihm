<?
define("NEED_AUTH", true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("NO_LEFT_MENU", "N");

if (isset($_REQUEST["backurl"]) && strlen($_REQUEST["backurl"])>0) 
	LocalRedirect($backurl);
$APPLICATION->SetTitle("Авторизация");
$APPLICATION->SetPageProperty("SHOW_BANNERS", "N");
$APPLICATION->SetPageProperty("NO_LEFT_MENU", "N");
?>
<p class="notetext">Вы зарегистрированы и успешно авторизовались.</p>

<p><a href="/">Вернуться на главную страницу</a></p>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>