<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if(!empty($arResult["SECTIONS"])):?>
	<?foreach($arResult["SECTIONS"] as $key => $section):?>
		<h2><?=$section["NAME"]?></h2>
		<table>
			<tr>
				<th>ФИО</th>
				<th>Должность</th>
				<th>Контакты</th>
			</tr>
			<?foreach($section["ITEMS"] as $item):?>
				<tr>
					<td width="31%"><?=$item['NAME']?></td>
					<td width="31%"><?=$item['POSITION']?></td>
					<td width="38%">
						<?if(!empty($item["PHONE"])):?>
							<b>тел:</b> <?=$item["PHONE"]?><br />
						<?endif;?>
						<?if(!empty($item["MOBILE"])):?>
							<b>моб:</b> <?=$item["MOBILE"]?><br />
						<?endif;?>
						<?if(!empty($item["EMAIL"])):?>
							<?$email = explode("@", $item["EMAIL"]);?>
							<b>email:</b> <a class="e-mail" title="<?=$email[0]?>" href="#<?=$email[1]?>" ></a>
						<?endif;?>
					</td>
				</tr>
			<?endforeach?>
		</table>
	<?endforeach?>
<?else:?>
	<p>К сожалению, не указано ни одного контакта.</p>
<?endif;?>