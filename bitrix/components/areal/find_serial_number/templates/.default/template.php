<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<?//pr($_REQUEST);?>
<div class="reg_equipment">
	<p>Здесь Вы можете отследить статус товара.</p>
	<form name="achievements_filter" class="filter_form" action="/support/registration/index.php" method="post">
		<div class="search">
			<div class="inputContainer">
				<input type="text" name="serialText" value="<?=$_REQUEST["serialText"]?>" placeholder="Введите серийный номер товара" />
			</div>
			<button type="submit" name="s" class="btn"><i></i> Найти</button>
		</div>
		<?if(count($arResult)>0):?>
			<?if(isset($arResult['ERROR'])):?>
			<?elseif($arResult['ELEMENT']['SALE_DATE']==""):?>
				<p>Название оборудования: <?=$arResult['ELEMENT']['NAME']?></p>
				<p>Не продавалось</p>
			<?elseif($arResult['ELEMENT']['COMMISSIONING_DATE']==""):?>
				<p>Название оборудования: <?=$arResult['ELEMENT']['NAME']?></p>
				<p>Дата продажи: <?=$arResult['ELEMENT']['SALE_DATE']?></p>
				<?if(in_array(UG_PO,$USER->GetUserGroupArray())|| in_array(UG_ADMIN,$USER->GetUserGroupArray())):?>
					<div class="field">
						<label class="field_label">Ввести в эксплуатацию до:</label>
						<div class="inputContainer">
							<input type="text" name="comm_date" value="<?=$_REQUEST["comm_date"]?>" class="date_asc" />
						</div>
					</div>
					<input name="commDateOk" type="submit" value="Подтвердить" />
				<?endif;?>
			<?else:?>
				<p>Название оборудования: <?=$arResult['ELEMENT']['NAME']?></p>
				<p>Дата продажи: <?=$arResult['ELEMENT']['SALE_DATE']?></p>
				<p>Дата ввода в эксплуатацию: <?=$arResult['ELEMENT']['COMMISSIONING_DATE']?></p>
				<?if(isset($arResult['REMONT'])):?>
					<p><b>Гарантийные ремонты:</b></p>
					<?foreach($arResult['REMONT'] as $arRemont):?>
						<p>&mdash; <b><?=$arRemont['DATE']?></b>: <?=$arRemont['COMMENT']?></p>
					<?endforeach;?>
				<?endif;?>
				<?if(in_array(UG_PO,$USER->GetUserGroupArray()) || in_array(UG_ADMIN,$USER->GetUserGroupArray())):?>
					<p><b>Добавить информацию о  гарантийном ремонте:</b></p>
					<div class="field">
						<label class="field_label">Дата гарантийного ремонта:</label>
						<div class="inputContainer">
							<input type="text" name="remontDate" value="<?=$_REQUEST["remontDate"]?>" class="date_asc" />
						</div>
					</div>
					<div class="field">
						<label class="field_label">Комментарий</label>
						<div class="textareaContainer">
							<textarea name="regComment"><?=$_REQUEST["regComment"]?></textarea>
						</div>
					</div>
					<input name="remontOk" type="submit" value="Подтвердить" />
				<?endif;?>
				<p><b>Состояние:</b> <?=$arResult['ELEMENT']['STATUS']?></p>
			<?endif;?>
		<?endif;?>
		<input type="hidden" name="serNumber" value="<?=$_POST['serialText']?>"/>
		<?=bitrix_sessid_post()?>
		<div class="clear"></div>
	</form>
	<?if(isset($arResult['ERROR'])):?>
		<div class="messErr"><?=$arResult['ERROR']?></div>
	<?endif;?>
	<?if($arResult['COMM_DATE_ERROR']!=""):?>
		<div class="messErr"><?=$arResult['COMM_DATE_ERROR']?></div><br clear="both">
	<?endif;?>
	<?if($arResult['REMONT_ERROR']!=""):?>
		<div class="messErr"><?=$arResult['REMONT_ERROR']?></div>
		<br clear="both">
	<?endif;?>
</div>