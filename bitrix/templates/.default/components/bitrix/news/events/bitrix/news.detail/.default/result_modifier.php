<?
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
if (is_array($arResult["PROPERTIES"]["MORE_PHOTO"]["VALUE"]) && count($arResult["PROPERTIES"]["MORE_PHOTO"]["VALUE"]) > 0)
{
	foreach($arResult["PROPERTIES"]["MORE_PHOTO"]["VALUE"] as $key => $arFile)
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
	unset($arResult["PROPERTIES"]["MORE_PHOTO"]["VALUE"]);
}

	if(empty($arResult["PROPERTIES"]["OPEN"]["VALUE"]) && !$USER->IsAuthorized())
		$arResult["SHOW"] = false;
	elseif(empty($arResult["PROPERTIES"]["OPEN"]["VALUE"]) && !in_array(UG_PO, CUser::GetUserGroup($USER->GetID())))
		$arResult["SHOW"] = false;
	else 
		$arResult["SHOW"] = true;
	if($arResult["SHOW"] == true) {
		if(!empty($arResult["PROPERTIES"]["TOWN"]["VALUE"])) {
			$obj = CIBlockElement::GetList(array(), array("IBLOCK_ID" => IB_CITIES, "ID" => $arResult["PROPERTIES"]["TOWN"]["VALUE"]), false, false, array("ID","NAME"));
			while($town = $obj->GetNext())
				$arResult["PROPERTIES"]["TOWN"]["VALUE"] = $town["NAME"];
		}		
	}
?>