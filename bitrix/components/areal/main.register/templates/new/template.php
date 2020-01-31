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
		<!-- div class='radioBlock'>
			<h3><?=GetMessage('CHOSE_SPOSOB')?></h3>
			<label class='label_radio' for='regform_user'><input name='user' id='regform_user' value='user' type='radio' <?if(!isset($_REQUEST['user']) || $_REQUEST['user'] == 'user'):?> checked='checked' <?endif;?>><?=GetMessage('USER')?></label>
			<label class='label_radio' for='regform_partner'><input name='user' id='regform_partner' value='partner' type='radio' <?if($_REQUEST['user'] == 'partner'):?> checked='checked' <?endif;?>><?=GetMessage('PARTNER')?></label>
		</div -->
		<div id='user_form' style="display:block;">
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
		<input type='submit' name='register_submit_button' id='reg_form_submit' value='<?=GetMessage('REG')?>' />
	</form>
<?endif?>