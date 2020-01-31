<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<h2><?=GetMessage("STEP_3")?></h2>
<div class="default_forms">	
	<h3><?=GetMessage("STAFFS")?></h3>
	<div id="specialities">
		<?
			if(!empty($_REQUEST["PROPERTY"]["SPECIALITIES"]))
				$specialists = $_REQUEST["PROPERTY"]["SPECIALITIES"];
			elseif(!empty($_SESSION["FORM"]["PROPERTY"]["SPECIALITIES"]))
				$specialists = $_SESSION["FORM"]["PROPERTY"]["SPECIALITIES"];			
		?>
		<?if(!empty($specialists)):?>
			<?foreach($specialists as $key => $spec):?>
				<div class="specialities">
					<div class="specialities_input_container">
						<div class="field">
							<label class="field_label"><?=GetMessage("NAME")?></label>
							<div class="inputContainer">
								<input type="text" name="PROPERTY[SPECIALITIES][<?=$key?>][NAME]" value="<?=htmlspecialchars($spec["NAME"])?>" />
							</div>
						</div>
						<div class="field">
							<label class="field_label"><?=GetMessage("INN")?></label>
							<div class="inputContainer">
								<input type="text" name="PROPERTY[SPECIALITIES][<?=$key?>][INN]" class="inn_asc" value="<?=htmlspecialchars($spec["INN"])?>" />
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
					<div class="specialities_input_container">
						<div class="field">
							<label class="field_label"><?=GetMessage("DATE_LEARNING")?></label>
							<div class="inputContainer">
								<input type="text" name="PROPERTY[SPECIALITIES][<?=$key?>][DATE_LEARNING]" class="date_asc" value="<?=htmlspecialchars($spec["DATE_LEARNING"])?>" />
							</div>
						</div>
						<div class="field">
							<label class="field_label"><?=GetMessage("PLACE_LEARNING")?></label>
							<div class="inputContainer">
								<input type="text" name="PROPERTY[SPECIALITIES][<?=$key?>][PLACE_LEARNING]" value="<?=htmlspecialchars($spec["PLACE_LEARNING"])?>" />
							</div>
						</div>
						<div class="clear"></div>	
					</div>
				</div>
			<?endforeach;?>
		<?else:?>
			<div class="specialities">
				<div class="specialities_input_container">
					<div class="field">
						<label class="field_label"><?=GetMessage("NAME")?></label>
						<div class="inputContainer">
							<input type="text" name="PROPERTY[SPECIALITIES][1][NAME]" value="" />
						</div>
					</div>
					<div class="field">
						<label class="field_label"><?=GetMessage("INN")?></label>
						<div class="inputContainer">
							<input type="text" name="PROPERTY[SPECIALITIES][1][INN]" class="inn_asc" value="" />
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
				<div class="specialities_input_container">
					<div class="field">
						<label class="field_label"><?=GetMessage("DATE_LEARNING")?></label>
						<div class="inputContainer">
							<input type="text" name="PROPERTY[SPECIALITIES][1][DATE_LEARNING]" class="date_asc" value="" />
						</div>
					</div>
					<div class="field">
						<label class="field_label"><?=GetMessage("PLACE_LEARNING")?></label>
						<div class="inputContainer">
							<input type="text" name="PROPERTY[SPECIALITIES][1][PLACE_LEARNING]" value="" />
						</div>
					</div>
					<div class="clear"></div>	
				</div>
			</div>
		<?endif;?>
	</div>
	<button class="add" name="add_specialities" id="add_specialities"><?=GetMessage("ADD")?></button>
	<?/* <h3><?=GetMessage("DOCUMENTS")?></h3>
	<?$documents = array(
		"Свидетельство о государственной регистрации юридического лица.",
		"Свидетельство о постановке на учет российской организации в налоговом органе по месту нахождения на территории Российской Федерации.",
		"Свидетельство о регистрации хозяйствующего субъекта в качестве ЦТО (для действующих ЦТО).",
		"Договор на аренду/субаренду производственных помещений или документ, подтверждающий наличие в собственности этих помещений.",
		"Договор на поставку ЭКЛЗ с организацией, уполномоченной на распространение ЭКЛЗ.",
		"Акт обследования территориальным органом вневедомственной охраны складских помещений для хранения не активированных ЭКЛЗ, с указанием об их соответствии требованиям руководящего документа РД 78.36.003-2002 МВД России (или договор с банком об аренде банковской ячейки для хранения не активированных ЭКЛЗ).",
		"Договор с территориальным органом вневедомственной охраны об охране складских помещений для хранения не активированных ЭКЛЗ (или договор с банком об аренде банковской ячейки для хранения не активированных ЭКЛЗ).",
		"Заключение Федеральной службы по надзору в сфере защиты прав потребителей и благополучия человека о соответствии помещений установленным требованиям для проведения технического обслуживания и ремонта ККТ.",
		"Заключение о пожарной безопасности помещений для проведения технического обслуживания и ремонта ККТ.",
		"Заключение электротехнической лаборатории о соответствии помещений установленным требованиям для проведения технического обслуживания и ремонта ККТ.",
		"Нормативные документы, регламентирующие применение контрольно-кассовой техники в РФ.",
		"Эксплуатационная и техническая документация на модели ККТ, по которым планируется заключить договор/получить пролонгацию договора на право осуществления технической поддержки.",
		"Документы, устанавливающие порядок, виды и сроки предоставления услуг по технической поддержке конкретных моделей ККТ, а также порядок выполнения гарантийных обязательств.",
		"Текущие графики проведения технического обслуживания ККТ.",
		"Документы по учету сведений о ККТ, об устанавливаемых на нее знаках &laquo;Сервисное обслуживание&raquo;, марок-пломб, о замененных функциональных и фискальных модулях."		
	);?>
	<?foreach($documents as $key => $doc):?>
		<label class="label_check" for="people_contacts">
			<input name="PROPERTY[DOCUMENTS][<?=$key?>]" type="checkbox" value="<?=$doc?>" <?if($_REQUEST["PROPERTY"]["DOCUMENTS"][$key] == $doc || $_SESSION["FORM"]["PROPERTY"]["DOCUMENTS"][$key] == $doc):?> checked="checked" <?endif;?> /><?=$doc?>
		</label>
	<?endforeach;?>
	<h3><?=GetMessage("SOFTWARE")?></h3>
	<?$software = array(
		"Программаторы, имеющие возможности работы с микроконтроллерами, применяемыми в ККТ Поставщика, в том числе последовательный внутрисхемный программатор для перепрограммирования микроконтроллеров системных плат фискальных регистраторов.",
		"Переходники микроконтроллеров под определенные модели микросхем применяемые в ККТ Поставщика.",
		"Отладочный комплект ЭКЛЗ",
		"Осциллограф с действующим сроком поверки.",
		"Паяльная станция.",
		"Вольтметр цифровой с действующим сроком поверки.",
		"ПЭВМ с предустановленным специализированным ПО для выполнения работ по ремонту и техническому обслуживанию моделей ККТ, в том числе портативные переносные ПЭВМ для обеспечения технической поддержки непосредственно на месте прямого использования ККТ у Потребителя.",
		"Комплект инструментов для проведения демонтажных и монтажных работ ККТ Поставщика.",
		"Набор интерфейсных кабелей (шлейфов)."
	);?>
	<?foreach($software as $k => $soft):?>
		<label class="label_check" for="people_contacts">
			<input name="PROPERTY[SOFTWARE][<?=$k?>]" type="checkbox" value="<?=$soft?>" <?if($_REQUEST["PROPERTY"]["SOFTWARE"][$k] == $soft || $_SESSION["FORM"]["PROPERTY"]["SOFTWARE"][$k] == $soft):?> checked="checked" <?endif;?> /><?=$soft?>
		</label>
	<?endforeach;?>*/?>
	<h3><?=GetMessage("POSTAVSCHIKI")?></h3> 
	<div id="postavschiki">
		<?
			if(!empty($_REQUEST["PROPERTY"]["LEARNING"]))
				$postavschiki = $_REQUEST["PROPERTY"]["LEARNING"];
			elseif(!empty($_SESSION["FORM"]["PROPERTY"]["LEARNING"]))
				$postavschiki = $_SESSION["FORM"]["PROPERTY"]["LEARNING"];			
		?>
		<?if(!empty($postavschiki)):?>
			<?foreach($postavschiki as $key => $post):?>
				<div class="postavschiki">
					<div class="specialities_input_container">
						<div class="field">
							<label class="field_label"><?=GetMessage("REGION")?></label>
							<select name="PROPERTY[LEARNING][0][REGION]" title="REGIONACTUAL__" class="region">
								<option value="0"><?=GetMessage("REGION")?></option>
								<?foreach($arResult["REGIONS"] as $key => $region):?>
									<option value="<?=$key?>" <?if($key == $post["REGION"]):?> selected="selected" <?endif;?>><?=$region?></option>
								<?endforeach;?>
							</select>
						</div>
						<div class="field">
							<label class="field_label"><?=GetMessage("TOWN")?></label>
							<select name="PROPERTY[LEARNING][0][TOWN]" id="REGIONACTUAL__" class="town">
								<option value="0"><?=GetMessage("TOWN")?></option>
								<?foreach($arResult["TOWNS"][$post["REGION"]] as $k => $town):?>
									<option value="<?=$k?>" <?if($k == $post["TOWN"]):?> selected="selected" <?endif;?>><?=$town?></option>
								<?endforeach;?>
							</select>
						</div>
						<div class="field button last">
							<label class="field_label"></label>
							<button class="delete delete_postavschiki" type="button">
								<img src="/design/images/close_cross.png" title="<?=GetMessage("DELETE_FILIAL")?>" width="13" height="13" />
							</button>
						</div>
						<div class="clear"></div>	
					</div>			
					<div class="field">
						<label class="field_label"><?=GetMessage("NAME_COMPANY")?></label>
						<div class="inputContainer">
							<input type="text" name="PROPERTY[LEARNING][0][NAME]" value="<?=htmlspecialchars($post["NAME"])?>" />
						</div>
					</div>				
					<div class="clear"></div>
				</div>
			<?endforeach;?>
		<?else:?>
			<div class="postavschiki">
				<div class="specialities_input_container">
					<div class="field">
						<label class="field_label"><?=GetMessage("REGION")?></label>
						<select name="PROPERTY[LEARNING][0][REGION]" title="REGIONACTUAL__" class="region">
							<option value="0"><?=GetMessage("REGION")?></option>
							<?foreach($arResult["REGIONS"] as $key => $region):?>
								<option value="<?=$key?>" <?if($key == $select_region):?> selected="selected" <?endif;?>><?=$region?></option>
							<?endforeach;?>
						</select>
					</div>
					<div class="field">
						<label class="field_label"><?=GetMessage("TOWN")?></label>
						<select name="PROPERTY[LEARNING][0][TOWN]" id="REGIONACTUAL__" class="town">
							<option value="0"><?=GetMessage("TOWN")?></option>
							<?foreach($arResult["TOWNS"][$select_region] as $k => $town):?>
								<option value="<?=$k?>" <?if($k == $select_town):?> selected="selected" <?endif;?>><?=$town?></option>
							<?endforeach;?>
						</select>
					</div>
					<div class="field button last">
						<label class="field_label"></label>
						<button class="delete delete_postavschiki" type="button">
							<img src="/design/images/close_cross.png" title="<?=GetMessage("DELETE_FILIAL")?>" width="13" height="13" />
						</button>
					</div>
					<div class="clear"></div>	
				</div>			
				<div class="field">
					<label class="field_label"><?=GetMessage("NAME_COMPANY")?></label>
					<div class="inputContainer">
						<input type="text" name="PROPERTY[LEARNING][0][NAME]" value="" />
					</div>
				</div>				
				<div class="clear"></div>
			</div>
		<?endif;?>
	</div>
	<button class="add" name="add_postav" id="add_postav"><?=GetMessage("ADD")?></button>
</div>
<input type="hidden" name="next_step" value="4" />
<input type="hidden" name="prev_step" value="2" />
<button type="submit" name="directions" class="orange_submit" value="prev"><?=mb_strtoupper(GetMessage("BACK"))?></button>
<button type="submit" name="directions" class="orange_submit" value="next"><?=mb_strtoupper(GetMessage("CONTINUE"))?></button>
	
