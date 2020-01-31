<?
function pr($v, $show = true)
{
	if($show)
		echo "<xmp>";
	else
		echo "<xmp style='display:none;'>";
	print_r($v);
	echo "</xmp>";
}

function date_convert($date, $strong = true, $tolower = false)
{
	$arDate = explode(".",$date);
	$str = "";
	if(count($arDate) == 3)
	{
		if(checkdate($arDate[1],$arDate[0],$arDate[2]))
		{
			if($strong)
				$str .= "<strong>".$arDate[0]." ";
			else
				$str .= $arDate[0]." ";
				
			switch($arDate[1])
			{
				case "01": $str .= "ЯНВАРЯ"; break;
				case "02": $str .= "ФЕВРАЛЯ"; break;
				case "03": $str .= "МАРТА"; break;
				case "04": $str .= "АПРЕЛЯ"; break;
				case "05": $str .= "МАЯ"; break;
				case "06": $str .= "ИЮНЯ"; break;
				case "07": $str .= "ИЮЛЯ"; break;
				case "08": $str .= "АВГУСТА"; break;
				case "09": $str .= "СЕНТЯБРЯ"; break;
				case "10": $str .= "ОКТЯБРЯ"; break;
				case "11": $str .= "НОЯБРЯ"; break;
				case "12": $str .= "ДЕКАБРЯ"; break;
			}
			if($strong)
				$str .= ",</strong> ".$arDate[2];
			else
				$str .= ", ".$arDate[2];
			
			if($tolower)
				$str = mb_strtolower($str);
			
			return $str;
		}
	}
	return $date;
}
?>