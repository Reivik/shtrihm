<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<div class="logo_company">
	<table>
		<tr>
			<td>
				<?if(!empty($arResult["COMPANY"]["PREVIEW_PICTURE"]["src"])):?>
					<img src="<?=$arResult["COMPANY"]["PREVIEW_PICTURE"]["src"]?>" title="<?=$arResult["COMPANY"]["NAME"]?>" alt="<?=$arResult["COMPANY"]["NAME"]?>" width="<?=$arResult["COMPANY"]["PREVIEW_PICTURE"]["width"]?>" height="<?=$arResult["COMPANY"]["PREVIEW_PICTURE"]["height"]?>" />
				<?endif;?>
			</td>
		</tr>
	</table>
</div>
<div class="description_fields">
	<div class="field">
		<label class="field_label"><?=GetMessage("COMPANY_NAME")?></label>
		<div class="inputContainerText"><span><?=$arResult["COMPANY"]["NAME"] ? $arResult["COMPANY"]["NAME"] : "&nbsp;"?></span></div>
	</div>
	<div class="field">
		<label class="field_label"><?=GetMessage("COMPANY_SLOGAN")?></label>
		<div class="inputContainerText"><span><?=$arResult["COMPANY"]["SLOGAN"] ? $arResult["COMPANY"]["SLOGAN"] : "&nbsp;"?></span></div>
	</div>
	<div class="field">
		<label class="field_label"><?=GetMessage("COMPANY_NUMBER_PERSON")?></label>
		<div class="inputContainerText"><span><?=$arResult["COMPANY"]["NUMBER_OF_STAFF"] ? $arResult["COMPANY"]["NUMBER_OF_STAFF"] : "&nbsp;"?></span></div>
	</div>
</div>
<div class="clear"></div>
<div class="field">
	<label class="field_label"><?=GetMessage("COMPANY_PREVIEW_TEXT")?></label>
	<div class="textareaContainerText"><span><?=$arResult["COMPANY"]["PREVIEW_TEXT"] ? $arResult["COMPANY"]["PREVIEW_TEXT"] : "&nbsp;"?></span></div>
</div>
<div class="field">
	<label class="field_label"><?=GetMessage("COMPANY_DETAIL_TEXT")?></label>
	<div class="textareaContainerText"><span><?=$arResult["COMPANY"]["DETAIL_TEXT"] ? $arResult["COMPANY"]["DETAIL_TEXT"] : "&nbsp;"?></span></div>
</div>

<div class="field">
	<label class="field_label"><?=GetMessage("COMPANY_OBOROT")?></label>
	<div class="inputContainerText"><span><?=$arResult["COMPANY"]["OBOROT"] ? $arResult["COMPANY"]["OBOROT"] : "&nbsp;"?></span></div>
</div>
<h3><?=GetMessage("COMPANY_STATUS")?></h3>
<?$n = 0;?>
<?foreach($arResult["STATUS"] as $key_stat => $status):?>
	<?if(($n+1)%4 == 0 || $n == 0):?>
		<div class="three_input_container">
	<?endif;?>
		<div class="field <?if(($n+1)%3 == 0):?> last <?endif;?>">
			<label class="label_check" for="c_status_<?=$key_stat?>">
				<input name="COMPANY[FILIALS][<?=$key_stat?>][status][]"<?if(in_array($key_stat, $arResult["COMPANY"]["FILIALS"]["main"]["status"])):?> checked="checked" <?endif;?> id="c_status_<?=$key_stat?>" type="checkbox" disabled value="<?=$key_stat?>" />
				<?=$status?>
			</label>
		</div>
	<?if(($n+1)%3 == 0 || $n == count($arResult["STATUS"])):?>
		</div>
	<?endif?>
	<?$n++;?>
<?endforeach;?>


<div class="clear"></div>
<h3><?=GetMessage("COMPANY_ADDRESS")?></h3>
<div class="three_input_container">
	<?foreach($arResult["REGIONS"] as $key => $region):?>
		<?if($key == $arResult["COMPANY"]["FILIALS"]["main"]["region"]):?>
			<div class="field">
				<label class="field_label"><?=GetMessage("REGION")?></label>
				<div class="inputContainerText"><span><?=$region?></span></div>
			</div>
		<?endif;?>
	<?endforeach;?>
	<?foreach($arResult["TOWNS"][$arResult["COMPANY"]["FILIALS"]["main"]["region"]] as $key => $town):?>
		<?if($key == $arResult["COMPANY"]["FILIALS"]["main"]["town"]):?>
			<div class="field">
				<label class="field_label"><?=GetMessage("TOWN")?></label>
				<div class="inputContainerText"><span><?=$town?></span></div>
			</div>
		<?endif;?>
	<?endforeach;?>
	<div class="field last">
		<label class="field_label"><?=GetMessage("ADDRESS")?></label>
		<div class="inputContainerText"><span><?=$arResult["COMPANY"]["FILIALS"]["main"]["address"] ? $arResult["COMPANY"]["FILIALS"]["main"]["address"] : "&nbsp;"?></span></div>
	</div>
</div>
<div class="clear"></div>
<h3><?=GetMessage("COMPANY_CONACTS")?></h3>	
<div class="three_input_container">
	<div class="field">
		<label class="field_label"><?=GetMessage("PHONE")?></label>
		<div class="inputContainerText"><span><?=$arResult["COMPANY"]["FILIALS"]["main"]["phone"] ? $arResult["COMPANY"]["FILIALS"]["main"]["phone"] : "&nbsp;"?></span></div>
	</div>
	<div class="field">
		<label class="field_label"><?=GetMessage("EMAIL")?></label>
		<div class="inputContainerText"><span><?=$arResult["COMPANY"]["FILIALS"]["main"]["email"] ? $arResult["COMPANY"]["FILIALS"]["main"]["email"] : "&nbsp;"?></span></div>
	</div>
	<div class="field last">
		<label class="field_label"><?=GetMessage("COMPANY_WEBSITE")?></label>
		<div class="inputContainerText"><span><?=$arResult["COMPANY"]["SITE"] ? $arResult["COMPANY"]["SITE"] : "&nbsp;"?></span></div>
	</div>
</div>
<div class="clear"></div>
<h3><?=GetMessage("COMPANY_DETAILS")?></h3>
<div class="field">
	<label class="field_label"><?=GetMessage("COMPANY_LEGAL_ADDRESS")?></label>
	<div class="inputContainerText"><span><?=$arResult["COMPANY"]["LEGAL_ADDRESS"] ? $arResult["COMPANY"]["LEGAL_ADDRESS"] : "&nbsp;"?></span></div>
</div>
<div class="two_input_container">
	<div class="field">
		<label class="field_label"><?=GetMessage("COMPANY_INN")?></label>
		<div class="inputContainerText"><span><?=$arResult["COMPANY"]["INN"] ? $arResult["COMPANY"]["INN"] : "&nbsp;"?></span></div>
	</div>
	<div class="field last">
		<label class="field_label"><?=GetMessage("COMPANY_KPP")?></label>
		<div class="inputContainerText"><span><?=$arResult["COMPANY"]["KPP"] ? $arResult["COMPANY"]["KPP"] : "&nbsp;"?></span></div>
	</div>		
	<div class="clear"></div>
</div>	
<div class="field">
	<label class="field_label"><?=GetMessage("COMPANY_RASCH_SHCET")?></label>
	<div class="inputContainerText"><span><?=$arResult["COMPANY"]["PAYMENT_ACCOUNT"] ? $arResult["COMPANY"]["PAYMENT_ACCOUNT"] : "&nbsp;"?></span></div>
</div>
<div class="field">
	<label class="field_label"><?=GetMessage("COMPANY_KORR_SCHET")?></label>
	<div class="inputContainerText"><span><?=$arResult["COMPANY"]["CORR_ACCOUN"] ? $arResult["COMPANY"]["CORR_ACCOUN"] : "&nbsp;"?></span></div>
</div>
<div class="field">
	<label class="field_label"><?=GetMessage("COMPANY_BIK")?></label>
	<div class="inputContainerText"><span><?=$arResult["COMPANY"]["BIK"] ? $arResult["COMPANY"]["BIK"] : "&nbsp;"?></span></div>
</div>
<div class="field">
	<label class="field_label"><?=GetMessage("COMPANY_BANK")?></label>
	<div class="inputContainerText"><span><?=$arResult["COMPANY"]["BANK"] ? $arResult["COMPANY"]["BANK"] : "&nbsp;"?></span></div>	
</div>
<div class="about">
	<h3><?=GetMessage("COMPANY_FILIALS")?></h3>
	<?if($arResult["COMPANY"]["FILIALS"]):?>
		<table>
			<tr>
				<th><?=GetMessage("FILIALS_DATA")?></th>
			</tr>
			<?foreach($arResult["COMPANY"]["FILIALS"] as $key => $filial):?>
				<?if($key != "main"):?>
					<tr class="filials">
						<td class="filial_description view">
							<label class="field_label"><?=GetMessage("STATUS")?></label>
							<div class="clear"></div>									
							<?$n = 0;?>
							<?foreach($arResult["STATUS"] as $key_stat => $status):?>
								<div class="field <?if(($n+1)%2 == 0):?> last <?endif;?>">
									<label class="label_check" for="c_status_<?=$key_stat?>">
										<input name="COMPANY[FILIALS][<?=$key?>][status][]"<?if(in_array($key_stat, $filial["status"])):?> checked="checked" <?endif;?> id="c_status_<?=$key_stat?>" type="checkbox" disabled value="<?=$key_stat?>" />
										<?=$status?>
									</label>
								</div>
								<?$n++;?>
							<?endforeach;?>
							<div class="clear"></div>
							<div class="regions_towns">
								<?foreach($arResult["REGIONS"] as $r => $region):?>
									<?if($r == $filial["region"]):?>
											<div class="field">
												<label class="field_label"><?=GetMessage("REGION")?></label>
												<div class="inputContainerText"><span><?=$region?></span></div>
											</div>
									<?endif;?>
								<?endforeach;?>
								<?foreach($arResult["TOWNS"][$filial["region"]] as $t => $town):?>
									<?if($t == $filial["town"]):?>
										<div class="field last">
											<label class="field_label"><?=GetMessage("TOWN")?></label>
											<div class="inputContainerText"><span><?=$town?></span></div>
										</div>
										<div class="clear"></div>
									<?endif;?>
								<?endforeach;?>
							</div>
							<div class="field">
								<label class="field_label"><?=GetMessage("ADDRESS")?></label>
								<div class="inputContainerText"><span><?=$filial["address"] ? $filial["address"] : "&nbsp;"?></span></div>
							</div>		
							<?foreach($arResult["OFFICE"] as $of):?>
								<?if($of == $filial["office"]):?>
									<div class="field last">
										<label class="field_label"><?=GetMessage("OFFICE")?></label>
										<div class="inputContainerText"><span><?=$of?></span></div>
									</div>
								<?endif;?>
							<?endforeach;?>
							<div class="clear"></div>
							
							<div class="field">
								<label class="field_label"><?=GetMessage("PHONE")?></label>
								<div class="inputContainerText"><span><?=$filial["phone"] ? $filial["phone"] : "&nbsp;"?></span></div>
							</div>
							<div class="field last">
								<label class="field_label"><?=GetMessage("EMAIL")?></label>
								<div class="inputContainerText"><span><?=$filial["email"] ? $filial["email"] : "&nbsp;"?></span></div>
							</div>
							<div class="clear"></div>
						</td>
					</tr>
				<?endif;?>
			<?endforeach;?>	
		</table>
	<?endif;?>
</div>
<?if(!empty($arResult["COMPANY"]["PARTNERS_LEVELS"])):?>
	<div class="two_input_container levels">
		<div class="field">
			<h3><?=GetMessage("PARTNER_LEVEL");?></h3>
		</div>
		<div class="field last">
			<?foreach($arResult["COMPANY"]["PARTNERS_LEVELS"] as $level):?>
				<span class="level"><?=$level?></span><br />
			<?endforeach;?>
		</div>		
		<div class="clear"></div>
	</div>
<?endif;?>