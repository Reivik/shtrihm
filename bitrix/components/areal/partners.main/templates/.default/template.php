<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if(!empty($arResult["ITEMS"])):?>
	<div class="block partners clients">
		<div class="blockCont">
			<h2><?=GetMessage("OUR").GetMessage("PARTNERS");?></h2>
			<ul>
				<?$rand_fly = rand(0, count($arResult["ITEMS"])-1);?>
				<?foreach($arResult["ITEMS"] as $key => $item):?>
					<li>
						<table class="clients_main_pic">
							<tr>
								<td>
									<a <?if($key != $rand_fly):?> class="bwWrapper2" <?else:?>class="bwWrapper2 not2"<?endif;?> href="<?=$arParams["PAGE"].$item["CODE"]?>/" title="<?=$item["NAME"]?>">
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
			<div class="all"><a href="<?=$arParams["PAGE"]?>"><?=GetMessage("ALL").GetMessage("PARTNERS")?></a></div>
		</div>
	</div>
<?endif;?>