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
			<header>				
				<div class="headTop">
					<?$APPLICATION->IncludeComponent("bitrix:news.list","main_head_slider",Array(
						"DISPLAY_DATE" => "N",
						"DISPLAY_NAME" => "Y",
						"DISPLAY_PICTURE" => "Y",
						"DISPLAY_PREVIEW_TEXT" => "N",
						"AJAX_MODE" => "N",
						"IBLOCK_TYPE" => "about",
						"IBLOCK_ID" => IB_SITES,
						"NEWS_COUNT" => "",
						"SORT_BY1" => "SORT",
						"SORT_ORDER1" => "ASC",
						"SORT_BY2" => "ACTIVE_FROM",
						"SORT_ORDER2" => "ASC",
						"FILTER_NAME" => "arrFilter",
						"FIELD_CODE" => Array(),
						"PROPERTY_CODE" => Array("LINK"),
						"CHECK_DATES" => "N",
						"DETAIL_URL" => "",
						"PREVIEW_TRUNCATE_LEN" => "",
						"ACTIVE_DATE_FORMAT" => "d.m.Y",
						"SET_TITLE" => "N",
						"SET_STATUS_404" => "Y",
						"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
						"ADD_SECTIONS_CHAIN" => "N",
						"HIDE_LINK_WHEN_NO_DETAIL" => "Y",
						"PARENT_SECTION" => "",
						"PARENT_SECTION_CODE" => "",
						"CACHE_TYPE" => "A",
						"CACHE_TIME" => "3600",
						"CACHE_FILTER" => "Y",
						"CACHE_GROUPS" => "Y",
						"DISPLAY_TOP_PAGER" => "N",
						"DISPLAY_BOTTOM_PAGER" => "N",
						"PAGER_TITLE" => "",
						"PAGER_SHOW_ALWAYS" => "N",
						"PAGER_TEMPLATE" => "",
						"PAGER_DESC_NUMBERING" => "N",
						"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
						"PAGER_SHOW_ALL" => "N",
						"AJAX_OPTION_JUMP" => "N",
						"AJAX_OPTION_STYLE" => "Y",
						"AJAX_OPTION_HISTORY" => "N",
						"AJAX_OPTION_ADDITIONAL" => ""
					));?>
					<div class="lang"><a href="" class="eng"><img src="/images/eng.png" alt=""/>Eng</a></div>
				</div>				
				<div class="headBott">
					<div class="logo"><a href="/"><?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/company_logo.php"), false);?></a></div>
					<div class="headBottRight"> 
						<div class="phone"><strong><?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/telephone.php"), false);?></strong></div>
						<ul class="menu">

							<?if($USER->IsAuthorized()):?>
								<?if(in_array(UG_AKP, CUser::GetUserGroup($USER->GetID()))):?>
									<li><a href="/personal/">Администрирование партнеров</a></li>
								<?elseif(in_array(UG_PP, CUser::GetUserGroup($USER->GetID())) || in_array(UG_PO, CUser::GetUserGroup($USER->GetID())) || in_array(UG_YC, CUser::GetUserGroup($USER->GetID())) || in_array(UG_TP, CUser::GetUserGroup($USER->GetID()))):?>
								<?
									CModule::IncludeModule("iblock");
									$rsUsers = CUser::GetList(($by="id"), ($order="desc"), array("ID" => $USER->GetID()), array("SELECT" => array("UF_*")));
									$arUsers = $rsUsers->GetNext();
									$company = $arUsers["UF_COMPANY"];
									$res = CIBlockElement::GetList(array(), array("IBLOCK_ID" => IB_COMPANY, "ID" => $company), false, false, array("ID", "NAME"));
									if($element = $res->GetNext()) {
										$company_name = $element["NAME"];
									}
								?>
									<li><a href="/personal/company/">Корпоративный кабинет: <?=$company_name?></a></li>
								<?elseif(in_array(UG_VEBINAR_CREATOR, CUser::GetUserGroup($USER->GetID()))):?>
									<li><a href="/partners_info/learning/webinars/create/">Создание вебинара</a></li>
								<?elseif(in_array(UG_ONLINE_CONSULT, CUser::GetUserGroup($USER->GetID()))):?>
									<?$APPLICATION->IncludeComponent("areal:online.link", ".default");?>									
								<?endif;?>
								<li><a href="?logout=yes">Выйти</a></li>
							<?else:?>
								<li><a href="?login=yes">Авторизация</a></li>
								<li><a href="/registration/">Регистрация</a></li>
							<?endif;?>

							<?$APPLICATION->IncludeComponent("areal:location", "");?>
						</ul>
						<?if(in_array($_SERVER['SCRIPT_NAME'], array('/partners_info/partners/index.php', '/partners_info/events/index.php', '/introduction/index.php')) && !$_SESSION['CLOSE_SITY_WINDOW']):?>
							<?if(isset($_SESSION['SHTRIH_TOWN']) || isset($_SESSION['SHTRIH_REGION']))?>
							<div class='cityNotyfyWindow'>
								<div class='title'>Ваш город</div>
								<div class='contentBlock'>
									<?=($_SESSION['SHTRIH_TOWN']!='')?$_SESSION['SHTRIH_TOWN']:$_SESSION['SHTRIH_REGION']?>
									<div class='closeCityWindow'><a href='javascript:void(0)' class='closeNotify'>Закрыть</a></div>
									<div class="clear"></div>
								</div>
							</div>
						<?endif;?>
						<?$APPLICATION->IncludeComponent("bitrix:menu", "top", array(
							"ROOT_MENU_TYPE" => "top",
							"MENU_CACHE_TYPE" => "A",
							"MENU_CACHE_TIME" => "36000000",
							"MENU_CACHE_USE_GROUPS" => "Y",
							"MENU_CACHE_GET_VARS" => array(
							),
							"MAX_LEVEL" => "4",
							"CHILD_MENU_TYPE" => "left",
							"USE_EXT" => "Y",
							"DELAY" => "N",
							"ALLOW_MULTI_SELECT" => "N"
							),
							false
						);?>
						<div class="clear"></div>  
					</div>
					<div class="clear"></div>
				</div>				
			</header>	
			<section class="content">
				<?if($_GET["login"] == "yes" && !$USER->IsAuthorized() && $path[1] != "forum"):?>
					<?$APPLICATION->IncludeComponent(
						"bitrix:system.auth.form",
						"",
						Array(
							"REGISTER_URL" => "/partners_info/registration/",
							"FORGOT_PASSWORD_URL" => "/login/",
							"PROFILE_URL" => "/personal/",
							"SHOW_ERRORS" => "Y"
						),
						false
					);?>
				<?endif;?>
				<?if($USER->IsAuthorized() && $path[1] == 'personal' && in_array(UG_AKP, CUser::GetUserGroup($USER->GetID()))):?>	
					<?$APPLICATION->IncludeComponent("areal:admin_filter_partner", ".default");?>
				<?endif;?>
				<?if($path[1] == "catalog" && strpos($path[2], "compare.php") === false):?>
					<div class="leftCol">
					<?$APPLICATION->IncludeComponent("bitrix:main.include", ".default", array("AREA_FILE_SHOW" => "sect", "AREA_FILE_SUFFIX" => "filter", "AREA_FILE_RECURSIVE" => "Y", "EDIT_TEMPLATE" => ""), false);?>
				<?endif;?>
				<?ShowLeftMenu();?>
				<?if($_SERVER["REQUEST_URI"] != "/" && $_SERVER["SCRIPT_NAME"] != "/index.php"):?>
					<div class="pageTitle">
						<h1><?$APPLICATION->ShowTitle();?></h1>
					</div>				
					<div class="pagesNav">
						<?
						$APPLICATION->IncludeComponent("bitrix:breadcrumb", ".default", array(
							"START_FROM" => "",
							"PATH" => "",
							"SITE_ID" => SITE_ID
							),
							false,
							Array('HIDE_ICONS' => 'Y')
						);
						?>
					</div>
				<?endif;?>
				<div class="pageCont">
				<?ShowBanners();?>