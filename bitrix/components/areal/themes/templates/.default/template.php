<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<?if(!empty($arResult)):?>
	<p><?=GetMessage("PREVIEW");?></p>
	<?$n = 0;?>
	<?foreach($arResult as $key => $item):?>
		<div>
			<label class="label_check" for="people_programm_<?=$n?>">
				<input name="people_programm_<?=$n?>" id="people_programm_<?=$n?>" type="checkbox" value="<?=$key?>" /><?=$key?>
			</label>
			<?if(!empty($item)):?>
				<ul class="programs people_programm_<?=$n?>">
					<?foreach($item as $i):?>
						<li><a href="<?=$i["DETAIL_PAGE_URL"]?>"><?=$i["NAME"]?></a></li>
					<?endforeach;?>
				</ul>
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