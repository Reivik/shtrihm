<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if(!empty($arResult["ITEMS"])):?>
	<div class="block-title clients">
		<div class="title"><?=GetMessage("OUR").GetMessage("CLIENTS");?></div>
		<div class="blockCont">
			<ul>
				<?$rand_fly = rand(0, 7);?>
				<?foreach($arResult["ITEMS"] as $key => $item):?>
					<li>
						<table class="clients_main_pic">
							<tr>
								<td>
									<a <?if($key != $rand_fly):?> class="bwWrapper" <?else:?> class="bwWrapper not"<?endif;?> href="<?=$arParams["PAGE"].$item["CODE"]?>/" title="<?=$item["NAME"]?>">
										<?if(!empty($item["PREVIEW_PICTURE"]["src"])):?>								
											<img class="imgGrey" src="<?=$item["PREVIEW_PICTURE"]["src"]?>" width="<?=$item["PREVIEW_PICTURE"]["width"]?>" height="<?=$item["PREVIEW_PICTURE"]["height"]?>" alt="<?=$item["NAME"]?>" title="<?=$item["NAME"]?>" />
										<?else:?>
											<?=$item["NAME"]?>
										<?endif;?>
									</a>
								</td>
							</tr>
						</table>
					</li>
				<?endforeach;?>
			</ul>
			<div class="all"><a href="<?=$arParams["PAGE"]?>"><?=GetMessage("ALL").GetMessage("CLIENTS")?></a></div>
		</div>
	</div>
<?endif;?>