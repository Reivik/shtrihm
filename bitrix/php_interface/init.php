<?
@require_once 'include/autoload.php';
define("RE_SITE_KEY","6LcC668UAAAAAMWoNiCpwP3CaiGPcVEfhljFbD2r");
define("RE_SEC_KEY","6LcC668UAAAAAMKSz7mqg7HPN6XBBU7I3ZsXQmGX"); 
//----------Created By yarslims@gmail.com ----------
require_once('consts.php');
require_once('yn_functions.php');
require_once('function.php');
require_once('event.php');

//--------------------------------------------------
function ShowBannersComponent(){
	global $APPLICATION;
	ob_start();
	$APPLICATION->IncludeComponent("areal:show.banners", ".default", array(
	
	),
	false
);
	$contentTime = ob_get_contents();
	ob_end_clean();
	return $contentTime;	
}
function ShowBanners(){
	global $APPLICATION;
	$APPLICATION->AddBufferContent("ShowBannersComponent");
}
function ShowLeftMenuContent(){
	global $APPLICATION;
	ob_start();
	
	$path = explode("/",$_SERVER["REQUEST_URI"]);
	if($path[1] == "login")
		$APPLICATION->SetPageProperty('NO_LEFT_MENU', "N");
	
	if($APPLICATION->GetProperty('NO_LEFT_MENU') != "N" || $APPLICATION->GetProperty('SHOW_CLIENTS') == "Y" || $APPLICATION->GetProperty('SHOW_SPECIAL_OFFERS') == "Y" || $APPLICATION->GetProperty('NEWS_LIST_LEFT') == "Y" || $APPLICATION->GetProperty('SHOW_CALENDAR_EVENT') == "Y" || $APPLICATION->GetProperty('SUBSCRIBE_FORM') == "Y" || $APPLICATION->GetProperty('VEBINARS_LIST_LEFT') == "Y") {
		if($path[1] != "catalog" && strpos($path[2], "compare.php") != 1)
			echo "<div class='leftCol'>";		
			//левое меню
			if($APPLICATION->GetProperty('NO_LEFT_MENU') != "N") {			
				$APPLICATION->IncludeComponent("bitrix:menu", "grey", array(
	"ROOT_MENU_TYPE" => (substr_count($_SERVER["REQUEST_URI"],"/partners_info")>0||substr_count($_SERVER["REQUEST_URI"],"/personal")>0||substr_count($_SERVER["REQUEST_URI"],"/service_centers")>0||substr_count($_SERVER["REQUEST_URI"],"/support")>0)?"left_main":"left",
	"MENU_CACHE_TYPE" => "N",
	"MENU_CACHE_TIME" => "36000000",
	"MENU_CACHE_USE_GROUPS" => "Y",
	"MENU_CACHE_GET_VARS" => array(
	),
	"MAX_LEVEL" => "3",
	"CHILD_MENU_TYPE" => "left",
	"USE_EXT" => "Y",
	"DELAY" => "N",
	"ALLOW_MULTI_SELECT" => "N"
	),
	false
);
			}
		if($APPLICATION->GetProperty('SHOW_CALENDAR_EVENT') == "Y") {
			include($_SERVER["DOCUMENT_ROOT"]."/include/calendar_event.php");
		}
		
		if($APPLICATION->GetProperty('SHOW_CLIENTS') == "Y") {
			$APPLICATION->IncludeComponent("areal:clients.main", "left", 
			array(
				'IBLOCK_ID'=>IB_CLIENTS	
				),
				false
			);
		}

		if($APPLICATION->GetProperty('NEWS_LIST_LEFT') == "Y") {
			$APPLICATION->IncludeComponent("areal:news.list", ".default");
		}
		
		if($APPLICATION->GetProperty('VEBINARS_LIST_LEFT') == "Y") {
			$APPLICATION->IncludeComponent("areal:vebinar.list.top", ".default");
		}
			
		echo "</div>";
		if(!in_array($path[1], array("catalog", "solutions", "introduction", "special_offers")) && !in_array($path[2], array("news", "clients", "partners", "learning", "events", "congratulation", "calendar", "download", "vacancy")) && TEXT_DECOR!=="N")
			$class = "textDecor";
		echo "<div class='rightCol ".$class."'>";
	}
	
	if($APPLICATION->GetProperty('SHOW_CALENDAR_EVENT_RIGHT') == "Y") {
		echo '<div class="aside">';
		include($_SERVER["DOCUMENT_ROOT"]."/include/calendar_event.php");
		echo '</div>';
	}
	if($APPLICATION->GetProperty('CONGRATULATION') == "Y") {
		$APPLICATION->IncludeComponent("areal:congratulation_partner", ".default");
	}	
	if($APPLICATION->GetProperty('ACHIEVEMENTS') == "Y") {
		$APPLICATION->IncludeComponent("areal:achievements", ".default");
	}
	if($APPLICATION->GetProperty('NEWS_LIST') == "Y") {
		echo '<div class="aside">';
		$APPLICATION->IncludeComponent("areal:news.list", ".default");
		echo '</div>';
	}
	if($APPLICATION->GetProperty('SHOW_SPECIAL_OFFERS') == "Y") {
		$APPLICATION->IncludeComponent(
			"areal:special.offers", 
			"left", 
			array( 
				"COUNT_IN_LINE" => 3,
				"SHOW_ALL" => "N"
			)
		);
	}
	
	$contentTime = ob_get_contents();
	ob_end_clean();
	return $contentTime;
}
function ShowLeftMenu(){
	global $APPLICATION;
	$APPLICATION->AddBufferContent("ShowLeftMenuContent");
}

AddEventHandler("iblock", "OnAfterIBlockElementUpdate", "BXIBlockAfterSave");
AddEventHandler("iblock", "OnAfterIBlockElementAdd", "BXIBlockAfterSave");
AddEventHandler("catalog", "OnPriceAdd", "BXIBlockAfterSave");
AddEventHandler("catalog", "OnPriceUpdate", "BXIBlockAfterSave");
function BXIBlockAfterSave($arg1, $arg2 = false){
	$ELEMENT_ID = false;
	$IBLOCK_ID = false;
	$OFFERS_IBLOCK_ID = false;
	$OFFERS_PROPERTY_ID = false;

	//Check for catalog event
	if(is_array($arg2) && $arg2["PRODUCT_ID"] > 0)
	{
		//Get iblock element
		$rsPriceElement = CIBlockElement::GetList(
			array(),
			array(
				"ID" => $arg2["PRODUCT_ID"],
			),
			false,
			false,
			array("ID", "IBLOCK_ID")
		);
		if($arPriceElement = $rsPriceElement->Fetch())
		{
			$arCatalog = CCatalog::GetByID($arPriceElement["IBLOCK_ID"]);
			if(is_array($arCatalog))
			{
				//Check if it is offers iblock
				if($arCatalog["OFFERS"] == "Y")
				{
					//Find product element
					$rsElement = CIBlockElement::GetProperty(
						$arPriceElement["IBLOCK_ID"],
						$arPriceElement["ID"],
						"sort",
						"asc",
						array("ID" => $arCatalog["SKU_PROPERTY_ID"])
					);
					$arElement = $rsElement->Fetch();
					if($arElement && $arElement["VALUE"] > 0)
					{
						$ELEMENT_ID = $arElement["VALUE"];
						$IBLOCK_ID = $arCatalog["PRODUCT_IBLOCK_ID"];
						$OFFERS_IBLOCK_ID = $arCatalog["IBLOCK_ID"];
						$OFFERS_PROPERTY_ID = $arCatalog["SKU_PROPERTY_ID"];
					}
				}
				//or iblock wich has offers
				elseif($arCatalog["OFFERS_IBLOCK_ID"] > 0)
				{
					$ELEMENT_ID = $arPriceElement["ID"];
					$IBLOCK_ID = $arPriceElement["IBLOCK_ID"];
					$OFFERS_IBLOCK_ID = $arCatalog["OFFERS_IBLOCK_ID"];
					$OFFERS_PROPERTY_ID = $arCatalog["OFFERS_PROPERTY_ID"];
				}
				//or it's regular catalog
				else
				{
					$ELEMENT_ID = $arPriceElement["ID"];
					$IBLOCK_ID = $arPriceElement["IBLOCK_ID"];
					$OFFERS_IBLOCK_ID = false;
					$OFFERS_PROPERTY_ID = false;
				}
			}
		}
	}
	//Check for iblock event
	elseif(is_array($arg1) && $arg1["ID"] > 0 && $arg1["IBLOCK_ID"] > 0)
	{
		//Check if iblock has offers
		$arOffers = CIBlockPriceTools::GetOffersIBlock($arg1["IBLOCK_ID"]);
		if(is_array($arOffers))
		{
			$ELEMENT_ID = $arg1["ID"];
			$IBLOCK_ID = $arg1["IBLOCK_ID"];
			$OFFERS_IBLOCK_ID = $arOffers["OFFERS_IBLOCK_ID"];
			$OFFERS_PROPERTY_ID = $arOffers["OFFERS_PROPERTY_ID"];
		}
	}

	if($ELEMENT_ID)
	{
		static $arPropCache = array();
		if(!array_key_exists($IBLOCK_ID, $arPropCache))
		{
			//Check for MINIMAL_PRICE property
			$rsProperty = CIBlockProperty::GetByID("MINIMUM_PRICE", $IBLOCK_ID);
			$arProperty = $rsProperty->Fetch();
			if($arProperty)
				$arPropCache[$IBLOCK_ID] = $arProperty["ID"];
			else
				$arPropCache[$IBLOCK_ID] = false;
		}

		if($arPropCache[$IBLOCK_ID])
		{
			//Compose elements filter
			$arProductID = array($ELEMENT_ID);
			if($OFFERS_IBLOCK_ID)
			{
				$rsOffers = CIBlockElement::GetList(
					array(),
					array(
						"IBLOCK_ID" => $OFFERS_IBLOCK_ID,
						"PROPERTY_".$OFFERS_PROPERTY_ID => $ELEMENT_ID,
					),
					false,
					false,
					array("ID")
				);
				while($arOffer = $rsOffers->Fetch())
					$arProductID[] = $arOffer["ID"];
			}

			$minPrice = false;
			$maxPrice = false;
			//Get prices
			$rsPrices = CPrice::GetList(
				array(),
				array(
					"BASE" => "Y",
					"PRODUCT_ID" => $arProductID,
				)
			);
			while($arPrice = $rsPrices->Fetch())
			{
				$PRICE = $arPrice["PRICE"];

				if($minPrice === false || $minPrice > $PRICE)
					$minPrice = $PRICE;

				if($maxPrice === false || $maxPrice < $PRICE)
					$maxPrice = $PRICE;
			}

			//Save found minimal price into property
			if($minPrice !== false)
			{
				CIBlockElement::SetPropertyValuesEx(
					$ELEMENT_ID,
					$IBLOCK_ID,
					array(
						"MINIMUM_PRICE" => $minPrice,
						"MAXIMUM_PRICE" => $maxPrice,
					)
				);
			}
		}
	}
}
/*function custom_mail($to, $subject, $body, $headers) {
	$f = fopen($_SERVER["DOCUMENT_ROOT"]."/maillog.txt", "a+");
	fwrite($f, print_r(array('TO' => $to, 'SUBJECT' => $subject, 'BODY' => $body, 'HEADERS' => $headers),1)."\n========\n");
	fclose($f);
	return mail($to, $subject, $body, $headers);
}
*/
/*AddEventHandler("subscribe", "BeforePostingSendMail", "BeforePostingSendMailHandler");
// создаем обработчик события "BeforePostingSendMail"
function BeforePostingSendMailHandler($arFields)
{
	AddMessage2Log(print_r($arFields, true));
	return $arFields;
}*/
?>