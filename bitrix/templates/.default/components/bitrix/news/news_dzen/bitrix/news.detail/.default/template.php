<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<!-- style>
	#modales {display:none;position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.5);z-index:3000;}
	.window-modal {width:800px;margin:0 auto;margin-top:2%;background:#fff;position:relative;height:90ch;overflow:auto;padding:30px;}
	.closex {position:absolute;right:10px;top:10px;font-size:18px;font-weight;bold;cursor:pointer;line-height:20px;width:20px;height:20px;text-align:Center;}
</style>
<script>
	function Modales() {
document.getElementById('modales').style.display='block';
}
	function Closes() {document.getElementById('modales').style.display='none';
}
</script -->
<div class="clients_detail">
	<?if(is_array($arResult["PICTURES"])):?>
		<div class="solutionLogo slid">
			<div class="block slider">
				<div class="blockContSlider">
					<ul class="sliderItems">
						<?foreach($arResult["PICTURES"] as $key => $arItem):?>
							<?if(is_array($arItem["M"])):?>
								<li>
									<table class="photo">
										<tr>
											<td>
												<a class="gallery main_image" rel="pict" href="<?=$arItem["L"]["src"]?>">
													<img src="<?=$arItem["M"]["src"]?>" title="<?=$arResult["NAME"]?>" width="<?=$arItem["M"]["width"]?>" height="<?=$arItem["M"]["height"]?>" alt="<?=$arResult["NAME"]?>" />
												</a>
											</td>
										</tr>
									</table>
								</li>
							<?endif;?>
						<?endforeach;?>
					</ul>
				</div>
			</div>
		</div>
	<?endif?>
	
	<?if(!empty($arResult["DISPLAY_ACTIVE_FROM"])):?>
		<span><?=$arResult["DISPLAY_ACTIVE_FROM"];?></span>
	<?endif;?>
	<div class="page_nav_solution">
		<?if($arResult["NAV_RESULT"]):?>
			<?if($arParams["DISPLAY_TOP_PAGER"] == "Y"):?><?=$arResult["NAV_STRING"]?><br /><?endif;?>
			<?echo $arResult["NAV_TEXT"];?>
			<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?><br /><?=$arResult["NAV_STRING"]?><?endif;?>
		<?elseif(strlen($arResult["DETAIL_TEXT"])>0):?>
			<?echo $arResult["DETAIL_TEXT"];?>
		<?else:?>
			<?echo $arResult["PREVIEW_TEXT"];?>
		<?endif?>

		<?/* if ($arResult["PROPERTIES"]["USE_A"]["VALUE"]){?>
		<div id="modales">
			<div class="window-modal">
				<div class="closex" onclick="Closes();">X</div>
<?$APPLICATION->IncludeComponent("areal:form.result.new", ".default", array(
	"WEB_FORM_ID" => "6",
	"IGNORE_CUSTOM_TEMPLATE" => "N",
	"USE_EXTENDED_ERRORS" => "N",
	"SEF_MODE" => "N",
	"SEF_FOLDER" => "/press_center/news/novinki/otkryt-priem-zayavok-na-postavku-fiskalnykh-nakopiteley/",
	"CACHE_TYPE" => "N",
	"CACHE_TIME" => "3600",
	"LIST_URL" => "result_list.php",
	"EDIT_URL" => "result_edit.php",
	"SUCCESS_URL" => "",
	"CHAIN_ITEM_TEXT" => "",
	"CHAIN_ITEM_LINK" => "",
	"EMAIL_MANAGER" => "",
	"VACANCY" => "",
	"VARIABLE_ALIASES" => array(
		"WEB_FORM_ID" => "WEB_FORM_ID",
		"RESULT_ID" => "RESULT_ID",
	)
	),
	false
);?></div>
	</div>
<?}*/?> 


	</div>

	<div class="print_article"><a href="/print/?id=<?=$arResult["ID"]?>" title="Распечатать статью" target="_blank" class="add">Распечатать статью</a></div>
	<div class="clear"></div>
	<?if(!empty($arResult["TAGS_LINKS"])):?>
		<div class="tags_cloud">
			<div class="tags">
				<?foreach($arResult["TAGS_LINKS"] as $link):?>
					<a href="<?=$link["URL"]?>"><?=$link["NAME"]?></a>
				<?endforeach;?>
			</div>
		</div>
	<?endif;?>
</div>
<br />
