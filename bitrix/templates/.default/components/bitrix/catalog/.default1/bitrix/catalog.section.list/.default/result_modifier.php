<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if(!empty($arResult["SECTIONS"])) {
	foreach($arResult["SECTIONS"] as $key => $section) {
		if(!empty($section["PICTURE"])) {
			$arResult["SECTIONS"][$key]["PICTURE"] = CFile::ResizeImageGet(
				$section["PICTURE"]["ID"],
				array("width" => 102, "height" => 102),
				BX_RESIZE_IMAGE_PROPORTIONAL,
				true,
				$arFilter
			);
		}
	}
}?>