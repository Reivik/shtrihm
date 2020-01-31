<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if(count($arResult["ITEMS"]) > 0):?>
	<div class="vebinars_list">
	<?foreach($arResult["ITEMS"] as $key => $arItem):?>
		<?
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
		?>
		<?//pr($arItem["DISPLAY_PROPERTIES"]["VIDEO"]);?>
		<div class="item <?if(($key+1)%3 == 0):?> last <?endif;?>">
			<span><?echo $arItem["DISPLAY_ACTIVE_FROM"]?></span>
			<table style="position: relative;">
				<tr>
					<td>
						<?if(!empty($arItem["PREVIEW_PICTURE"]["src"])):?>
							<img src="<?=$arItem["PREVIEW_PICTURE"]["src"]?>" width="<?=$arItem["PREVIEW_PICTURE"]["width"]?>" height="<?=$arItem["PREVIEW_PICTURE"]["src"]?>" alt="<?=$arItem["height"]?>" title="<?=$arItem["NAME"]?>" />
						<?else:?>
							<img src="/design/images/no-photo/pic200x110.png" width="200" height="110" alt="<?=$arItem["height"]?>" title="<?=$arItem["NAME"]?>" />
						<?endif;?>
						<span class="duration"><?=$arItem["DISPLAY_PROPERTIES"]["DURATION"]["VALUE"]?></span>
					</td>
				</tr>
			</table>
			<div class="clear"></div>
			<p class="name"><?=$arItem["NAME"]?></p>
			<p class="creator"><?=$arItem["DISPLAY_PROPERTIES"]["LEADING"]["NAME"]?>: <?=$arItem["DISPLAY_PROPERTIES"]["LEADING"]["VALUE"]?></p>
			<a href="/player.php?id=<?=$arItem["ID"]?>" onclick="window.open(this.href, this.target,'width=<?=$arItem["DISPLAY_PROPERTIES"]["VIDEO"]["VALUE"]["width"]?>,height=<?=intVal($arItem["DISPLAY_PROPERTIES"]["VIDEO"]["VALUE"]["height"]+20)?>,scrollbars=0');return false;" title="Смотреть"><span class="btn">Смотреть</span></a>
		</div>
	<?endforeach;?>
	<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
		<?=$arResult["NAV_STRING"]?>
	<?endif;?>
	</div>
<?else:?>
	<p>На данный момент вебинары недоступны.</p>
<?endif;?>