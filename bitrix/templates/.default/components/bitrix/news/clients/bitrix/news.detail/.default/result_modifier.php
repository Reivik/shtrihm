<?
if(isset($arResult["PREVIEW_PICTURE"]) && is_array($arResult["PREVIEW_PICTURE"])) {
	$arResult['PICTURES'][] = array(
		"M" => CFile::ResizeImageGet(
			$arResult["PREVIEW_PICTURE"]["ID"],
			array("width" => 307, "height" => 307),
			BX_RESIZE_IMAGE_PROPORTIONAL_ALT,
			true
		),
		"L" => CFile::ResizeImageGet(
			$arResult["PREVIEW_PICTURE"]["ID"],
			array("width" => 900, "height" => 900),
			BX_RESIZE_IMAGE_PROPORTIONAL_ALT,
			true
		)
	);
}
$reviews = CIBlockElement::GetList(
	array("SORT" => "ASC", "ID" => "ASC"), 
	array("IBLOCK_ID" => REVIEWS, "ACTIVE" => "Y", "PROPERTY_CLIENT" => $arResult["ID"], "!PROPERTY_PRODUCT" => false), 
	false, 
	false, 
	array("ID", "NAME", "PREVIEW_TEXT", "PROPERTY_CLIENT", "PROPERTY_FILE", "PROPERTY_PRODUCT.NAME", "PROPERTY_PRODUCT.DETAIL_PAGE_URL", "PROPERTY_PRODUCT.PREVIEW_PICTURE")
);
while($review = $reviews->GetNext()) {
	$arResult["REVIEWS"][] = array(
		"ID" => $review["ID"],	
		"NAME" => $review["~NAME"],	
		"PREVIEW_TEXT" => $review["PREVIEW_TEXT"],
		"PRODUCT" => array(
			"NAME" => $review["PROPERTY_PRODUCT_NAME"], 
			"DETAIL_PAGE_URL" => $review["PROPERTY_PRODUCT_DETAIL_PAGE_URL"], 
			"PREVIEW_PICTURE" => $review["PROPERTY_PRODUCT_PREVIEW_PICTURE"] ? CFile::ResizeImageGet(
				$review["PROPERTY_PRODUCT_PREVIEW_PICTURE"],
				array("width" => 62, "height" => 62),
				BX_RESIZE_IMAGE_PROPORTIONAL_ALT, 
				true
			) : ""
		)		
	);
	foreach($review["PROPERTY_FILE_VALUE"] as $file)
		$arResult['PICTURES'][] = array(
			"M" => CFile::ResizeImageGet(
				$file,
				array("width" => 307, "height" => 307),
				BX_RESIZE_IMAGE_PROPORTIONAL_ALT,
				true
			),
			"L" => CFile::ResizeImageGet(
				$file,
				array("width" => 900, "height" => 900),
				BX_RESIZE_IMAGE_PROPORTIONAL_ALT,
				true
			)
		);
}

$introductions = CIBlockElement::GetList(
	array("SORT" => "ASC", "ID" => "ASC"), 
	array("IBLOCK_ID" => IB_INTRO, "ACTIVE" => "Y", "PROPERTY_CLIENT" => $arResult["ID"]), 
	false, 
	false, 
	array("ID", "NAME", "PREVIEW_PICTURE", "PREVIEW_TEXT", "PROPERTY_CLIENT", "DETAIL_PAGE_URL")
);
while($introduction = $introductions->GetNext()) {
	$arResult["INTRODUCTIONS"][] = array(
		"ID" => $introduction["ID"],	
		"NAME" => $introduction["~NAME"],	
		"PREVIEW_PICTURE" => CFile::ResizeImageGet(
			$introduction["PREVIEW_PICTURE"],
			array("width" => 62, "height" => 62),
			BX_RESIZE_IMAGE_PROPORTIONAL_ALT, 
			true
		),
		"PREVIEW_TEXT" => $introduction["PREVIEW_TEXT"],
		"DETAIL_PAGE_URL" => $introduction["DETAIL_PAGE_URL"]
	);
}
?>