<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if(!empty($arResult["COMPANY"])):?>
	<h2><?=$arResult["COMPANY"]["NAME"]?></h2>
	<div class="manager">
		Ваше партнерство подтверждено
	</div>
	<div class="manager">
		<h3>Ваш региональный менеджер</h3>
		<?if(!empty($arResult["COMPANY"]["REGIONAL_MANAGER"]["ID"])):?>
			<table>
				<tr>
					<td>фИО</td>
					<td><?=$arResult["COMPANY"]["REGIONAL_MANAGER"]["NAME"]?></td>						
				</tr>
				<tr>
					<td>Телефон</td>
					<td><?=$arResult["COMPANY"]["REGIONAL_MANAGER"]["PHONE"]?></td>						
				</tr>
				<tr>
					<td>Email</td>
					<td><?=$arResult["COMPANY"]["REGIONAL_MANAGER"]["EMAIL"]?></td>						
				</tr>
				<tr>
					<td>Skype</td>
					<td><?=$arResult["COMPANY"]["REGIONAL_MANAGER"]["SKYPE"]?></td>						
				</tr>
				<tr>
					<td>IСQ</td>
					<td><?=$arResult["COMPANY"]["REGIONAL_MANAGER"]["ICQ"]?></td>						
				</tr>
			</table>
		<?else:?>
			Нет данных о региональном менеджере для Вашей компании
		<?endif;?>
	</div>
	<div class="manager">
		<h3>Ваш менеджер по продажам</h3>
		<?if(!empty($arResult["COMPANY"]["SALES_MANAGER"]["ID"])):?>
			<table>
				<tr>
					<td>фИО</td>
					<td><?=$arResult["COMPANY"]["SALES_MANAGER"]["NAME"]?></td>						
				</tr>
				<tr>
					<td>Телефон</td>
					<td><?=$arResult["COMPANY"]["SALES_MANAGER"]["PHONE"]?></td>						
				</tr>
				<tr>
					<td>Email</td>
					<td><?=$arResult["COMPANY"]["SALES_MANAGER"]["EMAIL"]?></td>						
				</tr>
				<tr>
					<td>Skype</td>
					<td><?=$arResult["COMPANY"]["SALES_MANAGER"]["SKYPE"]?></td>						
				</tr>
				<tr>
					<td>IСQ</td>
					<td><?=$arResult["COMPANY"]["SALES_MANAGER"]["ICQ"]?></td>						
				</tr>
			</table>
		<?else:?>
			Нет данных о менеджере по продажам для Вашей компании
		<?endif;?>
	</div>
	<?if(!empty($arResult["COMPANY"]["PARTNER_AGREEMENT"])):?>
		<div class="manager">
			Соглашение о партнерстве № <strong><?=$arResult["COMPANY"]["PARTNER_AGREEMENT"]?></strong><br />
			Срок действия соглашения о партнерстве: <?=$arResult["COMPANY"]["TERM_AGREEMENT"]?>
		</div>
	<?endif;?>
	<?if(!empty($arResult["COMPANY"]["SUPPLY_AGREEMENT"])):?>
		<div class="manager">
			Договор о поставке № <strong><?=$arResult["COMPANY"]["SUPPLY_AGREEMENT"]?></strong><br />
			Срок действия договора о поставке: <?=$arResult["COMPANY"]["TERM_SUPP_AGR"]?>
		</div>
	<?endif;?>
	<?if(!empty($arResult["COMPANY"]["LICENSE_AGREEMENT"])):?>
		<div class="manager">
			Лицензионный договор № <strong><?=$arResult["COMPANY"]["LICENSE_AGREEMENT"]?></strong><br />
			Срок действия лицензионного договора: <?=$arResult["COMPANY"]["TERM_LICENSE_AGR"]?>
		</div>
	<?endif;?>		
<?endif;?>