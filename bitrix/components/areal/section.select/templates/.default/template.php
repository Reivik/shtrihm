<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<select <?if($arParams['SET_ID']!="") echo "id='".$arParams['SET_ID']."'"?> <?if($arParams['SET_NAME']!="") echo "name='".$arParams['SET_NAME']."'"?>>
	<option value="0" <?if(0==$arParams['SECTION_ID']) echo "selected"?>>
		<?=$arParams['DEFAULT_NAME']?>
	</option>
	<?foreach($arResult["SECTIONS"] as $id=>$val):?>
		<?if($val['COUNT']>0):?>
			<option value="<?=$id?>" <?if($id==$arParams['SECTION_ID']) echo "selected"?>>
				<?=$val['NAME']?>
			</option>
		<?endif;?>
	<?endforeach;?>
</select>