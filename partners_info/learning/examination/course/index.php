<?
define("LEARNING", 1);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("NO_LEFT_MENU", "N");
$APPLICATION->SetTitle("Курсы");
?>
<?$APPLICATION->IncludeComponent(
	"bitrix:learning.course",
	".default",
	Array(
		"SEF_MODE" => "N",
		"COURSE_ID" => $_REQUEST["COURSE_ID"],
		"CHECK_PERMISSIONS" => "Y",
		"PATH_TO_USER_PROFILE" => "/company/personal/user/#USER_ID#/",
		"PAGE_WINDOW" => "10",
		"SHOW_TIME_LIMIT" => "Y",
		"PAGE_NUMBER_VARIABLE" => "PAGE",
		"TESTS_PER_PAGE" => "20",
		"SET_TITLE" => "Y",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600",
		"CACHE_NOTES" => "",
		"VARIABLE_ALIASES" => Array(
			"COURSE_ID" => "COURSE_ID",
			"INDEX" => "INDEX",
			"LESSON_ID" => "LESSON_ID",
			"CHAPTER_ID" => "CHAPTER_ID",
			"SELF_TEST_ID" => "SELF_TEST_ID",
			"TEST_ID" => "TEST_ID",
			"TYPE" => "TYPE",
			"TEST_LIST" => "TEST_LIST",
			"GRADEBOOK" => "GRADEBOOK",
			"FOR_TEST_ID" => "FOR_TEST_ID"
		)
	)
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>