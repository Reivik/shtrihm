<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Сотрудники");?>
<div class="clear"></div>
<div id="personal_cabinet" class="list_item_tabs">
	<ul>
		<li class="list_item_tab"><a href="/personal/profile/"><span>Профиль</span></a></li>
		<li class="list_item_tab"><a href="/personal/company/"><span>Данные компании</span></a></li>
		<li class="list_item_tab ui-state-active"><a href="/personal/staff/"><span>Сотрудники</span></a></li>
	</ul>
	<div class="list_last ui-tabs-panel">
		<?$APPLICATION->IncludeComponent("areal:partner_staff", ".default");?>
	</div>	
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>