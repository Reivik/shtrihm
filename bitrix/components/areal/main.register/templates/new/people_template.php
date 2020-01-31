<div class="clone people" style='display:none;'>
	<div class="checkBlock">
		<label class="label_check" for="people_contacts">
			<input name="COMPANY[PEOPLE][][contacts_person]" id="people_contacts" type="checkbox" /><?=GetMessage("CONTACT_PERSON")?>
		</label>
	</div>
	<div class="inputContainer">
		<input type="text" class="people_input" name="COMPANY[PEOPLE][][NAME]" value="" placeholder="<?=GetMessage("FULL_NAME")?>" />
	</div>
	<div class="inputContainer">	
		<input type="text" class="people_input" name="COMPANY[PEOPLE][][PROPERTY_VALUES][POSITION]" value="" placeholder="<?=GetMessage("CONTACT_POSITION")?>" />
	</div>
	<div class="inputContainer">
		<input type="text" class="people_input" name="COMPANY[PEOPLE][][PROPERTY_VALUES][EMAIL]" value="" placeholder="<?=GetMessage("CONTACT_EMAIL")?>" />
	</div>
	<div class="inputContainer">
		<input type="text" class="people_input last phone" name="COMPANY[PEOPLE][][PROPERTY_VALUES][PHONE]" value="" placeholder="<?=GetMessage("CONTACT_PHONE")?>" />
	</div>
	<button id="rem_p" class="del_filial" type="button">
		<img src="/design/images/close_cross.png" title="<?=GetMessage("DELETE_PEOPLE")?>" alt="<?=GetMessage("DELETE_PEOPLE")?>" width="13" height="13" />
	</button>
	<div class="clear"></div>
</div>