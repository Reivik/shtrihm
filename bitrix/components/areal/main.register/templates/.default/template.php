<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();?>
<?if($_REQUEST['success_partner'] == 'Y'):?>
	<?echo ShowNote(GetMessage('MAIN_REGISTER_AUTH'))?>
<?elseif($_REQUEST['success_user'] == 'Y'):?>
	<?echo ShowNote(GetMessage('MAIN_REGISTER_AUTH_USER'))?>
<?else:?>
	<?include($_SERVER['DOCUMENT_ROOT'].$templateFolder.'/filial_template.php');?>
	<?include($_SERVER['DOCUMENT_ROOT'].$templateFolder.'/people_template.php');?>
	<?if(count($arResult['ERROR']) > 0):?>
		<?ShowError(implode('<br />', $arResult['ERROR']));?>
	<?elseif($arResult['USE_EMAIL_CONFIRMATION'] === 'Y'):?>
		<p><?echo GetMessage('REGISTER_EMAIL_WILL_BE_SENT')?></p>
	<?endif?>
	<?/*<p><?=GetMessage('REGISTRATION_DESCRIPTION')?></p>*/?>
	<form class='protection' method='post' action='<?=POST_FORM_ACTION_URI?>' name='regform' enctype='multipart/form-data'>
		<?=bitrix_sessid_post()?>
		<?if($arResult['BACKURL'] <> ''):?>
			<input type='hidden' name='backurl' value='<?=$arResult['BACKURL']?>' />
		<?endif;?>
		<div class='radioBlock'>
			<h3><?=GetMessage('CHOSE_SPOSOB')?></h3>
			<label class='label_radio' for='regform_user'><input name='user' id='regform_user' value='user' type='radio' <?if(!isset($_REQUEST['user']) || $_REQUEST['user'] == 'user'):?> checked='checked' <?endif;?>><?=GetMessage('USER')?></label>
			<label class='label_radio' for='regform_partner'><input name='user' id='regform_partner' value='partner' type='radio' <?if($_REQUEST['user'] == 'partner'):?> checked='checked' <?endif;?>><?=GetMessage('PARTNER')?></label>
		</div>
		<div id='user_form'>
			<h2><?=GetMessage('PERSON_DATA')?></h2>
			<div class='info_block_form'>	
				<div class='inputContainer'>
					<input type='text' name='PERSON[NAME]' value='<?=htmlspecialchars($_REQUEST['PERSON']['NAME'])?>' placeholder='<?=GetMessage('FULL_NAME')?>' />
				</div>
				<div class='small_input_two'>
					<div class='field'>
						<div class='inputContainer'>	
							<input type='text' name='PERSON[EMAIL]' value='<?=htmlspecialchars($_REQUEST['PERSON']['EMAIL'])?>' placeholder='<?=GetMessage('CONTACT_EMAIL')?>' />
						</div>	
					</div>
					<div class='field last'>
						<div class='inputContainer'>	
							<input type='text' name='PERSON[PHONE]' class='phone' value='<?=htmlspecialchars($_REQUEST['PERSON']['PHONE'])?>' placeholder='<?=GetMessage('CONTACT_PHONE')?>' />
						</div>
					</div>
				<div class='clear'></div>
				</div>	
			</div>
		</div>
		<div id='partner_form'>
			<h2><?=GetMessage('ABOUT_COMPANY')?></h2>
			<div class='info_block_form about reg'>
				<div class='field'>
					<div class='inputContainer'>
						<input type='text' name='COMPANY[NAME]' value='<?=htmlspecialchars($_REQUEST['COMPANY']['NAME'])?>' placeholder='<?=GetMessage('COMPANY_NAME')?>' />
					</div>
				</div>
				<div class='field'>
					<div class='im_input'>
						<input type='text' placeholder='<?=GetMessage('COMPANY_LOGO')?>' />
					</div>
					<div class='im_button'>
						<span class='inptext'><?=GetMessage('DOWNLOAD')?></span>
						<input type='file' id='imulated' size='30' name='COMPANY_LOGO' />
						
					</div>
					<div class='clear'></div>
				</div>
				<div class='section_registration'>
					<div id='name_section_reg'>
						<?=GetMessage('SECTION_NAME')?>
						<img src='/design/images/selectR-new.png' title='Открыть' alt='Открыть' width='30' height='30' />
					</div>
					<div id='section_detail_reg'>
						<?$n = 0;?>
						<?foreach($arResult['SECTIONS'] as $key => $section):?>
							<div class='main_section'>
								<label class='label_check' for='checkbox_<?=$key?>'>
									<input name='COMPANY[PROPERTY_VALUES][DIRECTION][]' id='checkbox_<?=$section['ID']?>' value='<?=$section['ID']?>' <?if(in_array($key, $_REQUEST['section'])):?> checked='checked' <?endif;?> type='checkbox'><?=$section['NAME']?>
								</label>
								<div class='clear'></div>
								<?foreach($section['ITEMS'] as $k => $item):?>
									<?if($k == 0 || ($k+1)%4 == 0):?>
										<div class='line'>
									<?endif;?>
										<div class='second_section <?if(($k+1)%3 == 0):?> last <?endif;?>'>
											<label class='label_check' for='checkbox_<?=$section['ID']?>'>
												<input name='COMPANY[PROPERTY_VALUES][DIRECTION][]' id='checkbox_<?=$item['ID']?>' value='<?=$item['ID']?>' <?if(in_array($item['ID'], $_REQUEST['COMPANY']['PROPERTY_VALUES']['DIRECTION'])):?> checked='checked' <?endif;?> type='checkbox'><?=$item['NAME']?>
											</label>
											<div class='clear'></div>
											<?if(!empty($item["ITEMS"])):?>
												<div class="third_section">
													<?foreach($item['ITEMS'] as $k_2 => $item_2):?>
														<label class='label_check' for='checkbox_<?=$item["ID"]?>'>
															<input name='COMPANY[PROPERTY_VALUES][DIRECTION][]' id='checkbox_<?=$item_2['ID']?>' value='<?=$item_2['ID']?>' <?if(in_array($item_2['ID'], $_REQUEST['COMPANY']['PROPERTY_VALUES']['DIRECTION'])):?> checked='checked' <?endif;?> type='checkbox'><?=$item_2['NAME']?>
														</label>
													<?endforeach;?>
												</div>
											<?endif;?>
										</div>
									<?if(!isset($section['ITEMS'][$k+1]) || ($k+1)%3 == 0):?>
										</div>
									<?endif;?>
								<?endforeach;?>
								<div class='clear'></div>
							</div>
						<?endforeach;?>
						<div class='clear'></div>
					</div>
				</div>
				<div class='field'>
					<div class='inputContainer'>
						<input type='text' name='COMPANY[PROPERTY_VALUES][SLOGAN]' value='<?=htmlspecialchars($_REQUEST['COMPANY']['PROPERTY_VALUES']['SLOGAN'])?>' placeholder='<?=GetMessage('COMPANY_SLOGAN')?>' />
					</div>
				</div>
				<div class='field'>
					<div class='textareaContainer'>
						<textarea name='COMPANY[PREVIEW_TEXT]' placeholder='<?=GetMessage('COMPANY_PREVIEW_TEXT')?>'><?=$_REQUEST['COMPANY']['PREVIEW_TEXT']?></textarea>
					</div>
				</div>
				<div class='field'>
					<div class='textareaContainer'>
						<textarea name='COMPANY[DETAIL_TEXT]' placeholder='<?=GetMessage('COMPANY_DETAIL_TEXT')?>'><?=$_REQUEST['COMPANY']['DETAIL_TEXT']?></textarea>
					</div>
				</div>
				<div class='small_input_two'>
					<div class='field'>
						<div class='inputContainer'>
							<input type='text' name='COMPANY[PROPERTY_VALUES][NUMBER_OF_STAFF]' value='<?=htmlspecialchars($_REQUEST['COMPANY']['PROPERTY_VALUES']['NUMBER_OF_STAFF'])?>' placeholder='<?=GetMessage('COMPANY_NUMBER_PERSON')?>' />
						</div>
					</div>
					<div class='field last'>
						<div class='inputContainer'>
							<input type='text' name='COMPANY[PROPERTY_VALUES][OBOROT]' value='<?=htmlspecialchars($_REQUEST['COMPANY']['PROPERTY_VALUES']['OBOROT'])?>' placeholder='<?=GetMessage('COMPANY_OBOROT')?>' />
						</div>
					</div>
				</div>			
				<h3><?=GetMessage('STATUS')?></h3>
				<div class='small_input_three'>
					<?$n = 0;?>
					<?foreach($arResult['STATUS'] as $key => $status):?>
						<div class='field <?if(($n+1)%3 == 0):?> last <?endif;?>'>
							<label class='label_check' for='c_status_<?=$key?>'>
								<input name='COMPANY[FILIALS][main][status][]' id='c_status_<?=$key?>' type='checkbox' value='<?=$key?>'  <?if(!empty($_REQUEST['COMPANY']['FILIALS']['main']['status']) && in_array($key, $_REQUEST['COMPANY']['FILIALS']['main']['status'])):?> checked='checked' <?endif;?> />
								<?=$status?>
							</label>
						</div>
						<?$n++;?>
					<?endforeach;?>
					<div class='clear'></div>
				</div>
				<h3><?=GetMessage('PARTNERS_FORUM')?></h3>
				<div class='small_input_three'>
					<label class='label_check' for='people_forum'>
						<input name='COMPANY[people_forum]' id='people_forum' <?if($_REQUEST['COMPANY']['people_forum']):?> checked='checked' <?endif;?> type='checkbox' value="1" />
						<?=GetMessage('PARTNERS_FORUM_YES')?>
					</label>
					<div class='clear'></div>
				</div>
				<h3><?=GetMessage('COMPANY_ADDRESS')?></h3>
				<div class="country-region-town">
					<div class='field'>		
						<select name='COMPANY[FILIALS][main][country]' class='country' title='country_partner'>
							<option value='0'><?="Все страны"?></option>
							<?foreach($arResult['COUNTRIES'] as $key => $country):?>
								<option value='<?=$key?>' <?if(($_REQUEST['COMPANY']['FILIALS']['main']['country'] == $key) || (!isset($_REQUEST['COMPANY']['FILIALS']['main']['country']) && $key == $arResult['SELECTED_COUNTRY'])):?> selected='selected' <?endif;?> >
									<?=$country?>
								</option>
							<?endforeach;?>
						</select>
					</div>				
					<div class='small_input_three'>
						<div class='field'>
							<div class='select_location_many'>
								<select name='COMPANY[FILIALS][main][region]' class='region' title='main_region' id="country_partner">
									<option value='0'><?=GetMessage('REGION')?></option>
									<?
										if(!empty($_REQUEST['COMPANY']['FILIALS']['main']['country']))
											$regions = $arResult['REGIONS'][$_REQUEST['COMPANY']['FILIALS']['main']['country']];
										else 
											$regions = $arResult['REGIONS'][$arResult['SELECTED_COUNTRY']];
									?>
									<?foreach($regions as $rkey => $region):?>
										<option value='<?=$rkey?>' <?if(($_REQUEST['COMPANY']['FILIALS']['main']['region'] == $rkey) || (!isset($_REQUEST['COMPANY']['FILIALS']['main']['region']) && $rkey == $arResult['SELECTED_REGION'])):?> selected='selected' <?endif;?> >							
											<?=$region?>
										</option>
									<?endforeach;?>
								</select>
							</div>
						</div>
						<div class="hidecity">
							<div class='field'>
								<div class='select_location_many'>
									<select name='COMPANY[FILIALS][main][town]' class='town' id='main_region'>
										<option value='0'><?=GetMessage('TOWN')?></option>
										<?
											if(!empty($_REQUEST['COMPANY']['FILIALS']['main']['region']))
												$towns = $arResult['TOWNS'][$_REQUEST['COMPANY']['FILIALS']['main']['region']];
											else 
												$towns = $arResult['TOWNS'][$arResult['SELECTED_REGION']];
										?>
										<?foreach($towns as $k => $town):?>
											<option value='<?=$k?>' <?if(($_REQUEST['COMPANY']['FILIALS']['main']['town'] == $k) || (!isset($_REQUEST['COMPANY']['FILIALS']['main']['town']) && $k == $arResult['SELECTED_TOWN'])):?> selected='selected' <?endif;?> >
												<?=$town?>
											</option>
										<?endforeach;?>
									</select>	
								</div>
							</div>
						</div>	
						<div class='field last'>
							<div class='inputContainer'>
								<input type='text' name='COMPANY[FILIALS][main][address]' value='<?=htmlspecialchars($_REQUEST['COMPANY']['FILIALS']['main']['address'])?>' placeholder='<?=GetMessage('ADDRESS')?>' />
							</div>
							<input type='hidden' name='COMPANY[FILIALS][main][office_VALUE]' value='<?=htmlspecialchars($arResult['OFFICE'][0]["ID"])?>' />
						</div>
					</div>
				</div>
				<div class='clear'></div>
				<h3><?=GetMessage('COMPANY_CONACTS')?></h3>
				<div class='small_input_three'>
					<div class='field'>
						<div class='inputContainer'>
							<input type='text' name='COMPANY[FILIALS][main][phone]' class='phone' value='<?=htmlspecialchars($_REQUEST['COMPANY']['FILIALS']['main']['phone'])?>' placeholder='<?=GetMessage('PHONE')?>' />
						</div>
					</div>
					<div class='field'>
						<div class='inputContainer'>
							<input type='text' name='COMPANY[FILIALS][main][email]' value='<?=htmlspecialchars($_REQUEST['COMPANY']['FILIALS']['main']['email'])?>' placeholder='<?=GetMessage('EMAIL')?>' />
						</div>
					</div>
					<div class='field last'>
						<div class='inputContainer'>
							<input type='text' name='COMPANY[PROPERTY_VALUES][SITE]' value='<?=htmlspecialchars($_REQUEST['COMPANY']['PROPERTY_VALUES']['SITE'])?>' placeholder='<?=GetMessage('COMPANY_WEBSITE')?>' />
						</div>
					</div>
				</div>
				<div class='clear'></div>			
				<div class='checkBlock'>
					<label class='label_check' for='c_filials'>
						<input name='COMPANY[FILIALS_ON]' id='c_filials' type='checkbox' <?if(count($_REQUEST['COMPANY']['FILIALS']) > 1):?>checked='checked'<?endif?> />
						<h3><?=GetMessage('COMPANY_FILIALS')?></h3>
					</label>
				</div>
				<?if($_REQUEST['COMPANY']['FILIALS']):?>
					<?foreach($_REQUEST['COMPANY']['FILIALS'] as $key => $filial):?>
						<?if($key != 'main'):?>
							<div class='filials'>
								<div class='small_input_three'>
									<?$n = 0;?>
									<?foreach($arResult['STATUS'] as $key_fil => $status):?>
										<div class='field <?if(($n+1)%3 == 0):?> last <?endif;?>'>
											<label class='label_check' for='c_status_<?=$key?>'>
												<input name='COMPANY[FILIALS][<?=$key?>][status][]' id='c_status_<?=$key_fil?>' type='checkbox' value='<?=$key_fil?>'  <?if(!empty($filial['status']) && in_array($key_fil, $filial['status'])):?> checked='checked' <?endif;?> />
												<?=$status?>
											</label>
										</div>
										<?$n++;?>
									<?endforeach;?>
									<div class='clear'></div>
								</div>
								
								<div class='small_input_three'>
									<div class='field'>
										<select class='country' name='COMPANY[FILIALS][<?=$key?>][country]' title='country<?=$key?>'>
											<option value='0'><?="Страна"?></option>
											<?foreach($arResult['COUNTRIES'] as $r => $country):?>
												<option value='<?=$r?>' <?if($r == $filial['country']):?> selected='selected' <?endif;?> ><?=$country?></option>
											<?endforeach;?>
										</select>
									</div>
									<div class='field'>
										<select class='region' name='COMPANY[FILIALS][<?=$key?>][region]' title='region<?=$key?>'>
											<option value='0'><?=GetMessage('REGION')?></option>
											<?foreach($arResult['REGIONS'] as $r => $region):?>
												<option value='<?=$r?>' <?if($r == $filial['region']):?> selected='selected' <?endif;?> ><?=$region?></option>
											<?endforeach;?>
										</select>
									</div>
									<div class='field last'>
										<select class='town' name='COMPANY[FILIALS][<?=$key?>][town]' id='region<?=$key?>'>
											<option value='0'><?=GetMessage('TOWN')?></option>
											<?foreach($arResult['TOWNS'][$filial['region']] as $t => $town):?>
												<option value='<?=$t?>' <?if($t == $filial['town']):?> selected='selected' <?endif;?> ><?=$town?></option>
											<?endforeach;?>
										</select>
									</div>			
									<div class='clear'></div>
								</div>
								<div class='field last'>
									<div class='inputContainer'>
										<input type='text' name='COMPANY[FILIALS][<?=$key?>][address]' value='<?=htmlspecialchars($filial['address'])?>' placeholder='<?=GetMessage('ADDRESS')?>' />
									</div>
								</div>
								<div class='small_input_three'>
									<div class='field'>
										<select class='select_remake' name='COMPANY[FILIALS][<?=$key?>][office_VALUE]'>
											<?foreach($arResult['OFFICE'] as $of):?>
												<option value='<?=$of["ID"]?>' <?if($of["ID"] == $filial['office_VALUE']):?> selected='selected' <?endif;?> ><?=$of["NAME"]?></option>
											<?endforeach;?>
										</select>
									</div>
									<div class='field'>
										<div class='inputContainer'>
											<input type='text' name='COMPANY[FILIALS][<?=$key?>][phone]' class='phone' value='<?=htmlspecialchars($filial['phone'])?>' placeholder='<?=GetMessage('PHONE')?>' />
										</div>	
									</div>	
									<div class='field last'>
										<div class='inputContainer'>
											<input type='text' name='COMPANY[FILIALS][<?=$key?>][email]' value='<?=htmlspecialchars($filial['email'])?>' placeholder='<?=GetMessage('EMAIL')?>' />
										</div>			
									</div>			
									<div class='clear'></div>
								</div>
								<button id='rem_f' class='del_filial' type='button'><img src='/design/images/close_cross.png' title='<?=GetMessage('DELETE_FILIAL')?>' width='13' height='13' /></button>
							</div>
						<?endif;?>
					<?endforeach;?>	
				<?endif;?>
				<div class='c_fillials'></div>
				<button id='add_f' class='add_filial' type='button'><?=GetMessage('ADD_FILIAL')?></button>				
			</div>
			<h2><?=GetMessage('COMPANY_DETAILS')?></h2>
			<div class='info_block_form'>
				<div class='inputContainer'>
					<input type='text' name='COMPANY[PROPERTY_VALUES][LEGAL_ADDRESS]' value='<?=htmlspecialchars($_REQUEST['COMPANY']['PROPERTY_VALUES']['LEGAL_ADDRESS'])?>' placeholder='<?=GetMessage('COMPANY_LEGAL_ADDRESS')?>' />
				</div>
				<div class='inputContainer'>
					<input type='text' name='COMPANY[PROPERTY_VALUES][INN]' class='inn_asc' value='<?=htmlspecialchars($_REQUEST['COMPANY']['PROPERTY_VALUES']['INN'])?>' placeholder='<?=GetMessage('COMPANY_INN')?>' />
				</div>
				<div class='inputContainer'>
					<input type='text' name='COMPANY[PROPERTY_VALUES][KPP]' class='number' value='<?=htmlspecialchars($_REQUEST['COMPANY']['PROPERTY_VALUES']['KPP'])?>' placeholder='<?=GetMessage('COMPANY_KPP')?>' />
				</div>
				<div class='inputContainer'>
					<input type='text' name='COMPANY[PROPERTY_VALUES][PAYMENT_ACCOUNT]' class='number' value='<?=htmlspecialchars($_REQUEST['COMPANY']['PROPERTY_VALUES']['PAYMENT_ACCOUNT'])?>' placeholder='<?=GetMessage('COMPANY_RASCH_SHCET')?>' />
				</div>
				<div class='inputContainer'>
					<input type='text' name='COMPANY[PROPERTY_VALUES][CORR_ACCOUN]' class='number' value='<?=htmlspecialchars($_REQUEST['COMPANY']['PROPERTY_VALUES']['CORR_ACCOUN'])?>' placeholder='<?=GetMessage('COMPANY_KORR_SCHET')?>' />
				</div>
				<div class='inputContainer'>
					<input type='text' name='COMPANY[PROPERTY_VALUES][BIK]' class='number' value='<?=htmlspecialchars($_REQUEST['COMPANY']['PROPERTY_VALUES']['BIK'])?>' placeholder='<?=GetMessage('COMPANY_BIK')?>' />
				</div>
				<div class='inputContainer'>
					<input type='text' name='COMPANY[PROPERTY_VALUES][BANK]' value='<?=htmlspecialchars($_REQUEST['COMPANY']['PROPERTY_VALUES']['BANK'])?>' placeholder='<?=GetMessage('COMPANY_BANK')?>' />
				</div>
			</div>
			<h2><?=GetMessage('COMPANY_PERSON_LIST')?></h2>
			<div class='info_block_form peoples_all'>
				<?if(!empty($_REQUEST['COMPANY']['PEOPLE'])):?>
					<?foreach($_REQUEST['COMPANY']['PEOPLE'] as $p => $people):?>
						<div class='people'>
							<div class='checkBlock'>
								<label class='label_check' for='people_contacts'>
									<input name='COMPANY[PEOPLE][<?=$p?>][contacts_person]' id='people_contacts' <?if($people['contacts_person']):?> checked='checked' <?endif;?> type='checkbox' />
									<?=GetMessage('CONTACT_PERSON')?>
								</label>
							</div>
							<div class='inputContainer'>
								<input type='text' class='people_input' name='COMPANY[PEOPLE][<?=$p?>][NAME]' value='<?=htmlspecialchars($people['NAME'])?>' placeholder='<?=GetMessage('FULL_NAME')?>' />
							</div>
							<div class='inputContainer'>
								<input type='text' class='people_input' name='COMPANY[PEOPLE][<?=$p?>][PROPERTY_VALUES][POSITION]' value='<?=htmlspecialchars($people['PROPERTY_VALUES']['POSITION'])?>' placeholder='<?=GetMessage('CONTACT_POSITION')?>' />
							</div>
							<div class='inputContainer'>
								<input type='text' class='people_input' name='COMPANY[PEOPLE][<?=$p?>][PROPERTY_VALUES][EMAIL]' value='<?=htmlspecialchars($people['PROPERTY_VALUES']['EMAIL'])?>' placeholder='<?=GetMessage('CONTACT_EMAIL')?>' />
							</div>
							<div class='inputContainer'>
								<input type='text' class='people_input last' name='COMPANY[PEOPLE][<?=$p?>][PROPERTY_VALUES][PHONE]' class='number' value='<?=htmlspecialchars($people['PROPERTY_VALUES']['PHONE'])?>' placeholder='<?=GetMessage('CONTACT_PHONE')?>' />
							</div>
							<button id='rem_p' class='del_filial' type='button'>
								<img src='/design/images/close_cross.png' title='<?=GetMessage('DELETE_PEOPLE')?>' alt='<?=GetMessage('DELETE_PEOPLE')?>' width='13' height='13' />
							</button>
							<div class='clear'></div>
						</div>
					<?endforeach;?>
				<?endif;?>
				<div class='peoples'></div>
				<button id='add_p' class='add_filial' type='button'><?=GetMessage('ADD_PEOPLE')?></button>
			</div>
			<div class='small_block'>
				<h2><?=GetMessage('COMPANY_CONTACT_PERSON')?></h2>
				<div class='info_block_form conatact_person'>	
					<div class='inputContainer'>
						<input type='text' name='COMPANY[CONTACT_PERSON][NAME]' value='<?=htmlspecialchars($_REQUEST['COMPANY']['CONTACT_PERSON']['NAME'])?>' placeholder='<?=GetMessage('FULL_NAME')?>' />
					</div>
					<div class='inputContainer'>
						<input type='text' name='COMPANY[CONTACT_PERSON][POSITION]' value='<?=htmlspecialchars($_REQUEST['COMPANY']['CONTACT_PERSON']['POSITION'])?>' placeholder='<?=GetMessage('CONTACT_POSITION')?>' />
					</div>
					<div class='contact_phone_mail'>
						<div class='field'>
							<div class='inputContainer'>	
								<input type='text' name='COMPANY[CONTACT_PERSON][EMAIL]' value='<?=htmlspecialchars($_REQUEST['COMPANY']['CONTACT_PERSON']['EMAIL'])?>' placeholder='<?=GetMessage('CONTACT_EMAIL')?>' />
							</div>	
						</div>
						<div class='field last'>
							<div class='inputContainer'>	
								<input type='text' name='COMPANY[CONTACT_PERSON][PHONE]' class='phone' value='<?=htmlspecialchars($_REQUEST['COMPANY']['CONTACT_PERSON']['PHONE'])?>' placeholder='<?=GetMessage('CONTACT_PHONE')?>' />
							</div>
						</div>
					<div class='clear'></div>
					</div>	
				</div>
			</div>
			<div class='small_block last'>
				<h2><?=GetMessage('PARTNER_LEVEL')?></h2>
				<div class='info_block_form'>
					<?if($arResult['LEVELS']):?>
						<div class='checkBlock'>
							<?foreach($arResult['LEVELS'] as $key => $arrv):?>
								<label class='label_check' for='radio_<?=$key?>'>
									<input name='COMPANY[PROPERTY_VALUES][PARTNERS_LEVELS][]' id='radio_<?=$key?>' value='<?=$key?>' type='checkbox' <?if(in_array($key, $_REQUEST['COMPANY']['PROPERTY_VALUES']['PARTNERS_LEVELS'])):?> checked='checked' <?endif;?> />
									<?=$arrv['NAME']?>
								</label>			
							<?endforeach;?>
						</div>
					<?endif;?>		
				</div>
			</div>
			<div class='clear'></div>
		</div>
		<input type='submit' name='register_submit_button' id='reg_form_submit' value='<?=GetMessage('REG')?>' />
	</form>
<?endif?>