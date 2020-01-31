<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if(!empty($arResult["ITEMS"])):?>
<div class="block clients" style="width:100%;padding-top: 20px;">
		<div class="blockCont">
			<h2><?=GetMessage("OUR").GetMessage("CLIENTS");?></h2>
			<ul class="flickity" data-flickity-options='{ "prevNextButtons": true, "pageDots": false, "contain": true, "autoPlay": true, "cellAlign": "left" }'>
				<?$rand_fly = rand(0, count($arResult["ITEMS"])-1);?>
				<?foreach($arResult["ITEMS"] as $key => $item):?>
					<li>
						<table class="clients_main_pic">
							<tr>
								<td>
									<a <?if($key != $rand_fly):?> class="bwWrapper" <?else:?> class="bwWrapper not" <?endif;?> href="<?=$arParams["PAGE"].$item["CODE"]?>/" title="<?=$item["NAME"]?>">
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
				<li style="    width: 70px;
    text-align: center;
    line-height: 1.2;"><a href="<?=$arParams["PAGE"]?>"><?=GetMessage("ALL").GetMessage("CLIENTS")?></a></li>
			</ul>
			<!-- div class="all"><a href="<?=$arParams["PAGE"]?>"><?=GetMessage("ALL").GetMessage("CLIENTS")?></a></div -->
		</div>
	</div>
<?endif;?>
<div class="clear"></div>