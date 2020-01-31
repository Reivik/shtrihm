<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
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
		<td>Модель ККТ</td>

		<?//echo "<pre>"; print_r($arResult["ITEMS"]); echo "</pre>";?>

	</tr>
	</thead>
	<?foreach($arResult["ITEMS"] as $arElement):?>
	<?
	$this->AddEditAction($arElement['ID'], $arElement['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arElement['ID'], $arElement['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BCS_ELEMENT_DELETE_CONFIRM')));
	?>
	<tr id="<?=$this->GetEditAreaId($arElement['ID']);?>">
		<td>
			<?=$arElement["NAME"]?>
		</td>

		<td>
			<?=$arElement["DISPLAY_PROPERTIES"][118]["VALUE"]?>
		</td>

		<td>
			<?=$arElement["DISPLAY_PROPERTIES"][121]["VALUE"]?>
			<br/>
			<a href="mailto:<?=$arElement["DISPLAY_PROPERTIES"][122]["VALUE"]?>"><?=$arElement["DISPLAY_PROPERTIES"][122]["VALUE"]?></a>
		</td>

		<td>
			<?if (is_array($arElement["DISPLAY_PROPERTIES"][119]["DISPLAY_VALUE"])):?>
				<?foreach($arElement["DISPLAY_PROPERTIES"][119]["DISPLAY_VALUE"] as $model):?>
					<?=$model?>
					<br/>
				<?endforeach;?>
			<?else:?>
			<?=$arElement["DISPLAY_PROPERTIES"][119]["DISPLAY_VALUE"]?>
			<?endif?>
		</td>
	</tr>
	<?endforeach;?>
</table>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<p><?=$arResult["NAV_STRING"]?></p>
<?endif?>
</div>
