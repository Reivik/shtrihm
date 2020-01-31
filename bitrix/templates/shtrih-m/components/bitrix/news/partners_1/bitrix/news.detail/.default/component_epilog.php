<?$APPLICATION->AddHeadScript('http://api-maps.yandex.ru/2.0/?load=package.full&lang=ru-RU');?>
<?//pr($arResult);?>
<script type="text/javascript">
	ymaps.ready(init);
	function init(){     
		var myMap, pointsArray = new Array();
		<?foreach($arResult["FILLIALS"] as $placeMark):?>
			pointsArray[pointsArray.length] = {
				"TOWN" : "<?=$placeMark["TOWN"]?>",				
				"ADDRESS" : "<?=$placeMark["ADDRESS"]?>",
				"OFFICE" : "<?=$placeMark["OFFICE"]." ".$arResult["NAME"]?>",
				"lat" : "<?=$placeMark["COORDINATES"]["lat"]?>",
				"lng" : "<?=$placeMark["COORDINATES"]["lng"]?>"
			};
		<?endforeach;?>

		myMap = new ymaps.Map ("map", {
			center: [<?=$arResult["LOCATION_CENTER"]["lat"]?>, <?=$arResult["LOCATION_CENTER"]["lng"]?>],
			zoom: 15,
		});			
		for(var i=0; i < pointsArray.length; i++) {
			myPlacemark = new ymaps.Placemark(
				[pointsArray[i]["lat"], pointsArray[i]["lng"]], 
				{ 
					content: pointsArray[i]["TOWN"], 
					//balloonContent: pointsArray[i]["OFFICE"],
					iconContent: pointsArray[i]["OFFICE"]
				},
				{
					//preset: 'twirl#darkorangeStretchyIcon'
					preset: 'twirl#blackStretchyIcon'
				}
			);
			//myPlacemark.setIconContent("Щелкни меня");
			myMap.geoObjects.add(myPlacemark);
		}
		myMap.controls.add('zoomControl', { left: 5, top: 5 }).add('typeSelector').add('mapTools', { left: 35, top: 5 });
	}
</script>
<div id="map" style="width: 100%; height: 268px; margin-bottom: 30px;"></div>
<?
$GLOBALS["introFilter"] = array("PROPERTY_PARTNER" => $arResult["ID"]);
$APPLICATION->IncludeComponent("bitrix:news.list", "introduction", array(
	"IBLOCK_TYPE" => "clients",
	"IBLOCK_ID" => IB_INTRO,
	"NEWS_COUNT" => "20",
	"SORT_BY1" => "SORT",
	"SORT_ORDER1" => "DESC",
	"SORT_BY2" => "NAME",
	"SORT_ORDER2" => "ASC",
	"FILTER_NAME" => "introFilter",
	"FIELD_CODE" => array(
		0 => "",
		1 => "",
	),
	"PROPERTY_CODE" => array(
		0 => "ADDRESS",
		1 => "",
	),
	"CHECK_DATES" => "Y",
	"DETAIL_URL" => "",
	"AJAX_MODE" => "N",
	"AJAX_OPTION_JUMP" => "N",
	"AJAX_OPTION_STYLE" => "Y",
	"AJAX_OPTION_HISTORY" => "N",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "36000000",
	"CACHE_FILTER" => "N",
	"CACHE_GROUPS" => "Y",
	"PREVIEW_TRUNCATE_LEN" => "",
	"ACTIVE_DATE_FORMAT" => "d.m.Y",
	"SET_TITLE" => "N",
	"SET_STATUS_404" => "N",
	"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
	"ADD_SECTIONS_CHAIN" => "N",
	"HIDE_LINK_WHEN_NO_DETAIL" => "N",
	"PARENT_SECTION" => "",
	"PARENT_SECTION_CODE" => "",
	"DISPLAY_TOP_PAGER" => "N",
	"DISPLAY_BOTTOM_PAGER" => "Y",
	"PAGER_TITLE" => "Внедрения",
	"PAGER_SHOW_ALWAYS" => "N",
	"PAGER_TEMPLATE" => "",
	"PAGER_DESC_NUMBERING" => "N",
	"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
	"PAGER_SHOW_ALL" => "N",
	"DISPLAY_DATE" => "Y",
	"DISPLAY_NAME" => "Y",
	"DISPLAY_PICTURE" => "Y",
	"DISPLAY_PREVIEW_TEXT" => "Y",
	"AJAX_OPTION_ADDITIONAL" => ""
	),
	false
);?>