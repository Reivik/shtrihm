<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="popups_container">
    <?foreach($arResult["ITEMS"] as $arItem):?>
    <?
    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
    ?>
    <?$name = str_replace('"', '', $arItem["NAME"]);?>
    <div class="popup_wnd till<?=$arItem['ID']?>">
        <div class="close_popup"></div>
        <div class="left_part">
            <div class="imgs">
                <div class="main_pic js-pic-slidetill<?=$arItem['ID']?>">
                    <?if ($arItem['DETAIL_PICTURE']['SRC']) {?>
                    <div class="img">
                        <img src="<?=$arItem['DETAIL_PICTURE']['SRC']?>" alt="<?=$arItem['NAME']?>">
                    </div>
                    <?}?>
                    <?if ($arItem['DISPLAY_PROPERTIES']['MORE_PHOTO']['VALUE']) {?>
                        <?foreach ($arItem['DISPLAY_PROPERTIES']['MORE_PHOTO']['VALUE'] as $arPhot) {?>
                        <div class="img">
                            <img src="<?=CFile::GetPath($arPhot)?>" alt="<?=$arItem['NAME']?>">
                        </div>
                        <?}?>
                    <?}?>
                </div>
                <div class="small_pic js-small-pic-slidetill<?=$arItem['ID']?>">
                    <?if ($arItem['DETAIL_PICTURE']['SRC']) {?>
                        <div class="img">
                            <img src="<?=$arItem['DETAIL_PICTURE']['SRC']?>" alt="<?=$arItem['NAME']?>">
                        </div>
                    <?}?>
                    <?if ($arItem['DISPLAY_PROPERTIES']['MORE_PHOTO']['VALUE']) {?>
                        <?foreach ($arItem['DISPLAY_PROPERTIES']['MORE_PHOTO']['VALUE'] as $arPhot) {?>
                            <div class="img">
                                <img src="<?=CFile::GetPath($arPhot)?>" alt="<?=$arItem['NAME']?>">
                            </div>
                        <?}?>
                    <?}?>
                </div>
            </div>
            <div class="price_block">
                <?=$arItem["PROPERTIES"]["PRICE_WITH_FN"]["VALUE"]?> Р<?=$arItem["PROPERTIES"]["PRICE_DESC"]["VALUE"]?>
            </div>
            <div class="buttons_buy">
                <?if($arItem['ID']=="30481"){?>
                    <a onclick="OpenFormNewRos<?if ($arItem['DISPLAY_PROPERTIES']['SPEC_LINK']['VALUE']) {?>New<?}?><?=$arItem['ID']?>();">Заказать</a><a href="<?=$arItem['PROPERTIES']['DETAILS_URL_CUSTOM']['VALUE']?>">Подробнее</a>
                <?}else{?>
                    <a onclick="OpenForm<?if ($arItem['DISPLAY_PROPERTIES']['SPEC_LINK']['VALUE']) {?>New<?}?><?=$arItem['ID']?>();">Заказать</a><a href="<?=$arItem['PROPERTIES']['DETAILS_URL_CUSTOM']['VALUE']?>">Подробнее</a>
                <?}?>
                
            </div>
        </div>
        <div class="right_part">
            <span><?=$arItem["NAME"]?></span>
            <p><?=$arItem["PREVIEW_TEXT"]?></p>
            <div style="display:none;"><?echo '<pre>';print_r($arItem['DISPLAY_PROPERTIES']['FOR_WHO']); echo '</pre>';?></div>
            <?if ($arItem['DISPLAY_PROPERTIES']['FOR_WHO']['VALUE']) {?>
            <div class="for_who">
                <span>Кому подходит?</span>
                <p><?=$arItem['DISPLAY_PROPERTIES']['FOR_WHO']['DISPLAY_VALUE']?></p>
            </div>
            <?}?>
            <div style="display:none;"><?echo '<pre>';print_r($arItem['DISPLAY_PROPERTIES']['SUPPLY_FOR']); echo '</pre>';?></div>
            <?if ($arItem['DISPLAY_PROPERTIES']['SUPPLY_FOR']['VALUE']) {?>
            <div class="supply">
                <span>Совместимо с…</span>
                <p><?=$arItem['DISPLAY_PROPERTIES']['SUPPLY_FOR']['DISPLAY_VALUE']?></p>
            </div>
            <?}?>
            <div style="display:none;"><?echo '<pre>';print_r($arItem['DISPLAY_PROPERTIES']['FILTER_ON']); echo '</pre>';?></div>

            <?if ($arItem['DISPLAY_PROPERTIES']['FILTER_ON']['VALUE']) {?>
            <div class="pictos">
                <ul>
                    <?foreach ($arItem['DISPLAY_PROPERTIES']['FILTER_ON']['VALUE'] as $key => $arPictoGram) {?>
                        <li class="pg<?=$arItem['DISPLAY_PROPERTIES']['FILTER_ON']['VALUE_XML_ID'][$key]?>"><span><?=$arPictoGram?></span></li>
                    <?}?>
                </ul>
            </div>
            <?}?>
        </div>
    </div>
    <?endforeach;?>
</div>
<div class="reg_page">
	<div class="partner_banner_new till_banner_new">
        <div class="banner_white">
            <div class="partner_banner_inf">
                <h1>ОНЛАЙН-КАССЫ</h1>
                <p>Комплексное предложение включает в себя современный кассовый аппарат и фискальный накопитель на 15 месяцев</p>
            </div>
        </div>
	</div>
    <div class="char_filter">
        <h2>Укажите важные для вас характеристики онлайн-кассы</h2>
        <ul>
            <li data-group="f11"><span></span><p>Автономная работа
                    от встроенного
                    аккумулятора</p></li>
            <li data-group="f12"><span></span><p>Прием безналичных
                    средств платежа</p></li>
            <li data-group="f13"><span></span><p>Подходит для работы
                    в системе ЕГАИС</p></li>
            <li data-group="f14"><span></span><p>Узкая лента 57 мм</p></li>
            <li data-group="f15"><span></span><p>Широкая лента 80 мм</p></li>
            <li data-group="f16"><span></span><p>Автоотрезчик</p></li>
        </ul>
    </div>
    <div class="main_table">
        <?foreach($arResult["ITEMS"] as $arItem):?>
        <?
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

        //print_r($arItem['DISPLAY_PROPERTIES']);
        ?>
        <?$name = str_replace('"', '', $arItem["NAME"]);?>
        <div class="item_cell <?foreach ($arItem['DISPLAY_PROPERTIES']['FILTER_ON']['VALUE_XML_ID'] as $arFid) {echo 'f'.$arFid.' ';}?>" id="<?=$this->GetEditAreaId($arItem['ID']);?>">

            <div class="cell_title js-popup" data-till="till<?=$arItem['ID']?>">
                <h3><?=$arItem["NAME"]?></h3>
            </div>
            <div class="img_block_cell">
                <?if ($arItem["DISPLAY_PROPERTIES"]["FZ54_IN"]["VALUE"] == "Хит") {?>
                <div class="true_sticker hit_sticker">
                    ХИТ
                </div>
                <?}?>
                <?if ($arItem["DISPLAY_PROPERTIES"]["FZ54_IN"]["VALUE"] == "Новинка") {?>
                    <div class="true_sticker nov_sticker">
                        Новинка
                    </div>
                <?}?>
                <?if ($arItem["DISPLAY_PROPERTIES"]["FZ54_IN"]["VALUE"] && $arItem["DISPLAY_PROPERTIES"]["FZ54_IN"]["VALUE"] != "Новинка" && $arItem["DISPLAY_PROPERTIES"]["FZ54_IN"]["VALUE"] != "Хит") {?>
                    <div class="true_sticker gr_sticker">
                        Готовое решение
                    </div>
                <?}?>
                <div class="img_inner js-popup" data-till="till<?=$arItem['ID']?>">
                    <div class="fast_load"><a>Быстрый просмотр</a></div>
                    <img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="">
                </div>
            </div>
            <div class="price_block_cell">
                <span><?=$arItem["PROPERTIES"]["PRICE_WITH_FN"]["VALUE"]?> Р</span><a id="<?if ($arItem['DISPLAY_PROPERTIES']['SPEC_LINK']['VALUE']) {?>New<?}?><?=$arItem['ID']?>" onclick="OpenForm<?if ($arItem['DISPLAY_PROPERTIES']['SPEC_LINK']['VALUE']) {?>New<?}?><?=$arItem['ID']?>();">Заказать</a>
            </div>
        </div>
            <script>
                function OpenForm<?=$arItem['ID']?>() {
                    
                    <?
                    //print_r($arItem['DISPLAY_PROPERTIES']);
                    if($arItem['DISPLAY_PROPERTIES']['NEW_POPUP']['VALUE']=="Да"){?>
                        $('form[name=ONLINE_BILL_KVSDC]').addClass('js-form-address');
                        $('form[name=ONLINE_BILL_KVSDC]').find(".title_form").html("Заявка на онлайн-кассы")
                        $("body").addClass('body_stop');
                        $('#modal_new').css('display', 'block');
                        product_online_till_add2('<?=$name?>');
                    <?}else{?>
                        $('form[name=ONLINE_BILL]').addClass('js-form-address');
                        $('form[name=ONLINE_BILL]').find(".title_form").html("Заявка на онлайн-кассы")
                        $("body").addClass('body_stop');
                        $('#modal').css('display', 'block');
                        product_online_till_add('<?=$name?>');
                    <?}?>
                    
                    
                    //$('input[name=form_text_70]').val('<?=$arItem["NAME"]?>:1');
                }
                function OpenFormNew<?=$arItem['ID']?>() {
                    $('form[name=ONLINE_BILL]').addClass('js-form-address');
                    $('form[name=ONLINE_BILL]').attr('action', '/catalog/online-till/send.php');
                    $('form[name=ONLINE_BILL]').find(".title_form").html("Заявка на онлайн-кассы")
                    $('.send_button').attr('name', '');
                    //$("body").addClass('body_stop');
                    $('#modal').css('display', 'block');
                    product_online_till_add('<?=$name?>');
                }

                function OpenFormNewRos<?=$arItem['ID']?>() {
                    $('form[name=ONLINE_BILL]').addClass('js-form-address');
                    //$('form[name=ONLINE_BILL]').attr('action', '/catalog/online-till/ready.php');
                    $('form[name=ONLINE_BILL]').find(".title_form").html("Заявка на кассу ростелеком")
                    //$('.send_button').attr('name', '');
                    //$("body").addClass('body_stop');
                    $('#modal').css('display', 'block');
                    product_online_till_add_ros('<?=$name?>');
                }

                
            </script>
        <?endforeach;?>
    </div>
	<div class='reset_btn hide_item'>
		<a class='filter-reset'>Все кассы</a>
	</div>
<script>
	var array_product = [<?foreach($arResult["ITEMS"] as $key=>$arItem):?>
	<?$name = str_replace('"', '', $arItem["NAME"]);?>
	<?$price = str_replace(' ', '', $arItem["PROPERTIES"]["PRICE_WITH_FN"]["VALUE"]);?><?if ($key == 0) {?>['<?=$name?>', '<?=$price?>']<?}else{?>, ['<?=$name?>', '<?=$price?>']<?}?><?endforeach;?>];
    $(document).ready(function(){
	    $('.char_filter ul li').click(function(){
            var filter_item = $(this).data('group');
            if ($(this).hasClass('active')) {
                $('.char_filter ul li').removeClass('active');
                $('.item_cell').removeClass('hide_item');
				$('.reset_btn').addClass('hide_item');
            }else {
                $('.char_filter ul li').removeClass('active');
                $(this).addClass('active');
                $('.item_cell').addClass('hide_item');
                $('.' + filter_item + '').removeClass('hide_item');
				$('.reset_btn').removeClass('hide_item');
            }
        });
	    $('.filter-reset').click(function(){
            $('.char_filter ul li').removeClass('active');
            $('.item_cell').removeClass('hide_item');
			$('.reset_btn').addClass('hide_item');
        });
    });
    $(document).ready(function(){
        $('.js-popup').click(function(){
            var till_id = $(this).data('till');
            $('.' + till_id + '').addClass('active');
            $('.popups_container').addClass('active');
            $('body').addClass('no-scroll');
            $('.js-pic-slide' + till_id + '').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: false,
                fade: true,
                asNavFor: '.js-small-pic-slide' + till_id +''
            });
            $('.js-small-pic-slide' + till_id + '').slick({
                slidesToShow: 4,
                slidesToScroll: 1,
                asNavFor: '.js-pic-slide' + till_id + '',
                dots: false,
                centerMode: false,
                focusOnSelect: true
            });
            $('.' + till_id + ' .close_popup').click(function(){
                $('.' + till_id + '').removeClass('active');
                $('body').removeClass('no-scroll');
                $('.popups_container').removeClass('active');
                $('.js-pic-slide' + till_id + '').slick('unslick');
                $('.js-small-pic-slide' + till_id + '').slick('unslick');
            });
        });
    });
    $(document).ready(function() {
        $(".popups_container").children().each(function() {
            $(this).html($(this).html().replace(/&#8232;/g," "));
        });
    });
</script>
</div>
