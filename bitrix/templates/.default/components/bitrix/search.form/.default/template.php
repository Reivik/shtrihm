<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="search">
<form action="<?=$arResult["FORM_ACTION"]?>">
	<?if($arParams["USE_SUGGEST"] === "Y"):?>
	<?$APPLICATION->IncludeComponent(
			"bitrix:search.suggest.input",
			"",
			array(
				"NAME" => "q",
				"VALUE" => "",
				"INPUT_SIZE" => 15,
				"DROPDOWN_SIZE" => 10,
				
			),
			$component, array("HIDE_ICONS" => "Y")
		);?>
	<?else:?>
		<input type="text" name="q" value="" class="inputText FAQ_Search_input" placeholder="Поиск"/>
	<?endif;?>
	<button type="submit" name="s" class="btn"><i></i> Найти</button>
</form>
</div>