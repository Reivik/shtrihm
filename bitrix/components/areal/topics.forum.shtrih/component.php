<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
include_once("function.php");
$xml = simplexml_load_file($_SERVER["DOCUMENT_ROOT"].'/bitrix/php_interface/cron/xml.xml');
$xml1 = simplexml_load_file($_SERVER["DOCUMENT_ROOT"].'/bitrix/php_interface/cron/xml2.xml');
$xml2 = simplexml_load_file($_SERVER["DOCUMENT_ROOT"].'/bitrix/php_interface/cron/xml1.xml');

if($xml)
{
	foreach($xml as $num=>$topic)
	{
		$arResult["ITEMS"][] = array(
			"TITLE" => crop_str((string)$topic->TitleTopic),
			"LINK" => (string)$topic->LinkTopic,
		);
		
		if(!$arResult["LAST_DATE"])
			$arResult["LAST_DATE"] = (string)$topic->DateLastPost;
	}
}

if($xml1)
{
	foreach($xml1 as $num=>$forum)
	{
		if(isset($forum->TitleForum)){
			$arResult["ITEMS"]["2018"]["LEFT"]["FORUM"][] = array(
				"FORUM_ID" => crop_str((string)$forum->IdForum),
				"FORUM_NAME" => (string)$forum->TitleForum,
				"LINK" => (string)$forum->LinkForum
			);
		}
		else{
			continue;
		}
	}
	foreach($xml1 as $num=>$forum)
	{
		if(isset($forum->TitleTopic)){
			$arResult["ITEMS"]["2018"]["LEFT"]["TITLE"][] = array(
				"FORUM_ID" => crop_str((string)$forum->IdForum),
				"TITLE_NAME" => (string)$forum->TitleTopic,
				"LINK" => (string)$forum->LinkTopic
			);
		}
		else{
			continue;
		}
	}
		/*if(!$arResult["LAST_DATE"])
			$arResult["LAST_DATE"] = (string)$topic->DateLastPost;*/
}

if($xml2)
{
	foreach($xml2 as $num=>$forum)
	{
		if(isset($forum->TitleForum)){
			$arResult["ITEMS"]["2018"]["RIGHT"]["FORUM"][] = array(
				"FORUM_ID" => crop_str((string)$forum->IdForum),
				"FORUM_NAME" => (string)$forum->TitleForum,
				"LINK" => (string)$forum->LinkForum
			);
		}
		else{
			continue;
		}
	}
	foreach($xml2 as $num=>$forum)
	{
		if(isset($forum->TitleTopic)){
			$arResult["ITEMS"]["2018"]["RIGHT"]["TITLE"][] = array(
				"FORUM_ID" => crop_str((string)$forum->IdForum),
				"TITLE_NAME" => (string)$forum->TitleTopic,
				"LINK" => (string)$forum->LinkTopic
			);
		}
		else{
			continue;
		}
	}
		/*if(!$arResult["LAST_DATE"])
			$arResult["LAST_DATE"] = (string)$topic->DateLastPost;*/
}
$this->IncludeComponentTemplate();
?>