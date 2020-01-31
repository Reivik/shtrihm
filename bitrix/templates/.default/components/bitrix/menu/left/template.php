<?if(count($arResult) > 0):?>
	<ul class="catalog">
		<?foreach($arResult as $key => $item):?>
			<?if($item["DEPTH_LEVEL"] == 1 && $arResult[$key+1]["DEPTH_LEVEL"] == 2 && $item["SELECTED"])	$sub = true;?>
			<?if(($item["DEPTH_LEVEL"] == 1) || ($item["DEPTH_LEVEL"] == 2 && $sub)):?>
				<li class="<?/*if(mb_strlen($item["TEXT"]) >= 25):?>doubleLine<?endif;*/?>">
					<a href="<?=$item["LINK"]?>" class="<?if($item["SELECTED"]):?>current<?endif;?>"><?=$item["TEXT"]?></a>
				<?if(!($arResult[$key + 1]["DEPTH_LEVEL"] == 2 && $item["DEPTH_LEVEL"] == 1)):?>	
				</li>
				<?endif;?>
			<?endif;?>
			<?if($arResult[$key + 1]["DEPTH_LEVEL"] == 2 && $item["DEPTH_LEVEL"] == 1):?>
				<ul>
			<?endif;?>
			<?if($arResult[$key + 1]["DEPTH_LEVEL"] == 1 && $item["DEPTH_LEVEL"] == 2):?>
					</ul>
				</li>
			<?endif;?>
			<?if($item["DEPTH_LEVEL"] == 2 && $arResult[$key+1]["DEPTH_LEVEL"] == 1) $sub = false;?>
			<?if(!isset($arResult[$key + 1]) && $item["DEPTH_LEVEL"] == 2):?>
					</ul>
				</li>
			<?endif;?>
		<?endforeach;?>
	</ul>
<?endif;?>