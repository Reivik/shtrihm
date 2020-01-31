<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="news-detail">
	<?if(is_array($arResult["SMALL_PICTURE"]) && !isset($_REQUEST["PAGEN_1"])):?>
		<div class="solutionLogo">
			<a href="<?=$arResult["BIG_PICTURE"]["src"]?>" class="main_image">	
				<img src="<?=$arResult["SMALL_PICTURE"]["src"]?>" width="<?=$arResult["SMALL_PICTURE"]["width"]?>" height="<?=$arResult["SMALL_PICTURE"]["height"]?>" alt="<?=$arResult["NAME"]?>" title="<?=$arResult["NAME"]?>"  />
				<span class="zoom" title="<?=GetMessage("OPEN_BIG_PICTURE")?>"></span>
			</a>
		</div>
	<?endif?>
	<?if(!empty($arResult["DETAIL_TEXT"])):?>
		<?=$arResult["DETAIL_TEXT"]?>
	<?endif;?>	
	<div class="clear"></div>
	<?if(!empty($arResult["FILLIALS"])):?>
		<h2 class="marginTop">Контакты</h2>
		<?$i=1;
		foreach($arResult["FILLIALS"] as $key => $filial):?>
			<?if($i==1 || $i%3 == 1):?>
			<div>
			<?endif?>
				<div class="filial <?if(($key+1)%3 == 0 || $key == (count($arResult["FILLIALS"])-1)):?> last <?endif;?>">
					<?if(!empty($filial["OFFICE"])):?>
						<?=mb_strtoupper($filial["OFFICE"])?>:<br />
					<?endif;?>
					<?if(!empty($filial["TOWN"])):?>
						<b><?=$filial["TOWN"]?></b><br />
					<?endif;?>
					<?if(!empty($filial["ADDRESS"])):?>
						<b>адрес:</b> <?=$filial["ADDRESS"]?><br />
					<?endif;?>
					<?if(!empty($filial["PHONE"])):?>
						<b>тел.:</b> <?=$filial["PHONE"]?><br />
					<?endif;?>
					<?if(!empty($filial["EMAIL"])):?>
						<b>e-mail:</b> <a class="e-mail" title="<?=$filial["EMAIL"][0]?>" href="#<?=$filial["EMAIL"][1]?>" ></a>
					<?endif;?>
				</div>
			<?if($i==count($arResult["FILLIALS"]) || $i%3 == 0):?>
				<div style="clear:both"></div>
			</div>
			<?endif?>
		<?$i++;
		endforeach;?>
	<?endif;?>
</div>
<div class="clear"></div>