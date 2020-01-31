<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?$arForum_left = array();
$arForum_T_left = array();
$arForum_F_left = array();

$arForum_right = array();
$arForum_T_right = array();
$arForum_F_right = array();

$arFilter = Array("IBLOCK_ID"=>70, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
$temp = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>50), $arSelect);
while ($arItem = $temp->Fetch())
{	
	$arForum_T_left['ID'] =  $arItem['ID'];
	$arForum_T_left['IBLOCK_SECTION_ID'] =  $arItem['IBLOCK_SECTION_ID'];
	$arForum_T_left['NAME'] =  $arItem['NAME'];
	$temp_property = CIBlockElement::GetProperty($arItem['IBLOCK_ID'], $arItem['ID'], array("sort"=>"asc"), array());
	while($ar_props = $temp_property->Fetch()){
		$arForum_T_left['LINK'] =  $ar_props['VALUE'];
	}
	$catalog = CIBlockSection::GetByID($arItem['IBLOCK_SECTION_ID']);
	while($ar_props = $catalog->Fetch()){
		$arForum_F_left["ID"] = $ar_props['ID'];
		$arForum_F_left["NAME"] = $ar_props['NAME'];
	}	
	$arForum_left["ITEMS"]["ELEMENT"][] = $arForum_T_left;
	if($arForum_left["ITEMS"]["TITLE"]){
		$tmp = 0;
		foreach($arForum_left["ITEMS"]["TITLE"] as $key => $value_t):
			if($value_t['ID'] == $arForum_F_left["ID"]){
				$tmp = $tmp + 1;
			} 
		endforeach;
		if($tmp == 0){
			$arForum_left["ITEMS"]["TITLE"][] = $arForum_F_left;
		}
	}
	else{
		$arForum_left["ITEMS"]["TITLE"][] = $arForum_F_left;
	}
}

$arFilter = Array("IBLOCK_ID"=>71, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
$temp = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>50), $arSelect);
while ($arItem = $temp->Fetch())
{	
	$arForum_T_right['ID'] =  $arItem['ID'];
	$arForum_T_right['IBLOCK_SECTION_ID'] =  $arItem['IBLOCK_SECTION_ID'];
	$arForum_T_right['NAME'] =  $arItem['NAME'];
	$temp_property = CIBlockElement::GetProperty($arItem['IBLOCK_ID'], $arItem['ID'], array("sort"=>"asc"), array());
	while($ar_props = $temp_property->Fetch()){
		$arForum_T_right['LINK'] =  $ar_props['VALUE'];
	}
	$catalog = CIBlockSection::GetByID($arItem['IBLOCK_SECTION_ID']);
	while($ar_props = $catalog->Fetch()){
		$arForum_F_right["ID"] = $ar_props['ID'];
		$arForum_F_right["NAME"] = $ar_props['NAME'];
	}
	
	$arForum_right["ITEMS"]["ELEMENT"][] = $arForum_T_right;
	if($arForum_right["ITEMS"]["TITLE"]){
		$tmp = 0;
		foreach($arForum_right["ITEMS"]["TITLE"] as $key => $value_t):
			if($value_t['ID'] == $arForum_F_right["ID"]){
				$tmp = $tmp + 1;
			} 
		endforeach;
		if($tmp == 0){
			$arForum_right["ITEMS"]["TITLE"][] = $arForum_F_right;
		}
	}
	else{
		$arForum_right["ITEMS"]["TITLE"][] = $arForum_F_right;
	}
}?>

<div id="forum" class="block"> 
	<div class="block_center_up"><h2>Форумы</h2></div>
		<div class="block_left">
			<h2 class="h2_text">
				<?$APPLICATION->IncludeComponent(
		"bitrix:main.include","",
		Array(
			"AREA_FILE_SHOW" => "file",
			"PATH" => SITE_DIR."include/2018/Headers/Forumi/Forumi_left.php"
			)
		);?>
			</h2>
			<?foreach($arResult["ITEMS"]["2018"]["LEFT"]["FORUM"] as $key => $value_f):?>			
				<p class="forum_p"><a class="block_p_black_a" href="<?=$value_f["LINK"]?>"  target="_balnk"><span class="block_p_black"><?=$value_f["FORUM_NAME"]?></span></a></p>
				<?foreach($arResult["ITEMS"]["2018"]["LEFT"]["TITLE"] as $key => $value_t):?>
					<?if($value_t["FORUM_ID"] == $value_f["FORUM_ID"]){?>
						<a href="<?=$value_t["LINK"]?>" target="_blank" class="block_link"><?=$value_t["TITLE_NAME"]?></a>
					<?}?>
				<?endforeach;?>
			<?endforeach;?>
			
			<?if($arForum_left){?>
				<?foreach($arForum_left["ITEMS"]["TITLE"] as $key => $value_t):?>
					<p><span class="block_p_black"><?=$value_t["NAME"]?></span></p>
					<?foreach($arForum_left["ITEMS"]["ELEMENT"] as $key => $value_e):?>
						<?if($value_e["IBLOCK_SECTION_ID"] == $value_t["ID"]){?>						
							<a href="<?=$value_e["LINK"]?>" target="_blank" class="block_link"><?=$value_e["NAME"]?></a>
						<?}?>
					<?endforeach;?>
				<?endforeach;?>
			<?}?>
			
		</div>				
		<div class="block_center">
			<p>
			<?$APPLICATION->IncludeComponent("bitrix:main.include","",Array(
			"AREA_FILE_SHOW" => "file", 
			"PATH" => SITE_DIR."include/2018/Forumi.php"
			)
			);?>
			</p>
			<span id="forum_img" class="icon_center"></span>
		</div>				
		<div class="block_right">
			<h2 class="h2_text">
				<?$APPLICATION->IncludeComponent(
		"bitrix:main.include","",
		Array(
			"AREA_FILE_SHOW" => "file",
			"PATH" => SITE_DIR."include/2018/Headers/Forumi/Forumi_right.php"
			)
		);?>
			</h2>
			<?foreach($arResult["ITEMS"]["2018"]["RIGHT"]["FORUM"] as $key => $value_f):?>			
				<p class="forum_p"><a class="block_p_black_r_a" href="<?=$value_f["LINK"]?>"  target="_balnk"><span class="block_p_black_r"><?=$value_f["FORUM_NAME"]?></span></a></p>
				<?foreach($arResult["ITEMS"]["2018"]["RIGHT"]["TITLE"] as $key => $value_t):?>
					<?if($value_t["FORUM_ID"] == $value_f["FORUM_ID"]){?>
						<a href="<?=$value_t["LINK"]?>" target="_blank" class="block_link"><?=$value_t["TITLE_NAME"]?></a>
					<?}?>
				<?endforeach;?>
			<?endforeach;?>
			
			<?if($arForum_right){?>
				<?foreach($arForum_right["ITEMS"]["TITLE"] as $key => $value_t):?>
					<p><span class="block_p_black_r"><?=$value_t["NAME"]?></span></p>
					<?foreach($arForum_right["ITEMS"]["ELEMENT"] as $key => $value_e):?>
						<?if($value_e["IBLOCK_SECTION_ID"] == $value_t["ID"]){?>						
							<a href="<?=$value_e["LINK"]?>" target="_blank" class="block_link"><?=$value_e["NAME"]?></a>
						<?}?>
					<?endforeach;?>
				<?endforeach;?>
			<?}?>
			
		</div>
	<div class="block_center_down"></div>
</div>