<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->AddChainItem("Пресс-центр", "/press_center/");
$APPLICATION->AddChainItem("Новости", "/press_center/news/");
$APPLICATION->SetTitle("Редактирование подписки");
$APPLICATION->SetPageProperty("NO_LEFT_MENU", "N");
$APPLICATION->IncludeComponent(
	"bitrix:subscribe.edit",
	".default",
	Array(
		"AJAX_MODE" => "N",
		"SHOW_HIDDEN" => "N",
		"ALLOW_ANONYMOUS" => "Y",
		"SHOW_AUTH_LINKS" => "Y",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600",
		"CACHE_NOTES" => "",
		"SET_TITLE" => "Y",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"EGAIS" => "Y"
	),
false
);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
