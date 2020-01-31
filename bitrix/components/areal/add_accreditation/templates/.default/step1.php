<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<h2><?= GetMessage("STEP_1") ?></h2>
<div class="default_forms">
    <div class="field">
        <label class="field_label"><?= GetMessage("COMPANY_NAME") ?></label>
        <div class="inputContainer">
            <input type="text" name="PROPERTY[COMPANY_NAME]"
                   value='<?= $_REQUEST["PROPERTY"]["COMPANY_NAME"] ? htmlspecialchars($_REQUEST["PROPERTY"]["COMPANY_NAME"]) : htmlspecialchars($_SESSION["FORM"]["PROPERTY"]["COMPANY_NAME"]) ?>'/>
        </div>
    </div>
    <div class="field">
        <label class="field_label"><?= GetMessage("COMPANY_INN") ?></label>
        <div class="inputContainer">
            <input type="text" name="PROPERTY[COMPANY_INN]" class="inn_asc"
                   value="<?= $_REQUEST["PROPERTY"]["COMPANY_INN"] ? htmlspecialchars($_REQUEST["PROPERTY"]["COMPANY_INN"]) : htmlspecialchars($_SESSION["FORM"]["PROPERTY"]["COMPANY_INN"]) ?>"/>
        </div>
    </div>
    <div class="field">
        <label class="field_label"><?= GetMessage("COMPANY_KPP") ?></label>
        <div class="inputContainer">
            <input type="text" name="PROPERTY[COMPANY_KPP]" class="number"
                   value="<?= $_REQUEST["PROPERTY"]["COMPANY_KPP"] ? htmlspecialchars($_REQUEST["PROPERTY"]["COMPANY_KPP"]) : htmlspecialchars($_SESSION["FORM"]["PROPERTY"]["COMPANY_KPP"]) ?>"/>
        </div>
    </div>
    <div class="two_input_container">
        <div class="field">
            <label class="field_label"><?= GetMessage("REGION") ?></label>
            <? if (!empty($_REQUEST["PROPERTY"]["COMPANY_REGION"]))
                $select_region = $_REQUEST["PROPERTY"]["COMPANY_REGION"];
            elseif (!empty($_SESSION["FORM"]["PROPERTY"]["COMPANY_REGION"]))
                $select_region = $_SESSION["FORM"]["PROPERTY"]["COMPANY_REGION"];
            else
                $select_region = $arResult["SELECTED_REGION"];
            ?>
            <select name="PROPERTY[COMPANY_REGION]" title="REGION__" class="region">
                <option value="0"><?= GetMessage("REGION") ?></option>
                <? foreach ($arResult["REGIONS"] as $key => $region): ?>
                    <option value="<?= $key ?>" <? if ($key == $select_region): ?> selected="selected" <? endif; ?>><?= $region ?></option>
                <? endforeach; ?>
            </select>
        </div>
        <div class="field last">
            <label class="field_label"><?= GetMessage("TOWN") ?></label>
            <? if (!empty($_REQUEST["PROPERTY"]["COMPANY_TOWN"]))
                $select_town = $_REQUEST["PROPERTY"]["COMPANY_TOWN"];
            elseif (!empty($_SESSION["FORM"]["PROPERTY"]["COMPANY_TOWN"]))
                $select_town = $_SESSION["FORM"]["PROPERTY"]["COMPANY_TOWN"];
            else
                $select_town = $arResult["SELECTED_TOWN"];
            ?>
            <select name="PROPERTY[COMPANY_TOWN]" id="REGION__" class="town">
                <option value="0"><?= GetMessage("TOWN") ?></option>
                <? foreach ($arResult["TOWNS"][$select_region] as $k => $town): ?>
                    <option value="<?= $k ?>" <? if ($k == $select_town): ?> selected="selected" <? endif; ?>><?= $town ?></option>
                <? endforeach; ?>
            </select>
        </div>
        <div class="clear"></div>
    </div>
    <div class="three_buttons">
        <button name="integrator" class="integrator orange_submit">Интегратор</button>
        <button name="service-partner" class="service-partner orange_submit">Сервис-партнер</button>
        <button name="asc" class="asc orange_submit">АСЦ</button>
    </div>
    <?
    if (!empty($_REQUEST["PROPERTY"]["COMPANY_KKT"]))
        $req_items = $_REQUEST["PROPERTY"]["COMPANY_KKT"];
    else
        $req_items = $_SESSION["FORM"]["PROPERTY"]["COMPANY_KKT"];
    ?>
    <div class="field">
        <div class="products accreditation zero-cont hidden">
            <label class="label_check" for="item_0">
                <input name="PROPERTY[TYPE]" id="item_0" value="Интегратор"
                       type="checkbox" <? if (in_array(0, $req_items)): ?> checked="checked" <? endif; ?>>
                Интегратор
            </label>
            <label class="label_check" for="item_-1">
                <input name="PROPERTY[TYPE]" id="item_-1" value="Сервис-партнер"
                       type="checkbox" <? if (in_array(-1, $req_items)): ?> checked="checked" <? endif; ?>>
                Сервис-партнер
            </label>
            <label class="label_check" for="item_-2">
                <input name="PROPERTY[TYPE]" id="item_-2" value="АСЦ"
                       type="checkbox" <? if (in_array(-2, $req_items)): ?> checked="checked" <? endif; ?>>
                АСЦ
            </label>
        </div>
        <div class="products accreditation first-cont">
            <label class="field_label">Список ККТ</label>
            <label class="label_check" for="item_21700">
                <input name="PROPERTY[COMPANY_KKT][21700]" id="item_21700" value="21700"
                       type="checkbox" <? if (in_array(21700, $req_items)): ?> checked="checked" <? endif; ?>>
                ККТ «ШТРИХ-ON-LINE»
            </label>
<!--            --><?// if (isset($_SESSION["FORM"]["COUNTERS"][21700])): ?>
<!--                <div class='productCountInfo'>-->
<!--                    <label class='field_label'>Количество ККМ данной модели на обслуживании</label><br/>-->
<!--                    <input type='text' name='COUNTERS[21700][NOW]'-->
<!--                           value='--><?//= htmlspecialchars($_SESSION["FORM"]["COUNTERS"][21700]['NOW']) ?><!--'/><br/>-->
<!--                    <label class='field_label'>Планируемый среднемесячный объем закупок</label><br/>-->
<!--                    <input type='text' name='COUNTERS[21700][PLAN]'-->
<!--                           value='--><?//= htmlspecialchars($_SESSION["FORM"]["COUNTERS"][21700]['PLAN']) ?><!--'/>-->
<!--                </div>-->
<!--            --><?// endif; ?>
            <label class="label_check" for="item_22639">
                <input name="PROPERTY[COMPANY_KKT][22639]" id="item_22639" value="22639"
                       type="checkbox" <? if (in_array(22639, $req_items)): ?> checked="checked" <? endif; ?>>
                ККТ «ШТРИХ-ЛАЙТ-01Ф»
            </label>
<!--            --><?// if (isset($_SESSION["FORM"]["COUNTERS"][22639])): ?>
<!--                <div class='productCountInfo'>-->
<!--                    <label class='field_label'>Количество ККМ данной модели на обслуживании</label><br/>-->
<!--                    <input type='text' name='COUNTERS[22639][NOW]'-->
<!--                           value='--><?//= htmlspecialchars($_SESSION["FORM"]["COUNTERS"][22639]['NOW']) ?><!--'/><br/>-->
<!--                    <label class='field_label'>Планируемый среднемесячный объем закупок</label><br/>-->
<!--                    <input type='text' name='COUNTERS[22639][PLAN]'-->
<!--                           value='--><?//= htmlspecialchars($_SESSION["FORM"]["COUNTERS"][22639]['PLAN']) ?><!--'/>-->
<!--                </div>-->
<!--            --><?// endif; ?>
            <label class="label_check" for="item_22640">
                <input name="PROPERTY[COMPANY_KKT][22640]" id="item_22640" value="22640"
                       type="checkbox" <? if (in_array(22640, $req_items)): ?> checked="checked" <? endif; ?>>
                ККТ «ШТРИХ-М-01Ф»
            </label>
<!--            --><?// if (isset($_SESSION["FORM"]["COUNTERS"][22640])): ?>
<!--                <div class='productCountInfo'>-->
<!--                    <label class='field_label'>Количество ККМ данной модели на обслуживании</label><br/>-->
<!--                    <input type='text' name='COUNTERS[22640][NOW]'-->
<!--                           value='--><?//= htmlspecialchars($_SESSION["FORM"]["COUNTERS"][22640]['NOW']) ?><!--'/><br/>-->
<!--                    <label class='field_label'>Планируемый среднемесячный объем закупок</label><br/>-->
<!--                    <input type='text' name='COUNTERS[22640][PLAN]'-->
<!--                           value='--><?//= htmlspecialchars($_SESSION["FORM"]["COUNTERS"][22640]['PLAN']) ?><!--'/>-->
<!--                </div>-->
<!--            --><?// endif; ?>
            <label class="label_check" for="item_799">
                <input name="PROPERTY[COMPANY_KKT][799]" id="item_799" value="799"
                       type="checkbox" <? if (in_array(799, $req_items)): ?> checked="checked" <? endif; ?>>
                ККТ «ШТРИХ-ФР-01Ф»
            </label>
<!--            --><?// if (isset($_SESSION["FORM"]["COUNTERS"][799])): ?>
<!--                <div class='productCountInfo'>-->
<!--                    <label class='field_label'>Количество ККМ данной модели на обслуживании</label><br/>-->
<!--                    <input type='text' name='COUNTERS[799][NOW]'-->
<!--                           value='--><?//= htmlspecialchars($_SESSION["FORM"]["COUNTERS"][799]['NOW']) ?><!--'/><br/>-->
<!--                    <label class='field_label'>Планируемый среднемесячный объем закупок</label><br/>-->
<!--                    <input type='text' name='COUNTERS[799][PLAN]'-->
<!--                           value='--><?//= htmlspecialchars($_SESSION["FORM"]["COUNTERS"][799]['PLAN']) ?><!--'/>-->
<!--                </div>-->
<!--            --><?// endif; ?>
            <label class="label_check" for="item_14867">
                <input name="PROPERTY[COMPANY_KKT][14867]" id="item_14867" value="14867"
                       type="checkbox" <? if (in_array(14867, $req_items)): ?> checked="checked" <? endif; ?>>
                ККТ «ШТРИХ-МИНИ-02Ф»
            </label>
<!--            --><?// if (isset($_SESSION["FORM"]["COUNTERS"][14867])): ?>
<!--                <div class='productCountInfo'>-->
<!--                    <label class='field_label'>Количество ККМ данной модели на обслуживании</label><br/>-->
<!--                    <input type='text' name='COUNTERS[14867][NOW]'-->
<!--                           value='--><?//= htmlspecialchars($_SESSION["FORM"]["COUNTERS"][14867]['NOW']) ?><!--'/><br/>-->
<!--                    <label class='field_label'>Планируемый среднемесячный объем закупок</label><br/>-->
<!--                    <input type='text' name='COUNTERS[14867][PLAN]'-->
<!--                           value='--><?//= htmlspecialchars($_SESSION["FORM"]["COUNTERS"][14867]['PLAN']) ?><!--'/>-->
<!--                </div>-->
<!--            --><?// endif; ?>
            <label class="label_check" for="item_24458">
                <input name="PROPERTY[COMPANY_KKT][24458]" id="item_24458" value="24458"
                       type="checkbox" <? if (in_array(24458, $req_items)): ?> checked="checked" <? endif; ?>>
                ККТ «Элвес-МФ»
            </label>
<!--            --><?// if (isset($_SESSION["FORM"]["COUNTERS"][24458])): ?>
<!--                <div class='productCountInfo'>-->
<!--                    <label class='field_label'>Количество ККМ данной модели на обслуживании</label><br/>-->
<!--                    <input type='text' name='COUNTERS[24458][NOW]'-->
<!--                           value='--><?//= htmlspecialchars($_SESSION["FORM"]["COUNTERS"][24458]['NOW']) ?><!--'/><br/>-->
<!--                    <label class='field_label'>Планируемый среднемесячный объем закупок</label><br/>-->
<!--                    <input type='text' name='COUNTERS[24458][PLAN]'-->
<!--                           value='--><?//= htmlspecialchars($_SESSION["FORM"]["COUNTERS"][24458]['PLAN']) ?><!--'/>-->
<!--                </div>-->
<!--            --><?// endif; ?>
            <label class="label_check" for="item_725">
                <input name="PROPERTY[COMPANY_KKT][725]" id="item_725" value="725"
                       type="checkbox" <? if (in_array(725, $req_items)): ?> checked="checked" <? endif; ?>>
                ККТ «ШТРИХ-ЛАЙТ-02Ф»
            </label>
<!--            --><?// if (isset($_SESSION["FORM"]["COUNTERS"][725])): ?>
<!--                <div class='productCountInfo'>-->
<!--                    <label class='field_label'>Количество ККМ данной модели на обслуживании</label><br/>-->
<!--                    <input type='text' name='COUNTERS[725][NOW]'-->
<!--                           value='--><?//= htmlspecialchars($_SESSION["FORM"]["COUNTERS"][725]['NOW']) ?><!--'/><br/>-->
<!--                    <label class='field_label'>Планируемый среднемесячный объем закупок</label><br/>-->
<!--                    <input type='text' name='COUNTERS[725][PLAN]'-->
<!--                           value='--><?//= htmlspecialchars($_SESSION["FORM"]["COUNTERS"][725]['PLAN']) ?><!--'/>-->
<!--                </div>-->
<!--            --><?// endif; ?>
            <label class="label_check" for="item_567">
                <input name="PROPERTY[COMPANY_KKT][567]" id="item_567" value="567"
                       type="checkbox" <? if (in_array(567, $req_items)): ?> checked="checked" <? endif; ?>>
                ККТ «ШТРИХ-М-02-Ф»
            </label>
<!--            --><?// if (isset($_SESSION["FORM"]["COUNTERS"][567])): ?>
<!--                <div class='productCountInfo'>-->
<!--                    <label class='field_label'>Количество ККМ данной модели на обслуживании</label><br/>-->
<!--                    <input type='text' name='COUNTERS[567][NOW]'-->
<!--                           value='--><?//= htmlspecialchars($_SESSION["FORM"]["COUNTERS"][567]['NOW']) ?><!--'/><br/>-->
<!--                    <label class='field_label'>Планируемый среднемесячный объем закупок</label><br/>-->
<!--                    <input type='text' name='COUNTERS[567][PLAN]'-->
<!--                           value='--><?//= htmlspecialchars($_SESSION["FORM"]["COUNTERS"][567]['PLAN']) ?><!--'/>-->
<!--                </div>-->
<!--            --><?// endif; ?>
            <label class="label_check" for="item_797">
                <input name="PROPERTY[COMPANY_KKT][797]" id="item_797" value="797"
                       type="checkbox" <? if (in_array(797, $req_items)): ?> checked="checked" <? endif; ?>>
                ККТ «ШТРИХ-МИНИ-01Ф»
            </label>
<!--            --><?// if (isset($_SESSION["FORM"]["COUNTERS"][797])): ?>
<!--                <div class='productCountInfo'>-->
<!--                    <label class='field_label'>Количество ККМ данной модели на обслуживании</label><br/>-->
<!--                    <input type='text' name='COUNTERS[797][NOW]'-->
<!--                           value='--><?//= htmlspecialchars($_SESSION["FORM"]["COUNTERS"][797]['NOW']) ?><!--'/><br/>-->
<!--                    <label class='field_label'>Планируемый среднемесячный объем закупок</label><br/>-->
<!--                    <input type='text' name='COUNTERS[797][PLAN]'-->
<!--                           value='--><?//= htmlspecialchars($_SESSION["FORM"]["COUNTERS"][797]['PLAN']) ?><!--'/>-->
<!--                </div>-->
<!--            --><?// endif; ?>
            <label class="label_check" for="item_27793">
                <input name="PROPERTY[COMPANY_KKT][27793]" id="item_27793" value="27793"
                       type="checkbox" <? if (in_array(27793, $req_items)): ?> checked="checked" <? endif; ?>>
                ККТ «ШТРИХ СМАРТПОС-Ф»
            </label>
<!--            --><?// if (isset($_SESSION["FORM"]["COUNTERS"][27793])): ?>
<!--                <div class='productCountInfo'>-->
<!--                    <label class='field_label'>Количество ККМ данной модели на обслуживании</label><br/>-->
<!--                    <input type='text' name='COUNTERS[27793][NOW]'-->
<!--                           value='--><?//= htmlspecialchars($_SESSION["FORM"]["COUNTERS"][27793]['NOW']) ?><!--'/><br/>-->
<!--                    <label class='field_label'>Планируемый среднемесячный объем закупок</label><br/>-->
<!--                    <input type='text' name='COUNTERS[27793][PLAN]'-->
<!--                           value='--><?//= htmlspecialchars($_SESSION["FORM"]["COUNTERS"][27793]['PLAN']) ?><!--'/>-->
<!--                </div>-->
<!--            --><?// endif; ?>
            <label class="label_check" for="item_27792">
                <input name="PROPERTY[COMPANY_KKT][27792]" id="item_27792" value="27792"
                       type="checkbox" <? if (in_array(27792, $req_items)): ?> checked="checked" <? endif; ?>>
                ККТ «ШТРИХ-НАНО-Ф»
            </label>
<!--            --><?// if (isset($_SESSION["FORM"]["COUNTERS"][27792])): ?>
<!--                <div class='productCountInfo'>-->
<!--                    <label class='field_label'>Количество ККМ данной модели на обслуживании</label><br/>-->
<!--                    <input type='text' name='COUNTERS[27792][NOW]'-->
<!--                           value='--><?//= htmlspecialchars($_SESSION["FORM"]["COUNTERS"][27792]['NOW']) ?><!--'/><br/>-->
<!--                    <label class='field_label'>Планируемый среднемесячный объем закупок</label><br/>-->
<!--                    <input type='text' name='COUNTERS[27792][PLAN]'-->
<!--                           value='--><?//= htmlspecialchars($_SESSION["FORM"]["COUNTERS"][27792]['PLAN']) ?><!--'/>-->
<!--                </div>-->
<!--            --><?// endif; ?>
            <label class="label_check" for="item_26424">
                <input name="PROPERTY[COMPANY_KKT][26424]" id="item_26424" value="26424"
                       type="checkbox" <? if (in_array(26424, $req_items)): ?> checked="checked" <? endif; ?>>
                ККТ «ЭЛВЕС-ФР-Ф»
            </label>
<!--            --><?// if (isset($_SESSION["FORM"]["COUNTERS"][26424])): ?>
<!--                <div class='productCountInfo'>-->
<!--                    <label class='field_label'>Количество ККМ данной модели на обслуживании</label><br/>-->
<!--                    <input type='text' name='COUNTERS[26424][NOW]'-->
<!--                           value='--><?//= htmlspecialchars($_SESSION["FORM"]["COUNTERS"][26424]['NOW']) ?><!--'/><br/>-->
<!--                    <label class='field_label'>Планируемый среднемесячный объем закупок</label><br/>-->
<!--                    <input type='text' name='COUNTERS[26424][PLAN]'-->
<!--                           value='--><?//= htmlspecialchars($_SESSION["FORM"]["COUNTERS"][26424]['PLAN']) ?><!--'/>-->
<!--                </div>-->
<!--            --><?// endif; ?>
            <label class="label_check" for="item_25601">
                <input name="PROPERTY[COMPANY_KKT][25601]" id="item_25601" value="25601"
                       type="checkbox" <? if (in_array(25601, $req_items)): ?> checked="checked" <? endif; ?>>
                ККТ «ШТРИХ-ФР-02Ф»
            </label>
<!--            --><?// if (isset($_SESSION["FORM"]["COUNTERS"][25601])): ?>
<!--                <div class='productCountInfo'>-->
<!--                    <label class='field_label'>Количество ККМ данной модели на обслуживании</label><br/>-->
<!--                    <input type='text' name='COUNTERS[25601][NOW]'-->
<!--                           value='--><?//= htmlspecialchars($_SESSION["FORM"]["COUNTERS"][25601]['NOW']) ?><!--'/><br/>-->
<!--                    <label class='field_label'>Планируемый среднемесячный объем закупок</label><br/>-->
<!--                    <input type='text' name='COUNTERS[25601][PLAN]'-->
<!--                           value='--><?//= htmlspecialchars($_SESSION["FORM"]["COUNTERS"][25601]['PLAN']) ?><!--'/>-->
<!--                </div>-->
<!--            --><?// endif; ?>
        </div>
        <div class="products accreditation second-cont">
            <label class="field_label">Список АСПД</label>
            <label class="label_check" for="item_796">
                <input name="PROPERTY[COMPANY_KKT][796]" id="item_796" value="796"
                       type="checkbox" <? if (in_array(796, $req_items)): ?> checked="checked" <? endif; ?>>
                АСПД «ШТРИХ-LIGHT 200»
            </label>
<!--            --><?// if (isset($_SESSION["FORM"]["COUNTERS"][796])): ?>
<!--                <div class='productCountInfo'>-->
<!--                    <label class='field_label'>Количество ККМ данной модели на обслуживании</label><br/>-->
<!--                    <input type='text' name='COUNTERS[796][NOW]'-->
<!--                           value='--><?//= htmlspecialchars($_SESSION["FORM"]["COUNTERS"][796]['NOW']) ?><!--'/><br/>-->
<!--                    <label class='field_label'>Планируемый среднемесячный объем закупок</label><br/>-->
<!--                    <input type='text' name='COUNTERS[796][PLAN]'-->
<!--                           value='--><?//= htmlspecialchars($_SESSION["FORM"]["COUNTERS"][796]['PLAN']) ?><!--'/>-->
<!--                </div>-->
<!--            --><?// endif; ?>
            <label class="label_check" for="item_733">
                <input name="PROPERTY[COMPANY_KKT][733]" id="item_733" value="733"
                       type="checkbox" <? if (in_array(733, $req_items)): ?> checked="checked" <? endif; ?>>
                АСПД «ШТРИХ-М 200»
            </label>
<!--            --><?// if (isset($_SESSION["FORM"]["COUNTERS"][733])): ?>
<!--                <div class='productCountInfo'>-->
<!--                    <label class='field_label'>Количество ККМ данной модели на обслуживании</label><br/>-->
<!--                    <input type='text' name='COUNTERS[733][NOW]'-->
<!--                           value='--><?//= htmlspecialchars($_SESSION["FORM"]["COUNTERS"][733]['NOW']) ?><!--'/><br/>-->
<!--                    <label class='field_label'>Планируемый среднемесячный объем закупок</label><br/>-->
<!--                    <input type='text' name='COUNTERS[733][PLAN]'-->
<!--                           value='--><?//= htmlspecialchars($_SESSION["FORM"]["COUNTERS"][733]['PLAN']) ?><!--'/>-->
<!--                </div>-->
<!--            --><?// endif; ?>
            <label class="label_check" for="item_6236">
                <input name="PROPERTY[COMPANY_KKT][6236]" id="item_6236" value="6236"
                       type="checkbox" <? if (in_array(6236, $req_items)): ?> checked="checked" <? endif; ?>>
                АСПД «ШТРИХ-LIGHT 100»
            </label>
<!--            --><?// if (isset($_SESSION["FORM"]["COUNTERS"][6236])): ?>
<!--                <div class='productCountInfo'>-->
<!--                    <label class='field_label'>Количество ККМ данной модели на обслуживании</label><br/>-->
<!--                    <input type='text' name='COUNTERS[6236][NOW]'-->
<!--                           value='--><?//= htmlspecialchars($_SESSION["FORM"]["COUNTERS"][6236]['NOW']) ?><!--'/><br/>-->
<!--                    <label class='field_label'>Планируемый среднемесячный объем закупок</label><br/>-->
<!--                    <input type='text' name='COUNTERS[6236][PLAN]'-->
<!--                           value='--><?//= htmlspecialchars($_SESSION["FORM"]["COUNTERS"][6236]['PLAN']) ?><!--'/>-->
<!--                </div>-->
<!--            --><?// endif; ?>
            <label class="label_check" for="item_6235">
                <input name="PROPERTY[COMPANY_KKT][6235]" id="item_6235" value="6235"
                       type="checkbox" <? if (in_array(6235, $req_items)): ?> checked="checked" <? endif; ?>>
                АСПД «ШТРИХ-М»
            </label>
<!--            --><?// if (isset($_SESSION["FORM"]["COUNTERS"][6235])): ?>
<!--                <div class='productCountInfo'>-->
<!--                    <label class='field_label'>Количество ККМ данной модели на обслуживании</label><br/>-->
<!--                    <input type='text' name='COUNTERS[6235][NOW]'-->
<!--                           value='--><?//= htmlspecialchars($_SESSION["FORM"]["COUNTERS"][6235]['NOW']) ?><!--'/><br/>-->
<!--                    <label class='field_label'>Планируемый среднемесячный объем закупок</label><br/>-->
<!--                    <input type='text' name='COUNTERS[6235][PLAN]'-->
<!--                           value='--><?//= htmlspecialchars($_SESSION["FORM"]["COUNTERS"][6235]['PLAN']) ?><!--'/>-->
<!--                </div>-->
<!--            --><?// endif; ?>
        </div>
        <div class="products accreditation second-cont">
            <label class="field_label">Список POS-систем</label>
            <label class="label_check" for="item_7023">
                <input name="PROPERTY[COMPANY_KKT][7023]" id="item_7023" value="7023"
                       type="checkbox" <? if (in_array(7023, $req_items)): ?> checked="checked" <? endif; ?>>
                POS-система «ШТРИХ-LightPOS WinCE 6.0»
            </label>
<!--            --><?// if (isset($_SESSION["FORM"]["COUNTERS"][7023])): ?>
<!--                <div class='productCountInfo'>-->
<!--                    <label class='field_label'>Количество ККМ данной модели на обслуживании</label><br/>-->
<!--                    <input type='text' name='COUNTERS[7023][NOW]'-->
<!--                           value='--><?//= htmlspecialchars($_SESSION["FORM"]["COUNTERS"][7023]['NOW']) ?><!--'/><br/>-->
<!--                    <label class='field_label'>Планируемый среднемесячный объем закупок</label><br/>-->
<!--                    <input type='text' name='COUNTERS[7023][PLAN]'-->
<!--                           value='--><?//= htmlspecialchars($_SESSION["FORM"]["COUNTERS"][7023]['PLAN']) ?><!--'/>-->
<!--                </div>-->
<!--            --><?// endif; ?>
            <label class="label_check" for="item_11140">
                <input name="PROPERTY[COMPANY_KKT][11140]" id="item_11140" value="11140"
                       type="checkbox" <? if (in_array(11140, $req_items)): ?> checked="checked" <? endif; ?>>
                POS-система «ШТРИХ-miniPOS SCALE»
            </label>
<!--            --><?// if (isset($_SESSION["FORM"]["COUNTERS"][11140])): ?>
<!--                <div class='productCountInfo'>-->
<!--                    <label class='field_label'>Количество ККМ данной модели на обслуживании</label><br/>-->
<!--                    <input type='text' name='COUNTERS[11140][NOW]'-->
<!--                           value='--><?//= htmlspecialchars($_SESSION["FORM"]["COUNTERS"][11140]['NOW']) ?><!--'/><br/>-->
<!--                    <label class='field_label'>Планируемый среднемесячный объем закупок</label><br/>-->
<!--                    <input type='text' name='COUNTERS[11140][PLAN]'-->
<!--                           value='--><?//= htmlspecialchars($_SESSION["FORM"]["COUNTERS"][11140]['PLAN']) ?><!--'/>-->
<!--                </div>-->
<!--            --><?// endif; ?>
            <label class="label_check" for="item_8688">
                <input name="PROPERTY[COMPANY_KKT][8688]" id="item_8688" value="8688"
                       type="checkbox" <? if (in_array(8688, $req_items)): ?> checked="checked" <? endif; ?>>
                Фронт-система «ШТРИХ-FrontMaster» v.01/02
            </label>
<!--            --><?// if (isset($_SESSION["FORM"]["COUNTERS"][8688])): ?>
<!--                <div class='productCountInfo'>-->
<!--                    <label class='field_label'>Количество ККМ данной модели на обслуживании</label><br/>-->
<!--                    <input type='text' name='COUNTERS[8688][NOW]'-->
<!--                           value='--><?//= htmlspecialchars($_SESSION["FORM"]["COUNTERS"][8688]['NOW']) ?><!--'/><br/>-->
<!--                    <label class='field_label'>Планируемый среднемесячный объем закупок</label><br/>-->
<!--                    <input type='text' name='COUNTERS[8688][PLAN]'-->
<!--                           value='--><?//= htmlspecialchars($_SESSION["FORM"]["COUNTERS"][8688]['PLAN']) ?><!--'/>-->
<!--                </div>-->
<!--            --><?// endif; ?>
            <label class="label_check" for="item_8690">
                <input name="PROPERTY[COMPANY_KKT][8690]" id="item_8690" value="8690"
                       type="checkbox" <? if (in_array(8690, $req_items)): ?> checked="checked" <? endif; ?>>
                Фронт-система «ШТРИХ-FrontMaster» v.03
            </label>
<!--            --><?// if (isset($_SESSION["FORM"]["COUNTERS"][8690])): ?>
<!--                <div class='productCountInfo'>-->
<!--                    <label class='field_label'>Количество ККМ данной модели на обслуживании</label><br/>-->
<!--                    <input type='text' name='COUNTERS[8690][NOW]'-->
<!--                           value='--><?//= htmlspecialchars($_SESSION["FORM"]["COUNTERS"][8690]['NOW']) ?><!--'/><br/>-->
<!--                    <label class='field_label'>Планируемый среднемесячный объем закупок</label><br/>-->
<!--                    <input type='text' name='COUNTERS[8690][PLAN]'-->
<!--                           value='--><?//= htmlspecialchars($_SESSION["FORM"]["COUNTERS"][8690]['PLAN']) ?><!--'/>-->
<!--                </div>-->
<!--            --><?// endif; ?>
            <label class="label_check" for="item_8691">
                <input name="PROPERTY[COMPANY_KKT][8691]" id="item_8691" value="8691"
                       type="checkbox" <? if (in_array(8691, $req_items)): ?> checked="checked" <? endif; ?>>
                Фронт-система «ШТРИХ-FrontMaster» v.04
            </label>
<!--            --><?// if (isset($_SESSION["FORM"]["COUNTERS"][8691])): ?>
<!--                <div class='productCountInfo'>-->
<!--                    <label class='field_label'>Количество ККМ данной модели на обслуживании</label><br/>-->
<!--                    <input type='text' name='COUNTERS[8691][NOW]'-->
<!--                           value='--><?//= htmlspecialchars($_SESSION["FORM"]["COUNTERS"][8691]['NOW']) ?><!--'/><br/>-->
<!--                    <label class='field_label'>Планируемый среднемесячный объем закупок</label><br/>-->
<!--                    <input type='text' name='COUNTERS[8691][PLAN]'-->
<!--                           value='--><?//= htmlspecialchars($_SESSION["FORM"]["COUNTERS"][8691]['PLAN']) ?><!--'/>-->
<!--                </div>-->
<!--            --><?// endif; ?>
            <label class="label_check" for="item_27355">
                <input name="PROPERTY[COMPANY_KKT][27355]" id="item_27355" value="27355"
                       type="checkbox" <? if (in_array(27355, $req_items)): ?> checked="checked" <? endif; ?>>
                POS-комплект плюс необходимый ON-LINE
            </label>
<!--            --><?// if (isset($_SESSION["FORM"]["COUNTERS"][27355])): ?>
<!--                <div class='productCountInfo'>-->
<!--                    <label class='field_label'>Количество ККМ данной модели на обслуживании</label><br/>-->
<!--                    <input type='text' name='COUNTERS[27355][NOW]'-->
<!--                           value='--><?//= htmlspecialchars($_SESSION["FORM"]["COUNTERS"][27355]['NOW']) ?><!--'/><br/>-->
<!--                    <label class='field_label'>Планируемый среднемесячный объем закупок</label><br/>-->
<!--                    <input type='text' name='COUNTERS[27355][PLAN]'-->
<!--                           value='--><?//= htmlspecialchars($_SESSION["FORM"]["COUNTERS"][27355]['PLAN']) ?><!--'/>-->
<!--                </div>-->
<!--            --><?// endif; ?>
        </div>
        <div class="products accreditation second-cont">
            <label class="field_label">Список POS-периферии</label>
            <label class="label_check" for="item_6281">
                <input name="PROPERTY[COMPANY_KKT][6281]" id="item_6281" value="6281"
                       type="checkbox" <? if (in_array(6281, $req_items)): ?> checked="checked" <? endif; ?>>
                Программируемая клавиатура КВ-64К
            </label>
<!--            --><?// if (isset($_SESSION["FORM"]["COUNTERS"][6281])): ?>
<!--                <div class='productCountInfo'>-->
<!--                    <label class='field_label'>Количество ККМ данной модели на обслуживании</label><br/>-->
<!--                    <input type='text' name='COUNTERS[6281][NOW]'-->
<!--                           value='--><?//= htmlspecialchars($_SESSION["FORM"]["COUNTERS"][6281]['NOW']) ?><!--'/><br/>-->
<!--                    <label class='field_label'>Планируемый среднемесячный объем закупок</label><br/>-->
<!--                    <input type='text' name='COUNTERS[6281][PLAN]'-->
<!--                           value='--><?//= htmlspecialchars($_SESSION["FORM"]["COUNTERS"][6281]['PLAN']) ?><!--'/>-->
<!--                </div>-->
<!--            --><?// endif; ?>
            <label class="label_check" for="item_6278">
                <input name="PROPERTY[COMPANY_KKT][6278]" id="item_6278" value="6278"
                       type="checkbox" <? if (in_array(6278, $req_items)): ?> checked="checked" <? endif; ?>>
                Программируемая клавиатура КВ-64RK
            </label>
<!--            --><?// if (isset($_SESSION["FORM"]["COUNTERS"][6278])): ?>
<!--                <div class='productCountInfo'>-->
<!--                    <label class='field_label'>Количество ККМ данной модели на обслуживании</label><br/>-->
<!--                    <input type='text' name='COUNTERS[6278][NOW]'-->
<!--                           value='--><?//= htmlspecialchars($_SESSION["FORM"]["COUNTERS"][6278]['NOW']) ?><!--'/><br/>-->
<!--                    <label class='field_label'>Планируемый среднемесячный объем закупок</label><br/>-->
<!--                    <input type='text' name='COUNTERS[6278][PLAN]'-->
<!--                           value='--><?//= htmlspecialchars($_SESSION["FORM"]["COUNTERS"][6278]['PLAN']) ?><!--'/>-->
<!--                </div>-->
<!--            --><?// endif; ?>
            <label class="label_check" for="item_20147">
                <input name="PROPERTY[COMPANY_KKT][20147]" id="item_20147" value="20147"
                       type="checkbox" <? if (in_array(20147, $req_items)): ?> checked="checked" <? endif; ?>>
                Дисплей покупателя ШТРИХ-Т D3
            </label>
<!--            --><?// if (isset($_SESSION["FORM"]["COUNTERS"][20147])): ?>
<!--                <div class='productCountInfo'>-->
<!--                    <label class='field_label'>Количество ККМ данной модели на обслуживании</label><br/>-->
<!--                    <input type='text' name='COUNTERS[20147][NOW]'-->
<!--                           value='--><?//= htmlspecialchars($_SESSION["FORM"]["COUNTERS"][20147]['NOW']) ?><!--'/><br/>-->
<!--                    <label class='field_label'>Планируемый среднемесячный объем закупок</label><br/>-->
<!--                    <input type='text' name='COUNTERS[20147][PLAN]'-->
<!--                           value='--><?//= htmlspecialchars($_SESSION["FORM"]["COUNTERS"][20147]['PLAN']) ?><!--'/>-->
<!--                </div>-->
<!--            --><?// endif; ?>
            <label class="label_check" for="item_850">
                <input name="PROPERTY[COMPANY_KKT][850]" id="item_850" value="850"
                       type="checkbox" <? if (in_array(850, $req_items)): ?> checked="checked" <? endif; ?>>
                Дисплей покупателя ШТРИХ-Т D2
            </label>
<!--            --><?// if (isset($_SESSION["FORM"]["COUNTERS"][850])): ?>
<!--                <div class='productCountInfo'>-->
<!--                    <label class='field_label'>Количество ККМ данной модели на обслуживании</label><br/>-->
<!--                    <input type='text' name='COUNTERS[850][NOW]'-->
<!--                           value='--><?//= htmlspecialchars($_SESSION["FORM"]["COUNTERS"][850]['NOW']) ?><!--'/><br/>-->
<!--                    <label class='field_label'>Планируемый среднемесячный объем закупок</label><br/>-->
<!--                    <input type='text' name='COUNTERS[850][PLAN]'-->
<!--                           value='--><?//= htmlspecialchars($_SESSION["FORM"]["COUNTERS"][850]['PLAN']) ?><!--'/>-->
<!--                </div>-->
<!--            --><?// endif; ?>
            <label class="label_check" for="item_6207">
                <input name="PROPERTY[COMPANY_KKT][6207]" id="item_6207" value="6207"
                       type="checkbox" <? if (in_array(6207, $req_items)): ?> checked="checked" <? endif; ?>>
                Денежный ящик "ШТРИХ-miniCD"
            </label>
<!--            --><?// if (isset($_SESSION["FORM"]["COUNTERS"][6207])): ?>
<!--                <div class='productCountInfo'>-->
<!--                    <label class='field_label'>Количество ККМ данной модели на обслуживании</label><br/>-->
<!--                    <input type='text' name='COUNTERS[6207][NOW]'-->
<!--                           value='--><?//= htmlspecialchars($_SESSION["FORM"]["COUNTERS"][6207]['NOW']) ?><!--'/><br/>-->
<!--                    <label class='field_label'>Планируемый среднемесячный объем закупок</label><br/>-->
<!--                    <input type='text' name='COUNTERS[6207][PLAN]'-->
<!--                           value='--><?//= htmlspecialchars($_SESSION["FORM"]["COUNTERS"][6207]['PLAN']) ?><!--'/>-->
<!--                </div>-->
<!--            --><?// endif; ?>
            <label class="label_check" for="item_732">
                <input name="PROPERTY[COMPANY_KKT][732]" id="item_732" value="732"
                       type="checkbox" <? if (in_array(732, $req_items)): ?> checked="checked" <? endif; ?>>
                Денежный ящик "ШТРИХ-CD"
            </label>
<!--            --><?// if (isset($_SESSION["FORM"]["COUNTERS"][732])): ?>
<!--                <div class='productCountInfo'>-->
<!--                    <label class='field_label'>Количество ККМ данной модели на обслуживании</label><br/>-->
<!--                    <input type='text' name='COUNTERS[732][NOW]'-->
<!--                           value='--><?//= htmlspecialchars($_SESSION["FORM"]["COUNTERS"][732]['NOW']) ?><!--'/><br/>-->
<!--                    <label class='field_label'>Планируемый среднемесячный объем закупок</label><br/>-->
<!--                    <input type='text' name='COUNTERS[732][PLAN]'-->
<!--                           value='--><?//= htmlspecialchars($_SESSION["FORM"]["COUNTERS"][732]['PLAN']) ?><!--'/>-->
<!--                </div>-->
<!--            --><?// endif; ?>
        </div>
        <div class="products accreditation second-cont">
            <label class="field_label">Весы с печатью этикеток</label>
            <label class="label_check" for="item_350">
                <input name="PROPERTY[COMPANY_KKT][350]" id="item_350" value="350"
                       type="checkbox" <? if (in_array(350, $req_items)): ?> checked="checked" <? endif; ?>>
                Весы «ШТРИХ-ПРИНТ» ФI v.4.5
            </label>
<!--            --><?// if (isset($_SESSION["FORM"]["COUNTERS"][350])): ?>
<!--                <div class='productCountInfo'>-->
<!--                    <label class='field_label'>Количество ККМ данной модели на обслуживании</label><br/>-->
<!--                    <input type='text' name='COUNTERS[350][NOW]'-->
<!--                           value='--><?//= htmlspecialchars($_SESSION["FORM"]["COUNTERS"][350]['NOW']) ?><!--'/><br/>-->
<!--                    <label class='field_label'>Планируемый среднемесячный объем закупок</label><br/>-->
<!--                    <input type='text' name='COUNTERS[350][PLAN]'-->
<!--                           value='--><?//= htmlspecialchars($_SESSION["FORM"]["COUNTERS"][350]['PLAN']) ?><!--'/>-->
<!--                </div>-->
<!--            --><?// endif; ?>
            <label class="label_check" for="item_549">
                <input name="PROPERTY[COMPANY_KKT][549]" id="item_549" value="549"
                       type="checkbox" <? if (in_array(549, $req_items)): ?> checked="checked" <? endif; ?>>
                Весы «ШТРИХ-ПРИНТ» М v.4.5
            </label>
<!--            --><?// if (isset($_SESSION["FORM"]["COUNTERS"][549])): ?>
<!--                <div class='productCountInfo'>-->
<!--                    <label class='field_label'>Количество ККМ данной модели на обслуживании</label><br/>-->
<!--                    <input type='text' name='COUNTERS[549][NOW]'-->
<!--                           value='--><?//= htmlspecialchars($_SESSION["FORM"]["COUNTERS"][549]['NOW']) ?><!--'/><br/>-->
<!--                    <label class='field_label'>Планируемый среднемесячный объем закупок</label><br/>-->
<!--                    <input type='text' name='COUNTERS[549][PLAN]'-->
<!--                           value='--><?//= htmlspecialchars($_SESSION["FORM"]["COUNTERS"][549]['PLAN']) ?><!--'/>-->
<!--                </div>-->
<!--            --><?// endif; ?>
            <label class="label_check" for="item_550">
                <input name="PROPERTY[COMPANY_KKT][550]" id="item_550" value="550"
                       type="checkbox" <? if (in_array(550, $req_items)): ?> checked="checked" <? endif; ?>>
                Весы «ШТРИХ-ПРИНТ» v.4.5
            </label>
<!--            --><?// if (isset($_SESSION["FORM"]["COUNTERS"][550])): ?>
<!--                <div class='productCountInfo'>-->
<!--                    <label class='field_label'>Количество ККМ данной модели на обслуживании</label><br/>-->
<!--                    <input type='text' name='COUNTERS[550][NOW]'-->
<!--                           value='--><?//= htmlspecialchars($_SESSION["FORM"]["COUNTERS"][550]['NOW']) ?><!--'/><br/>-->
<!--                    <label class='field_label'>Планируемый среднемесячный объем закупок</label><br/>-->
<!--                    <input type='text' name='COUNTERS[550][PLAN]'-->
<!--                           value='--><?//= htmlspecialchars($_SESSION["FORM"]["COUNTERS"][550]['PLAN']) ?><!--'/>-->
<!--                </div>-->
<!--            --><?// endif; ?>
            <label class="label_check" for="item_562">
                <input name="PROPERTY[COMPANY_KKT][562]" id="item_562" value="562"
                       type="checkbox" <? if (in_array(562, $req_items)): ?> checked="checked" <? endif; ?>>
                Весы «ШТРИХ-ПРИНТ» C 120 МК v.4.5
            </label>
<!--            --><?// if (isset($_SESSION["FORM"]["COUNTERS"][562])): ?>
<!--                <div class='productCountInfo'>-->
<!--                    <label class='field_label'>Количество ККМ данной модели на обслуживании</label><br/>-->
<!--                    <input type='text' name='COUNTERS[562][NOW]'-->
<!--                           value='--><?//= htmlspecialchars($_SESSION["FORM"]["COUNTERS"][562]['NOW']) ?><!--'/><br/>-->
<!--                    <label class='field_label'>Планируемый среднемесячный объем закупок</label><br/>-->
<!--                    <input type='text' name='COUNTERS[562][PLAN]'-->
<!--                           value='--><?//= htmlspecialchars($_SESSION["FORM"]["COUNTERS"][562]['PLAN']) ?><!--'/>-->
<!--                </div>-->
<!--            --><?// endif; ?>
            <label class="label_check" for="item_563">
                <input name="PROPERTY[COMPANY_KKT][563]" id="item_563" value="563"
                       type="checkbox" <? if (in_array(563, $req_items)): ?> checked="checked" <? endif; ?>>
                Весы «ШТРИХ-ПРИНТ» ПВ v.4.5
            </label>
<!--            --><?// if (isset($_SESSION["FORM"]["COUNTERS"][563])): ?>
<!--                <div class='productCountInfo'>-->
<!--                    <label class='field_label'>Количество ККМ данной модели на обслуживании</label><br/>-->
<!--                    <input type='text' name='COUNTERS[563][NOW]'-->
<!--                           value='--><?//= htmlspecialchars($_SESSION["FORM"]["COUNTERS"][563]['NOW']) ?><!--'/><br/>-->
<!--                    <label class='field_label'>Планируемый среднемесячный объем закупок</label><br/>-->
<!--                    <input type='text' name='COUNTERS[563][PLAN]'-->
<!--                           value='--><?//= htmlspecialchars($_SESSION["FORM"]["COUNTERS"][563]['PLAN']) ?><!--'/>-->
<!--                </div>-->
<!--            --><?// endif; ?>
            <label class="label_check" for="item_21982">
                <input name="PROPERTY[COMPANY_KKT][21982]" id="item_21982" value="21982"
                       type="checkbox" <? if (in_array(21982, $req_items)): ?> checked="checked" <? endif; ?>>
                Весы «Штрих-PC 200 C3V2»
            </label>
<!--            --><?// if (isset($_SESSION["FORM"]["COUNTERS"][21982])): ?>
<!--                <div class='productCountInfo'>-->
<!--                    <label class='field_label'>Количество ККМ данной модели на обслуживании</label><br/>-->
<!--                    <input type='text' name='COUNTERS[21982][NOW]'-->
<!--                           value='--><?//= htmlspecialchars($_SESSION["FORM"]["COUNTERS"][21982]['NOW']) ?><!--'/><br/>-->
<!--                    <label class='field_label'>Планируемый среднемесячный объем закупок</label><br/>-->
<!--                    <input type='text' name='COUNTERS[21982][PLAN]'-->
<!--                           value='--><?//= htmlspecialchars($_SESSION["FORM"]["COUNTERS"][21982]['PLAN']) ?><!--'/>-->
<!--                </div>-->
<!--            --><?// endif; ?>
            <label class="label_check" for="item_6271">
                <input name="PROPERTY[COMPANY_KKT][6271]" id="item_6271" value="6271"
                       type="checkbox" <? if (in_array(6271, $req_items)): ?> checked="checked" <? endif; ?>>
                Весы «Штрих-PC 200 C3»
            </label>
<!--            --><?// if (isset($_SESSION["FORM"]["COUNTERS"][6271])): ?>
<!--                <div class='productCountInfo'>-->
<!--                    <label class='field_label'>Количество ККМ данной модели на обслуживании</label><br/>-->
<!--                    <input type='text' name='COUNTERS[6271][NOW]'-->
<!--                           value='--><?//= htmlspecialchars($_SESSION["FORM"]["COUNTERS"][6271]['NOW']) ?><!--'/><br/>-->
<!--                    <label class='field_label'>Планируемый среднемесячный объем закупок</label><br/>-->
<!--                    <input type='text' name='COUNTERS[6271][PLAN]'-->
<!--                           value='--><?//= htmlspecialchars($_SESSION["FORM"]["COUNTERS"][6271]['PLAN']) ?><!--'/>-->
<!--                </div>-->
<!--            --><?// endif; ?>
        </div>
        <div class="products accreditation second-cont">
            <label class="field_label">Оборудование для штрих-кодирования</label>
            <label class="label_check" for="item_18173">
                <input name="PROPERTY[COMPANY_KKT][18173]" id="item_18173" value="18173"
                       type="checkbox" <? if (in_array(18173, $req_items)): ?> checked="checked" <? endif; ?>>
                Ручной сканер 2D штрих-кодов VMC BurstScan Lite
            </label>
<!--            --><?// if (isset($_SESSION["FORM"]["COUNTERS"][18173])): ?>
<!--                <div class='productCountInfo'>-->
<!--                    <label class='field_label'>Количество ККМ данной модели на обслуживании</label><br/>-->
<!--                    <input type='text' name='COUNTERS[18173][NOW]'-->
<!--                           value='--><?//= htmlspecialchars($_SESSION["FORM"]["COUNTERS"][18173]['NOW']) ?><!--'/><br/>-->
<!--                    <label class='field_label'>Планируемый среднемесячный объем закупок</label><br/>-->
<!--                    <input type='text' name='COUNTERS[18173][PLAN]'-->
<!--                           value='--><?//= htmlspecialchars($_SESSION["FORM"]["COUNTERS"][18173]['PLAN']) ?><!--'/>-->
<!--                </div>-->
<!--            --><?// endif; ?>
            <label class="label_check" for="item_6273">
                <input name="PROPERTY[COMPANY_KKT][6273]" id="item_6273" value="6273"
                       type="checkbox" <? if (in_array(6273, $req_items)): ?> checked="checked" <? endif; ?>>
                Ручной image сканер VMC BurstScan II+
            </label>
<!--            --><?// if (isset($_SESSION["FORM"]["COUNTERS"][6273])): ?>
<!--                <div class='productCountInfo'>-->
<!--                    <label class='field_label'>Количество ККМ данной модели на обслуживании</label><br/>-->
<!--                    <input type='text' name='COUNTERS[6273][NOW]'-->
<!--                           value='--><?//= htmlspecialchars($_SESSION["FORM"]["COUNTERS"][6273]['NOW']) ?><!--'/><br/>-->
<!--                    <label class='field_label'>Планируемый среднемесячный объем закупок</label><br/>-->
<!--                    <input type='text' name='COUNTERS[6273][PLAN]'-->
<!--                           value='--><?//= htmlspecialchars($_SESSION["FORM"]["COUNTERS"][6273]['PLAN']) ?><!--'/>-->
<!--                </div>-->
<!--            --><?// endif; ?>
            <label class="label_check" for="item_6006">
                <input name="PROPERTY[COMPANY_KKT][6006]" id="item_6006" value="6006"
                       type="checkbox" <? if (in_array(6006, $req_items)): ?> checked="checked" <? endif; ?>>
                Ручной image сканер VMC BurstScan HD
            </label>
<!--            --><?// if (isset($_SESSION["FORM"]["COUNTERS"][6006])): ?>
<!--                <div class='productCountInfo'>-->
<!--                    <label class='field_label'>Количество ККМ данной модели на обслуживании</label><br/>-->
<!--                    <input type='text' name='COUNTERS[6006][NOW]'-->
<!--                           value='--><?//= htmlspecialchars($_SESSION["FORM"]["COUNTERS"][6006]['NOW']) ?><!--'/><br/>-->
<!--                    <label class='field_label'>Планируемый среднемесячный объем закупок</label><br/>-->
<!--                    <input type='text' name='COUNTERS[6006][PLAN]'-->
<!--                           value='--><?//= htmlspecialchars($_SESSION["FORM"]["COUNTERS"][6006]['PLAN']) ?><!--'/>-->
<!--                </div>-->
<!--            --><?// endif; ?>
        </div>
    </div>
</div>
<input type="hidden" name="next_step" value="2"/>
<button disabled id="submit_step1" type="submit" name="directions" class="orange_submit"
        value="next"><?= mb_strtoupper(GetMessage("CONTINUE")) ?></button>