<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if(!empty($arResult["FILES"])):?>
	<p>В данном разделе вы можете скачать файлы.</p>
	<table>
		<tr>
			<th>Файл</th>
			<th>Описание</th>
			<th>Ссылка для скачивания</th>
		</tr>
		<?foreach($arResult["FILES"] as $files):?>
			<tr>
				<td><img src="<?=$files["PREVIEW_PICTURE"]["src"]?>" width="<?=$files["PREVIEW_PICTURE"]["width"]?>" height="<?=$files["PREVIEW_PICTURE"]["height"]?>" title="<?=$files["NAME"]?>" alt="<?=$files["NAME"]?>" /></td>
				<td><?=$files["NAME"]?></td>
				<td><a href="/partners_info/advertisin/download.php?file=<?=$files["LINK"]?>" title="Скачать">Скачать</a></td>
			</tr>
		<?endforeach;?>
	</table>
<?endif;?>