<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if(!empty($arResult["SECTIONS"])):?>
	<noindex><p>
	<?if($arResult["DIFFERENT"]):
		?><a href="<?=htmlspecialcharsbx($APPLICATION->GetCurPageParam("DIFFERENT=N",array("DIFFERENT")))?>" rel="nofollow"><?=GetMessage("CATALOG_ALL_CHARACTERISTICS")?></a><?
	else:
		?><?=GetMessage("CATALOG_ALL_CHARACTERISTICS")?><?
	endif
	?>&nbsp;|&nbsp;<?
	if(!$arResult["DIFFERENT"]):
		?><a href="<?=htmlspecialcharsbx($APPLICATION->GetCurPageParam("DIFFERENT=Y",array("DIFFERENT")))?>" rel="nofollow"><?=GetMessage("CATALOG_ONLY_DIFFERENT")?></a><?
	else:
		?><?=GetMessage("CATALOG_ONLY_DIFFERENT")?><?
	endif?>
	</p></noindex>
	<?foreach($arResult["SECTIONS"] as $section):?>		
		<?$tableCnt = count($section["ITEMS"]);?>
		<h2><?=$section["SECTION_NAME"]?></h2>
		<div class="compare_result">
			<table class="compare_table">
				<tr>
					<th class="prop_name"><strong>Характеристики</strong></th>
					<?foreach($section["ITEMS"] as $item):?>
						<th><?=$item["NAME"]?></th>
					<?endforeach;?>
				</tr>
				<tr>
					<td class="prop_name"></td>
					<?foreach($section["ITEMS"] as $item):?>
						<td style="text-align: center; vertical-align: middle">
							<a href="<?=$item["DETAIL_PAGE_URL"]?>">
								<img src="<?=$item["PREVIEW_PICTURE"]["src"]?>" width="<?=$item["PREVIEW_PICTURE"]["width"]?>"  height="<?=$item["PREVIEW_PICTURE"]["height"]?>" title="<?=$item["NAME"]?>" alt="<?=$item["NAME"]?>" />
							</a>
						</td>
					<?endforeach;?>
				</tr>
				<?$arResult["PROPS"] = array();?>
				<?foreach($arResult["SHOW_PROPERTIES"] as $code => $arProperty){
					$flag = 0;
					foreach($section["ITEMS"] as $item)		
						if($item["PROPERTIES"][$code]["VALUE"])
							$flag = 1;
					if($flag == 1) $arResult["PROPS"][$code] = $arProperty;
				}?>
				<?if(!empty($arResult["PROPS"])):?>
					<?foreach($arResult["PROPS"] as $code => $arProperty):?>
						<?$arCompare = Array();?>
						<?foreach($section["ITEMS"] as $item):?>
							<?$arPropertyValue = $item["PROPERTIES"][$code]["VALUE"];
							if(is_array($arPropertyValue))
							{
								sort($arPropertyValue);
								$arPropertyValue = implode(" / ", $arPropertyValue);
							}
							$arCompare[] = $arPropertyValue;?>
						<?endforeach;?>
						<?$diff = (count(array_unique($arCompare)) > 1 ? true : false);?>
						<?if($diff || !$arResult["DIFFERENT"]):?>
							<tr>
								<td class="prop_name"><?=$arProperty["NAME"]?></td>
								<?foreach($section["ITEMS"] as $item):?>
									<?if($diff):?>
										<td>
											<?echo (
												is_array($item["PROPERTIES"][$code]["VALUE"])
												? implode("/ ", $item["PROPERTIES"][$code]["VALUE"])
												: $item["PROPERTIES"][$code]["VALUE"]
											);?>
										</td>
									<?else:?>
										<td>
											<?echo (
												is_array($item["PROPERTIES"][$code]["VALUE"])
												? implode("/ ", $item["PROPERTIES"][$code]["VALUE"])
												: $item["PROPERTIES"][$code]["VALUE"]
											);?>
										</td>
									<?endif;?>
								<?endforeach;?>
							</tr>
							<?//$i++;?>
						<?endif;?>
					<?endforeach;?>
				<?endif;?>
				<tr>
					<td></td>
					<?foreach($section["ITEMS"] as $item):?>
						<td>
							<a class="compare-delete-item" href="<?=htmlspecialchars($APPLICATION->GetCurPageParam("action=DELETE_FROM_COMPARE_RESULT&IBLOCK_ID=".$arParams['IBLOCK_ID']."&ID[]=".$item['ID'],array("action", "IBLOCK_ID", "ID")))?>" title="<?=GetMessage("CATALOG_REMOVE_PRODUCT")?>">Убрать из сравнения</a>						
						</td>
					<?endforeach;?>
				</tr>
			</table>
		</div>
	<?endforeach;?>
<?endif;?>