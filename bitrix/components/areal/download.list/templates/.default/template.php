<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if(!empty($arResult["DOCUMENTS"])):?>
	<table>
		<tr>
			<th>Документы/файл</th>
			<th>Версия</th>
			<th>Дата последнего обновления</th>
			<th>Размер</th>
			<th></th>
		</tr>
		<?foreach($arResult["DOCUMENTS"] as $docs):?>
			<tr>
				<td><?=$docs["NAME"]?></td>
				<td><?=$docs["VERSION"] ? $docs["VERSION"] : "Не известно"?></td>
				<td><?=$docs["LAST_UPDATE"] ? date('d.m.Y',strtotime($docs["LAST_UPDATE"])) : "Не известно"?></td>
				<td><?=$docs["FILE"]["FILE_SIZE"] ? $docs["FILE"]["FILE_SIZE"] : "Не известно"?></td>
				<td>
					<?if($docs["RIGHT"] == 1):?>
						<a href="<?=$arParams["DOWNLOAD_PATH"]?>?file=<?=$docs["ID"]?>&iblock=<?=$docs["IBLOCK_ID"]?>" title="Скачать"><strong>Скачать</strong></a>
					<?else:?>
						Недостаточно прав для скачивания файла
					<?endif;?>
				</td>
			</tr>
		<?endforeach;?>
	</table>
	<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
		<br /><?=$arResult["NAV_STRING"]?>
	<?endif;?>
<?else:?>
	<p>Нет доступных документов</p>
<?endif;?>