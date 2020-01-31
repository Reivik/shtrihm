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
				<td><?=$files["NAME"]?></td>
				<td><?=$files["PREVIEW_TEXT"]?></td>
				<td><a href="/partners_info/advertisin/download.php?file=<?=$files["LINK"]?>" title="Скачать">Скачать</a></td>
			</tr>
		<?endforeach;?>
	</table>
<?endif;?>