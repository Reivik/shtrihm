<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<?if($_REQUEST["success"] == "Y" && empty($arResult["ERROR"])):?>
	<?ShowNote(GetMessage("SUCCESS_SAVE"));?>
	<p><?=GetMessage("LIST_VEBINAR")?></p>
<?else:?>
	<?if(!empty($arResult["ERROR"])):?>
		<?ShowError(implode("<br />", $arResult["ERROR"]));?>
	<?endif;?>
	<form class="protection" method="post" action="<?=POST_FORM_ACTION_URI?>" name="add_vebinar" enctype="multipart/form-data">
		<?=bitrix_sessid_post()?>
		<h2><?=GetMessage("VEBINAR_INFO")?></h2>
		<div class="info_block_form">
			<div class="field">
				<label class="field_label"><?=GetMessage("NAME")?></label>
				<div class="inputContainer">
					<input type="text" name="RESULT[NAME]" value="<?=htmlspecialchars($_REQUEST["RESULT"]["NAME"])?>" />
				</div>
			</div>
			<div class="field">
				<label class="field_label"><?=GetMessage("PREVIEW_TEXT")?></label>
				<div class="textareaContainer">
					<textarea name="RESULT[PREVIEW_TEXT]"><?=htmlspecialchars($_REQUEST["RESULT"]["PREVIEW_TEXT"])?></textarea>
				</div>
			</div>
			<div class="field">
				<label class="field_label"><?=GetMessage("PREVIEW_PICTURE")?></label>
				<div class="clear"></div>
				<div class="im_input">
					<input type="text" />
				</div>
				<div class="im_button">
					<span class="inptext"><?=GetMessage("DOWNLOAD")?></span>
					<input type="file" id="imulated" size="30" name="COMPANY_LOGO" />
				</div>
				<div class="clear"></div>
			</div>
			
			<div class="field">
				<label class="field_label"><?=GetMessage("DATE_ACTIVE_FROM")?></label>
				<div class="inputContainer">
					<input type="text" class="date_vebinar" name="RESULT[DATE_ACTIVE_FROM]" value="<?=htmlspecialchars($_REQUEST["RESULT"]["DATE_ACTIVE_FROM"])?>" />
				</div>
			</div>
			<div class="field">
				<label class="field_label"><?=GetMessage("LEADING")?></label>
				<div class="inputContainer">
					<input type="text" name="RESULT[PROPERTY][LEADING]" value="<?=$_REQUEST["RESULT"]["PROPERTY"]["LEADING"] ? htmlspecialchars($_REQUEST["RESULT"]["PROPERTY"]["LEADING"]) : $USER->GetFirstName()?>" />
				</div>
			</div>
			<div class="field">
				<label class="field_label"><?=GetMessage("DURATION")?></label>
				<div class="inputContainer">
					<input type="text" class="number" name="RESULT[PROPERTY][DURATION]" value="<?=htmlspecialchars($_REQUEST["RESULT"]["PROPERTY"]["DURATION"])?>" />
				</div>
			</div>
			<?if(!empty($arResult["DIRECTIONS"])):?>
				<div class="field">
					<label class="field_label"><?=GetMessage("CATEGORY")?></label>
					<div class="field">
						<select name="RESULT[IBLOCK_SECTION_ID]">
							<option value="0" <?if($_REQUEST["RESULT"]["IBLOCK_SECTION_ID"] == 0):?> selected="selected" <?endif;?> >Все</option>
							<?foreach($arResult["DIRECTIONS"] as $key => $sections):?>
								<option value="<?=$key?>" <?if($key == $_REQUEST["RESULT"]["IBLOCK_SECTION_ID"]):?> selected="selected" <?endif;?> ><?=$sections?></option>
							<?endforeach;?>
						</select>
					</div>
				</div>
			<?endif;?>
			
			<div class="field">
				<label class="label_check" for="c_no_invite">
					<input name="RESULT[NO_INVITE]" id="c_no_invite" type="checkbox" value="1" <?if(!empty($_REQUEST["RESULT"]["NO_INVITE"])):?> checked="checked"<?endif?> />
					<?=GetMessage("NO_INVITE")?>
				</label>
			</div>
			<div class="field">
				<label class="label_check" for="c_top">
					<input name="RESULT[TOP]" id="c_top" type="checkbox" value="1" <?if(!empty($_REQUEST["RESULT"]["TOP"])):?> checked="checked"<?endif?> />
					<?=GetMessage("TOP")?>
				</label>
			</div>
			<div class="field">
				<label class="label_check" for="c_active">
					<input name="RESULT[ACTIVE]" id="c_active" type="checkbox" value="1" <?if(!empty($_REQUEST["RESULT"]["ACTIVE"])):?> checked="checked"<?endif?> />
					<?=GetMessage("ACTIVE")?>
				</label>
			</div>
		</div>
		<h2><?=GetMessage("PARTICIPANT")?></h2>
		<div class="info_block_form">
			<h3><?=GetMessage("CHOOSE_USER")?></h3>
			<div class="field">
				<label class="label_check" for="user_all_checked">
					<input name="PARTICIPANT[ALL_USER]" id="user_all_checked" type="checkbox" <?if(!empty($_REQUEST["PARTICIPANT"]["ALL_USER"])):?> checked="checked"<?endif?> value="1" />
					<?=GetMessage("ALL_USERS")?>
				</label>
			</div>
			<div class="user_all_checked">
				<b><?=GetMessage("PARTNERS");?></b>
				<div class="field">
					<label class="label_check" for="c_active">
						<input name="PARTICIPANT[ALL]" id="c_active" type="checkbox" <?if(!empty($_REQUEST["PARTICIPANT"]["ALL"])):?> checked="checked"<?endif?> value="1" />
						<?=GetMessage("ALL_PARTNERS")?>
					</label>
				</div>
				<b><?=GetMessage("GROUP_BY");?></b>
				<div class="field">
					<?foreach($arResult["LEVELS"] as $key => $level):?>
						<label class="label_check" for="c_<?=$key?>">
							<input name="PARTICIPANT[GROUP][<?=$key?>]" id="c_<?=$key?>" type="checkbox" value="1" <?if(!empty($_REQUEST["PARTICIPANT"]["GROUP"][$key])):?> checked="checked"<?endif?> />
							<?=$level?>
						</label>
					<?endforeach;?>
				</div>
				<b><?=GetMessage("DIRECTION_BY");?></b>
				<div class="field">
					<div class="section_registration">
						<div id="name_section_reg">
							<?=GetMessage("SELECT_CATEGORY")?>
							<img src="/design/images/selectR-new.png" title="Открыть" alt="Открыть" width="30" height="30" />
						</div>
						<div id="section_detail_reg">
							<?$n = 0;?>
							<?foreach($arResult["SECTIONS"] as $key => $section):?>
								<div class="main_section">
									<label class="label_check" for="checkbox_<?=$key?>">
										<input name="PARTICIPANT[DIRECTION][]" id="checkbox_<?=$key?>" value="<?=$section["ID"]?>" <?if(in_array($section["ID"], $_REQUEST["PARTICIPANT"]["DIRECTION"])):?> checked="checked" <?endif;?> type="checkbox"><?=$section["NAME"]?>
									</label>
									<div class="clear"></div>
									<?foreach($section["ITEMS"] as $k => $item):?>
										<?if($k == 0 || ($k+1)%4 == 0):?>
											<div class="line">
										<?endif;?>
											<div class="second_section <?if(($k+1)%3 == 0):?> last <?endif;?>">
												<label class="label_check" for="checkbox_<?=$key?>">
													<input name="PARTICIPANT[DIRECTION][]" id="checkbox_<?=$item["ID"]?>" value="<?=$item["ID"]?>" <?if(in_array($item["ID"], $_REQUEST["PARTICIPANT"]["DIRECTION"])):?> checked="checked" <?endif;?> type="checkbox"><?=$item["NAME"]?>
												</label>
												<div class="clear"></div>
											</div>
										<?if(!isset($section["ITEMS"][$k+1]) || ($k+1)%3 == 0):?>
											</div>
										<?endif;?>
									<?endforeach;?>
									<div class="clear"></div>
								</div>
							<?endforeach;?>
							<div class="clear"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="clear"></div>
		<input type="submit" name="save" class="orange_submit" id="save" value="<?=GetMessage("SAVE")?>" />
	</form>
<?endif;?>