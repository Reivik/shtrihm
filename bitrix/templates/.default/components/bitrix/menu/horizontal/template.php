<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if (empty($arResult))
	return;

$lastSelectedItem = null;
$lastSelectedIndex = -1;

foreach($arResult as $itemIdex => $arItem)
{
	if (!$arItem["SELECTED"])
		continue;

	if ($lastSelectedItem == null || strlen($arItem["LINK"]) >= strlen($lastSelectedItem["LINK"]))
	{
		$lastSelectedItem = $arItem;
		$lastSelectedIndex = $itemIdex;
	}
}

?>
<ul class="navMenu">
<?
$i=0;
$l2=false;
$l3=false;
?>
<?foreach($arResult as $itemIndex => $arItem):?>
	<?if($arItem["DEPTH_LEVEL"] == 1):?>
		<?$i++;?>
		
		<li class="<?if($i<=3):?>largeLink<?endif;?> <?if($arItem["SELECTED"]):?>selected<?endif;?>" >
			<a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
		<?if($arResult[$itemIndex+1]["DEPTH_LEVEL"]<=1):?>
			</li>
		<?endif;?>
	<?endif;?>
	
	<?if($arItem["DEPTH_LEVEL"] == 2):?>
		<?if($l2==false):?>
			<div class="subMenu">
				<div class="pointer"></div>
				<ul>
			<?$l2 = true;?>
		<?endif;?>
		
					<li>
						<a href="<?=$arItem["LINK"]?>" <?if($arResult[$itemIndex+1]["DEPTH_LEVEL"]==3):?>class="subMenuLink"<?endif;?>><?=$arItem["TEXT"]?></a>
					<?if($arResult[$itemIndex+1]["DEPTH_LEVEL"]<=2):?>
					</li>
					<?endif;?>
		<?if($arResult[$itemIndex+1]["DEPTH_LEVEL"]<=1):?>
			<?$l2 = false;?>
				</ul>
			</div>
		</li>
		<?endif;?>
	<?endif;?>
	
	<?if($arItem["DEPTH_LEVEL"] == 3):?>
		<?if($l3==false):?>
			<ul>
			<?$l3=true;?>
		<?endif;?>
		
		<li><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
		
		<?if($arResult[$itemIndex+1]["DEPTH_LEVEL"]==2):?>
			<?$l3 = false;?>
			</ul>
		</li>
		<?endif;?>
		
		<?if($arResult[$itemIndex+1]["DEPTH_LEVEL"]<=1):?>
			<?$l3 = false;?>
			<?$l2 = false;?>
						</ul>
					</li>
				</ul>
			</div>
		</li>
		<?endif;?>
	<?endif;?>

<?endforeach;?>
</ul>