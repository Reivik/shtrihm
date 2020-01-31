<div class="index-news">
<div class="index-news__wrap">
<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<?if(!empty($arResult)):?>
	<p><?=GetMessage("PREVIEW");?></p>
	<?$n = 0;?>
	<?foreach($arResult as $key => $item):?>
		<div>
			<h3><?=$key?></h3>
			<?if(!empty($item)):?>
					<?foreach($item as $i):?>
						<div class="index-news__col">
        <div class="index-news__item">
          <div class="index-news__teaser">
            <a href="<?=$i["DETAIL_PAGE_URL"]?>"><img src="<?=CFile::GetPath($i["PREVIEW_PICTURE"])?>"></a>
          </div>
          <div class="index-news__caption">
            <a href="<?=$i["DETAIL_PAGE_URL"]?>"><?=$i["NAME"]?> </a>
          </div>
        </div>
      </div>
		<?endforeach;?>
			<?endif;?>
			<div class="clear"></div>
		</div>
		<?$n++;?>
	<?endforeach;?>
<?else:?>
	<p><?=GetMessage("NO_ITEM");?></p>
<?endif;?>
<script>
	
</script>
</div></div>