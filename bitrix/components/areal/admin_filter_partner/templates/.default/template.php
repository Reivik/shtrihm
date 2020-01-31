<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?//pr($arResult);?>
<a name="filter"></a>
<form name="admin_partner_filter" class="filter_form" action="<?=$APPLICATION->GetCurPage()?>#filter" method="get">
	<h3>Для просмотра данных личного кабинета выберите компанию:</h3>
	<div class="field">
		<select name="admin_now_region" class="region" title="region_partner">
			<option value="0">Регион</option>
			
			<?if(isset($_REQUEST["admin_now_region"])) 
				$selected_region = $_REQUEST["admin_now_region"];
			else $selected_region = $arResult["SELECTED_REGION"];
			echo $selected_region;?>
			<?foreach($arResult["REGIONS"] as $key => $region):?>
				<option value="<?=$key?>" <?if($selected_region == $key):?> selected="selected" <?endif;?> ><?=$region?></option>
			<?endforeach;?>
		</select>
	</div>		
	<div class="field">
		<select name="admin_now_town" class="town" id="region_partner">
			<option value="0">Город</option>
			<?if(isset($_REQUEST["admin_now_region"]) && isset($_REQUEST["admin_now_town"])) {
				$towns = $arResult["TOWNS"][$_REQUEST["admin_now_region"]];
				$selected_town = $arResult["TOWNS"][$_REQUEST["admin_now_region"]][$_REQUEST["admin_now_town"]];
			}
			else {
				$towns = $arResult["TOWNS"][$arResult["SELECTED_REGION"]];
				$selected_town = $arResult["TOWNS"][$arResult["SELECTED_REGION"]][$arResult["SELECTED_TOWN"]];
			}?>
			<?foreach($towns as $k => $town):?>
				<option value="<?=$k?>" <?if($selected_town == $k):?> selected="selected" <?endif;?> ><?=$town?></option>
			<?endforeach;?>
		</select>	
	</div>
	<?if(!empty($arResult["DIRECTIONS"])):?>
		<div class="field last">
			<select name="admin_now_direction">
				<option value="0">Все направления</option>
				<?foreach($arResult["DIRECTIONS"] as $directions):?>
					<option value="<?=$directions["ID"]?>" <?if($directions["ID"] == $_REQUEST["admin_now_direction"]):?> selected="selected" <?endif;?> ><?=$directions["NAME"]?></option>
				<?endforeach;?>
			</select>
		</div>
	<?endif;?>
	<?if(!empty($arResult["LEVELS"])):?>
		<div class="field">
			<select name="admin_now_level">
				<option value="0">Уровень доступа</option>
				<?foreach($arResult["LEVELS"] as $level):?>
					<option value="<?=$level["ID"]?>" <?if($level["ID"] == $_REQUEST["admin_now_level"]):?> selected="selected" <?endif;?> ><?=$level["NAME"]?></option>
				<?endforeach;?>
			</select>
		</div>
	<?endif;?>
	<div class="field">
		<select name="admin_now_confirmed">
			<option value="0">Подтверждение партнера</option>
			<option value="Y" <?if($_REQUEST["admin_now_confirmed"] == "Y"):?> selected="selected" <?endif;?>>Подтвержден</option>
			<option value="N" <?if($_REQUEST["admin_now_confirmed"] == "N"):?> selected="selected" <?endif;?>>Неподтвержден</option>
		</select>
	</div>
	<div class="field last search">
		<div class="inputContainer">
			<input type="text" name="admin_now_search" placeholder="Название компании" value="<?=htmlspecialchars($_REQUEST["admin_now_search"])?>" />
		</div>
		<input type="hidden" name="send_ok" value="send" />
		<button type="submit" name="send_now" class="btn" value="send"><i></i> Найти</button>
	</div>
	<div class="clear"></div>
	<?if((!empty($arResult["COMPANY"]) && $_REQUEST["send_ok"]) || (!empty($arResult["COMPANY"]) && isset($_REQUEST["company_partner_id"]))):?>
		<div class="partner_form">
			<h3>Выберите компанию</h3>
			<div id="partners_list" class="admin_partner">
				<?foreach($arResult["COMPANY"] as $key => $partner):?>
					<div class="partner count_4 <?if(($key+1)%4 == 0):?> last <?endif;?> <?if($_REQUEST["admin_now_company"] == $partner["ID"]):?> active <?endif;?>">
						<input type="hidden" name="partner_id" value="<?=$partner["ID"]?>" disabled="disabled" />
						<table>
							<tr>
								<td class="img">
									<?if(!empty($partner["PREVIEW_PICTURE"])):?>
										<img src="<?=$partner["PREVIEW_PICTURE"]["src"]?>" width="<?=$partner["PREVIEW_PICTURE"]["width"]?>" height="<?=$partner["PREVIEW_PICTURE"]["height"]?>" title="<?=$partner["NAME"]?>" alt="<?=$partner["NAME"]?>" />
									<?else:?>
										<img src="/design/images/no-photo/pic58x58.png" alt="<?=$partner["NAME"]?>" title="<?=$partner["NAME"]?>" width="58" height="58" />
									<?endif;?>
								</td>
							</tr>
						</table>
						<table>
							<tr>
								<td>
									<span><?=$partner["NAME"]?></span>
								</td>
							</tr>
						</table>
					</div>
				<?endforeach;?>
				<div class="clear"></div>
			</div>
		</div>
		<input type="hidden" name="admin_now_company" value="<?=htmlspecialchars($_REQUEST["admin_now_company"])?>" />
	<?else:?>
		<p>По Вашему запросу компаний не найдено.</p>
	<?endif;?>

	<?if(isset($_REQUEST["admin_now_company"]) || isset($GLOBALS["ADMIN_CHOOSE_COMPANY"])):?>
		<?if(!empty($arResult["COMPANY"])):?>
			<?foreach($arResult["COMPANY"] as $key => $partner):?>
				<?if(($_REQUEST["admin_now_company"] == $partner["ID"]) || ($GLOBALS["ADMIN_CHOOSE_COMPANY"] == $partner["ID"])):?>
					<h3>Вы выбрали компанию <u><?=$partner["NAME"]?></u></h3>
				<?endif;?>
			<?endforeach;?>
		<?endif;?>
	<?endif;?>
</form>