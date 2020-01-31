<?
	ini_set('date.timezone', 'Europe/Moscow'); 
	$_SERVER["DOCUMENT_ROOT"] = "/home/bitrix/www";
	$hour = date("H");
	$day = date("D");
	if(PHP_SAPI == 'cli' && (($hour >= 18 && $hour <=24) || $day == "Sat" || $day=="Sun"))
		exit();
	
	$str1 = file_get_contents("http://forum.shtrih-m.ru/xml_script.php");
	$str1 = iconv("cp1251", "UTF-8", $str1);
	$str2 = file_get_contents("http://forum.shtrih-m.ru/xml_script_f.php?f=18");
	$str2 = iconv("cp1251", "UTF-8", $str2);
	$str3 = file_get_contents("http://forum.shtrih-m.ru/xml_script_f.php?f=17");
	$str3 = iconv("cp1251", "UTF-8", $str3);
	
	if(strlen($str1) > 5)
	{
		$fp = fopen($_SERVER["DOCUMENT_ROOT"]."/bitrix/php_interface/cron/xml.xml", "wb");
		fwrite($fp, $str1);
		fclose($fp);
	}
	if(strlen($str2) > 5)
	{
		$fp1 = fopen($_SERVER["DOCUMENT_ROOT"]."/bitrix/php_interface/cron/xml1.xml", "wb");
		fwrite($fp1, $str2);
		fclose($fp1);
	}
	if(strlen($str3) > 5)
	{
		$fp2 = fopen($_SERVER["DOCUMENT_ROOT"]."/bitrix/php_interface/cron/xml2.xml", "wb");
		fwrite($fp2, $str3);
		fclose($fp2);
	}
?>