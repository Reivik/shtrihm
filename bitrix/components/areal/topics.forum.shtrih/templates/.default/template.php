<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="block client topics-forum">
	<div class="blockCont">
		<h2>Форум</h2>
		<ul>
			<?foreach($arResult["ITEMS"] as $num=>$topic):?>
			<li><a href="<?=$topic["LINK"]?>" title="" target="_blank"><?=$topic["TITLE"]?></a></li>
			<?endforeach?>
		</ul>
		<input type="hidden" name="last_topic_date" value="<?=$arResult["LAST_DATE"]?>" />
		<input type="hidden" name="comp_path" value="<?=$componentPath?>" />
	</div>
	<div class="all-topics">
		<a href="http://forum.shtrih-m.ru" title="" target="_blank">Все темы</a>
	</div>
</div>