<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<form name="<? echo $arResult["FILTER_NAME"] . "_form" ?>" action="<? echo $arResult["FORM_ACTION"] ?>" method="get"
      class="smartfilter">
    <? foreach ($arResult["HIDDEN"] as $arItem): ?>
        <input type="hidden" name="<? echo $arItem["CONTROL_NAME"] ?>" id="<? echo $arItem["CONTROL_ID"] ?>"
               value="<? echo $arItem["HTML_VALUE"] ?>"/>
    <? endforeach; ?>
    <div class="row">
        <?
        foreach ($arResult["ITEMS"] as $key => $arItem)
        {
        //echo "<pre>"; print_r($arItem["VALUES"]); echo "</pre>";
        ?>
        <div class="col-lg-12 bx-filter-parameters-box <?
        if ($arItem["DISPLAY_EXPANDED"] == "Y"):?>bx-active<? endif ?>">
            <span class="bx-filter-container-modef"></span>
            <div class="bx-filter-parameters-box-title">
                <span class="bx-filter-parameters-box-hint"><?= $arItem["NAME"] ?></span>
            </div>

            <div class="bx-filter-block" data-role="bx_filter_block">
                <div class="row bx-filter-parameters-box-container">
                    <?
                    $arCur = current($arItem["VALUES"]);
                    $checkedItemExist = false;
                    ?>
                    <div class="col-xs-12">
                        <div class="bx-filter-select-container">
                            <div class="bx-filter-select-block"
                                 onclick="smartFilter.showDropDownPopup(this, '<?= CUtil::JSEscape($key) ?>')">
                                <div class="bx-filter-select-text" data-role="currentOption">
                                    <?
                                    foreach ($arItem["VALUES"] as $val => $ar) {
                                        if ($ar["CHECKED"]) {
                                            echo $ar["VALUE"];
                                            $checkedItemExist = true;
                                        }
                                    }
                                    if (!$checkedItemExist) {
                                        echo "ВСЕ";
                                    }
                                    ?>
                                </div>
                                <div class="bx-filter-select-arrow"></div>
                                <input

                                        style="display: none"
                                        type="radio"
                                        name="<?= $arCur["CONTROL_ID"] ?>"
                                        id="<? echo "all_" . $arCur["CONTROL_ID"] ?>"
                                        value=""
                                />
                                <div class="group">
                                    <input
                                        <?
                                        foreach ($arItem["VALUES"] as $val => $ar):?>
                                            <? $number = substr($ar["CONTROL_NAME"], 10, 3); ?>
                                            style="display: none"
                                            class="item-<?= $number; ?>"
                                            type="radio"
                                            value=""
                                            name="<? echo $ar["CONTROL_NAME"] ?>"
                                            id="all_<? echo $number ?>"
                                            <? echo "ВСЕ"; ?>
                                        <? endforeach; ?>
                                    />
                                    <?
                                    foreach ($arItem["VALUES"] as $val => $ar):?>
                                        <? $number = substr($ar["CONTROL_NAME"], 10, 3); ?>
                                        <input
                                                style="display: none"
                                                class="item-<?= $number; ?>"
                                                type="radio"
                                                value="<? echo $ar["HTML_VALUE"] ?>"
                                                name="<? echo $ar["CONTROL_NAME"] ?>"
                                                id="<? echo $ar["CONTROL_ID"] ?>"
                                            <? echo $ar["CHECKED"] ? 'checked="checked"' : '' ?>
                                        />
                                    <? endforeach ?>
                                </div>
                                <div class="bx-filter-select-popup" data-role="dropdownContent"
                                     style="display: none;">
										 <ul style="width:100px;">
                                        <li>
                                            <label
                                                <? foreach ($arItem["VALUES"] as $val => $ar): ?>
                                                    <? $number = substr($ar["CONTROL_NAME"], 10, 3); ?>
                                                    for="<?= "all_" . $number ?>"
                                                    data-role="label_<?= "all_" . $number ?>"
                                                    onclick="smartFilter.selectDropDownItem(this, '<?= CUtil::JSEscape("all_" . $number) ?>')"
                                                <? endforeach; ?>
                                                    class="bx-filter-param-label">
														<?="ВСЕ"?>
                                            </label>
                                        </li>
										<br/>
                                        <?
                                        foreach ($arItem["VALUES"] as $val => $ar):
                                            $class = "";
                                            if ($ar["CHECKED"])
                                                $class .= " selected";
                                            if ($ar["DISABLED"])
                                                $class .= " disabled";
                                            ?>
                                            <li>
                                                <label for="<?= $ar["CONTROL_ID"] ?>"
                                                       class="bx-filter-param-label<?= $class ?>"
                                                       data-role="label_<?= $ar["CONTROL_ID"] ?>"
                                                       onclick="smartFilter.selectDropDownItem(this, '<?= CUtil::JSEscape($ar["CONTROL_ID"]) ?>')"><?= $ar["VALUE"] ?>
                                                </label>
                                            </li>
                                        <? endforeach ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div style="clear: both"></div>
                </div>
            </div>
            <?
            }
            ?>
        </div><!--//row-->
        <!--Кнопки-->
        <div class="row">
            <div class="col-xs-12 bx-filter-button-box">
                <div class="bx-filter-block">
                    <div class="bx-filter-parameters-box-container">
                        <input
                                style="margin-right: 10px"
                                type="submit"
                                id="set_filter"
                                name="set_filter"
                                value="<?= GetMessage("CT_BCSF_SET_FILTER") ?>"
                        />
                        <input
                                type="submit"
                                id="del_filter"
                                name="del_filter"
                                value="<?= GetMessage("CT_BCSF_DEL_FILTER") ?>"
                        />
                    </div>
                </div>
            </div>
        </div>
        <!--/кнопки-->
        <div class="clb"></div>
    </div>
</form>


<script>
    var smartFilter = new JCSmartFilter('<?echo CUtil::JSEscape($arResult["FORM_ACTION"])?>');
</script>

<script>

    $(".item-696").on("click", function () {

        $(".item-696 ").removeAttr("checked"); // Снимаем чекбокс со всей группы
        $(this).prop("checked", true); // Оставляем выбранный чекбокс

    });

    $(".item-697").on("click", function () {

        $(".item-697").removeAttr("checked"); // Снимаем чекбокс со всей группы
        $(this).prop("checked", true); // Оставляем выбранный чекбокс

    });

</script>
