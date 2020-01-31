<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<?

$arFromDate=array();
$arToDate=array();
if($arParams['INPUT_VALUE']!="")
{
	$arFromDate=explode(".",$arParams['INPUT_VALUE']);
	$arResult['START_DAY']=$arFromDate[0];
	$arResult['START_MONTH']=$arFromDate[1];
	$arResult['START_YEAR']=$arFromDate[2];
}
if($arParams['INPUT_VALUE_FINISH']!="")
{
	$arToDate=explode(".",$arParams['INPUT_VALUE_FINISH']);
	$arResult['FINISH_DAY']=$arToDate[0];
	$arResult['FINISH_MONTH']=$arToDate[1];
	$arResult['FINISH_YEAR']=$arToDate[2];
}

$arResult["MONTH"] = array(
	"01" => "январь",
	"02" => "февраль",
	"03" => "март",
	"04" => "апрель",
	"05" => "май",
	"06" => "июнь",
	"07" => "июль",
	"08" => "август",
	"09" => "сентябрь",
	"10" => "октябрь",
	"11" => "ноябрь",
	"12" => "декабрь"
);

$this->IncludeComponentTemplate();
?>
