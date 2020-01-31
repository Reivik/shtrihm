<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="clear"></div>
<?if(count($arResult["SECTIONS"]) > 0):?>
	<?foreach($arResult["SECTIONS"] as $arSection):?>
		<div class="item_list_catalog">
			<div class="photo">
				<table class="photo">
					<tr>
						<td>
							<a href="<?=$arSection["SECTION_PAGE_URL"]?>" title="<?=$arSection["NAME"]?>">
								<?if($arSection["PICTURE"]):?>
									<img src="<?=$arSection["PICTURE"]["src"]?>" width="<?=$arSection["PICTURE"]["width"]?>" height="<?=$arSection["PICTURE"]["height"]?>" alt="<?=$arSection["NAME"]?>" title="<?=$arSection["NAME"]?>" />
								<?else:?>
									<img src="/design/images/no-photo/pic102x102.png" alt="<?=$arSection["NAME"]?>" title="<?=$arSection["NAME"]?>" />
								<?endif;?>
							</a>
						</td>
					</tr>
				</table>				
			</div>
			<div class="text">
				<h2><a href="<?=$arSection["SECTION_PAGE_URL"]?>"><?=$arSection["NAME"]?></a></h2>
				<?if($arSection["DESCRIPTION"]):?>
					<p><?=$arSection["DESCRIPTION"]?></p>
				<?endif;?>
			</div>
			<div class="show">
				<a href="<?=$arSection["SECTION_PAGE_URL"]?>" class="view">Смотреть</a>
			</div>
			<div class="clear"></div>
		</div>
	<?endforeach;?>
	<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
		<?=$arResult["NAV_STRING"]?>
	<?endif;?>
<?else:?>
	<p>К сожалению в данный момент в этом разделе нет актуальной информации.</p>
<?endif;?>