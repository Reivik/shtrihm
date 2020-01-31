<?
define("LEARNING", 1);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Список курсов");
?> 
<?$APPLICATION->IncludeComponent(
	"bitrix:learning.course.list",
	".default",
	Array(
		"SORBY" => "SORT",
		"SORORDER" => "ASC",
		"COURSE_DETAIL_TEMPLATE" => "course/?COURSE_ID=#COURSE_ID#",
		"CHECK_PERMISSIONS" => "Y",
		"COURSES_PER_PAGE" => "20",
		"SET_TITLE" => "Y"
	),
false
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>