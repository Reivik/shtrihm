<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
//pr($arResult);
//hack for news
foreach($arResult as $key=>$menu)
{
    if(($menu["LINK"] == "/press_center/") && ($menu["DEPTH_LEVEL"]==2 || $menu["DEPTH_LEVEL"]==3 || $menu["DEPTH_LEVEL"]==4))
        unset($arResult[$key]);
	elseif(($menu["LINK"] == "/press_center/info-portal/") && ($menu["DEPTH_LEVEL"]==2 || $menu["DEPTH_LEVEL"]==3 || $menu["DEPTH_LEVEL"]==4))
        unset($arResult[$key]);
    elseif(($menu["LINK"] == "/press_center/special_offers/") && ($menu["DEPTH_LEVEL"]==2 || $menu["DEPTH_LEVEL"]==3 || $menu["DEPTH_LEVEL"]==4))
        unset($arResult[$key]);
    elseif(($menu["LINK"] == "/press_center/clients/") && ($menu["DEPTH_LEVEL"]==2 || $menu["DEPTH_LEVEL"]==3 || $menu["DEPTH_LEVEL"]==4))
        unset($arResult[$key]);
    elseif(($menu["LINK"] == "/press_center/news/") && ($menu["DEPTH_LEVEL"]==2 || $menu["DEPTH_LEVEL"]==3 || $menu["DEPTH_LEVEL"]==4))
        unset($arResult[$key]);
    elseif(($menu["LINK"] == "/press_center/news/") && ($menu["DEPTH_LEVEL"]==1))
        $arResult[$key]["IS_PARENT"] = "";
	elseif(($menu["LINK"] == "/press_center/info-portal/") && ($menu["DEPTH_LEVEL"]==1))
        $arResult[$key]["IS_PARENT"] = "";
    elseif(($menu["LINK"] == "/press_center/") && ($menu["DEPTH_LEVEL"]==1))
        $arResult[$key]["IS_PARENT"] = "";
    elseif(($menu["LINK"] == "/press_center/special_offers/") && ($menu["DEPTH_LEVEL"]==1))
        $arResult[$key]["IS_PARENT"] = "";
    elseif(($menu["LINK"] == "/press_center/clients/") && ($menu["DEPTH_LEVEL"]==1))
        $arResult[$key]["IS_PARENT"] = "";

    if(($menu["LINK"] == "/support/faq/") && ($menu["DEPTH_LEVEL"]==1)){
        $arResult[$key]["IS_PARENT"]='';
        $key++;
        while($arResult[$key]['DEPTH_LEVEL']!=1){
            unset($arResult[$key]);$key++;
        }
    }
}
?>
