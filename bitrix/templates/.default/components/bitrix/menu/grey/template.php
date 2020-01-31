<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if (!empty($arResult)):?>
	<ul class="catalog">
		<?$previousLevel = 0;
		foreach($arResult as $arItem):?>
			<?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
				<?=str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
			<?endif?>
			<?if ($arItem["IS_PARENT"]):?>
				<?if ($arItem["DEPTH_LEVEL"] == 1):?>
					<li class="<?if ($arItem["SELECTED"]):?>root-item-selected first<?else:?>root-item<?endif?> <?if(mb_strlen($arItem["TEXT"]) >= 28):?>doubleLine<?endif;?> "><a href="<?=$arItem["LINK"]?>" class="main-item-selected"><?=$arItem["TEXT"]?></a>
						<ul class="root-item">
				<?else:?>
					<li class="<?if(mb_strlen($arItem["TEXT"]) >= 28):?>doubleLine<?endif;?> parent<?if ($arItem["SELECTED"]):?> item-selected<?endif?>"><a href="<?=$arItem["LINK"]?>" class="main-item-selected"><?=$arItem["TEXT"]?></a>
						<ul <?if($arItem["DEPTH_LEVEL"]>2):?>style="display:none;"<?endif?>>
				<?endif?>
			<?else:?>
				<?if ($arItem["PERMISSION"] > "D"):?>
					<?if ($arItem["DEPTH_LEVEL"] == 1):?>
						<li class="<?if(mb_strlen($arItem["TEXT"]) >= 28):?>doubleLine<?endif;?> <?if ($arItem["SELECTED"]):?>root-item-selected first<?else:?>root-item<?endif?>"><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
					<?else:?>
						<li class="<?if(mb_strlen($arItem["TEXT"]) >= 28):?>doubleLine<?endif;?>"><a href="<?=$arItem["LINK"]?>" <?if ($arItem["SELECTED"]):?> class="item-selected"<?endif?>><?=$arItem["TEXT"]?></a></li>
					<?endif?>
				<?else:?>
					<?if ($arItem["DEPTH_LEVEL"] == 1):?>
						<li class="<?if(mb_strlen($arItem["TEXT"]) >= 28):?>doubleLine<?endif;?> <?if ($arItem["SELECTED"]):?>root-item-selected first<?else:?>root-item<?endif?>"><a href="" title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>"><?=$arItem["TEXT"]?></a></li>
					<?else:?>
						<li class="<?if(mb_strlen($arItem["TEXT"]) >= 28):?>doubleLine<?endif;?>"><a href="" class="denied" title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>"><?=$arItem["TEXT"]?></a></li>
					<?endif?>
				<?endif?>
			<?endif?>
			<?$previousLevel = $arItem["DEPTH_LEVEL"];?>
		<?endforeach?>
		<?if ($previousLevel > 1):?>
			<?=str_repeat("</ul></li>", ($previousLevel-1) );?>
		<?endif?>
	</ul>
<?endif?>