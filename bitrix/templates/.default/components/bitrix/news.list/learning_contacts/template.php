<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if(count($arResult["ITEMS"]) > 0):?>
	<div class="pageCont">
		<table>
			<tr>
				<th>Город</th>
				<th>Название филиала</th>
				<th>Руководитель</th>
				<th>Контакты</th>
			</tr>
			<?foreach($arResult["ITEMS"] as $arItem):?>
				<tr>
					<td><?=$arItem["PROPERTIES"]["CITY"]["VALUE"]?></td>
					<td><?=$arItem["NAME"]?></td>
					<td><?=$arItem["PROPERTIES"]["HEAD"]["VALUE"]?></td>
					<td>
						<?if(!empty($arItem["PROPERTIES"]["ADDRESS"]["VALUE"])):?><b>Адрес: </b> <?=$arItem["PROPERTIES"]["ADDRESS"]["VALUE"]?><br /><?endif;?>
						<?if(!empty($arItem["PROPERTIES"]["PHONE"]["VALUE"])):?><b>Телефон: </b> <?=$arItem["PROPERTIES"]["PHONE"]["VALUE"]?><br /><?endif;?>
						<?if(!empty($arItem["PROPERTIES"]["EMAIL"]["VALUE"])):?>
							<?$email = explode("@", $arItem["PROPERTIES"]["EMAIL"]["VALUE"]);?>
							<b>Email: </b> <a class="e-mail" title="<?=$email[0]?>" href="#<?=$email[1]?>" ></a><br />
						<?endif;?>
						<?if(!empty($arItem["PROPERTIES"]["SCHEME"]["VALUE"])):?>
							<?$scheme=CFile::GetFileArray($arItem["PROPERTIES"]["SCHEME"]["VALUE"]);?>
							<b><a class="scheme main_image" title="Схема проезда" href="<?=$scheme["SRC"]?>"><img src="<?=$scheme["SRC"]?>" width="100%" /></a></b><br />
						<?endif;?>
					</td>
				</tr>
			<?endforeach;?>
		</table>
	</div>
	<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
		<?=$arResult["NAV_STRING"]?>
	<?endif;?>
<?else:?>
	<p>По Вашему запросу ничего не найдено.</p>
<?endif;?>

<script type="text/javascript">
  $(document).ready(function() {
    $(".main_image").fancybox();
  });
</script>
