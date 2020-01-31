<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if(is_array($arResult["PREVIEW_PICTURE"]))
{
	$arResult['PICTURES'][] = array(
		"S" => CFile::ResizeImageGet(
			$arResult['PREVIEW_PICTURE'],
			array("width" => 88, "height" => 88),
			BX_RESIZE_IMAGE_PROPORTIONAL,
			true
		),
		"M" => CFile::ResizeImageGet(
			$arResult['PREVIEW_PICTURE'],
			array("width" => 326, "height" => 326),
			BX_RESIZE_IMAGE_PROPORTIONAL,
			true
		),
		"L" => CFile::ResizeImageGet(
			$arResult['PREVIEW_PICTURE'],
			array("width" => 900, "height" => 900),
			BX_RESIZE_IMAGE_PROPORTIONAL,
			true
		)
	);
}

if (is_array($arResult['MORE_PHOTO']) && count($arResult['MORE_PHOTO']) > 0)
{
	unset($arResult['DISPLAY_PROPERTIES']['MORE_PHOTO']);
	foreach ($arResult['MORE_PHOTO'] as $key => $arFile)
	{
		$arResult['PICTURES'][] = array(
			"S" => CFile::ResizeImageGet(
				$arFile,
				array("width" => 88, "height" => 88),
				BX_RESIZE_IMAGE_PROPORTIONAL,
				true
			),
			"M" => CFile::ResizeImageGet(
				$arFile,
				array("width" => 326, "height" => 326),
				BX_RESIZE_IMAGE_PROPORTIONAL,
				true
			),
			"L" => CFile::ResizeImageGet(
				$arFile,
				array("width" => 900, "height" => 900),
				BX_RESIZE_IMAGE_PROPORTIONAL,
				true
			)
		);
	}
}
$reviews = CIBlockElement::GetList(
	array("SORT" => "ASC", "ID" => "ASC"), 
	array("IBLOCK_ID" => REVIEWS, "ACTIVE" => "Y", "PROPERTY_PRODUCT" => $arResult["ID"]), 
	false, 
	false, 
	array("ID", "NAME", "PREVIEW_TEXT", "PROPERTY_PRODUCT", "PROPERTY_FILE", "PROPERTY_CLIENT.NAME", "PROPERTY_CLIENT.DETAIL_PAGE_URL", "PROPERTY_CLIENT.PREVIEW_PICTURE")
);
while($review = $reviews->GetNext()) {
	$arResult["REVIEWS"][] = array(
		"ID" => $review["ID"],	
		"NAME" => $review["~NAME"],	
		"PREVIEW_TEXT" => $review["~PREVIEW_TEXT"],	
		"CLIENT" => array(
			"NAME" => $review["PROPERTY_CLIENT_NAME"], 
			"DETAIL_PAGE_URL" => $review["PROPERTY_CLIENT_DETAIL_PAGE_URL"], 
			"PREVIEW_PICTURE" => CFile::ResizeImageGet(
				$review["PROPERTY_CLIENT_PREVIEW_PICTURE"],
				array("width" => 62, "height" => 62),
				BX_RESIZE_IMAGE_PROPORTIONAL_ALT, 
				true
			)
		),
		"FILE" => CFile::GetPath($review["PROPERTY_FILE_VALUE"])
	);
}
if(!empty($arResult["PROPERTIES"]["other_product"]["VALUE"])) {
	foreach($arResult["PROPERTIES"]["other_product"]["VALUE"] as $it) {
		unset($products);
		unset($product);
		$products = CIBlockElement::GetList(array("SORT" => "ASC", "NAME" => "ASC"), array("IBLOCK_ID" => IB_PRODUCTS, "ID" => $it), false, false, array("ID", "NAME", "DETAIL_PAGE_URL", "PREVIEW_PICTURE", "PREVIEW_TEXT"));
		if($product = $products->GetNext()) {
			$arResult["RECOMENTED_PRODUCTS"][] = array(
				"ID" => $product["ID"],
				"NAME" => $product["NAME"],
				"DETAIL_PAGE_URL" => $product["DETAIL_PAGE_URL"],
				"PREVIEW_PICTURE" => CFile::ResizeImageGet(
					$product["PREVIEW_PICTURE"],
					array("width" => 117, "height" => 117),
					BX_RESIZE_IMAGE_PROPORTIONAL_ALT, 
					true
				),
				"PREVIEW_TEXT" => $product["PREVIEW_TEXT"]
			);
		}		
	}
}

?>