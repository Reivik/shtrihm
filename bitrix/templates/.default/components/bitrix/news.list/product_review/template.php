<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if(!empty($arResult["REVIEWS"])):?>
	<table class="show_info">
		<tr>
			<th colspan="2">Клиент</th>
			<th>Отзыв</th>
		</tr>
		<?foreach($arResult["REVIEWS"] as $reviews):?>
			<tr>
				<td class="photo" style="border-right: none;">
					<a class="img" href="<?=substr($reviews["CLIENT"]["DETAIL_PAGE_URL"], 1, strlen($reviews["CLIENT"]["DETAIL_PAGE_URL"])-1)?>" title="<?=$reviews["CLIENT"]["NAME"]?>">
						<?if(!empty($reviews["CLIENT"]["PREVIEW_PICTURE"]["src"])):?>
							<img src="<?=$reviews["CLIENT"]["PREVIEW_PICTURE"]["src"]?>" alt="<?=$reviews["CLIENT"]["NAME"]?>" title="<?=$reviews["CLIENT"]["NAME"]?>" width="<?=$reviews["CLIENT"]["PREVIEW_PICTURE"]["width"]?>" height="<?=$reviews["CLIENT"]["PREVIEW_PICTURE"]["height"]?>">
						<?else:?>
							<img src="/design/images/no-photo/pic102x102.png" alt="<?=$reviews["CLIENT"]["NAME"]?>" title="<?=$reviews["CLIENT"]["NAME"]?>" width="62" height="62">											
						<?endif;?>
					</a>
				</td>
				<td class="name" style="border-left: none;">
					<a href="<?=substr($reviews["CLIENT"]["DETAIL_PAGE_URL"], 1, strlen($reviews["CLIENT"]["DETAIL_PAGE_URL"])-1)?>" title="<?=$reviews["CLIENT"]["NAME"]?>"><strong><?=$reviews["CLIENT"]["NAME"]?></strong></a>
				</td>
				<td class="text">
					<div class="preview_news full"><?echo $reviews["PREVIEW_TEXT"];?></div>
					<a href="#" class="showMorePreview">Показать</a>
					<a href="#" class="hideMorePreview">Спрятать</a>
				</td>
			</tr>
		<?endforeach;?>
	</table>
	<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
		<?=$arResult["NAV_STRING"]?>
	<?endif;?>
<?else:?>
	<p>О данном продукте еще нет отзывов.</p>
<?endif;?>