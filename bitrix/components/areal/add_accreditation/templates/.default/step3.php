<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="specialities clone" style="display: none;">
	<div class="specialities_input_container">
		<div class="field">
			<label class="field_label"><?=GetMessage("NAME")?></label>
			<div class="inputContainer">
				<input type="text" name="PROPERTY[SPECIALITIES][][NAME]" value="" />
			</div>
		</div>
		<div class="field">
			<label class="field_label"><?=GetMessage("COMPANY_INN")?></label>
			<div class="inputContainer">
				<input type="text" class="inn_asc" name="PROPERTY[SPECIALITIES][][INN]" value="" />
			</div>
		</div>
		<div class="field button last">
			<label class="field_label"></label>
			<button class="delete delete_speciality" type="button">
				<img src="/design/images/close_cross.png" title="<?=GetMessage("DELETE_FILIAL")?>" width="13" height="13" />
			</button>
		</div>
		<div class="clear"></div>	
	</div>
</div>
<h2><?=GetMessage("STEP_3")?></h2>
<h3><?=GetMessage("BANK_DETAILS")?></h3>
<div class="default_forms">
	<div class="two_input_container">
		<div class="field">
			<label class="field_label"><?=GetMessage("RASCH_SCHET")?></label>
			<div class="inputContainer">
				<input type="text" class="number" name="PROPERTY[RASCH_SCHET]" value="<?=htmlspecialchars($_REQUEST["PROPERTY"]["RASCH_SCHET"])?>" />
			</div>
		</div>
		<div class="field last">
			<label class="field_label"><?=GetMessage("KORR_SCHET")?></label>
			<div class="inputContainer">
				<input type="text" class="number" name="PROPERTY[KORR_SCHET]" value="<?=htmlspecialchars($_REQUEST["PROPERTY"]["KORR_SCHET"])?>" />
			</div>
		</div>
		<div class="clear"></div>	
	</div>
	<div class="two_input_container">
		<div class="field">
			<label class="field_label"><?=GetMessage("BIK")?></label>
			<div class="inputContainer">
				<input type="text" class="number" name="PROPERTY[BIK]" value="<?=htmlspecialchars($_REQUEST["PROPERTY"]["BIK"])?>" />
			</div>
		</div>
		<div class="field last">
			<label class="field_label"><?=GetMessage("BANK_NAME")?></label>
			<div class="inputContainer">
				<input type="text" name="PROPERTY[BANK_NAME]" value="<?=htmlspecialchars($_REQUEST["PROPERTY"]["BANK_NAME"])?>" />
			</div>
		</div>
		<div class="clear"></div>	
	</div>
</div>
<h3><?=GetMessage("CONTACT_DATA")?></h3>
<div class="default_forms">
	<div class="two_input_container">
		<div class="field">
			<label class="field_label"><?=GetMessage("PHONE")?></label>
			<div class="inputContainer">
				<input type="text" class="phone_asc" name="PROPERTY[PHONE]" value="<?=htmlspecialchars($_REQUEST["PROPERTY"]["PHONE"])?>" />
			</div>
		</div>
		<div class="field last">
			<label class="field_label"><?=GetMessage("FAX")?></label>
			<div class="inputContainer">
				<input type="text" class="phone_asc" name="PROPERTY[FAX]" value="<?=htmlspecialchars($_REQUEST["PROPERTY"]["FAX"])?>" />
			</div>
		</div>
		<div class="clear"></div>	
	</div>
	<div class="two_input_container">
		<div class="field">
			<label class="field_label"><?=GetMessage("EMAIL")?></label>
			<div class="inputContainer">
				<input type="text" name="PROPERTY[EMAIL]" value="<?=htmlspecialchars($_REQUEST["PROPERTY"]["EMAIL"])?>" />
			</div>
		</div>
		<div class="field last">
			<label class="field_label"><?=GetMessage("WWW")?></label>
			<div class="inputContainer">
				<input type="text" name="PROPERTY[WWW]" value="<?=htmlspecialchars($_REQUEST["PROPERTY"]["WWW"])?>" />
			</div>
		</div>
		<div class="clear"></div>	
	</div>
</div>
<h3><?=GetMessage("CONTACT_PERSON")?></h3>
<div class="default_forms">
	<div class="three_input_container">
		<div class="field">
			<label class="field_label"><?=GetMessage("HEAD_NAME")?></label>
			<div class="inputContainer">
				<input type="text" name="PROPERTY[CONTACT_NAME]" value="<?=htmlspecialchars($_REQUEST["PROPERTY"]["CONTACT_NAME"])?>" />
			</div>
		</div>
		<div class="field">
			<label class="field_label"><?=GetMessage("HEAD_POSITION")?></label>
			<div class="inputContainer">
				<input type="text" name="PROPERTY[CONTACT_POSITION]" value="<?=htmlspecialchars($_REQUEST["PROPERTY"]["CONTACT_POSITION"])?>" />
			</div>
		</div>
		<div class="field last">
			<label class="field_label"><?=GetMessage("EMAIL")?></label>
			<div class="inputContainer">
				<input type="text" name="PROPERTY[CONTACT_EMAIL]" value="<?=htmlspecialchars($_REQUEST["PROPERTY"]["CONTACT_EMAIL"])?>" />
			</div>
		</div>
		<div class="clear"></div>	
	</div>
</div>
<h3><?=GetMessage("STAFFS")?></h3>
<div class="default_forms">	
	<div id="specialities">
		<?if($_REQUEST["PROPERTY"]["SPECIALITIES"][0]["NAME"] || $_REQUEST["PROPERTY"]["SPECIALITIES"][0]["INN"]):?>
		<?foreach($_REQUEST["PROPERTY"]["SPECIALITIES"] as $num=>$dataSp):?>
			<?if($num != 0):?>
			<div class="specialities">
			<?endif?>
			<div class="specialities_input_container">
				<div class="field">
					<label class="field_label"><?=GetMessage("NAME")?></label>
					<div class="inputContainer">
						<input type="text" name="PROPERTY[SPECIALITIES][<?=$num?>][NAME]" value="<?=htmlspecialchars($dataSp["NAME"])?>" />
					</div>
				</div>
				<div class="field">
					<label class="field_label"><?=GetMessage("COMPANY_INN")?></label>
					<div class="inputContainer">
						<input type="text" class="inn_asc" name="PROPERTY[SPECIALITIES][<?=$num?>][INN]" value="<?=htmlspecialchars($dataSp["INN"])?>" />
					</div>
				</div>
				<div class="field button last">
					<label class="field_label"></label>
					<button class="delete delete_speciality" type="button">
						<img src="/design/images/close_cross.png" title="<?=GetMessage("DELETE_FILIAL")?>" width="13" height="13" />
					</button>
				</div>
				<div class="clear"></div>	
			</div>
			<?if($num != 0):?>
			</div>
			<?endif?>
		<?endforeach?>
		<?else:?>
		<div class="specialities_input_container">
			<div class="field">
				<label class="field_label"><?=GetMessage("NAME")?></label>
				<div class="inputContainer">
					<input type="text" name="PROPERTY[SPECIALITIES][0][NAME]" value="" />
				</div>
			</div>
			<div class="field">
				<label class="field_label"><?=GetMessage("COMPANY_INN")?></label>
				<div class="inputContainer">
					<input type="text" class="inn_asc" name="PROPERTY[SPECIALITIES][0][INN]" value="" />
				</div>
			</div>
			<div class="field button last">
				<label class="field_label"></label>
				<button class="delete delete_speciality" type="button">
					<img src="/design/images/close_cross.png" title="<?=GetMessage("DELETE_FILIAL")?>" width="13" height="13" />
				</button>
			</div>
			<div class="clear"></div>	
		</div>
		<?endif?>
	</div>
	<button class="add" name="add_specialities" id="add_specialities"><?=GetMessage("ADD")?></button>
</div>
<input type="hidden" name="next_step" value="4" />
<input type="hidden" name="prev_step" value="2" />
<button type="submit" name="directions" class="orange_submit" value="prev"><?=mb_strtoupper(GetMessage("BACK"))?></button>
<button type="submit" name="directions" class="orange_submit" value="next"><?=mb_strtoupper(GetMessage("CONTINUE"))?></button>