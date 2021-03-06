<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if (intval($arParams["COURSE_ID"]) > 0):?>
	<?$APPLICATION->IncludeComponent("bitrix:learning.course.tree", "", Array(
		"COURSE_ID"	=> $arParams["COURSE_ID"],
		"COURSE_DETAIL_TEMPLATE"	=> $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["course.detail"],
		"CHAPTER_DETAIL_TEMPLATE"	=> $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["chapter.detail"],
		"LESSON_DETAIL_TEMPLATE" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["lesson.detail"],
		"SELF_TEST_TEMPLATE"	=> $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["test.self"],
		"TESTS_LIST_TEMPLATE"	=> $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["test.list"],
		"TEST_DETAIL_TEMPLATE"	=> $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["test"],
		"CHECK_PERMISSIONS"	=> $arParams["CHECK_PERMISSIONS"],
		"SET_TITLE"	=> $arParams["SET_TITLE"]
		),
		$component
	);?>
<?endif?>
<?$APPLICATION->IncludeComponent("bitrix:learning.student.gradebook", "", Array(
	"TEST_DETAIL_TEMPLATE"	=> $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["test"],
	"COURSE_DETAIL_TEMPLATE"	=> $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["course.detail"],
	"TEST_ID_VARIABLE" => ($arParams["SEF_MODE"] == "Y" ? $arResult["ALIASES"]["gradebook"]["FOR_TEST_ID"] : $arResult["ALIASES"]["FOR_TEST_ID"]),
	"SET_TITLE"	=> $arParams["SET_TITLE"]
	),
	$component
);?>