<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->AddChainItem("Пресс-центр", "/press_center/");
$APPLICATION->AddChainItem("Новости", "/press_center/news/");
$APPLICATION->SetTitle("Подписка");
$chain = $APPLICATION->GetNavChain(false, false, false, true);
$APPLICATION->SetPageProperty("NO_LEFT_MENU", "N");
$APPLICATION->IncludeComponent(
	"bitrix:subscribe.index",
	"",
	Array(
		"SHOW_COUNT" => "N",
		"SHOW_HIDDEN" => "N",
		"PAGE" => "/subscribe/subscr_edit.php",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600",
		"SET_TITLE" => "N"
	),
false
);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>