<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if(!empty($arResult["ITEMS"])):?>
	<table>
		<tr>
			<th>Документы/файл</th>
			<th>Версия</th>
			<th>Дата последнего обновления</th>
			<th>Размер</th>
			<th></th>
		</tr>
		<?foreach($arResult["ITEMS"] as $arItem):?>
			<?
				$file=CFile::GetFileArray($arItem['PROPERTIES']['FILE']['VALUE']);
				$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
				$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
				if($file['FILE_SIZE']<1024)
					$file['FILE_SIZE'].=" Б";
				elseif($file['FILE_SIZE']/1024<1024)
					$file['FILE_SIZE']=round($file['FILE_SIZE']/1024)." Кб";
				else
					$file['FILE_SIZE']=round($file['FILE_SIZE']/(1024*1024))." Mб";
			?>
			<tr>
				<td><?=$arItem["NAME"]?></td>
				<td><?=$arItem["PROPERTIES"]["VERSION"]["VALUE"]?></td>
				<td><?=$arItem["PROPERTIES"]["LAST_UPDATE"]["VALUE"]?></td>
				<td><?=$file['FILE_SIZE']?></td>
				<td><a href="http://<?=SITE_SERVER_NAME."/support/download/download.php?id=".$arItem['ID']?>" class="dload">Скачать</a></td>
			</tr>
		<?endforeach;?>
	</table>
	<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
		<br /><?=$arResult["NAV_STRING"]?>
	<?endif;?>
<?else:?>
	<p>Нет доступных файлов</p>
<?endif;?>
