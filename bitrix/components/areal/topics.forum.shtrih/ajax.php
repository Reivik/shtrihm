<?
define("NO_KEEP_STATISTIC", true);
define("NO_AGENT_STATISTIC", true);
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
include_once("function.php");

if((int)$_REQUEST["lastPostDate"])
{
	$xml = simplexml_load_file($_SERVER["DOCUMENT_ROOT"].'/bitrix/php_interface/cron/xml.xml');
	$isUpdate = false;
	if($xml)
	{
		foreach($xml as $num=>$topic)
		{
			if($_REQUEST["lastPostDate"] < $topic->DateLastPost && !$isUpdate)
				$isUpdate = true;
				
			if($isUpdate)
			{
				$arResult["ITEMS"][] = array(
					"TITLE" => crop_str((string)$topic->TitleTopic),
					"LINK" => (string)$topic->LinkTopic,
				);
				
				if(!$arResult["LAST_DATE"])
					$arResult["LAST_DATE"] = (string)$topic->DateLastPost;
			}
			else break;
		}
	}
	
	if($arResult["ITEMS"])
	{
		$arResult["ITEMS"] = array_reverse($arResult["ITEMS"]);
		echo json_encode($arResult);
	}
	else
		echo json_encode(false);
}
?>