<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if(!empty($arResult)):?>
	<?//$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/filter_partner.php"), false);?>

    <p>Для удобства восприятия и поиска Вы можете отсортировать список организаций по следующим критериям: страна, область/край, город и вид продукции.</p>
	<a name="filter"></a>
	<form name="partner_filter" class="filter_form introduction" action="<?=$APPLICATION->GetCurPage()?>#filter" method="get">		
		<div class="country-region-town">
			<div class="field">
				<select name="country" class="country" title="country_partner">
					<option value="0" <?if($arResult["SELECTED_COUNTRY"] == 0):?> selected="selected" <?endif;?> >Все страны</option>
					<?foreach($arResult["COUNTRIES"] as $keyCon => $country):?>
						<option value="<?=$keyCon?>" <?if($arResult["SELECTED_COUNTRY"] == $keyCon):?> selected="selected" <?endif;?> ><?=$country?></option>
					<?endforeach;?>
				</select>
			</div>	
			<div class="two_input_container">				
				<div class="field">
					<select name="region" class="region" id="country_partner" title="region_partner">
						<option value="0" <?if($arResult["SELECTED_REGION"] == 0):?> selected="selected" <?endif;?> >Все регионы</option>
						<?foreach($arResult["REGIONS"][$arResult["SELECTED_COUNTRY"]] as $key => $region):?>
							<option value="<?=$key?>" <?if($arResult["SELECTED_REGION"] == $key):?> selected="selected" <?endif;?> ><?=$region?></option>
						<?endforeach;?>
					</select>
				</div>	
				<div class="hidecity">
					<div class="field last">
						<select name="town" class="town" id="region_partner">
							<option value="0" <?if($arResult["SELECTED_TOWN"] == 0):?> selected="selected" <?endif;?> >Все города</option>
							<?foreach($arResult["TOWNS"][$arResult["SELECTED_REGION"]] as $k => $town):?>
								<option value="<?=$k?>" <?if($arResult["SELECTED_TOWN"] == $k):?> selected="selected" <?endif;?> ><?=$town?></option>
							<?endforeach;?>
						</select>	
					</div>
				</div>	
				<div class="clear"></div>
			</div>
		</div>

			<div class="field">
				<select name="directions">
					<option value="0" <?if($_REQUEST["directions"] == 0):?> selected="selected" <?endif;?> >Вид продукции</option>
					<?foreach($arResult["DIRECTIONS"] as $directions):?>
						<option value="<?=$directions["ID"]?>" <?if($directions["ID"] == $_REQUEST["directions"]):?> selected="selected" <?endif;?> ><?=$directions["NAME"]?></option>
					<?endforeach;?>
				</select>
			</div>




            <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
            <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

            <div class="field statuses-wrapper">
                <label for="statuses">Статусы компаний</label>
                <select id="statuses" multiple="multiple" name="statuses[]">
                    <?foreach($arResult["STATUSES"] as $id => $name):?>
                        <option value="<?=$id?>" <?if(in_array($id, $_REQUEST['statuses'])):?> selected="selected" <?endif;?> ><?=$name?></option>
                    <?endforeach;?>
                </select>
            </div>

            <script type="text/javascript">
                $(function () {
                    $('#statuses').select2({
                        'width':'100%',
                        'placeholder': 'Статусы компаний'
                    });
                });
            </script>
            <style type="text/css">
                 .pageCont .field ul > li{
                    background: none;
                }
                .statuses-wrapper{
                    margin-bottom: 20px;
                }
                 .select2-container .select2-selection--multiple{
                     padding-bottom: 3px;
                 }
                 .select2-container--default .select2-selection--multiple .select2-selection__rendered li{
                     font-size: 13px;
                     padding: 2px 3px 2px 3px;
                     height: auto;
                     line-height: 1;
                 }
            </style>
       


		<div class="search">
			<div class="inputContainer">
				<input type="text" name="search" placeholder="Поиск" value="<?=htmlspecialcharsEx($_REQUEST["search"])?>" />
			</div>
			<button type="submit" name="send" class="btn"><i></i> Найти</button>
		</div>		
		<div class="clear"></div>
	</form>
<?endif;?>
