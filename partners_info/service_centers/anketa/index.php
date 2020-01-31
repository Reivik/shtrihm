<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Анкета на пролонгацию договора аккредитации");?>
 
<br />
  <?$APPLICATION->IncludeComponent("areal:add_anketa", ".default", array(
	
	),
	false,
	array(
	"ACTIVE_COMPONENT" => "Y"
	)
);?> <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>