<?define("TEXT_DECOR","N");
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Регистрация оборудования");
?> 
<?$APPLICATION->IncludeComponent(
	"areal:find_serial_number",
	"",
	Array(
	),
false
);?>
 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>