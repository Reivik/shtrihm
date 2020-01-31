<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (count($arResult["ITEMS"]) < 1):?>
	<?return;?>
<?endif;?>
<div class="block slider">
	<div class="blockCont">
		<ul class="sliderItems">
			<?foreach($arResult["ITEMS"] as $key => $arItem):?>
			<?
				$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
				$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('NEWS_ELEMENT_DELETE_CONFIRM')));
			?>
			<?if(is_array($arItem["PREVIEW_PICTURE"])):?>
				<li  id="<?=$this->GetEditAreaId($arItem['ID']);?>" class="<?if($key==0):?>current<?endif;?>" style="display:none;">
					<img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt=""/>
					<div class="slideText">
						<h2><?=$arItem["NAME"]?></h2>
						<?if($arItem["PREVIEW_PICTURE"]["DESCRIPTION"]):?>
							<p><i>На фото:</i></p>
							<p><?=$arItem["PREVIEW_PICTURE"]["DESCRIPTION"]?></p>
						<?endif;?>
					</div>
				</li>
			<?endif;?>
			<?endforeach;?>
		</ul>
		
		<ul class="sliderNav">
			<?foreach($arResult["ITEMS"] as $key => $arItem):?>
				<li><a href="" class="<?if($key==0):?>current<?endif;?>"><?=$key+1?></a></li>
			<?endforeach;?>
		</ul>
	</div>
</div>