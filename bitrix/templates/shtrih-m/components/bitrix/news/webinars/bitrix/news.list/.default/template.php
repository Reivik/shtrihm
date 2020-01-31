<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<script type="text/javascript" src="/design/js/webinar_search.js?4"></script>
<div class="webinars_container">
    <div class="webinars_title">
        <h1>ВИДЕОУРОКИ</h1>
		<div class="webinar_switcher">
			<div class="partner">
				<span data-aim="for_partner" class="active">
					<img src="../../images/web-partners.png" />
					Партнерам
				</span>
			</div>
			<div class="client">
				<span data-aim="for_client" >
					<img src="../../images/web-clients.png" />
					Клиентам
				</span>
			</div>
			<input type="text" id="webinar_search" placeholder="Поиск по вебинарам" />
		</div>
        <p></p>
    </div>
    <div class="webinars_list for_partner active">
        <?foreach($arResult["ITEMS"] as $arItem):?>
        <?
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
		$link = $arItem["PROPERTIES"]["LINK"]["VALUE"] . '" target="_blank';
		if(strpos($link,'youtube') || $arItem["PROPERTIES"]["FILE"]["VALUE"]!="") {
			$link = $arItem["DETAIL_PAGE_URL"];
		}
        ?>
        <?if ($arItem["IBLOCK_SECTION_ID"] == '530') {?>
		<a href="<?=$link?>">
        	<div class="webinars_list_item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
				<div class="img_item" style="background:url('<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>') no-repeat scroll center center;">
					<div class="section_name partners">
					</div>
					<div class="time">
						<?if($arItem["PROPERTIES"]["TIME"]["VALUE"]) {?>
							<p>
								Продолжительность: <?=$arItem["PROPERTIES"]["TIME"]["VALUE"]?>
							</p>
						<?}?>
					</div>
				</div>
				<div class="text_item">
					<h2>
						<span>Видеоурок</span><br/>
						<?=$arItem["NAME"]?>
					</h2>
					<p><?=$arItem["PREVIEW_TEXT"]?></p>
				</div>
			</div>
		</a>
        <?}?>
        <?endforeach;?>
    </div>
    <div class="webinars_list for_client">
        <?foreach($arResult["ITEMS"] as $arItem):?>
            <?
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
			$link = $arItem["PROPERTIES"]["LINK"]["VALUE"] . '" target="_blank';
			if(strpos($link,'youtube') || $arItem["PROPERTIES"]["FILE"]["VALUE"]!="") {
				$link = $arItem["DETAIL_PAGE_URL"];
			}
			?>
            <?if ($arItem["IBLOCK_SECTION_ID"] == '531') {?>
				<a href="<?=$link?>">
					<div class="webinars_list_item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
						<div class="img_item" style="background:url('<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>') no-repeat scroll center center;">
							<div class="section_name clients">
							</div>
							<div class="time">
								<?if($arItem["PROPERTIES"]["TIME"]["VALUE"]) {?>
									<p>
										Продолжительность: <?=$arItem["PROPERTIES"]["TIME"]["VALUE"]?>
									</p>
								<?}?>
								</div>
						</div>
						<div class="text_item">
							<h2>
								<span>Видеоурок</span><br/>
								<?=$arItem["NAME"]?>
							</h2>
							<p><?=$arItem["PREVIEW_TEXT"]?></p>
						</div>
					</div>
				</a>
            <?}?>
        <?endforeach;?>
    </div>
<?/*if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;*/?>
</div>
