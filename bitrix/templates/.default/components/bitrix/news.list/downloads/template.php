<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?$APPLICATION->IncludeComponent(
	"areal:filter_download",
	".default",
	array(
		"IBLOCK_ID" => IB_DOWNLOAD_FILES,
		"SECTION_ID" => (int)$_REQUEST['section_id'],
		"ELEMENT_ID" => (int)$_REQUEST['product_id'],
		"TYPE" => (int)$_REQUEST['type_id'],
		"SEARCH_STRING" => $_REQUEST['searchDownloads'],
		"CACHE_TIME" => "36000000",
		"SHOW_ELEMENTS_COUNT" => "Y"
	),
	false
);?>

<?if(count($arResult["ITEMS"])>0):?>
	<div class="download textDecor">
		<table>
			<tbody>
				<tr>
					<th class="name_th">Документы/файл</th>
					<th>Версия</th>
					<th>Дата последнего обновления</th>
					<th class="fsize_th">Размер</th>
				</tr>
				<?foreach($arResult["ITEMS"] as $arItem):?>
					<?
					$file=CFile::GetFileArray($arItem['PROPERTIES']['FILE']['VALUE']);
					//pr($file);
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
						<td><?=$arItem['NAME']?></td>
						<td><?=$arItem['PROPERTIES']['VERSION']['VALUE']?></td>
						<td><?=$arItem['PROPERTIES']['LAST_UPDATE']['VALUE']?></td>
						<td><div class="fsize"><?=$file['FILE_SIZE']?></div><a href="http://<?=SITE_SERVER_NAME."/support/download/download.php?id=".$arItem['ID']?>" class="dload">Скачать</a></td>
					</tr>
				<?endforeach;?>
			</tbody>
		</table>
	</div>
	<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
		<br /><?=$arResult["NAV_STRING"]?>
	<?endif;?> 
<?else:?>
	<div class="messErr">Нет элементов удовлетворяющих параметрам поиска!</div>
<?endif;?>
