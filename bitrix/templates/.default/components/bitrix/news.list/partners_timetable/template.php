<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
	$MONTH = array(
		"01" => "Январь",
		"02" => "Февраль",
		"03" => "Март",
		"04" => "Апрель",
		"05" => "Май",
		"06" => "Июнь",
		"07" => "Июль",
		"08" => "Август",
		"09" => "Сентябрь",
		"10" => "Октябрь",
		"11" => "Ноябрь",
		"12" => "Декабрь");
?>
<?if(count($arResult["ITEM"]) > 0):?>
	<?foreach($arResult['DATES'] as $date=>$keys):?>
		<?$arDates=explode('-',$date);?>
		<h2><?=$MONTH[$arDates[0]].' '.$arDates[1]?></h2>
		<table width="100%">		
			<tr>
				<!--<th width="144px"></?=GetMessage("REGION");?></th>-->
				<th><?=GetMessage("INFORMATION");?></th>
				<th></th>
			</tr>		
			<?foreach($keys as $key):?>
				<?$arItem=$arResult["ITEM"][$key]?>				
				<tr>
					<!--<td>
</?=$arItem["PROGRAMM"]["CITY"]?>
</?if(!empty($arItem["PROGRAMM"]["PICTURE"])):?>
<img src="</?=$arItem["PROGRAMM"]["PICTURE"]?>" width="100px" />
</?endif;?>
					</td>-->
					<td>
						<?if(!empty($arItem["PROGRAMM"]["NAME"])):?>
							<b><?=GetMessage("THEME_OF_COURSE");?></b> <?=$arItem["PROGRAMM"]["NAME"]?><br />
						<?endif;?>
						<?/*if(!empty($arItem["PROGRAMM"]["TYPE_COMPANY"])):?>
							<b><?=GetMessage("TYPE_OF_COMPANY");?></b> <?=$arItem["PROGRAMM"]["TYPE_COMPANY"]?><br />
						<?endif;?>
						<?if(!empty($arItem["PROGRAMM"]["PERSON"])):?>
							<b><?=GetMessage("CATEGORY");?></b> <?=$arItem["PROGRAMM"]["PERSON"]?><br />
						<?endif;*/?>
						<?if(!empty($arItem["PROPERTIES"]["FORM"]["VALUE"])):?>
							<b><?=GetMessage("FORM_EDUCATION");?></b> <?=$arItem["PROPERTIES"]["FORM"]["VALUE"]?><br />
						<?endif;?>
						<?if(!empty($arItem["PROGRAMM"]["DURATION"])):?>
							<b><?=GetMessage("DURATION");?></b> <?=$arItem["PROGRAMM"]["DURATION"]?><br />
						<?endif;?>
						<?if(!empty($arItem["PROGRAMM"]["COMPENSATION"])):?>
							<b><?=GetMessage("COMPENSATION");?></b> <?=$arItem["PROGRAMM"]["COMPENSATION"]?><br />
						<?endif;?>
						<?if($arItem["PROGRAMM"]["DATE_ACTIVE_FROM"] && $arItem["PROGRAMM"]["DATE_ACTIVE_TO"]):?>
							<b><?=GetMessage("DATE");?>:</b> <?=getPeriodByTwoDate($arItem["PROGRAMM"]["DATE_ACTIVE_FROM"], $arItem["PROGRAMM"]["DATE_ACTIVE_TO"])?><br />
						<?endif;?>
						<?if(!empty($arItem["PROGRAMM"]["PRICE"])):?>
							<b><?=GetMessage("PRICE");?>:</b> 
							<?if(is_array($arItem["PROGRAMM"]["PRICE"])):?>
								<?=implode(", ", $arItem["PROGRAMM"]["PRICE"])?><br />
							<?else:?>
								<?=$arItem["PROGRAMM"]["PRICE"]?><br />
							<?endif;?>
						<?endif;?>
						<?if($_REQUEST['archive']!=='2'):?>
							<a class="btn learning" href="/partners_info/learning/request/?theme=<?=$arItem["PROGRAMM"]["ID_THEME"]?>&person=<?=$arItem["PROGRAMM"]["PERSON"]?>&type_company=<?=$arItem["PROGRAMM"]["TYPE_COMPANY"]?>"><?=GetMessage("APPLY_FOR_THE_TRAINING");?></a><br />						
						<?endif;?>
					</td>
					<td>
						<a class="btn" href="<?=$arItem["PROGRAMM"]["DETAIL_PAGE_URL"]?>"><?=GetMessage("MORE");?></a><br />
					</td>
				</tr>
			<?endforeach;?>
		</table>
	<?endforeach;?>
	<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
		<br /><?=$arResult["NAV_STRING"]?>
	<?endif;?>
<?else:?>
	<p><?=GetMessage("NO_ITEMS");?></p>
<?endif;?>