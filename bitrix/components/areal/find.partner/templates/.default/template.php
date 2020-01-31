<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if(!empty($arResult["PARTNERS"])):?>
	<?foreach($arResult["PARTNERS"] as $key => $partner):?>
		<div class="partner <?if(($key+1)%3 == 0):?> last <?endif;?>">
			<table>
				<tr>
					<td class="img">
						<?if(!empty($partner["PREVIEW_PICTURE"])):?>
							<img src="<?=$partner["PREVIEW_PICTURE"]["src"]?>" width="<?=$partner["PREVIEW_PICTURE"]["width"]?>" height="<?=$partner["PREVIEW_PICTURE"]["height"]?>" title="<?=$partner["NAME"]?>" alt="<?=$partner["NAME"]?>" />
						<?else:?>
							<img src="/design/images/no-photo/pic58x58.png" alt="<?=$partner["NAME"]?>" title="<?=$partner["NAME"]?>" width="58" height="58" />
						<?endif;?>
					</td>
					<td>
						<span><?=$partner["NAME"]?></span>
					</td>
				</tr>
			</table>
		</div>
	<?endforeach;?>
	<div class="clear"></div>
<?endif;?>