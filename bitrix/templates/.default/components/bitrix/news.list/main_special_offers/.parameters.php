<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$arTemplateParameters = array(
	"DISPLAY_IMG_WIDTH" => array(
		"NAME" => GetMessage("T_IBLOCK_DESC_IMG_WIDTH"),
		"TYPE" => "TEXT",
		"DEFAULT" => "59",
	),
	"DISPLAY_IMG_HEIGHT" => array(
		"NAME" => GetMessage("T_IBLOCK_DESC_IMG_HEIGHT"),
		"TYPE" => "TEXT",
		"DEFAULT" => "59",
	),
	"DISPLAY_DETAIL_IMG_WIDTH" => Array(
		"NAME" => GetMessage("T_IBLOCK_DESC_DETAIL_IMG_WIDTH"),
		"TYPE" => "TEXT",
		"DEFAULT" => "350",
	),
	"DISPLAY_DETAIL_IMG_HEIGHT" => Array(
		"NAME" => GetMessage("T_IBLOCK_DESC_DETAIL_IMG_HEIGHT"),
		"TYPE" => "TEXT",
		"DEFAULT" => "1000",
	),
	"SHARPEN" => Array(
		"NAME" => GetMessage("T_IBLOCK_DESC_SHARPEN"),
		"TYPE" => "TEXT",
		"DEFAULT" => "30",
	),
);

?>