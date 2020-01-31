<?
if(CModule::IncludeModule("iblock")) {
    $arResult = GetLocationInformation();
    /* $sects = CIBlockSection::GetList(array("SORT" => "ASC", "NAME" => "ASC"), array("IBLOCK_ID" => IB_PRODUCTS, "ACTIVE" => "Y"), true, array("NAME", "ID", "DEPTH_LEVEL", "IBLOCK_SECTION_ID"));
    while($sect = $sects->GetNext()) {
        unset($lists);
        $lists = CIBlockElement::GetList(array(), array("IBLOCK_ID" => IB_PRODUCTS, "ACTIVE" => "Y", "INCLUDE_SUBSECTIONS" => "Y", "SECTION_ID" => $sect["ID"]), array());
        if($lists > 0)
            $sections[] = $sect;
    }

    foreach($sections as $sec) {
        if($sec["DEPTH_LEVEL"] == 1) {
            $levels[] = $sec;
        }
    }
    foreach($levels as $key => $lev) {
        foreach($sections as $section_2) {
            if($section_2["DEPTH_LEVEL"] == 2 && $section_2["IBLOCK_SECTION_ID"] == $lev["ID"]) {
                $levels[$key]["SECTIONS"][] = $section_2;
            }
        }
    }
    if(count($levels) > 0) {
        foreach($levels as $k => $level) {
            if(count($level["SECTIONS"]) > 0) {
                foreach($level["SECTIONS"] as $v => $l) {
                    unset($res);
                    unset($element);
                    $res = CIBlockElement::GetList(
                        array("SORT" => "ASC"),
                        array("IBLOCK_ID" => IB_PRODUCTS, "ACTIVE" => "Y", "SECTION_ID" => $l["ID"], "INCLUDE_SUBSECTIONS" => "Y", "!PROPERTY_accreditation" => false),
                        false,
                        false,
                        array("IBLOCK_ID", "NAME", "ID", "ACTIVE", "IBLOCK_SECTION_ID", "PROPERTY_type")
                    );
                    while($element = $res->GetNext()) {
                        $levels[$k]["SECTIONS"][$v]["ITEMS"][] = $element;
                    }
                    if(count($levels[$k]["SECTIONS"][$v]["ITEMS"]) <= 0)
                        unset($levels[$k]["SECTIONS"][$v]);
                }
            }
            else unset($levels[$k]);
        }
    } */

    $res = CIBlockElement::GetList(
        array("SORT" => "ASC"),
        array("IBLOCK_ID" => IB_PRODUCTS, "ACTIVE" => "Y", "!PROPERTY_accreditation" => false),
        false,
        false,
        array("IBLOCK_ID", "NAME", "ID", "ACTIVE", "IBLOCK_SECTION_ID", "PROPERTY_type")
    );
    while($element = $res->GetNext()) {
        $arResult["ITEMS"][$element["ID"]] = $element;
    }

    $arResult["PRODUCTS"] = $levels;
    if(!isset($_REQUEST["success"])) {
        $arResult["STEP"] = 1;
    }

    if(!empty($_REQUEST["directions"]) && bitrix_sessid_post() && !empty($_REQUEST["sessid"]) && !empty($_REQUEST["jssid"]) && $_REQUEST["sessid"] == $_REQUEST["jssid"]) {
        if($_REQUEST["directions"] == "next" && $_REQUEST["next_step"] == 2) {

            foreach($_REQUEST["COUNTERS"] as $k=>$v){
                if(((int)$v['NOW']<=0 && (int)$v['PLAN']<=0) || !in_array($k,$_REQUEST["PROPERTY"]["COMPANY_KKT"]))
                    unset($_REQUEST["COUNTERS"][$k]);
            }
            foreach($_REQUEST["PROPERTY"]["COMPANY_KKT"] as $v){
                if(!isset($_REQUEST["COUNTERS"][$v]))
                    unset($_REQUEST["PROPERTY"]["COMPANY_KKT"][$v]);
            }
            $_SESSION["FORM"]["COUNTERS"]=$_REQUEST["COUNTERS"];
            $_SESSION["FORM"]["PROPERTY"]["COMPANY_KKT"] = $_REQUEST["PROPERTY"]["COMPANY_KKT"];

            if(!$_REQUEST["PROPERTY"]["COMPANY_NAME"])
                $arResult["ERROR"][] = GetMessage("EMPTY_COMPANY_NAME");
            if(!$_REQUEST["PROPERTY"]["COMPANY_INN"])
                $arResult["ERROR"][] = GetMessage("EMPTY_COMPANY_INN");
            if(!$_REQUEST["PROPERTY"]["COMPANY_KPP"])
                $arResult["ERROR"][] = GetMessage("EMPTY_COMPANY_KPP");
            if(!$_REQUEST["PROPERTY"]["COMPANY_REGION"])
                $arResult["ERROR"][] = GetMessage("EMPTY_COMPANY_REGION");
            if(!$_REQUEST["PROPERTY"]["COMPANY_TOWN"])
                $arResult["ERROR"][] = GetMessage("EMPTY_COMPANY_TOWN");
            if(empty($_REQUEST["PROPERTY"]["COMPANY_KKT"]) && $_REQUEST["PROPERTY"]["TYPE"] != 'Интегратор')
                $arResult["ERROR"][] = GetMessage("EMPTY_COMPANY_KKT");
            if(empty($arResult["ERROR"])) {
                $arResult["STEP"] = 2;
                $_SESSION["FORM"]["PRODUCTS"] = $_REQUEST["PRODUCTS"];
                if(!isset($_SESSION["FORM"]["PROPERTY"]))
                    $_SESSION["FORM"]["PROPERTY"] = array();
                $_SESSION["FORM"]["PROPERTY"] = array_merge($_SESSION["FORM"]["PROPERTY"], $_REQUEST["PROPERTY"]);;
                $_SESSION["FORM"]["SECTIONS"] = $_REQUEST["SECTIONS"];
            }
            else {
                $arResult["STEP"] = 1;
            }
        }
        elseif($_REQUEST["directions"] == "next" && $_REQUEST["next_step"] == 3) {
            $required = array(
                "HEAD_NAME",
                "HEAD_POSITION",
                "HEAD_DOCUMENT"
            );
            foreach($_REQUEST["PROPERTY"] as $key => $prop) {
                if(in_array($key, $required) && !$prop)
                    $arResult["ERROR"][] = GetMessage("EMPTY_".$key);
            }
            if(empty($arResult["ERROR"])) {
                $arResult["STEP"] = 3;
                $_SESSION["FORM"]["PROPERTY"] = array_merge($_SESSION["FORM"]["PROPERTY"], $_REQUEST["PROPERTY"]);
            }
            else {
                $arResult["STEP"] = 2;
            }
        }
        elseif($_REQUEST["directions"] == "next" && $_REQUEST["next_step"] == 4) {
            $required = array(
                "PHONE",
                "FAX",
                "EMAIL",
                "CONTACT_NAME",
                "CONTACT_POSITION",
                "CONTACT_EMAIL",
                "SPECIALITIES"
            );
            foreach($_REQUEST["PROPERTY"] as $key => $prop) {
                if(in_array($key, $required) && !$prop)
                    $arResult["ERROR"][] = GetMessage("EMPTY_".$key);
                if($key == "EMAIL" && !empty($prop))
                    if(!check_email($prop))
                        $arResult["ERROR"][] = GetMessage("EMAIL_ERROR");

            }

            unset($_REQUEST["PROPERTY"]["SPECIALITIES"][1]);
            if(!$_REQUEST["PROPERTY"]["SPECIALITIES"][0]["NAME"] && !$_REQUEST["PROPERTY"]["SPECIALITIES"][0]["INN"])
                $arResult["ERROR"][] = GetMessage("EMPTY_NONE_SPECIALITIES");
            else
            {
                foreach($_REQUEST["PROPERTY"]["SPECIALITIES"] as $num=>$dataSp)
                {
                    if($dataSp["NAME"] && !$dataSp["INN"])
                        $arResult["ERROR"][] = GetMessage("EMPTY_SPECIALITIES_NOTE_INN", array("#NAME#"=>$dataSp["NAME"]));
                    elseif(!$dataSp["NAME"] && $dataSp["INN"])
                        $arResult["ERROR"][] = GetMessage("EMPTY_SPECIALITIES_NOTE_NAME", array("#INN#"=>$dataSp["INN"]));
                }
            }

            if(empty($arResult["ERROR"])) {
                $arResult["STEP"] = 0;
                $_SESSION["FORM"]["PROPERTY"] = array_merge($_SESSION["FORM"]["PROPERTY"], $_REQUEST["PROPERTY"]);
            }
            else {
                $arResult["STEP"] = 3;
            }
        }
        elseif($_REQUEST["directions"] == "prev" && $_REQUEST["prev_step"]) {
            $arResult["STEP"] = $_REQUEST["prev_step"];
        }
        else {
            $arResult["STEP"] = 1;
        }

        if($arResult["STEP"] == 0) {
            if(!empty($_SESSION["FORM"]["PROPERTY"]["SPECIALITIES"])) {
                foreach($_SESSION["FORM"]["PROPERTY"]["SPECIALITIES"] as $specialities)
                    if($specialities["NAME"] && $specialities["INN"])
                        $speciality[] = $specialities["NAME"]." ".$specialities["INN"];
                if(!empty($speciality))
                    $spec = implode("\n\r", $speciality);
            }
            unset($_SESSION["FORM"]["PROPERTY"]["SPECIALITIES"]);
            if(strlen($spec) > 0)
                $_SESSION["FORM"]["PROPERTY"]["SPECIALITIES"] = array("VALUE" => array("TEXT" => $spec, "TYPE" => "text"));

            $el = new CIBlockElement;

            if(count($_SESSION["FORM"]["COUNTERS"])>0){
                $arCounters=array();
                foreach($_SESSION["FORM"]["COUNTERS"] as $id=>$elem){
                    $PROP = array();
                    $PROP['PRODUCT'] = $id;
                    $PROP['NOW'] = $elem['NOW'];
                    $PROP['PLAN'] = $elem['PLAN'];

                    $arLoadProductArray = Array(
                        "IBLOCK_ID"       => 53,
                        "PROPERTY_VALUES" => $PROP,
                        "NAME"            => "Счетчик товаров ".$id,
                        "ACTIVE"          => "Y"
                    );

                    $arCounters[] = $el->Add($arLoadProductArray);
                }
            }

            $arItemsid = $_SESSION["FORM"]["PROPERTY"]["COMPANY_KKT"];
            /*$_SESSION["FORM"]["PROPERTY"]["COMPANY_KKT"] = $arCounters;*/
            //$_SESSION["FORM"]["PROPERTY"]["COMPANY_NAME"] = "ООО \"Тест\"";
            if(!empty($_SESSION["FORM"]["PROPERTY"])) {
                $arRes = Array(
                    "IBLOCK_ID" => IB_APP_ACCREDITATION,
                    "PROPERTY_VALUES" => $_SESSION["FORM"]["PROPERTY"],
                    "NAME" => date("d.m.y H:i")
                );
                if(!$id_message = $el->Add($arRes))
                    $arResult["ERROR"][] = $el->LAST_ERROR;
                else {
                    //посылаем сообщения
                    $content = "\n".'<h2>'.GetMessage("APP_NAME").'</h2>';
                    $content .= "\n".'<h3>'.GetMessage("STEP1").'</h3>';
                    $content .= "\n".'<table style="margin-bottom: 16px; border-collapse: collapse;" border="1" cellspacing="2" cellpadding="10" valign="top">';
                    $step1 = array(
                        "COMPANY_NAME",
                        "COMPANY_INN",
                        "COMPANY_KPP",
                        "COMPANY_REGION",
                        "COMPANY_TOWN",
                        "COMPANY_KKT"
                    );
                    foreach($step1 as $ar1) {
                        $str = "";
                        if($ar1 == "COMPANY_REGION")
                            $str = $arResult["REGIONS"][$_SESSION["FORM"]["PROPERTY"]["COMPANY_REGION"]];
                        elseif($ar1 == "COMPANY_TOWN")
                            $str = $arResult["TOWNS"][$_SESSION["FORM"]["PROPERTY"]["COMPANY_REGION"]][$_SESSION["FORM"]["PROPERTY"]["COMPANY_TOWN"]];
                        elseif($ar1 == "COMPANY_KKT") {
                            foreach($arItemsid as $kkt) {
                                if(is_array($arResult["ITEMS"][$kkt]) && is_array($_SESSION["FORM"]["COUNTERS"][$kkt]))
                                    $kkts[] = $arResult["ITEMS"][$kkt]["NAME"]."\n"."<br/>Количество ККМ данной модели на обслуживании - ".$_SESSION["FORM"]["COUNTERS"][$kkt]['NOW']."\n"."<br/>Планируемый среднемесячный объем закупок - ".$_SESSION["FORM"]["COUNTERS"][$kkt]['PLAN']."\n";
                            }
                            $str = implode("<br />", $kkts);
                        }
                        else
                            $str = $_SESSION["FORM"]["PROPERTY"][$ar1];

                        if(strlen($str) > 0) {
                            $content .= "\n".'<tr>';
                            $content .= "\n".'<td>'.GetMessage($ar1).'</td>';
                            $content .= "\n".'<td>'.$str.'</td>';
                            $content .= "\n".'</tr>';
                        }
                    }
                    $content .= "\n".'<tr>';
					$content .= "\n".'<td>Тип аккредитации:</td>';
                    $content .= "\n".'<td>'.$_SESSION["FORM"]["PROPERTY"]['TYPE'].'</td>';
                    $content .= "\n".'</tr>';
					$content .= "\n".'</table>';
                    $content .= "\n".'<h3>'.GetMessage("STEP2").'</h3>';
                    $content .= "\n".'<table style="margin-bottom: 16px; border-collapse: collapse;" border="1" cellspacing="2" cellpadding="10" valign="top">';
                    $step2 = array(
                        "HEAD" => array(
                            "HEAD_NAME",
                            "HEAD_POSITION",
                            "HEAD_DOCUMENT"
                        ),
                        "LEGAL" => array(
                            "LEGAL_ADDRESS_REGION",
                            "LEGAL_ADDRESS_TOWN",
                            "LEGAL_ADDRESS_INDEX",
                            "LEGAL_ADDRESS_ADDRESS"
                        ),
                        "POSTAL" => array(
                            "POSTAL_ADDRESS_REGION",
                            "POSTAL_ADDRESS_TOWN",
                            "POSTAL_ADDRESS_INDEX",
                            "POSTAL_ADDRESS_ADDRESS"
                        ),
                        "ACTUAL" => array(
                            "ACTUAL_ADDRESS_REGION",
                            "ACTUAL_ADDRESS_TOWN",
                            "ACTUAL_ADDRESS_INDEX",
                            "ACTUAL_ADDRESS_ADDRESS"
                        )
                    );
                    foreach($step2 as $key => $ar2) {
                        $str = "";
                        $content .= "\n".'<tr>';
                        $content .= "\n".'<td colspan="2" align="center"><b>'.GetMessage($key).'</b></td>';
                        $content .= "\n".'</tr>';
                        foreach($ar2 as $field) {
                            if($field == "LEGAL_ADDRESS_REGION" || $field == "POSTAL_ADDRESS_REGION" || $field == "ACTUAL_ADDRESS_REGION")
                                $str = $arResult["REGIONS"][$_SESSION["FORM"]["PROPERTY"][$field]];
                            elseif($field == "LEGAL_ADDRESS_TOWN")
                                $str = $arResult["TOWNS"][$_SESSION["FORM"]["PROPERTY"]["LEGAL_ADDRESS_REGION"]][$_SESSION["FORM"]["PROPERTY"]["LEGAL_ADDRESS_TOWN"]];
                            elseif($field == "POSTAL_ADDRESS_TOWN")
                                $str = $arResult["TOWNS"][$_SESSION["FORM"]["PROPERTY"]["POSTAL_ADDRESS_REGION"]][$_SESSION["FORM"]["PROPERTY"]["POSTAL_ADDRESS_TOWN"]];
                            elseif($field == "ACTUAL_ADDRESS_TOWN")
                                $str = $arResult["TOWNS"][$_SESSION["FORM"]["PROPERTY"]["ACTUAL_ADDRESS_REGION"]][$_SESSION["FORM"]["PROPERTY"]["ACTUAL_ADDRESS_TOWN"]];
                            else
                                $str = $_SESSION["FORM"]["PROPERTY"][$field];
                            if(strlen($str) > 0) {
                                $content .= "\n".'<tr>';
                                $content .= "\n".'<td>'.GetMessage($field).'</td>';
                                $content .= "\n".'<td>'.$str.'</td>';
                                $content .= "\n".'</tr>';
                            }
                        }
                    }
                    $content .= "\n".'</table>';
                    $step2 = array(
                        "BANK" => array(
                            "RASCH_SCHET",
                            "KORR_SCHET",
                            "BIK",
                            "BANK_NAME"
                        ),
                        "CONTACT" => array(
                            "PHONE",
                            "FAX",
                            "EMAIL",
                            "WWW"
                        ),
                        "CONTACT_PERSON" => array(
                            "CONTACT_NAME",
                            "CONTACT_POSITION",
                            "CONTACT_EMAIL"
                        ),
                        "SPECIALITY" => array(
                            "SPECIALITIES"
                        )
                    );
                    $content .= "\n".'<h3>'.GetMessage("STEP3").'</h3>';
                    $content .= "\n".'<table style="margin-bottom: 16px; border-collapse: collapse;" border="1" cellspacing="2" cellpadding="10" valign="top">';
                    foreach($step2 as $key => $ar2) {
                        $str = "";
                        if($key == "SPECIALITY") {
                            if(!empty($_SESSION["FORM"]["PROPERTY"]["SPECIALITIES"]["VALUE"]["TEXT"])) {
                                $content .= "\n".'<tr>';
                                $content .= "\n".'<td colspan="2" align="center"><b>'.GetMessage($key).'</b></td>';
                                $content .= "\n".'</tr>';
                                $str = explode("\n\r", $_SESSION["FORM"]["PROPERTY"]["SPECIALITIES"]["VALUE"]["TEXT"]);
                                $content .= "\n".'<tr>';
                                $content .= "\n".'<td>'.GetMessage("SPECIALITIES").'</td>';
                                $content .= "\n".'<td>'.implode("<br />", $str).'</td>';
                                $content .= "\n".'</tr>';
                            }
                        }
                        else {
                            if(!empty($ar2)) {
                                $content .= "\n".'<tr>';
                                $content .= "\n".'<td colspan="2" align="center"><b>'.GetMessage($key).'</b></td>';
                                $content .= "\n".'</tr>';
                                foreach($ar2 as $field) {
                                    if(!empty($_SESSION["FORM"]["PROPERTY"][$field])) {
                                        $str = $_SESSION["FORM"]["PROPERTY"][$field];
                                        $content .= "\n".'<tr>';
                                        $content .= "\n".'<td>'.GetMessage($field).'</td>';
                                        $content .= "\n".'<td>'.$str.'</td>';
                                        $content .= "\n".'</tr>';
                                    }
                                }
                            }
                        }
                    }
                    $content .= "\n".'</table>';
                    $arSend = array(
                        "EMAIL" => $arRes["PROPERTY_VALUES"]["CONTACT_EMAIL"],
                        "CONTENT" => $content,
                        "NAME" => $arRes["PROPERTY_VALUES"]["CONTACT_NAME"]
                    );

                    AddMessage2Log(print_r("Prolongation"));
                    AddMessage2Log(print_r($arRes, true));

                    CEvent::Send("USER_ACCREDITATION", "s1", $arSend, "Y", 77);
                    CEvent::Send("USER_ACCREDITATION", "s1", $arSend, "Y", 78);
                    unset($_SESSION["FORM"]);
                    LocalRedirect($APPLICATION->GetCurPageParam("success=yes"));
                }
            }
        }
    }

    $this->IncludeComponentTemplate();
}
?>