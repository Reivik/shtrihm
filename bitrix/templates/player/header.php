<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
IncludeTemplateLangFile(__FILE__);
?>
<!DOCTYPE html>
<html xml:lang="<?=LANGUAGE_ID?>" lang="<?=LANGUAGE_ID?>">
	<head>
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-PPGKCZD');</script>
<!-- End Google Tag Manager -->
		<?$APPLICATION->ShowHead();?>
		<title><?$APPLICATION->ShowTitle()?></title>
		<?
		$APPLICATION->AddHeadString('<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />');
		$APPLICATION->AddHeadString('<link rel="icon" href="/favicon.ico" type="image/x-icon" />');
		$APPLICATION->AddHeadString('<link rel="stylesheet" href="/design/fonts/fonts.css" type="text/css" />');
		$APPLICATION->AddHeadString('<link rel="stylesheet" href="/design/css/style.css" type="text/css" />');
		$APPLICATION->AddHeadString('<link rel="stylesheet" href="/design/css/mirgorodskaja.css" type="text/css" />');
		$APPLICATION->AddHeadString('<link rel="stylesheet" href="/design/css/print.css" type="text/css" />');
		?>
	</head>
	<body>	
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PPGKCZD"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
		<?$APPLICATION->ShowPanel();?>