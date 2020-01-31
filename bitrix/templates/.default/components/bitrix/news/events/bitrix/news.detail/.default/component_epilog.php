<?
	if(empty($arResult["PROPERTIES"]["OPEN"]["VALUE"]) && !$USER->IsAuthorized())
		$arResult["SHOW"] = false;
	elseif(empty($arResult["PROPERTIES"]["OPEN"]["VALUE"]) && !in_array(UG_PO, CUser::GetUserGroup($USER->GetID())))
		$arResult["SHOW"] = false;
	else 
		$arResult["SHOW"] = true;
	if($arResult["SHOW"] == true) {
	
		if(!empty($arResult["PROPERTIES"]["TOWN"]["VALUE"]) && !empty($arResult["PROPERTIES"]["ADDRESS"]["VALUE"])) {
			$query = json_decode(file_get_contents("http://maps.google.com/maps/api/geocode/json?address=".urlencode($arResult["PROPERTIES"]["TOWN"]["VALUE"]." ".$arResult["PROPERTIES"]["ADDRESS"]["VALUE"])."&sensor=false"), true);
			$arPoints=explode(',',$arResult["PROPERTIES"]['POINT']['VALUE']);
			if((double)$arPoints[0]!='' && (double)$arPoints[1]!=''){
				$location["lat"] = (double)$arPoints[0];
				$location["lng"] = (double)$arPoints[1];
			}
			else
				$location = $query["results"][0]["geometry"]["location"];
			if(!empty($location)) {
				$APPLICATION->AddHeadScript('http://api-maps.yandex.ru/2.0/?load=package.full&lang=ru-RU');?>
				<script type="text/javascript">
					ymaps.ready(init);
					function init(){     
						var myMap, myPlacemarkAr;					
						myMap = new ymaps.Map ("map", {
							center: [<?=$location["lat"]?>, <?=$location["lng"]?>],
							zoom: 12,
						});
						myPlacemark = new ymaps.Placemark(
							["<?=$location["lat"]?>", "<?=$location["lng"]?>"], 
							{ 
								content: "<?=$arResult["NAME"]?>",
								//balloonContent: "<?=$arResult["NAME"]?>"
								iconContent: "<?=$arResult["NAME"]?>"
							},
							{
								//preset: 'twirl#darkorangeStretchyIcon'
								preset: 'twirl#blackStretchyIcon'
							}
						);
						myMap.geoObjects.add(myPlacemark);
						myMap.controls.add('zoomControl', { left: 5, top: 5 }).add('typeSelector').add('smallZoomControl', { right: 5, top: 75 }).add('mapTools', { left: 35, top: 5 });
					}
				</script>
				<div id="map" style="width: 100%; height: 268px; margin-bottom: 30px;"></div>
			<?}
		}
	}
?>