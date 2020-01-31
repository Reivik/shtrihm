<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?/*<div class="attention">
					<i class="fa fa-exclamation-triangle"></i>
					<div>
						<strong>Вниманию технических специалистов!</strong>
						<span>Уважаемые коллеги, просьба внимательно прочитать инструкцию и в случае необходимости восстановить прошивку.</span>
						<a href="/press_center/news/informatsionnye-pisma-dlya-partnerov/vnimaniyu-tekhnicheskikh-spetsialistov/" target="_blank">Подробнее</a> 
					</div>
				</div>*/?>

<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
<iframe width="100%" height="319" src="<?=$arItem["DISPLAY_PROPERTIES"]["V_LINK"]["VALUE"]?>" frameborder="0" allowfullscreen></iframe>

<?endforeach;?>


