<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if($arResult["DETAIL_PICTURE"]):?>
	<?$scheme=CFile::GetFileArray($arResult["DETAIL_PICTURE"]["ID"]);?>
	<img src="<?=$scheme["SRC"]?>" width="100%" /><br />
<?endif;?>
<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arResult["FIELDS"]["PREVIEW_TEXT"]):?>
	<p><?=$arResult["FIELDS"]["PREVIEW_TEXT"];unset($arResult["FIELDS"]["PREVIEW_TEXT"]);?></p>
<?endif;?>
<?if(strlen($arResult["DETAIL_TEXT"])>0):?>
	<?echo $arResult["DETAIL_TEXT"];?>
<?endif?>

<?foreach($arResult["FIELDS"] as $code=>$value):?>
		<p><b><?=GetMessage("IBLOCK_FIELD_".$code)?>:</b>&nbsp;<?=$value;?></p>
<?endforeach;?>
<?foreach($arResult["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>
	<?if($arProperty["CODE"] == "PRICE"):?>
		<?if(count($arProperty["VALUE"]) > 1) {
			foreach($arProperty["VALUE"] as $key => $price)
				$prices[] = $price." (".$arProperty["DESCRIPTION"][$key].")";
		}
		elseif(count($arProperty["VALUE"]) == 1) {
			$prices = $arProperty["VALUE"][0];
		}?>
		<?if(!empty($prices)):?>
			<p><b><?=$arProperty["NAME"]?>:</b>
			<?if(is_array($prices)):?>
				<?=implode(", ", $prices)?><br />
			<?else:?>
				<?=$prices?><br />
			<?endif;?>
		<?endif;?>
	<?else:?>
		<p><b><?=$arProperty["NAME"]?>:</b>&nbsp;
			<?if(is_array($arProperty["DISPLAY_VALUE"])):?>
				<?=implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]);?>
			<?else:?>
				<?=$arProperty["DISPLAY_VALUE"];?>
			<?endif;?>
		</p>
	<?endif;?>
<?endforeach;?>

			<a class="btn learning" href="/partners_info/learning/request/?theme=<?=$arResult["ID"]?>" target="_blank" title="<?=GetMessage("SEND_APPLICATION")?>"><?=GetMessage("SEND_APPLICATION")?></a>
