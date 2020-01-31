<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if(!empty($arResult["ITEMS"])):?>
	<p>При выборе партнера обращайте внимание на полученные им компетенции, соответствующие вашему проекту. Это позволит более целенаправленно осуществлять выбор заказчика, соответствующего вашим требованиям.</p>
	<table>
		<tr>
			<th>Название</th>
			<th>Описание</th>
		</tr>
		<?foreach($arResult["ITEMS"] as $arItem):?>
			<tr>
				<td>
					<?if(!empty($arItem["PREVIEW_PICTURE"])):?>
						<img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" width="<?=$arItem["PREVIEW_PICTURE"]["WIDTH"]?>" height="<?=$arItem["PREVIEW_PICTURE"]["HEIGHT"]?>" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" />
					<?endif;?>
					<?echo $arItem["NAME"]?>
				</td>
				<td><?echo $arItem["PREVIEW_TEXT"];?></td>
			</tr>
		<?endforeach;?>
	</table>
	<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
		<?=$arResult["NAV_STRING"]?>
	<?endif;?>
<?endif;?>

