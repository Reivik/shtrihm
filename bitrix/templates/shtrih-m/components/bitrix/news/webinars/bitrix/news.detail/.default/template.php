<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="webinars_container inner_container">
    <div class="webinar_title">
        <h1>
			<span>Видеоурок</span><br/>
			<?=$arResult["NAME"]?>
		</h1>
    </div>
	<div class="pagesNav" style="padding: 0 20px;">
		<a href="/" title="Главная">Главная</a> / 
		<a href="/support/" title="Поддержка">Поддержка</a> / 
		<a href="/support/webinars/" title="Вебинары">Вебинары</a>
	</div>
    <div class="webinars_list">
        <div class="webinars_list_item single">
            <div class="text_item">
				<?if ($arResult["DETAIL_TEXT"]!='') {?>
					<p><?=$arResult["DETAIL_TEXT"]?></p>
				<?}else{?>
					<p><?=$arResult["PREVIEW_TEXT"]?></p>
				<?}?>
                <div class="item_info">
                    <div class="develop">
                        Видеоурок создан:<br>
                        <?=$arResult["PROPERTIES"]["WHO"]["VALUE"]?>
                    </div>
                    <div class="section_name">
                        <a href="<?=$arResult["PROPERTIES"]["LINK"]["VALUE"]?>" target="_blank">Смотреть</a>
                    </div>
                </div>
            </div>
            <div class="web_video">
				<?
				$link = $arResult["PROPERTIES"]["LINK"]["VALUE"] . '" target="_blank';
				if(strpos($link,'youtube')) {
					$url=str_replace('watch?v=','embed/',$link);?>
				<iframe src="<?=$url?>" width="100%" height="100%" allowfullscreensrc="?rel=0&showinfo=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
				<?}else{
					$url = CFile::GetPath($arResult['PROPERTIES']['FILE']['VALUE']);?>
					<video width="100%" height="100%" controls="controls">
					   <source src="<?=$url?>">
					   Тег video не поддерживается вашим браузером.
					</video>
				<?}?>
            </div>
        </div>
    </div>
</div>
    <div class="another_list">
		<h2>Смотрите также:</h2>
        <div class="another_web_list">
            <?
            $arFilter = Array('IBLOCK_ID' => $arResult['IBLOCK_ID'], '!ID' => $arResult['ID'], 'ACTIVE' => 'Y');
            $arSelect = Array('ID', 'NAME', 'DETAIL_PAGE_URL', 'PREVIEW_PICTURE');
            $res = CIBlockElement::GetList(Array('ACTIVE_FROM'=>'DESC', 'SORT'=>'ASC'), $arFilter, false, false, $arSelect);
            while($ob = $res->GetNextElement())
            {
                $arFields = $ob->GetFields();
                $arResult['ANOTHER_ITEMS'][] = $arFields;
            }
            ?>
            <?foreach ($arResult['ANOTHER_ITEMS'] as $key => $arItem) {?>
            <?if ($key < 4) {?>
				<?
					$arProp = CIBlockElement::GetProperty($arResult['IBLOCK_ID'],$arItem['ID']);
					$PROPS = array();
					while($ar_props = $arProp->Fetch())
						$PROPS[$ar_props['CODE']] = $ar_props['VALUE'];
					$link = $PROPS["LINK"] . '" target="_blank';
					if(strpos($link,'youtube') || $PROPS["FILE"]) {
						$link = $arItem["DETAIL_PAGE_URL"];
					}
				?>
				<a href="<?=$link?>">
					<div class="small_item">
						<div class="img" style="background:url(<?=CFile::GetPath($arItem['PREVIEW_PICTURE'])?>) no-repeat scroll center center;">
						</div>
						<h3><?=$arItem['NAME']?></h3>
					</div>
				</a>
            <?}
            }?>
        </div>
    </div>
