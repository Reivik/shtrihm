<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<h2><?=GetMessage("STEP_2")?></h2>
<div class="default_forms">
	<h3><?=GetMessage("KKT_QUANTITY")?></h3>
	<?
		$array = array(
			"Общее количество ККТ (все марки, включая ШТРИХ-М)",
			//"ККМ ЭЛВЕС-МИКРО-Ф",
			//"ККМ ЭЛВЕС-01-03Ф",
			//"ККМ ЭЛВЕС-МИНИ-ФР-Ф",
			//"ККМ ЭЛВЕС-МИНИ-Ф",
			//"ККМ ШТРИХ-POS-Ф",
			//"ККМ ШТРИХ-МИКРО-Ф",
			//"ККМ ШТРИХ-МИНИ-Ф",
			//"ККМ ШТРИХ-2000Ф",
			//"ККМ ШТРИХ-ФР-Ф",
			"ККМ ЭЛВЕС-МИКРО-К версия 01",
			"ККМ ЭЛВЕС-МИКРО-К версия 02",
			"ККМ ШТРИХ-МИНИ-К версия 01",
			"ККМ ШТРИХ-МИНИ-К версия 02",
			"ККМ ЭЛВЕС-МК",
			"ККМ ЭЛВЕС-ФР-К версия 01",
			"ККМ ШТРИХ-ФР-К версия 01",
			"ККМ ШТРИХ-МИНИ-ФР-К версия 01",
			"ККМ ШТРИХ-КОМБО-ФР-К версия 01",
			"ККМ ШТРИХ-950К версия 01",
			"ККМ ШТРИХ-М-ФР-К",
			"ККМ ШТРИХ-LIGHT-ФР-К",
			"ККМ ШТРИХ-ТАКСИ-К",
			//"Весы ШТРИХ-ПРИНТ",
			"ККМ ШТРИХ-КИОСК-ФР-К",
			"ШТРИХ-КОМБО-ПТК",
			"ШТРИХ-LIGHT-ПТК",
			"ШТРИХ-М-ПТК"
		);
	?>
	<table>
		<tr>
			<th></th>
			<th>Реализовано в 2015 году (шт.)</th>
			<th>Обслуживается на <?=date("d.m.Y")?> (шт.)</th>
		</tr>
		<?foreach($array as $th):?>
			<tr>
				<td><?=$th?></td>
				<td>
					<div class="inputContainer">
						<input name="PROPERTY[KKT_QUANTITY][<?=$th?>][2011]" class="number" type="text" value="<?=$_REQUEST["PROPERTY"]["KKT_QUANTITY"][$th][2011] ? htmlspecialchars($_REQUEST["PROPERTY"]["KKT_QUANTITY"][$th][2011]) : htmlspecialchars($_SESSION["FORM"]["PROPERTY"]["KKT_QUANTITY"][$th][2011])?>" />
					</div>
				</td>
				<td>
					<div class="inputContainer">
						<input name="PROPERTY[KKT_QUANTITY][<?=$th?>][today]" class="number" type="text" value="<?=$_REQUEST["PROPERTY"]["KKT_QUANTITY"][$th]["today"] ? htmlspecialchars($_REQUEST["PROPERTY"]["KKT_QUANTITY"][$th]["today"]) : htmlspecialchars($_SESSION["FORM"]["PROPERTY"]["KKT_QUANTITY"][$th]["today"])?>" />
					</div>
				</td>
			</tr>
		<?endforeach;?>
	</table>
	<h3>Другие производители оборудования, продукцию которых вы реализуете и обслуживаете</h3>
	<?$proizvoditeli = array(
		"АРКУС-Д",	
		"ПРО САМ",	
		"Инкотекс",
		"КАСБИ",
		"ОКА",
		"ТЕРЛИС",
		"Искра",
		"Счетмаш",
		"Орион",
		"Сервис Плюс",	
		"ККС",
		"ПОС система",
		"Пэй Киоск",
		"ЯРУС"
	);?>
	<?foreach($proizvoditeli as $pr):?>
		<label class="label_check" for="people_contacts">
			<input name="PROPERTY[PROIZVODITELI][<?=$pr?>]" type="checkbox" value="<?=$pr?>" <?if($_REQUEST["PROPERTY"]["PROIZVODITELI"][$pr] == $pr || $_SESSION["FORM"]["PROPERTY"]["PROIZVODITELI"][$pr] == $pr):?> checked="checked" <?endif;?> /><?=$pr?>
		</label>
	<?endforeach;?>
</div>
<input type="hidden" name="next_step" value="3" />
<input type="hidden" name="prev_step" value="1" />
<button type="submit" name="directions" class="orange_submit" value="prev"><?=mb_strtoupper(GetMessage("BACK"))?></button>
<button type="submit" name="directions" class="orange_submit" value="next"><?=mb_strtoupper(GetMessage("CONTINUE"))?></button>