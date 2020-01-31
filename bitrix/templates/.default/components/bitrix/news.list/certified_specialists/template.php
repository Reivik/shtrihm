<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if(!empty($arResult["ITEMS"])):?>
	<table>
		<tr>
			<th>ФИО</th>
			<th>Должность</th>
			<th>Компания</th>
			<th>Квалификация</th>
			<th>Дата</th>
		</tr>
		<?foreach($arResult["ITEMS"] as $arItem):?>
			<tr>
				<td><?=$arItem["NAME"]?></td>
				<td>
					<?if(!empty($arItem["PROPERTIES"]["QUALIFICATION"]["VALUE"])):?>
						<?foreach($arItem["PROPERTIES"]["QUALIFICATION"]["VALUE"] as $programm):?>
							<a href="<?=$programm["DETAIL_PAGE_URL"]?>" title="<?=$programm["NAME"]?>"><?=$programm["NAME"]?></a><br />
						<?endforeach;?>
					<?endif;?>
				</td>
				<td><?=$arItem["PROPERTIES"]["COMPANY"]["VALUE"]?></td>
				<td><?=$arItem["NAME"]?></td>
				<td><?=$arItem["DATE_ACTIVE_FROM"]?></td>
			</tr>
		<?endforeach;?>
	</table>
<?else:?>
	<p>По вашему запросу ничего не найдено.</p>
<?endif;?>