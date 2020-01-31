<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if(!empty($arResult)):?>
	<div class="aside">
		<div class="congratulations-list">	
			<article class="last">
				<a href="#">
					<div class="normal-state">
						<div class="img-wrap">
							<div class="img">
								<img src="<?=$arResult["PREVIEW_PICTURE"]["src"]?>" width="<?=$arResult["PREVIEW_PICTURE"]["width"]?>" height="<?=$arResult["PREVIEW_PICTURE"]["height"]?>" alt="" title="" />
							</div>
						</div>
					</div>
					<div class="active-state">
						<div class="left">
							<h2>поздравляем <span><?=$arResult["NAME"]?></span></h2>
							<p><?=$arResult["PREVIEW_TEXT"]?></p>
						</div>
						<div class="right">
							<div class="img-wrap">
								<div class="img">
									<img src="<?=$arResult["PREVIEW_PICTURE"]["src"]?>" width="<?=$arResult["PREVIEW_PICTURE"]["width"]?>" height="<?=$arResult["PREVIEW_PICTURE"]["height"]?>" alt="" title="" />
								</div>
							</div>
						</div>
					</div>
				</a>
				<div class="all">
					<a href='/partners_info/congratulation/'>Все поздравления</a>
				</div>
			</article>
			<div class="clear"></div>
		</div>
	</div>
<?endif;?>