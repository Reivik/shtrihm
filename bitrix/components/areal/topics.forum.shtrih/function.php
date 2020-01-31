<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

function crop_str($string, $limit = 100)
{
	if(mb_strlen($string, "UTF-8") > $limit)
	{
		$substring_limited = mb_substr($string, 0, $limit, "UTF-8");
		$string = mb_substr($substring_limited, 0, mb_strrpos($substring_limited, ' ', "UTF-8" ), "UTF-8")."...";
	}
	return $string;
}
?>