<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>

<?//pr($arResult);?>
<?//pr($_REQUEST);?>
<?//pr($_SESSION["FILTER"]);?>
<div class="download_filter">
	<form name="download_filter" action="<?=$_SERVER["HTTP_X_FORWARDED_PROTO"].'://'.$_SERVER["HTTP_HOST"].$_SERVER["SCRIPT_URL"]; ?>" method="get" class="default_forms downloadform">
		<div class="select_line">
			<div class="section_select">
				<select name="section_id">
					<option value="all" <?if($arParams["SECTION_ID"] == "all"):?>selected<?endif;?>>Категория товара</option>
					<?foreach($arResult["SECTIONS"] as $id=>$sect):?>
						<option value="<?=$id?>" <?if($arParams["SECTION_ID"] == $id):?>selected<?endif;?>><?=$sect["NAME"]?></option>
					<?endforeach;?>
				</select>
			</div>
			<div class="product_select">
				<select name="product_id" class="main_select">
					<option value="all" <?if($arParams["ELEMENT_ID"] == "all"):?>selected<?endif;?>>Наименование товара</option>
					<?foreach($arResult["PRODUCTS"] as $id=>$prod):?>
						<option value="<?=$id?>" <?if($arParams["ELEMENT_ID"] == $id):?>selected<?endif;?>><?=$prod["NAME"]?></option>
					<?endforeach;?>
				</select>
			</div>
		</div>
		<div class="select_line">
			<div class="type_select">
				<select name="type_id">
					<option value="all" <?if($arParams["TYPE"] == "all"):?>selected<?endif;?>>Тип файла</option>
					<?foreach($arResult["TYPES"] as $id=>$type):?>
						<option value="<?=$id?>" <?if($arParams["TYPE"] == $id):?>selected<?endif;?>><?=$type["NAME"]?></option>
					<?endforeach;?>
				</select>
			</div>
		</div>
		<div class="search">
			<input type="text" name="searchDownloads" value="<?=$arParams['SEARCH_STRING']?>" class="inputText downloadSearchInput" placeholder="Поиск"/>
			<button type="submit" class="btn"><i></i> Найти</button>
		</div>
	</form>
</div>

<!--скрытые поля-->
<div style="display:none">
	<?foreach($arResult["SECTIONS_DOWNLOADS"] as $id_s):?>
	<div class="sel<?=$id_s?>">
		<select name="product_id" id="sel<?=$id_s?>">
			<option value="all">Наименование товара</option>
			<?if($arResult["ELEMENTS_SECTIONS"][$id_s]):?>
				<?foreach($arResult["ELEMENTS_SECTIONS"][$id_s] as $id=>$name):?>
					<option value="<?=$id?>"><?=$name?></option>
				<?endforeach?>
			<?endif?>
		</select>
	</div>
	<?endforeach?>
	<div class="selall">
		<select name="product_id" id="selall">
			<option value="all">Наименование товара</option>
			<?foreach($arResult["ALL_PRODUCTS"] as $id=>$name):?>
				<option value="<?=$id?>"><?=$name?></option>
			<?endforeach?>
		</select>
	</div>
</div>
