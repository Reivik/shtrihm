<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if(!empty($arResult["COMPANY"])):?>
<?if($_REQUEST["success"] == "yes" && empty($arResult["ERROR"])):?>
	<?ShowNote("Ваши изменения успешно сохранены.");?>
<?endif;?>
<?if(!empty($arResult["ERROR"])):?>
	<?ShowError(implode("<br />", $arResult["ERROR"]));?>
<?endif;?>
	<form class="protection lk" method="post" action="<?=POST_FORM_ACTION_URI?>" name="change_profile" enctype="multipart/form-data">
		<?=bitrix_sessid_post()?>
		<h2><?=$arResult["COMPANY"]["NAME"]?></h2>
		<div class="manager">
			<label class="label_check" for="confirmed"><input name="confirmed_partner" id="confirmed" value="1" type="checkbox" <?if($_REQUEST["confirmed_partner"] == 1 || (!isset($_REQUEST["confirmed_partner"]) && $arResult["COMPANY"]["ACTIVE"] == "Y")):?> checked="checked" <?endif;?>>Партнерство подтверждено</label>
		</div>
		<?if($arResult["COMPANY"]["ACTIVE"] != "Y"):?>
			<div class="manager">
				<label class="label_check" for="delete"><input name="delete" id="delete" value="1" type="checkbox" <?if($_REQUEST["delete"] == 1):?> checked="checked" <?endif;?>>Удалить компанию</label>
			</div>
		<?endif;?>
		<div class="manager">
			<h3>Уровни партнерства</h3>
			<?if(!empty($arResult["COMPANY"]["PARTNER_LEVELS"])):?>
				<?foreach($arResult["COMPANY"]["PARTNER_LEVELS"] as $key => $level):?>
					<label class="label_check" for="confirmed_<?=$key?>">
						<input name="PROPERTY[PARTNERS_LEVELS][<?=$key?>]" id="confirmed_<?=$key?>" value="<?=$key?>" type="checkbox" <?if($_REQUEST["PROPERTY"]["PARTNERS_LEVELS"][$key] == $key || (!isset($_REQUEST["PROPERTY"]["PARTNERS_LEVELS"]) &&  in_array($key,$arResult["COMPANY"]["PARTNER_LEVELS_VALUES"]))):?> checked="checked" <?endif;?>>
						<?=$level?>
					</label>
				<?endforeach;?>
			<?else:?>
				<p>Пользователь не указал требуемых уровней партнерства.</p>
				<p>Вы можете указать доступные данному партнеру уровни доступа.</p>
				<?foreach($arResult["LEVELS"] as $key => $level):?>
					<label class="label_check" for="confirmed_<?=$key?>">
						<input name="PROPERTY[PARTNERS_LEVELS][<?=$key?>]" id="confirmed_<?=$key?>" value="<?=$key?>" type="checkbox" <?if($_REQUEST["PROPERTY"]["PARTNERS_LEVELS"][$key] == $key || (!isset($_REQUEST["PROPERTY"]["PARTNERS_LEVELS"]) && in_array($key,$arResult["COMPANY"]["PARTNER_LEVELS_VALUES"]))):?> checked="checked" <?endif;?>>
						<?=$level?>
					</label>
				<?endforeach;?>
			<?endif;?>
		</div>
		<div class="manager">
			<h3>Партнерский форум</h3>
			<?if($arResult["COMPANY"]["FORUM_DESIRE"]):?>
				<p>Пользователь указал, что желает участвовать в партнерском форуме.</P>
			<?endif;?>
			<?if($arResult["COMPANY"]["FORUM"]):?>
				<p>Сотрудники данного партнера <b>имеют возможность</b> участвовать в партнерском форуме.</p>
				<label class="label_check" for="partner_forum_no"><input name="partner_forum_no" id="partner_forum_no" value="<?=UG_FORUM?>" type="checkbox">Запретить компании участвовать в партнерском форуме</label>
			<?else:?>
				<p>Сотрудники данного партнера <b>не имеют возможности</b> участвовать в партнерском форуме.</p>
				<label class="label_check" for="partner_forum_yes">
					<input name="partner_forum_yes" id="partner_forum_yes" value="<?=UG_FORUM?>" type="checkbox" <?=($arResult["COMPANY"]["FORUM_DESIRE"])?'checked':'';?>/>
					Разрешить компании участвовать в партнерском форуме
				</label>
			<?endif;?>
		</div>
		<?if(!empty($arResult["COMPANY"]["STATUS"])):?>
			<div class="manager">
				<h3>Статусы</h3>
				<?foreach($arResult["COMPANY"]["STATUS"] as $key => $status):?>
					<label class="label_check" for="status_<?=$key?>"><input name="PROPERTY[STATUS][<?=$key?>]" id="status_<?=$key?>" value="<?=$key?>" type="checkbox" <?if($_REQUEST["PROPERTY"]["STATUS"][$key] == $key || (!isset($_REQUEST["PROPERTY"]["STATUS"]) && $arResult["COMPANY"]["STATUS"][$key] == $status)):?> checked="checked" <?endif;?>><?=$status?></label>
				<?endforeach;?>
			</div>
		<?endif;?>
		<div class="manager">
			<h3>Региональный менеджер</h3>
			<?if(!empty($arResult['MANAGERS'])):?>
				<select name="PROPERTY[REGIONAL_MANAGER]">
					<option value="0">Региональный менеджер</option>
					<?foreach($arResult['MANAGERS'] as $reg):?>
						<option value="<?=$reg["ID"]?>" <?if($_REQUEST["PROPERTY"]["REGIONAL_MANAGER"] == $reg["ID"] || (!isset($_REQUEST["PROPERTY"]["REGIONAL_MANAGER"]) && $arResult["COMPANY"]["REGIONAL_MANAGER"] == $reg["ID"])):?> selected="selected" <?endif;?>><?=$reg["NAME"]?></option>
					<?endforeach;?>
				</select>
			<?endif;?>
		</div>
		<div class="manager">
			<h3>Менеджер по продажам</h3>
			<?if(!empty($arResult['MANAGERS'])):?>
				<select name="PROPERTY[SALES_MANAGER]">
					<option value="0">Менеджер по продажам</option>
					<?foreach($arResult['MANAGERS'] as $reg):?>
						<option value="<?=$reg["ID"]?>" <?if($_REQUEST["PROPERTY"]["SALES_MANAGER"] == $reg["ID"] || (!isset($_REQUEST["PROPERTY"]["SALES_MANAGER"]) && $arResult["COMPANY"]["SALES_MANAGER"] == $reg["ID"])):?> selected="selected" <?endif;?>><?=$reg["NAME"]?></option>
					<?endforeach;?>
				</select>
			<?endif;?>
		</div>
		<div class="two_input_container">
			<div class="field">
				<label class="field_label">Соглашение о партнерстве №</label>
				<div class="inputContainer">
					<input type="text" name="PROPERTY[PARTNER_AGREEMENT]" <?if(!empty($_REQUEST["PROPERTY"]["PARTNER_AGREEMENT"])):?> value="<?=htmlspecialchars($_REQUEST["PROPERTY"]["PARTNER_AGREEMENT"])?>" <?elseif(!isset($_REQUEST["PROPERTY"]["PARTNER_AGREEMENT"]) && $arResult["COMPANY"]["PARTNER_AGREEMENT"]):?> value="<?=$arResult["COMPANY"]["PARTNER_AGREEMENT"]?>" <?endif;?> />
				</div>
			</div>
			<div class="field last">
				<label class="field_label">Срок действия соглашения о партнерстве:</label>
				<div class="inputContainer">
					<input type="text" name="PROPERTY[TERM_AGREEMENT]" <?if(!empty($_REQUEST["PROPERTY"]["TERM_AGREEMENT"])):?> value="<?=htmlspecialchars($_REQUEST["PROPERTY"]["TERM_AGREEMENT"])?>" <?elseif(!isset($_REQUEST["PROPERTY"]["TERM_AGREEMENT"]) && $arResult["COMPANY"]["TERM_AGREEMENT"]):?> value="<?=$arResult["COMPANY"]["TERM_AGREEMENT"]?>" <?endif;?> />
				</div>	
			</div>		
			<div class="clear"></div>
		</div>
		<div class="two_input_container">
			<div class="field">
				<label class="field_label">Договор о поставке №</label>
				<div class="inputContainer">
					<input type="text" name="PROPERTY[SUPPLY_AGREEMENT]" <?if(!empty($_REQUEST["PROPERTY"]["SUPPLY_AGREEMENT"])):?> value="<?=htmlspecialchars($_REQUEST["PROPERTY"]["SUPPLY_AGREEMENT"])?>" <?elseif(!isset($_REQUEST["PROPERTY"]["SUPPLY_AGREEMENT"]) && $arResult["COMPANY"]["SUPPLY_AGREEMENT"]):?> value="<?=$arResult["COMPANY"]["SUPPLY_AGREEMENT"]?>" <?endif;?> />
				</div>
			</div>
			<div class="field last">
				<label class="field_label">Срок действия договора о поставке:</label>
				<div class="inputContainer">
					<input type="text" name="PROPERTY[TERM_SUPP_AGR]" <?if(!empty($_REQUEST["PROPERTY"]["TERM_SUPP_AGR"])):?> value="<?=htmlspecialchars($_REQUEST["PROPERTY"]["TERM_SUPP_AGR"])?>" <?elseif(!isset($_REQUEST["PROPERTY"]["TERM_SUPP_AGR"]) && $arResult["COMPANY"]["TERM_SUPP_AGR"]):?> value="<?=$arResult["COMPANY"]["TERM_SUPP_AGR"]?>" <?endif;?> />
				</div>	
			</div>		
			<div class="clear"></div>
		</div>
		<div class="two_input_container">
			<div class="field">
				<label class="field_label">Лицензионный договор №</label>
				<div class="inputContainer">
					<input type="text" name="PROPERTY[LICENSE_AGREEMENT]" <?if(!empty($_REQUEST["PROPERTY"]["LICENSE_AGREEMENT"])):?> value="<?=htmlspecialchars($_REQUEST["PROPERTY"]["LICENSE_AGREEMENT"])?>" <?elseif(!isset($_REQUEST["PROPERTY"]["LICENSE_AGREEMENT"]) && $arResult["COMPANY"]["LICENSE_AGREEMENT"]):?> value="<?=$arResult["COMPANY"]["LICENSE_AGREEMENT"]?>" <?endif;?> />
				</div>
			</div>
			<div class="field last">
				<label class="field_label">Срок действия лицензионного договора:</label>
				<div class="inputContainer">
					<input type="text" name="PROPERTY[TERM_LICENSE_AGR]" <?if(!empty($_REQUEST["PROPERTY"]["TERM_LICENSE_AGR"])):?> value="<?=htmlspecialchars($_REQUEST["PROPERTY"]["TERM_LICENSE_AGR"])?>" <?elseif(!isset($_REQUEST["PROPERTY"]["TERM_LICENSE_AGR"]) && $arResult["COMPANY"]["TERM_LICENSE_AGR"]):?> value="<?=$arResult["COMPANY"]["TERM_LICENSE_AGR"]?>" <?endif;?> />
				</div>	
			</div>		
			<div class="clear"></div>
		</div>
		<button type="submit" name="changeCompany" value="send">Сохранить изменения</button>
	</form>
<?endif;?>