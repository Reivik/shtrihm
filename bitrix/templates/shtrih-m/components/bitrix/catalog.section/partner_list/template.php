<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="catalog-section">
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<p><?=$arResult["NAV_STRING"]?></p>
<?endif?>
<table class="data-table" cellspacing="0" cellpadding="0" border="0" width="100%">
	<thead>
	<tr>
		<td>Организация</td>
		<td>Город</td>
		<td>Контакты</td>
	</tr>
	</thead>

	<?foreach($arResult["ITEMS"] as $arElement):?>
	<?
	$this->AddEditAction($arElement['ID'], $arElement['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arElement['ID'], $arElement['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BCS_ELEMENT_DELETE_CONFIRM')));
	?>
	<tr id="<?=$this->GetEditAreaId($arElement['ID']);?>">
		<td style="max-width: 250px">
			<?=$arElement["NAME"]?>
		</td>

		<td>
			<?=$arElement["DISPLAY_PROPERTIES"]["REG_CITY"]["VALUE"]?>
		</td>

		<td>
			<?=$arElement["DISPLAY_PROPERTIES"]["PHONES"]["VALUE"]?>
			<br/>
			<a href="mailto:<?=$arElement["DISPLAY_PROPERTIES"]["EMAIL"]["VALUE"]?>"><?=$arElement["DISPLAY_PROPERTIES"]["EMAIL"]["VALUE"]?></a>
			<br/>
			<?=$arElement["DISPLAY_PROPERTIES"]["WWW"]["VALUE"]?>
		</td>

	</tr>
	<?endforeach;?>

</table>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<p><?=$arResult["NAV_STRING"]?></p>
<?endif?>
</div>
