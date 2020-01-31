<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?//pr($arResult);?>
<?if (!empty($arResult)):?>
	<ul class="navMenu">
		<?$previousLevel = 0; $n = 0;
		foreach($arResult as $arItem):?>			
			<?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
				<?=str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
			<?endif?>
			<?if ($arItem["IS_PARENT"]):?>
				<?if ($arItem["DEPTH_LEVEL"] == 1):?>
					<?$n++;?>
					<li class="<?if ($arItem["SELECTED"]):?>root-item-selected<?else:?>root-item<?endif?> count_<?=$n?> <?if(mb_strlen($arItem["TEXT"]) >= 25):?>doubleLine<?endif;?>">
						<?/*<a href="<?=$arItem["LINK"]?>" class="main-item-selected"><?=$arItem["TEXT"]?></a>*/?>
						<a class="main-item-selected"><?=$arItem["TEXT"]?></a>
						<div class="subMenu">
							<div class="pointer"></div>
							<ul class="root-item">
				<?else:?>
					<li class="parent<?if ($arItem["SELECTED"]):?> item-selected<?endif?> <?if(mb_strlen($arItem["TEXT"]) >= 25):?>doubleLine<?endif;?>">
						<a href="<?=$arItem["LINK"]?>" class="main-item-selected subMenuLink"><?=$arItem["TEXT"]?></a>
						<ul class="">
				<?endif?>
			<?else:?>
				<?if($arItem["PERMISSION"] > "D"):?>
					<?if ($arItem["DEPTH_LEVEL"] == 1):?>
						<?$n++;?>
						<li class="<?if ($arItem["SELECTED"]):?>root-item-selected<?else:?>root-item<?endif?> count_<?=$n?> <?if(mb_strlen($arItem["TEXT"]) >= 25):?>doubleLine<?endif;?>">
							<a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a> 
						</li>
					<?else:?>
						<li <?if(mb_strlen($arItem["TEXT"]) >= 25):?> class="doubleLine" <?endif;?>>
							<a href="<?=$arItem["LINK"]?>" <?if ($arItem["SELECTED"]):?> class="item-selected"<?endif?>><?=$arItem["TEXT"]?></a>
						</li>
					<?endif?>
				<?else:?>
					<?if ($arItem["DEPTH_LEVEL"] == 1):?>
						<?$n++;?>
						<li class="<?if ($arItem["SELECTED"]):?>root-item-selected<?else:?>root-item<?endif?> count_<?=$n?> <?if(mb_strlen($arItem["TEXT"]) >= 25):?>doubleLine<?endif;?>"><a href="" title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>"><?=$arItem["TEXT"]?></a></li>
					<?else:?>
						<li <?if(mb_strlen($arItem["TEXT"]) >= 25):?> class="doubleLine" <?endif;?>><a href="" class="denied " title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>"><?=$arItem["TEXT"]?></a></li>
					<?endif?>
				<?endif?>
			<?endif?>
			<?$previousLevel = $arItem["DEPTH_LEVEL"];?>
		<?endforeach?>
		<?if ($previousLevel > 1):?>
			<?=str_repeat("</ul></div></li>", ($previousLevel-1) );?>
		<?endif?>
	</ul>
<?endif?>