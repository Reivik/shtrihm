<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if ($_GET["success"]=="Y"):?>
	<a name="thank"></a>
	<div class="messCheck"><h2><?=GetMessage("SUCCESS_FORM", Array ("#WORK_POSITION#" => $arResult["NAME"]))?></h2></div>
<?endif?>
<?if(!empty($arResult["PROPERTIES"]["responsibility"]["~VALUE"]["TEXT"])):?>
	<h3><?=$arResult["PROPERTIES"]["responsibility"]["NAME"]?>:</h3>
	<div class="vacancy"><?=$arResult["PROPERTIES"]["responsibility"]["~VALUE"]["TEXT"]?></div>
<?endif;?>
<?if($arResult["PROPERTIES"]["requirements"]["~VALUE"]["TEXT"]):?>
	<h3><?=$arResult["PROPERTIES"]["requirements"]["NAME"]?>:</h3>
	<div class="vacancy"><?=$arResult["PROPERTIES"]["requirements"]["~VALUE"]["TEXT"]?></div>
<?endif;?>
<?if($arResult["PROPERTIES"]["conditions"]["~VALUE"]["TEXT"]):?>
	<h3><?=$arResult["PROPERTIES"]["conditions"]["NAME"]?>:</h3>
	<div class="vacancy"><?=$arResult["PROPERTIES"]["conditions"]["~VALUE"]["TEXT"]?></div>
<?endif;?>
<?/*<p>
	<b class="b_email"><?=$arResult["PROPERTIES"]["EMAIL"]["NAME"]?>:</b>
	<a href="mailto:<?=$arResult['PROPERTIES']['EMAIL']['VALUE']?>" title="Написать письмо" ><?=$arResult['PROPERTIES']['EMAIL']['VALUE']?></a>
</p>*/?>

<div id="form_vac" title="<?=GetMessage("RESPOND_VACANCY");?>" style="display: none">
<!--
form.rquest.vacancy
form.result.new
-->
	<?$APPLICATION->IncludeComponent("areal:form.rquest.vacancy", ".default", array(
	"WEB_FORM_ID" => "4",
	"IGNORE_CUSTOM_TEMPLATE" => "N",
	"USE_EXTENDED_ERRORS" => "N",
	"SEF_MODE" => "N",
	"SEF_FOLDER" => "/about/vacancy/administrator-servisnogo-tsentra/",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "3600",
	"LIST_URL" => "result_list.php",
	"EDIT_URL" => "result_edit.php",
	"SUCCESS_URL" => "",
	"CHAIN_ITEM_TEXT" => "",
	"CHAIN_ITEM_LINK" => "",
	"EMAIL_MANAGER" => $arResult["PROPERTIES"]["EMAIL"]["VALUE"],
	"VACANCY" => $arResult["ID"],
	"VARIABLE_ALIASES" => array(
		"WEB_FORM_ID" => "WEB_FORM_ID",
		"RESULT_ID" => "RESULT_ID",
	)
	),
	false
);?>
	<?/* $APPLICATION->IncludeComponent("areal:form.result.new","",Array(
			"SEF_MODE" => "Y", 
			"WEB_FORM_ID" => "4", 
			"LIST_URL" => "index.php", 
			"EDIT_URL" => "result_edit.php", 
			"SUCCESS_URL" => "resume_success.php", 
			"CHAIN_ITEM_TEXT" => "", 
			"CHAIN_ITEM_LINK" => "", 
			"IGNORE_CUSTOM_TEMPLATE" => "Y", 
			"USE_EXTENDED_ERRORS" => "Y", 
			"CACHE_TYPE" => "A", 
			"CACHE_TIME" => "3600", 
			"SEF_FOLDER" => "/", 
			"EMAIL_MANAGER" =>$arResult['PROPERTIES']['EMAIL']['VALUE'],
			"VACANCY"=>$arResult["NAME"],
			"VARIABLE_ALIASES" => Array(
			),
			 
		)
	); */?>
</div>
<?if ($_GET["success"]!="Y"):?>
	<button href="#form_text_16" id="respond" name="changeCompany"><?=GetMessage("RESPOND");?></button>
<?endif?>
