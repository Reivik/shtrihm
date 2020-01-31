<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<?if($_REQUEST["success"] == "Y" && empty($arResult["ERROR"])):?>
	<?ShowNote(GetMessage("SUCCESS_SAVE"));?>
<?endif;?>
<?if(!empty($arResult["ERROR"])):?>
	<?ShowError(implode("<br />", $arResult["ERROR"]));?>
<?endif;?>
<?if(empty($arResult["PARTICIPANTS"])):?>
	<?ShowError(GetMessage("NO_PARTICIPANTS"));?>
<?endif;?>
<a name="save_form"></a>
<form class="protection" method="post" action="<?=POST_FORM_ACTION_URI?>#save_form" name="add_vebinar" enctype="multipart/form-data">
	<?=bitrix_sessid_post()?>
	<h2><?=GetMessage("VEBINAR_INFO")?></h2>
	<div class="info_block_form">
		<?if(!empty($arResult["VEBINAR"]["PREVIEW_PICTURE"]["src"])):?>
		<div class="img_picture">
			<table>
				<tr>
					<td>
						<img src="<?=$arResult["VEBINAR"]["PREVIEW_PICTURE"]["src"]?>" width="<?=$arResult["VEBINAR"]["PREVIEW_PICTURE"]["width"]?>" height="<?=$arResult["VEBINAR"]["PREVIEW_PICTURE"]["height"]?>" alt="<?=$arResult["VEBINAR"]["NAME"]?>" title="<?=$arResult["VEBINAR"]["NAME"]?>" />
					</td>
				</tr>
			</table>
		</div>
		<div class="field_img">
		<?endif;?>
			<div class="field">
				<label class="field_label"><?=GetMessage("NAME")?></label>
				<div class="inputContainer">
					<input type="text" name="RESULT[NAME]" value="<?=$_REQUEST["RESULT"]["NAME"] ? htmlspecialchars($_REQUEST["RESULT"]["NAME"]) : $arResult["VEBINAR"]["NAME"]?>" />
				</div>
			</div>			
			<div class="field">
				<label class="field_label"><?=GetMessage("PREVIEW_PICTURE")?></label>
				<div class="input file">
					<div class="input-files">
						<input type="text" class="full <?if(!empty($arResult["VEBINAR"]["PREVIEW_PICTURE"]["src"])):?> small <?endif;?>" />
						<a href="#"><?=GetMessage("DOWNLOAD")?></a>
						<input type="file" name="COMPANY_LOGO" />
					</div>
				</div>
			</div>
			<div class="field">
				<label class="field_label"><?=GetMessage("DATE_ACTIVE_FROM")?></label>
				<div class="inputContainer">
					<input type="text" class="date_vebinar" name="RESULT[DATE_ACTIVE_FROM]" value="<?=$_REQUEST["RESULT"]["DATE_ACTIVE_FROM"] ? htmlspecialchars($_REQUEST["RESULT"]["DATE_ACTIVE_FROM"]) : $arResult["VEBINAR"]["DATE_ACTIVE_FROM"]?>" />
				</div>
			</div>
		<?if(!empty($arResult["VEBINAR"]["PREVIEW_PICTURE"]["src"])):?>
		</div>
		<div class="clear"></div>
		<?endif;?>
		<div class="field">
			<label class="field_label"><?=GetMessage("PREVIEW_TEXT")?></label>
			<div class="textareaContainer">
				<textarea name="RESULT[PREVIEW_TEXT]"><?=$_REQUEST["RESULT"]["PREVIEW_TEXT"] ? htmlspecialchars($_REQUEST["RESULT"]["PREVIEW_TEXT"]) : $arResult["VEBINAR"]["PREVIEW_TEXT"]?></textarea>
			</div>
		</div>
		<div class="field">
			<label class="field_label"><?=GetMessage("LEADING")?></label>
			<div class="inputContainer">
				<input type="text" name="RESULT[PROPERTY][LEADING]" value="<?=$_REQUEST["RESULT"]["PROPERTY"]["LEADING"] ? htmlspecialchars($_REQUEST["RESULT"]["PROPERTY"]["LEADING"]) : $arResult["VEBINAR"]["LEADING"]?>" />
			</div>
		</div>
		<div class="field">
			<label class="field_label"><?=GetMessage("DURATION")?></label>
			<div class="inputContainer">
				<input type="text" name="RESULT[PROPERTY][DURATION]" value="<?=$_REQUEST["RESULT"]["PROPERTY"]["DURATION"] ? htmlspecialchars($_REQUEST["RESULT"]["PROPERTY"]["DURATION"]) : $arResult["VEBINAR"]["DURATION"]?>" />
			</div>
		</div>
		<?if(!empty($arResult["DIRECTIONS"])):?>
			<div class="field">
				<label class="field_label"><?=GetMessage("CATEGORY")?></label>
				<div class="field">
					<select name="RESULT[IBLOCK_SECTION_ID]">
						<option value="0" <?if($_REQUEST["RESULT"]["IBLOCK_SECTION_ID"] == 0):?> selected="selected" <?endif;?> >Все</option>
						<?foreach($arResult["DIRECTIONS"] as $key => $sections):?>
							<option value="<?=$key?>" <?if((isset($_REQUEST["RESULT"]["IBLOCK_SECTION_ID"]) && $key == $_REQUEST["RESULT"]["IBLOCK_SECTION_ID"]) || ($key == $arResult["VEBINAR"]["IBLOCK_SECTION_ID"])):?> selected="selected" <?endif;?> ><?=$sections?></option>
						<?endforeach;?>
					</select>
				</div>
			</div>
		<?endif;?>
		<div class="field">
			<label class="label_check" for="c_no_invite">
				<input name="RESULT[NO_INVITE]" id="c_no_invite" type="checkbox" value="1" <?if((!empty($_REQUEST["PROPERTY"]["NO_INVITE"]) && $_REQUEST["PROPERTY"]["NO_INVITE"] == 1) || ($arResult["VEBINAR"]["NO_INVITE"] == 1)):?> checked="checked"<?endif?> />
				<?=GetMessage("NO_INVITE")?>
			</label>
		</div>
		<div class="field">
			<label class="label_check" for="c_top">
				<input name="RESULT[TOP]" id="c_top" type="checkbox" value="1" <?if((!empty($_REQUEST["PROPERTY"]["TOP"]) && $_REQUEST["PROPERTY"]["TOP"] == 1) || ($arResult["VEBINAR"]["TOP"] == 1)):?> checked="checked"<?endif?> />
				<?=GetMessage("TOP")?>
			</label>
		</div>
		<div class="field">
			<label class="label_check" for="c_active">
				<input name="RESULT[ACTIVE]" id="c_active" type="checkbox" value="1"<?if((!empty($_REQUEST["ACTIVE"]) && $_REQUEST["ACTIVE"] == 1) || ($arResult["VEBINAR"]["ACTIVE"] == "Y")):?> checked="checked"<?endif?> />
				<?=GetMessage("ACTIVE")?>
			</label>
		</div>
	</div>
	<?$parts = explode(" ", $arResult["VEBINAR"]["DATE_ACTIVE_FROM"]);
	$part_1 = explode(".", $parts[0]);
	$new_en_date = $part_1[2]."-".$part_1[1]."-".$part_1[0];
	if(strtotime($new_en_date) == strtotime(date("Y-m-d"))):?>
		<a class="orange_submit" id="to_bbb" href="<?=$arResult["HREF_COMMIT"]?>" target="_blank" title="Подключиться к вебинару">Подключиться к вебинару</a>
	<?endif;?>
	<?if(!empty($arResult["PARTICIPANTS"]["registered"])):?>
		<h2><?=GetMessage("PARTICIPANT1")?></h2>
		<table>
			<tr>
				<th>ФИО</th>
				<th>Должность</th>
				<th>Компания</th>
				<th>Дата регистрации</th>
				<th></th>
			</tr>
			<?foreach($arResult["PARTICIPANTS"]["registered"] as $people):?>
				<tr>
					<td><?=$people["NAME"]?></td>
					<td><?=$people["POSITION"]?></td>
					<td><?=$people["COMPANY"]?></td>
					<td><?=$people["DATE"]?></td>
					<td><?=$people["INVITED"] ? "Приглашен" : "Не приглашен"?></td>
				</tr>
			<?endforeach;?>
		</table>
	<?endif;?>
	<?if(!empty($arResult["PARTICIPANTS"]["application"])):?>
		<h2><?=GetMessage("PARTICIPANT2")?></h2>
		<table>
			<tr>
				<th>ФИО</th>
				<th>Должность</th>
				<th>Компания</th>
				<th>Дата регистрации</th>
				<th></th>
			</tr>
			<?foreach($arResult["PARTICIPANTS"]["application"] as $people):?>
				<tr>
					<td><?=$people["NAME"]?></td>
					<td><?=$people["POSITION"]?></td>
					<td><?=$people["COMPANY"]?></td>
					<td><?=$people["DATE"]?></td>
					<td>
						<?if($people["INVITED"] == 0):?>
							<label class="label_check" for="c_people_<?=$people["ID"]?>">
								<input class="refusal_vebinar" name="PARTICIPANTS[INVITING][<?=$people["ID"]?>]" id="c_people_<?=$people["ID"]?>" type="checkbox" value="<?=$people["ID"]?>" />
								<?=GetMessage("INVITE")?>
							</label>
							<label class="label_check" for="c_people_<?=$people["ID"]?>">
								<input class="refusal_vebinar" name="PARTICIPANTS[REFUSAL][<?=$people["ID"]?>]" id="c_people_<?=$people["ID"]?>" type="checkbox" value="<?=$people["ID"]?>" />
								<?=GetMessage("REFUSAL")?>
							</label>
						<?else:?>
							<?=GetMessage("YES")?>
						<?endif;?>
					</td>
				</tr>
			<?endforeach;?>
		</table>
	<?endif;?>
	<?if(!empty($arResult["PARTICIPANTS"]["refusal"])):?>
		<h2><?=GetMessage("PARTICIPANT3")?></h2>
		<table>
			<tr>
				<th>ФИО</th>
				<th>Должность</th>
				<th>Компания</th>
				<th>Дата регистрации</th>
				<th></th>
			</tr>
			<?foreach($arResult["PARTICIPANTS"]["refusal"] as $people):?>
				<tr>
					<td><?=$people["NAME"]?></td>
					<td><?=$people["POSITION"]?></td>
					<td><?=$people["COMPANY"]?></td>
					<td><?=$people["DATE"]?></td>
					<td>
						<?if($people["INVITED"] == 0):?>
							<label class="label_check" for="c_people_<?=$people["ID"]?>">
								<input name="PARTICIPANTS[INVITING][<?=$people["ID"]?>]" id="c_people_<?=$people["ID"]?>" type="checkbox" value="<?=$people["ID"]?>" />
								<?=GetMessage("INVITE")?>
							</label>
						<?else:?>
							<?=GetMessage("YES")?>
						<?endif;?>
					</td>
				</tr>
			<?endforeach;?>
		</table>
	<?endif;?>
	<h2><?=GetMessage("INVITING")?></h2>
	<div class="info_block_form">
		<h3><?=GetMessage("SELECT_PARTNER")?></h3>
		<div class="field">
			<label class="label_check" for="c_active">
				<input name="PARTICIPANT[ALL]" id="c_active" type="checkbox" <?if(!empty($_REQUEST["PARTICIPANT"]["ALL"])):?> checked="checked"<?endif?> value="1" />
				<?=GetMessage("ALL_PARTNERS")?>
			</label>
		</div>
		<h4><?=GetMessage("GROUP_BY");?></h4>
		<div class="field">
			<?foreach($arResult["LEVELS"] as $key => $level):?>
				<label class="label_check" for="c_<?=$key?>">
					<input name="PARTICIPANT[GROUP][<?=$key?>]" id="c_<?=$key?>" type="checkbox" value="1" <?if(!empty($_REQUEST["PARTICIPANT"]["GROUP"][$key])):?> checked="checked"<?endif?> />
					<?=$level?>
				</label>
			<?endforeach;?>
		</div>
		<h4><?=GetMessage("DIRECTION_BY");?></h4>
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
	<div class="clear"></div>
	<input type="submit" name="save" class="orange_submit" id="save" value="<?=GetMessage("SAVE")?>" />
</form>