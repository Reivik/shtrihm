<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Мои результаты");
?>
<h2>Журнал обучения</h2>
<?$APPLICATION->IncludeComponent(
	"bitrix:learning.student.gradebook",
	"",
	Array(
		"TEST_DETAIL_TEMPLATE" => "/partners_info/learning/examination/index.php?COURSE_ID=#COURSE_ID#&TEST_ID=#TEST_ID#",
		"COURSE_DETAIL_TEMPLATE" => "/partners_info/learning/examination/index.php?COURSE_ID=#COURSE_ID#&INDEX=Y",
		"TEST_ID_VARIABLE" => "TEST_ID",
		"SET_TITLE" => "Y"
	)
);?>
<h2>Мои сертификаты</h2>
<?$APPLICATION->IncludeComponent(
	"bitrix:learning.student.certificates",
	"",
	Array(
		"COURSE_DETAIL_TEMPLATE" => "/partners_info/learning/examination/index.php?COURSE_ID=#COURSE_ID#&INDEX=Y",
		"TESTS_LIST_TEMPLATE" => "/partners_info/learning/examination/index.php?COURSE_ID=#COURSE_ID#&TEST_LIST=Y",
		"SET_TITLE" => "Y"
	),
false
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>