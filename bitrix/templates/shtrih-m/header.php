<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
IncludeTemplateLangFile(__FILE__);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?=LANGUAGE_ID?>" lang="<?=LANGUAGE_ID?>">
<head>
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-PPGKCZD');</script>
<!-- End Google Tag Manager -->	
        <!--[if lt IE 9]>
		<script src="/design/js/html5.js" type="text/javascript"></script>
	<![endif]-->
	<?$APPLICATION->ShowHead();?>
	<title><?$APPLICATION->ShowTitle()?></title>
	<?
	$APPLICATION->AddHeadString('<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />');
	$APPLICATION->AddHeadString('<link rel="icon" href="/favicon.ico" type="image/x-icon" />');
	$APPLICATION->AddHeadString('<link rel="stylesheet" href="/design/css/jquery.countdown.css" type="text/css" />');
	$APPLICATION->AddHeadString('<link rel="stylesheet" href="/design/css/style.css?88" type="text/css" />');
	$APPLICATION->AddHeadString('<link rel="stylesheet" href="/design/css/fonts.css" type="text/css" />');
	$APPLICATION->AddHeadString('<link rel="stylesheet" href="/design/css/jquery.fancybox-1.3.4.css" type="text/css" />');
	$APPLICATION->AddHeadString('<link rel="stylesheet" href="/design/css/jquery.selectbox.css" type="text/css" />');
	$APPLICATION->AddHeadString('<link rel="stylesheet" href="/design/css/yn.css?2" type="text/css" />');
	$APPLICATION->AddHeadString('<link rel="stylesheet" href="/design/css/ap.css?1" type="text/css" />');
	$APPLICATION->AddHeadString('<link rel="stylesheet" href="/design/css/mirgorodskaja.css?534" type="text/css" />');
	$APPLICATION->AddHeadString('<link rel="stylesheet" href="/design/sp/dist/css/slider-pro.min.css" type="text/css" />');

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
	$APPLICATION->AddHeadScript('/design/js/mirgorodskaja.js?7');
	$APPLICATION->AddHeadScript('/design/js/fx.js');
	$APPLICATION->AddHeadScript('/design/sp/dist/js/jquery.sliderPro.min.js');
	$APPLICATION->AddHeadScript('https://use.fontawesome.com/8b0b8ad3e0.js');
	$APPLICATION->AddHeadScript('/design/js/jquery.plugin.js');
	$APPLICATION->AddHeadScript('/design/js/jquery.countdown.js');
	$APPLICATION->AddHeadScript('/design/js/jquery.countdown-ru.js');
	if (CSite::InDir('/catalog/') || CSite::InDir('/partners_info/rt-online/')) {
	$APPLICATION->AddHeadScript('/design/js/region_array.js');
	$APPLICATION->AddHeadScript('/design/js/city_array.js');
	$APPLICATION->AddHeadScript('/design/js/form.js');
	}
	?>
	<!--[if IE]><link href="/design/css/ie.css" rel="stylesheet" type="text/css" /><![endif]-->
	<!--[if lt IE 9]><link href= "/design/css/ie78.css" rel= "stylesheet" media= "all" /><![endif]-->
	<!--[if lt IE 8]><link href= "/design/css/ie7.css" rel= "stylesheet" media= "all" /><![endif]-->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>

	<?//$APPLICATION->ShowPanel();?>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PPGKCZD"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
	<?if (CSite::InDir('/catalog/')):?>
<div id="modal">
	<div class="overflow_modal">
		<div class="modal_page">
			<div class="close_button" onclick="CloseForm();"><i class="fa fa-times"></i></div>
			
 <?$APPLICATION->IncludeComponent("bitrix:form", "new_web_form", array(
	"START_PAGE" => "new",
	"SHOW_LIST_PAGE" => "N",
	"SHOW_EDIT_PAGE" => "N",
	"SHOW_VIEW_PAGE" => "Y",
	"SUCCESS_URL" => "/catalog/online-till/ready.php",
	"WEB_FORM_ID" => "7",
	"RESULT_ID" => $_REQUEST[RESULT_ID],
	"SHOW_ANSWER_VALUE" => "N",
	"SHOW_ADDITIONAL" => "N",
	"SHOW_STATUS" => "N",
	"EDIT_ADDITIONAL" => "N",
	"EDIT_STATUS" => "N",
	"NOT_SHOW_FILTER" => array(
		0 => "",
		1 => "",
	),
	"NOT_SHOW_TABLE" => array(
		0 => "",
		1 => "",
	),
	"IGNORE_CUSTOM_TEMPLATE" => "N",
	"USE_EXTENDED_ERRORS" => "N",
	"SEF_MODE" => "N",
	"SEF_FOLDER" => "/catalog/online-till/",
	"AJAX_MODE" => "N",
	"AJAX_OPTION_JUMP" => "N",
	"AJAX_OPTION_STYLE" => "Y",
	"AJAX_OPTION_HISTORY" => "N",
	"CACHE_TYPE" => "N",
	"CACHE_TIME" => "3600",
	"CHAIN_ITEM_TEXT" => "",
	"CHAIN_ITEM_LINK" => "",
	"AJAX_OPTION_ADDITIONAL" => "",
	"VARIABLE_ALIASES" => array(
		"action" => "action",
	)
	),
	false
);?>
		</div>
	</div>
</div>
<div id="modal_new">
	<div class="overflow_modal">
		<div class="modal_page">
			<div class="close_button" onclick="CloseFormNew();"><i class="fa fa-times"></i></div>
				 <?$APPLICATION->IncludeComponent("bitrix:form", "new_web_form_new", array( ///home/bitrix/www/bitrix/templates/shtrih-m/components/bitrix/form/new_web_form_new
					"START_PAGE" => "new",
					"SHOW_LIST_PAGE" => "N",
					"SHOW_EDIT_PAGE" => "N",
					"SHOW_VIEW_PAGE" => "Y",
					"SUCCESS_URL" => "/catalog/online-till/ready.php",
					"WEB_FORM_ID" => "16",
					"RESULT_ID" => $_REQUEST[RESULT_ID],
					"SHOW_ANSWER_VALUE" => "N",
					"SHOW_ADDITIONAL" => "N",
					"SHOW_STATUS" => "N",
					"EDIT_ADDITIONAL" => "N",
					"EDIT_STATUS" => "N",
					"NOT_SHOW_FILTER" => array(
						0 => "",
						1 => "",
					),
					"NOT_SHOW_TABLE" => array(
						0 => "",
						1 => "",
					),
					"IGNORE_CUSTOM_TEMPLATE" => "N",
					"USE_EXTENDED_ERRORS" => "N",
					"SEF_MODE" => "N",
					"SEF_FOLDER" => "/catalog/online-till/",
					"AJAX_MODE" => "N",
					"AJAX_OPTION_JUMP" => "N",
					"AJAX_OPTION_STYLE" => "Y",
					"AJAX_OPTION_HISTORY" => "N",
					"CACHE_TYPE" => "N",
					"CACHE_TIME" => "3600",
					"CHAIN_ITEM_TEXT" => "",
					"CHAIN_ITEM_LINK" => "",
					"AJAX_OPTION_ADDITIONAL" => "",
					"VARIABLE_ALIASES" => array(
						"action" => "action",
					)
					),
					false
				);?>
		</div>
	</div>
</div>

<?endif?>
	<?$path = explode("/",$_SERVER["REQUEST_URI"]);?>
	<?DefineRegionsArray();?>
	<?//DefineTownsArray();?>	
	<div id="panel"><?$APPLICATION->ShowPanel();?></div>	
<!-- div id="q_overlay">
	<div class="q_modal">
		<div class="q_close" onclick="CloseQ()">x</div>
			<!-- h2 style="padding:20px;">Ваш вопрос</h2 -->
		<div style="padding:0px;">
			<?/*$APPLICATION->IncludeComponent("bitrix:main.feedback", "qform", array(
	"USE_CAPTCHA" => "Y",
	"OK_TEXT" => "Спасибо, ваше сообщение принято.",
	"EMAIL_TO" => "op@shtrih-m.ru",
	"REQUIRED_FIELDS" => array(
		0 => "NAME",
		1 => "PHONE",
		2 => "CITY",
		3 => "EMAIL",
		4 => "MESSAGE",
	),
	"EVENT_MESSAGE_ID" => array(
	),
	"AJAX_MODE" => "Y",  // режим AJAX
	"AJAX_OPTION_SHADOW" => "N", 
	"AJAX_OPTION_JUMP" => "N", // скроллинг страницы к компоненту
	"AJAX_OPTION_STYLE" => "Y", // подключить стили
	"AJAX_OPTION_HISTORY" => "N",
	),
	false
);*/?></div>
	</div>
</div>

	<div id ="page" style="visibility: hidden;">
			<header>				
				<div class="headBott">
					<div class="logo"><a href="/"><?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/company_logo.php"), false);?></a></div>
					<div class="headBottRight"> 
					<div style="
    float: right;
    margin-right: 240px;
    border: 1px solid #c6c6c6;
    /* padding-top: 10px; */
    /* bottom: 35px; */
    margin-top: 63px;
    margin-bottom: -73px;
    ">	
<?$APPLICATION->IncludeComponent(
						"bitrix:search.form",
						"shtrih-m",
						Array(
							"USE_SUGGEST" => "N",
							"PAGE" => "/search/"
						),
					false
					);?>
	</div>
						
						<div class="phone" style="
    margin-right: 238px;
    width: 448px;
    margin-top: -24px;
"><?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/telephone.php"), false);?></div>
						
						<ul class="menu" style="top: -13px;">

							<?if($USER->IsAuthorized()):?>
								<?if(in_array(UG_AKP, CUser::GetUserGroup($USER->GetID()))):?>
									<li style="float: initial;"><a href="/personal/">Администрирование партнеров</a></li>
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
									<li style="float: initial;"><a href="/personal/company/">Корпоративный кабинет: <?=$company_name?></a></li>
								<?elseif(in_array(UG_VEBINAR_CREATOR, CUser::GetUserGroup($USER->GetID()))):?>
									<li style="float: right;"><a href="/partners_info/learning/webinars/create/">Создание вебинара</a></li>
								<?elseif(in_array(UG_ONLINE_CONSULT, CUser::GetUserGroup($USER->GetID()))):?>
									<?$APPLICATION->IncludeComponent("areal:online.link", ".default");?>									
								<?endif;?>
								<li style="float: right;"><a href="?logout=yes">Выйти</a></li>
							<?else:?>
								<!--<li style="float: initial;"><a href="?login=yes">Авторизация</a></li>
								<li style="float: right;"><a href="/registration/">Регистрация</a></li>-->
							<?endif;?>

							
						</ul>
						<ul class="menu" style="top: 21px;">
						
						<?//Закомментирован компонент, ломал сайт на получении геоданных с http://api.sypexgeo.net/xml/91.146.60.109 ?>
						<?//$APPLICATION->IncludeComponent("areal:location", "");?>
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
							"MENU_CACHE_TYPE" => "N",
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
						);?>				<div class="clear"></div>  
					</div>
					<div class="clear"></div>
				</div>				
				<?if ($APPLICATION->GetCurPage(false) == SITE_DIR) {?>
					<?$APPLICATION->IncludeComponent("bitrix:news.list", "counter", array(
						"IBLOCK_TYPE" => "about",
						"IBLOCK_ID" => "73",
						"NEWS_COUNT" => "1",
						"SORT_BY1" => "ACTIVE_FROM",
						"SORT_ORDER1" => "DESC",
						"SORT_BY2" => "SORT",
						"SORT_ORDER2" => "ASC",
						"FILTER_NAME" => "",
						"FIELD_CODE" => array(
							0 => "",
							1 => "NAME",
							2 => "PREVIEW_TEXT",
							3 => "PREVIEW_PICTURE",
							4 => "DATE_ACTIVE_TO",
							5 => "",
						),
						"PROPERTY_CODE" => array(
							0 => "DATES",
							1 => "LINK",
							2 => "",
							3 => "",
						),
						"CHECK_DATES" => "Y",
						"DETAIL_URL" => "",
						"AJAX_MODE" => "N",
						"AJAX_OPTION_JUMP" => "N",
						"AJAX_OPTION_STYLE" => "Y",
						"AJAX_OPTION_HISTORY" => "N",
						"CACHE_TYPE" => "N",
						"CACHE_TIME" => "36000000",
						"CACHE_FILTER" => "N",
						"CACHE_GROUPS" => "Y",
						"PREVIEW_TRUNCATE_LEN" => "",
						"ACTIVE_DATE_FORMAT" => "d.m.Y",
						"SET_TITLE" => "N",
						"SET_STATUS_404" => "N",
						"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
						"ADD_SECTIONS_CHAIN" => "N",
						"HIDE_LINK_WHEN_NO_DETAIL" => "N",
						"PARENT_SECTION" => "",
						"PARENT_SECTION_CODE" => "",
						"INCLUDE_SUBSECTIONS" => "Y",
						"DISPLAY_TOP_PAGER" => "N",
						"DISPLAY_BOTTOM_PAGER" => "N",
						"PAGER_TITLE" => "Новости",
						"PAGER_SHOW_ALWAYS" => "N",
						"PAGER_TEMPLATE" => "",
						"PAGER_DESC_NUMBERING" => "N",
						"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
						"PAGER_SHOW_ALL" => "N",
						"DISPLAY_DATE" => "N",
						"DISPLAY_NAME" => "N",
						"DISPLAY_PICTURE" => "Y",
						"DISPLAY_PREVIEW_TEXT" => "N",
						"AJAX_OPTION_ADDITIONAL" => ""
						),
						false
					);?>
				<?}?>				
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
				<?


				if($path[1] == "catalog" && strpos($path[2], "compare.php") === false && $APPLICATION->GetCurDir() != "/catalog/online-till/" && $APPLICATION->GetCurPage()!='/catalog/online-till/ready.php'): ?>
					<div class="leftCol">
					<?$APPLICATION->IncludeComponent("bitrix:main.include", ".default", array("AREA_FILE_SHOW" => "sect", "AREA_FILE_SUFFIX" => "filter", "AREA_FILE_RECURSIVE" => "Y", "EDIT_TEMPLATE" => ""), false);?>
				<?endif;?>
				<?


				if($APPLICATION->GetCurPage()!='/catalog/online-till/ready.php'): ?>
					<?ShowLeftMenu();?>
				<?endif;?>

					<?if($_SERVER["REQUEST_URI"] != "/" && $_SERVER["SCRIPT_NAME"] != "/index.php"):?>
						<?if (CSite::InDir('/partner-registration/') || CSite::InDir('/support/webinars/') || $APPLICATION->GetCurDir() == "/catalog/online-till/" || $APPLICATION->GetCurPage()=='/catalog/online-till/ready.php' || CSite::InDir('/partners_info/rt-online/') || CSite::InDir('/elves-mf/')) {?>
					<?}else{?>
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
					<?}?>
				<?endif;?>
				<div class="pageCont">
					<?/*ShowBanners();*/?>					
<? if ($APPLICATION->GetCurPage(false) === '/'): ?> 
<?$APPLICATION->IncludeComponent("bitrix:news.list", "newsilder_new", Array(
	"IBLOCK_TYPE" => "about",	// Тип информационного блока (используется только для проверки)
	"IBLOCK_ID" => "17",	// Код информационного блока
	"NEWS_COUNT" => "15",	// Количество новостей на странице
	"SORT_BY1" => "SORT",	// Поле для первой сортировки новостей
	"SORT_ORDER1" => "DESC",	// Направление для первой сортировки новостей
	"SORT_BY2" => "SORT",	// Поле для второй сортировки новостей
	"SORT_ORDER2" => "ASC",	// Направление для второй сортировки новостей
	"FILTER_NAME" => "",	// Фильтр
	"FIELD_CODE" => array(	// Поля
		0 => "PREVIEW_PICTURE",
		1 => "DETAIL_PICTURE",
		2 => "",
	),
	"PROPERTY_CODE" => array(	// Свойства
		0 => "LINK",
		1 => "PAGE",
		2 => "",
	),
	"CHECK_DATES" => "Y",	// Показывать только активные на данный момент элементы
	"DETAIL_URL" => "",	// URL страницы детального просмотра (по умолчанию - из настроек инфоблока)
	"AJAX_MODE" => "N",	// Включить режим AJAX
	"AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
	"AJAX_OPTION_STYLE" => "Y",	// Включить подгрузку стилей
	"AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
	"CACHE_TYPE" => "N",	// Тип кеширования
	"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
	"CACHE_FILTER" => "N",	// Кешировать при установленном фильтре
	"CACHE_GROUPS" => "Y",	// Учитывать права доступа
	"PREVIEW_TRUNCATE_LEN" => "",	// Максимальная длина анонса для вывода (только для типа текст)
	"ACTIVE_DATE_FORMAT" => "d.m.Y",	// Формат показа даты
	"SET_TITLE" => "N",	// Устанавливать заголовок страницы
	"SET_STATUS_404" => "N",	// Устанавливать статус 404, если не найдены элемент или раздел
	"INCLUDE_IBLOCK_INTO_CHAIN" => "N",	// Включать инфоблок в цепочку навигации
	"ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
	"HIDE_LINK_WHEN_NO_DETAIL" => "N",	// Скрывать ссылку, если нет детального описания
	"PARENT_SECTION" => "",	// ID раздела
	"PARENT_SECTION_CODE" => "",	// Код раздела
	"INCLUDE_SUBSECTIONS" => "Y",	// Показывать элементы подразделов раздела
	"DISPLAY_TOP_PAGER" => "N",	// Выводить над списком
	"DISPLAY_BOTTOM_PAGER" => "Y",	// Выводить под списком
	"PAGER_TITLE" => "Новости",	// Название категорий
	"PAGER_SHOW_ALWAYS" => "Y",	// Выводить всегда
	"PAGER_TEMPLATE" => "",	// Название шаблона
	"PAGER_DESC_NUMBERING" => "N",	// Использовать обратную навигацию
	"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",	// Время кеширования страниц для обратной навигации
	"PAGER_SHOW_ALL" => "Y",	// Показывать ссылку "Все"
	"DISPLAY_DATE" => "Y",	// Выводить дату элемента
	"DISPLAY_NAME" => "Y",	// Выводить название элемента
	"DISPLAY_PICTURE" => "Y",	// Выводить изображение для анонса
	"DISPLAY_PREVIEW_TEXT" => "Y",	// Выводить текст анонса
	"AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
	),
	false
);?>
<?endif;?>