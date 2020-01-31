<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
IncludeTemplateLangFile(__FILE__);
?>
<!DOCTYPE html>
<html xml:lang="<?=LANGUAGE_ID?>" lang="<?=LANGUAGE_ID?>">
<head>
	<meta name = "format-detection" content = "telephone=no">
	<!--[if lt IE 9]>
		<script src="/design/js/html5.js" type="text/javascript"></script>
	<![endif]-->
	<?$APPLICATION->ShowHead();?>
	<title><?$APPLICATION->ShowTitle()?></title>
	<?
	$APPLICATION->AddHeadString('<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />');
	$APPLICATION->AddHeadString('<link rel="icon" href="/favicon.ico" type="image/x-icon" />');


	$APPLICATION->AddHeadString('<link rel="stylesheet" href="/design/css/style.css?var='.time().'" type="text/css" />');
	$APPLICATION->AddHeadString('<link rel="stylesheet" href="/design/css/fonts.css?var='.time().'" type="text/css" />');
	$APPLICATION->AddHeadString('<link rel="stylesheet" href="/design/css/jquery.fancybox-1.3.4.css" type="text/css" />');
	$APPLICATION->AddHeadString('<link rel="stylesheet" href="/design/css/jquery.selectbox.css" type="text/css" />');
	$APPLICATION->AddHeadString('<link rel="stylesheet" href="/design/css/yn.css?var='.time().'" type="text/css" />');
	$APPLICATION->AddHeadString('<link rel="stylesheet" href="/design/css/ap.css?var='.time().'" type="text/css" />');
	$APPLICATION->AddHeadString('<link rel="stylesheet" href="/design/css/mirgorodskaja.css?var='.time().'" type="text/css" />');
	$APPLICATION->AddHeadString('<link rel="stylesheet" href="/bitrix/templates/2018/style.css?var='.time().'" type="text/css" />');
	


	$APPLICATION->AddHeadScript('/design/js/jquery-1.7.2.min.js');
	$APPLICATION->AddHeadScript('/design/js/load.js');
	$APPLICATION->AddHeadScript('/design/js/jquery.selectbox-0.2.js');
	$APPLICATION->AddHeadScript('/design/js/jquery-ui-1.10.2.custom.js');
	$APPLICATION->AddHeadScript('/design/js/jquery.placeholder.js');
	$APPLICATION->AddHeadScript('/design/js/jQuery.BlackAndWhite.min.js');
	$APPLICATION->AddHeadScript('/design/js/jquery.fancybox-1.3.4.js');
	$APPLICATION->AddHeadScript('/design/js/jcarousellite.js');
	$APPLICATION->AddHeadScript('/design/js/jquery.cycle.all.js');
	$APPLICATION->AddHeadScript('/design/js/jquery.maskedinput-1.3.js');
	$APPLICATION->AddHeadScript('/design/js/jquery.flsgallery.js');
	$APPLICATION->AddHeadScript('/share42/share42.js');
	$APPLICATION->AddHeadScript('/design/js/ar.js');
	$APPLICATION->AddHeadScript('/design/js/ap.js');
	$APPLICATION->AddHeadScript('/design/js/mirgorodskaja.js');
	$APPLICATION->AddHeadScript('/design/js/fx.js');
	$APPLICATION->AddHeadScript('/bitrix/templates/2018/script.js');

	CModule::IncludeModule('iblock');
	
	$Webinar = array();
	
	$arFilter = Array("IBLOCK_ID"=>68, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
	$temp = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>50), $arSelect);
	while ($arItem = $temp->Fetch())
	{
		$temp_property = CIBlockElement::GetProperty($arItem['IBLOCK_ID'], $arItem['ID'], array("sort"=>"asc"), array());
		while($ar_props = $temp_property->Fetch())
		 
		$arItem['test'][] = $ar_props;
		$Webinar[] = $arItem;
	}	
 
	foreach($Webinar as $key => $value):
		$file = CFile::ResizeImageGet ($value['test'][3]['VALUE'], array('width'=>138, 'height'=>138), BX_RESIZE_IMAGE_EXACT, true);
		$Webinar[$key]['test'][3] = $file['src'];
	endforeach;
	
	if( $curl = curl_init() ) {
		$out;
		$data = array(
		'key'      => $Webinar[0]['test'][0]['VALUE'],
		'event_id' => $Webinar[0]['test'][1]['VALUE']
	); 
   $ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "http://my.webinar.ru/api0/GetStatus.php");
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
	$out = curl_exec($ch);
	curl_close($ch);
  }
  
  $simple = $out;
	$p = xml_parser_create();
	xml_parse_into_struct($p, $simple, $vals, $index);
	xml_parser_free($p);	
	?>
	<!--[if IE]><link href="/design/css/ie.css" rel="stylesheet" type="text/css" /><![endif]-->
	<!--[if lt IE 9]><link href= "/design/css/ie78.css" rel= "stylesheet" media= "all" /><![endif]-->
	<!--[if lt IE 8]><link href= "/design/css/ie7.css" rel= "stylesheet" media= "all" /><![endif]-->
</head>
<body>
	<!-- Rating@Mail.ru counter -->
	<script type="text/javascript">//<![CDATA[
	var _tmr = _tmr || [];
	_tmr.push({id: '749068', type: 'pageView', start: (new Date()).getTime()});
	(function (d, w) {
	   var ts = d.createElement('script'); ts.type = 'text/javascript'; ts.async = true;
	   ts.src = (d.location.protocol == 'https:' ? 'https:' : 'http:') + '//top-fwz1.mail.ru/js/code.js';
	   var f = function () {var s = d.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ts, s);};
	   if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); }
	})(document, window);
	//]]></script><noscript><div style="position:absolute;left:-10000px;">
	<img src="//top-fwz1.mail.ru/counter?id=749068;js=na" style="border:0;" height="1" width="1" alt="Рейтинг@Mail.ru" />
	</div></noscript>
	<!-- //Rating@Mail.ru counter -->

	<?$path = explode("/",$_SERVER["REQUEST_URI"]);?>
	<?DefineRegionsArray();?>
	<?//DefineTownsArray();?>	
	<div id="panel"><?$APPLICATION->ShowPanel();?></div>	
		<div id ="page" style="visibility: hidden;">
					<div id="rad-x">
				<div class="heder_left">
					<a href="http://shtrih-m.ru"><img id="logo_shtrih" src="/design/images/logo_and_pone.png" alt=""></a>
				</div>
				<div class="heder_center">
					<a href="#novosti" id="novosti_link" class="main_link">Новости</a>
					<a href="#sroki" id="sroki_link" class="main_link">Сроки</a>
					<a href="#zakoni" id="zakoni_link" class="main_link">Законы и нормы</a>
					<a href="#resheniya" id="resheniya_link" class="main_link">Решения</a>
					<a href="#forum" id="forumi_link" class="main_link">Форум</a>
					<a href="#cto" id="cto_link" class="main_link">ЦТО</a>
					<img id="logo_2018" src="/design/images/menu_bg.png" alt="">
				</div>
				<div class="heder_right">
					<?$APPLICATION->IncludeComponent("bitrix:main.include","",Array(
						"AREA_FILE_SHOW" => "file", 
						"PATH" => SITE_DIR."include/myChannel-2018.php"
						)
					);?>
					<div class="heder_right_down">
						<img id="online" src="<?=$Webinar[0]['test'][3]?>" alt="">
						<p class="online">Онлайн конференция по тематике</p>
						<span id="<?if($vals[0]['attributes']['STAGE']!= 'START'):?>online_play_no<?else:?>online_play<?endif?>"  class="play"></span>
						<a id="zapis" href="#q">Записаться на вебинар</a>
					</div>
				</div>
				<div class="clear"></div>
				<!--<img src="menu_bg.png">-->				
			</div>