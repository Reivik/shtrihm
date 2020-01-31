<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if (count($arResult["ITEMS"]) < 1):?>
	<div class="messErr">В этом блоке нет элементов, удовлетворяющих параметрам фильтра</div>
	<?return;?>
<?endif;?>
<?if (count($arResult["ITEMS"]) > 0):?>
	<div class="implantations">
		<?foreach($arResult["ITEMS"] as $key => $arItem):?>
			<article <?if(($key+1)%3 == 0):?> class="last" <?endif;?> >
				<?/*<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" title="<?=$arItem["NAME"]?>">*/?>
					<table class="photo">
						<tr>
							<td>
								<?if($arItem["PREVIEW_PICTURE"]):?>
									<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" title="<?=$arItem["NAME"]?>">
										<img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" width="<?=$arItem["PREVIEW_PICTURE"]["WIDTH"]?>" height="<?=$arItem["PREVIEW_PICTURE"]["HEIGHT"]?>" alt=""/>
									</a>
								<?else:?>
									<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" title="<?=$arItem["NAME"]?>">
										<img src="/design/images/no-photo/pic201x160.png" width="201" height="160" title="<?=$arItem["NAME"]?>" alt="<?=$arItem["NAME"]?>"/>
									</a>
								<?endif;?>
							</td>
						</tr>
					</table>
					<h2><a href="<?=$arItem["DETAIL_PAGE_URL"]?>" title="<?=$arItem["NAME"]?>"><?=$arItem["NAME"]?></a></h2>
					<div class="detail">
						<label><?if(!empty($arItem["PROPERTIES"]["PARTNER"]["VALUE"]["NAME"])):?>Внедрение выполнено компанией:<?endif;?></label>
						<a href="<?=$arItem["PROPERTIES"]["PARTNER"]["VALUE"]["DETAIL_PAGE_URL"]?>" title="<?=$arItem["PROPERTIES"]["PARTNER"]["VALUE"]["NAME"]?>"><span class="company"><?=$arItem["PROPERTIES"]["PARTNER"]["VALUE"]["NAME"]?></span></a>
						<label><?if(!empty($arItem["PROPERTIES"]["CITY"]["VALUE"])):?>Город:<?endif;?></label>
						<span><?=$arItem["PROPERTIES"]["CITY"]["VALUE"]?></span>
					</div>
					<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" title="<?=$arItem["NAME"]?>"><span class="btn">Смотреть</span></a>
			</article>
		<?endforeach;?>
		<div class="clear"></div>
		<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
			<?=$arResult["NAV_STRING"]?>
		<?endif;?>
		<?if($USER->IsAuthorized()):?>
			<?if(in_array(UG_AKP, CUser::GetUserGroup($USER->GetID())) || in_array(UG_PO, CUser::GetUserGroup($USER->GetID())) || in_array(UG_YC, CUser::GetUserGroup($USER->GetID())) || in_array(UG_TP, CUser::GetUserGroup($USER->GetID()))):?>
				<a href="/personal/add_introduction/" class="add add-implantations"><i></i>Добавить внедрение</a>
			<?endif;?>
		<?endif;?>
		<div class="clear"></div>
	</div>
<?endif;?>