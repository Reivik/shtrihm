<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if($_REQUEST["success"] == "yes" && empty($arResult["ERROR"])):?>
	<?ShowNote(GetMessage("SUCCESS_SAVE"));?>
<?else:?>
	<?if(!empty($arResult["ERROR"])):?>
		<?ShowError(implode("<br />", $arResult["ERROR"]));?>
	<?endif;?>
	<h2><?=GetMessage("ANKETA")?></h2>
	<div class="listener_about_person clone" style="display: none;">
		<div class="field button right">
			<button class="delete delete_listener_about_person" type="button">
				<img src="/design/images/close_cross.png" title="<?=GetMessage("DELETE_FILIAL")?>" width="13" height="13" />
			</button>
		</div>
		<div class="clear"></div>
		<div class="two_input_container">
			<div class="field">
				<label class="field_label"><?=GetMessage("CONTACT_NAME")?></label>
				<div class="inputContainer">
					<input type="text" name="LISTENER[][NAME]" value="" />
				</div>
			</div>
			<div class="field last">
				<label class="field_label"><?=GetMessage("CONTACT_POSITION")?></label>
				<div class="inputContainer">
					<input type="text" name="LISTENER[][POSITION]" value="" />
				</div>	
			</div>		
			<div class="clear"></div>
		</div>
		<div class="two_input_container">
			<div class="field">
				<label class="field_label"><?=GetMessage("PHONE")?></label>
				<div class="inputContainer">
					<input type="text" name="LISTENER[][PHONE]" class="phone" value="" />
				</div>
			</div>
			<div class="field last">
				<label class="field_label"><?=GetMessage("EMAIL")?></label>
				<div class="inputContainer">
					<input type="text" name="LISTENER[][EMAIL]" value="" />
				</div>	
			</div>		
			<div class="clear"></div>
		</div>
		<?/*<div class="field">
			<label class="label_check" for="LISTENER[][CHANGE_BASE]">
				<input name="LISTENER[][CHANGE_BASE]" id="LISTENER[][CHANGE_BASE]" type="checkbox" value="1" />
				<?=GetMessage("CHANGE_BASE")?>
			</label>
		</div>
		<div class="field">
			<label class="label_check" for="LISTENER[][NEED_RECOMENTED]">
				<input name="LISTENER[][NEED_RECOMENTED]" id="LISTENER[][NEED_RECOMENTED]" type="checkbox" value="1" />
				<?=GetMessage("NEED_RECOMENTED")?>
			</label>
		</div>*/?>
		<div class="field">
			<div class="textareaContainer">
				<textarea name="LISTENER[][TEXT]"></textarea>
			</div>
		</div>
	</div>
	<form method="post" action="<?=POST_FORM_ACTION_URI?>" name="apply_for_the_training" enctype="multipart/form-data">
		<div class="default_forms">			
			<div class="field">
				<label class="field_label"><?=GetMessage("THEME")?></label>
				<select name="theme" id="select_theme">
					<option value="0"><?=GetMessage("THEME")?></option>
					<?foreach($arResult["FILTER"]["THEME"] as $theme):?>
						<option value="<?=$theme["ID"]?>" <?if($theme["ID"] == $_REQUEST["theme"]):?> selected="selected" <?endif;?> ><?=$theme["NAME"]?></option>
					<?endforeach;?>
					<option value="different">Другое</option>
				</select>			
			</div>	
			<div class="country-region-town">
				<div class="field">
					<label class="field_label"><?="Страна"/*GetMessage("COUNTRY")*/?></label>
					<select name="country" class="country" title="country_partner">
						<option value="0" <?if($arResult["SELECTED_COUNTRY"] == 0):?> selected="selected" <?endif;?> >Все страны</option>
						<?foreach($arResult["COUNTRIES"] as $keyCon => $country):?>
							<option value="<?=$keyCon?>" <?if($arResult["SELECTED_COUNTRY"] == $keyCon):?> selected="selected" <?endif;?> ><?=$country?></option>
						<?endforeach;?>
					</select>
				</div>					
				<div class="three_input_container">		
					<div class="field">						
						<?
							if(!empty($_REQUEST["COMPANY_REGION"]) && !empty($_REQUEST["COMPANY_COUNTRY"])) {
								$select_region = $_REQUEST["COMPANY_REGION"];
								$region = $arResult["REGIONS"][$_REQUEST["COMPANY_COUNTRY"]];
							}
							elseif(!empty($arResult["COMPANY_REGION"]) && !empty($arResult["COMPANY_COUNTRY"])) {
								$select_region = $arResult["COMPANY_REGION"];
								$region = $arResult["REGIONS"][$arResult["COMPANY_COUNTRY"]];
							}
							else {
								$select_region = $arResult["SELECTED_REGION"];
								$region = $arResult["REGIONS"][$arResult["SELECTED_COUNTRY"]];
							}
						?>
						<label class="field_label"><?=GetMessage("REGION")?></label>
						<select name="COMPANY_REGION" title="region_of_activity" class="region" id="country_partner">
							<option value="0">Регион</option>
							<?foreach($region as $k => $t):?>
								<option value="<?=$k?>" <?if($select_region == $k):?> selected="selected" <?endif;?> ><?=$t?></option>
							<?endforeach;?>
						</select>
					</div>
					<div class="hidecity">
						<div class="field">	
							<?
								if(!empty($_REQUEST["COMPANY_TOWN"]) && !empty($_REQUEST["COMPANY_REGION"])) {
									$select_town = $_REQUEST["COMPANY_TOWN"];
									$town = $arResult["TOWNS"][$_REQUEST["COMPANY_REGION"]];
								}
								elseif(!empty($arResult["COMPANY_TOWN"]) && !empty($arResult["COMPANY_REGION"])) {
									$select_town = $arResult["COMPANY_TOWN"];
									$town = $arResult["TOWNS"][$arResult["COMPANY_REGION"]];
								}
								else {
									$select_town = $arResult["SELECTED_TOWN"];
									$town = $arResult["TOWNS"][$arResult["SELECTED_REGION"]];
								}
							?>
							<label class="field_label"><?=GetMessage("TOWN")?></label>			
							<select name="COMPANY_TOWN" id="region_of_activity" class="town">
								<option value="0">Город</option>
								<?foreach($town as $k => $t):?>
									<option value="<?=$k?>" <?if($select_town == $k):?> selected="selected" <?endif;?> ><?=$t?></option>
								<?endforeach;?>
							</select>
						</div>
					</div>
					<div class="field last">
						<label class="field_label"><?=GetMessage("ADDRESS")?></label>
						<div class="inputContainer">
							<input type="text" name="COMPANY_ADDRESS" value="<?=$_REQUEST["COMPANY_ADDRESS"] ? htmlspecialchars($_REQUEST["COMPANY_ADDRESS"]) : $arResult["COMPANY_ADDRESS"]?>" />
						</div>
					</div>
					<div class="clear"></div>
				</div>	
			</div>
			<div class="two_input_container">
				<div class="field">
					<label class="field_label"><?=GetMessage("PHONE")?></label>
					<div class="inputContainer">
						<input type="text" name="COMPANY_PHONE" class="phone" value="<?=$_REQUEST["COMPANY_PHONE"] ? htmlspecialchars($_REQUEST["COMPANY_PHONE"]) : $arResult["COMPANY_PHONE"]?>" />
					</div>
				</div>
				<div class="field last">
					<label class="field_label"><?=GetMessage("EMAIL")?></label>
					<div class="inputContainer">
						<input type="text" name="COMPANY_EMAIL" value="<?=$_REQUEST["COMPANY_EMAIL"] ? htmlspecialchars($_REQUEST["COMPANY_EMAIL"]) : $arResult["COMPANY_EMAIL"]?>" />
					</div>	
				</div>		
				<div class="clear"></div>
			</div>
			<div class="field">
				<label class="field_label"><?=GetMessage("COMPANY_NAME")?></label>
				<div class="inputContainer">
					<input type="text" name="COMPANY_NAME" value="<?=$_REQUEST["COMPANY_NAME"] ? htmlspecialchars($_REQUEST["COMPANY_NAME"]) : $arResult["COMPANY_NAME"]?>" />
				</div>
			</div>
		</div>
		<h3><?=GetMessage("CONTACT_PERSON")?></h3>
		<div class="default_forms">
			<div class="two_input_container">
				<div class="field">
					<label class="field_label"><?=GetMessage("CONTACT_NAME")?></label>
					<div class="inputContainer">
						<input type="text" name="CONTACT_NAME" value="<?=$_REQUEST["CONTACT_NAME"] ? htmlspecialchars($_REQUEST["CONTACT_NAME"]) : $arResult["CONTACT_NAME"]?>" />
					</div>
				</div>
				<div class="field last">
					<label class="field_label"><?=GetMessage("CONTACT_POSITION")?></label>
					<div class="inputContainer">
						<input type="text" name="CONTACT_POSITION" value="<?=$_REQUEST["CONTACT_POSITION"] ? htmlspecialchars($_REQUEST["CONTACT_POSITION"]) : $arResult["CONTACT_POSITION"]?>" />
					</div>	
				</div>		
				<div class="clear"></div>
			</div>
			<div class="two_input_container">
				<div class="field">
					<label class="field_label"><?=GetMessage("PHONE")?></label>
					<div class="inputContainer">
						<input type="text" name="CONTACT_PHONE" class="phone" value="<?=$_REQUEST["CONTACT_PHONE"] ? htmlspecialchars($_REQUEST["CONTACT_PHONE"]) : $arResult["CONTACT_PHONE"]?>" />
					</div>
				</div>
				<div class="field last">
					<label class="field_label"><?=GetMessage("EMAIL")?></label>
					<div class="inputContainer">
						<input type="text" name="CONTACT_EMAIL" value="<?=$_REQUEST["CONTACT_EMAIL"] ? htmlspecialchars($_REQUEST["CONTACT_EMAIL"]) : $arResult["CONTACT_EMAIL"]?>" />
					</div>	
				</div>		
				<div class="clear"></div>
			</div>
		</div>
		<h3><?=GetMessage("INFORMATION_ABOUT_LISTENER")?></h3>
		<div class="default_forms">
			<?if(!empty($_REQUEST["LISTENER"])):?>
				<?foreach($_REQUEST["LISTENER"] as $key => $listener):?>
					<div class="listener_about">
						<div class="listener_about_person">
							<div class="field button right">
								<button class="delete delete_listener_about_person" type="button">
									<img src="/design/images/close_cross.png" title="<?=GetMessage("DELETE_FILIAL")?>" width="13" height="13" />
								</button>
							</div>
							<div class="clear"></div>
							<div class="two_input_container">
								<div class="field">
									<label class="field_label"><?=GetMessage("CONTACT_NAME")?></label>
									<div class="inputContainer">
										<input type="text" name="LISTENER[<?=$key?>][NAME]" value="<?=htmlspecialchars($listener["NAME"])?>" />
									</div>
								</div>
								<div class="field last">
									<label class="field_label"><?=GetMessage("CONTACT_POSITION")?></label>
									<div class="inputContainer">
										<input type="text" name="LISTENER[<?=$key?>][POSITION]" value="<?=htmlspecialchars($listener["POSITION"])?>" />
									</div>	
								</div>		
								<div class="clear"></div>
							</div>
							<div class="two_input_container">
								<div class="field">
									<label class="field_label"><?=GetMessage("PHONE")?></label>
									<div class="inputContainer">
										<input type="text" name="LISTENER[<?=$key?>][PHONE]" class="phone" value="<?=htmlspecialchars($listener["PHONE"])?>" />
									</div>
								</div>
								<div class="field last">
									<label class="field_label"><?=GetMessage("EMAIL")?></label>
									<div class="inputContainer">
										<input type="text" name="LISTENER[<?=$key?>][EMAIL]" value="<?=htmlspecialchars($listener["EMAIL"])?>" />
									</div>	
								</div>		
								<div class="clear"></div>
							</div>
							<div class="field">
								<label class="label_check" for="LISTENER[<?=$key?>][CHANGE_BASE]">
									<input name="LISTENER[<?=$key?>][CHANGE_BASE]" id="LISTENER[<?=$key?>][CHANGE_BASE]" <?if(!empty($listener["CHANGE_BASE"])):?> checked="checked" <?endif;?> type="checkbox" value="1" />
									<?=GetMessage("CHANGE_BASE")?>
								</label>
							</div>
							<div class="field">
								<label class="label_check" for="LISTENER[<?=$key?>][NEED_RECOMENTED]">
									<input name="LISTENER[<?=$key?>][NEED_RECOMENTED]" id="LISTENER[<?=$key?>][NEED_RECOMENTED]" <?if(!empty($listener["NEED_RECOMENTED"])):?> checked="checked" <?endif;?> type="checkbox" value="1" />
									<?=GetMessage("NEED_RECOMENTED")?>
								</label>
							</div>
							<div class="field">
								<label class="field_label"><?=GetMessage("TEXT")?></label>
								<div class="textareaContainer">
									<textarea name="LISTENER[<?=$key?>][TEXT]"><?=htmlspecialchars($listener["TEXT"])?></textarea>
								</div>
							</div>
						</div>
					</div>
				<?endforeach;?>
			<?else:?>
				<div class="listener_about">
					<div class="listener_about_person">
						<div class="field button right">
							<button class="delete delete_listener_about_person" type="button">
								<img src="/design/images/close_cross.png" title="<?=GetMessage("DELETE_FILIAL")?>" width="13" height="13" />
							</button>
						</div>
						<div class="clear"></div>
						<div class="two_input_container">
							<div class="field">
								<label class="field_label"><?=GetMessage("CONTACT_NAME")?></label>
								<div class="inputContainer">
									<input type="text" name="LISTENER[0][NAME]" value="" />
								</div>
							</div>
							<div class="field last">
								<label class="field_label"><?=GetMessage("CONTACT_POSITION")?></label>
								<div class="inputContainer">
									<input type="text" name="LISTENER[0][POSITION]" value="" />
								</div>	
							</div>		
							<div class="clear"></div>
						</div>
						<div class="two_input_container">
							<div class="field">
								<label class="field_label"><?=GetMessage("PHONE")?></label>
								<div class="inputContainer">
									<input type="text" name="LISTENER[0][PHONE]" class="phone" value="" />
								</div>
							</div>
							<div class="field last">
								<label class="field_label"><?=GetMessage("EMAIL")?></label>
								<div class="inputContainer">
									<input type="text" name="LISTENER[0][EMAIL]" value="" />
								</div>	
							</div>		
							<div class="clear"></div>
						</div>
						<?/*<div class="field">
							<label class="label_check" for="LISTENER[0][CHANGE_BASE]">
								<input name="LISTENER[0][CHANGE_BASE]" id="LISTENER[0][CHANGE_BASE]" type="checkbox" value="1" />
								<?=GetMessage("CHANGE_BASE")?>
							</label>
						</div>
						<div class="field">
							<label class="label_check" for="LISTENER[0][NEED_RECOMENTED]">
								<input name="LISTENER[0][NEED_RECOMENTED]" id="LISTENER[0][NEED_RECOMENTED]" type="checkbox" value="1" />
								<?=GetMessage("NEED_RECOMENTED")?>
							</label>
						</div>*/?>
						<div class="field">
							<label class="field_label"><?=GetMessage("TEXT")?></label>
							<div class="textareaContainer">
								<textarea name="LISTENER[0][TEXT]"></textarea>
							</div>
						</div>
					</div>
				</div>
			<?endif;?>
		</div>
		<button class="add" name="add_listener"><?=GetMessage("ADD_LISTENER")?></button>
		<button class="orange_button" type="submit" name="send" value="1"><?=GetMessage("APPLY_TRAINING")?></button>
	</form>
	<?/*<script type="text/javascript">
		var theme = new Array();
		<?foreach($arResult["FILTER"]["THEME"] as $theme):?>
			theme[theme.length] = {
				"id":'<?=$theme["ID"]?>',
				"name":'<?=$theme["NAME"]?>',
				"type_company":'<?=$theme["TYPE_COMPANY"]?>',
				"person":'<?=$theme["PERSON"]?>'
			};
		<?endforeach;?>
		 $('select[name="type_company"]').on("change", function() {
			var select_id = $(this).find('option:selected').val();
			var objSel_person = document.getElementById("select_person");
			objSel_person.options.length = 0;
			objSel_person.options[objSel_person.options.length] = new Option("Категория специалиста", 0);
			for(var i=0; i < theme.length; i++) {
				if((select_id != 0 && theme[i]["type_company"] == select_id) || select_id == 0) {
					var flag = 0;
					for(var j=0; j < objSel_person.options.length; j++) {
						if(objSel_person.options[j].value == theme[i]["person"])
							flag = 1;
					}
					if(flag == 0)
						objSel_person.options[objSel_person.options.length] = new Option(theme[i]["person"], theme[i]["person"]);				
				}
			}
			$("#select_person").selectbox("detach")
			$("#select_person").selectbox("attach");
			changeTheme();
		}); 
		
		 $('#select_theme').on("change", function() {
			if($(this).find('option:selected').val()=='different'){
				//do something
			}
		}); 
		$('select[name="type_company"]').on("change", function() {changeTheme();});
		
		function changeTheme() {
			var type_company = $('select[name="type_company"]').find('option:selected').val();
			var objSel_person = document.getElementById("select_theme");
			objSel_person.options.length = 0;
			objSel_person.options[objSel_person.options.length] = new Option("Тема программы", 0);
			for(var i=0; i < theme.length; i++) {
				if(((type_company != 0 && theme[i]["type_company"] == type_company) || type_company == 0))
					objSel_person.options[objSel_person.options.length] = new Option(theme[i]["name"], theme[i]["name"]);
			}
			objSel_person.options[objSel_person.options.length] = new Option("Другое", 'different');
			$("#select_theme").selectbox("detach")
			$("#select_theme").selectbox("attach");
		}
	</script>*/?>
<?endif;?>