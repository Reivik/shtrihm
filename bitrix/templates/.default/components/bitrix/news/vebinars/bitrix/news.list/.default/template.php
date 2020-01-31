<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if(count($arResult["ITEMS"]) > 0):?>
	<div class="vebinars_list">
	<?foreach($arResult["ITEMS"] as $key => $arItem):?>
		<div class="item <?if(($key+1)%3 == 0):?> last <?endif;?>">
			<span><?echo $arItem["DISPLAY_ACTIVE_FROM"]?><?echo substr($arItem["ACTIVE_FROM"], 9, 7)?></span>
			<table>
				<tr>
					<td>
						<?if(!empty($arItem["PREVIEW_PICTURE"]["src"])):?>
							<img src="<?=$arItem["PREVIEW_PICTURE"]["src"]?>" width="<?=$arItem["PREVIEW_PICTURE"]["width"]?>" height="<?=$arItem["PREVIEW_PICTURE"]["height"]?>" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" />
						<?else:?>
							<img src="/design/images/no-photo/pic200x110.png" width="200" height="110" alt="<?=$arItem["height"]?>" title="<?=$arItem["NAME"]?>" />
						<?endif;?>
						<div class="duration"><?=$arItem["PROPERTIES"]["DURATION"]["VALUE"]?> мин</div>
					</td>
				</tr>
			</table>
			<div class="clear"></div>
			<p class="name"><?=$arItem["NAME"]?></p>
			<p class="creator"><?=$arItem["DISPLAY_PROPERTIES"]["LEADING"]["NAME"]?>: <?=$arItem["DISPLAY_PROPERTIES"]["LEADING"]["VALUE"]?></p>
			<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" title="Смотреть"><span class="btn">Смотреть</span></a>
		</div>
	<?endforeach;?>
	<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
		<?=$arResult["NAV_STRING"]?>
	<?endif;?>
	</div>
	<div class="clear"></div>
<?else:?>
	<p>На данный момент вебинары недоступны.</p>
<?endif;?>
<?if(in_array(UG_VEBINAR_CREATOR, CUser::GetUserGroup($USER->GetID()))):?>
	<a href="create/" id="add_vebinar" class="add" title="Создать вебинар"><i></i>Создать вебинар</a>
<?endif;?>