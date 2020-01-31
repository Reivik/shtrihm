<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?global $k;
?> 


<div class="pageCont">
	<table>
		<tr>
			<th>Подразделение</th>
			<th>ФИО</th>
			<th>Должность</th>
			<th>Контакты</th>
		</tr>
		<tr>
		<?foreach($arResult as $key=>$section):?>
		<td rowspan="<?=count($section['ITEMS']); $k=count($section['ITEMS']);?>">
		<?=$section["SECTION_NAME"]?></td>
		<?$as=0;?>
		<?foreach($section['ITEMS'] as $arEmployee):?>
		<? 
		
		if(($as>0)&&($as!=$k)) echo "<tr>"?>

		<td><?=$arEmployee['NAME']?></td>
		<td><?=$arEmployee['PROPERTIES']['POSITION']['VALUE']?></td>
		<td><?=$arEmployee['PROPERTIES']['PHONE']['NAME']?>: <?=$arEmployee['PROPERTIES']['PHONE']['VALUE']?><br/>
		<?=$arEmployee['PROPERTIES']['EMAIL']['NAME']?>:&nbsp;<a class="e-mail" title="<?=substr($arEmployee['PROPERTIES']['EMAIL']['VALUE'],0,strpos($arEmployee['PROPERTIES']['EMAIL']['VALUE'],'@'));?>" href="#<?=substr($arEmployee['PROPERTIES']['EMAIL']['VALUE'], strrpos($arEmployee['PROPERTIES']['EMAIL']['VALUE'], '@')+1);?>" ></a>
		</td>
	
	<?if(($as>0)&&($as!=$k)) echo "</tr>"?>
	<? $as++?>
			<?endforeach?>
			
			
			</tr>
			
		<?endforeach?>
		
			</table>
</div>

		
					<div class="clear"></div>