<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("АСЦ");
?>
<?if($USER->IsAuthorized()):?>
	<?if(in_array(UG_AKP, CUser::GetUserGroup($USER->GetID())) || in_array(UG_PO, CUser::GetUserGroup($USER->GetID()))):?>
		<p>Производитель – компания «ШТРИХ-М».</p>
		<p>АСЦ (Авторизованный Сервисный Центр) – организация, обеспечивающая гарантийный и послегарантийный  ремонты Оборудования Производителя. АСЦ должен соответствовать определенным Требованиям (ссылка).</p>
		<p>Сертификация – процедура, проводимая Производителем как для АСЦ, так и для Специалистов в штате АСЦ. Порядок сертификации (ссылка).</p>
		<p>Оборудование – продукция, выпускаемая Производителем, за исключением Контрольно-Кассовой Техники (из раздела «ЦТО»). Актуальный список Оборудования (ссылка).</p>
		<p>Гарантийный ремонт – работы по восстановлению свойств  Оборудования, позволяющих использовать его по назначению в течение срока службы. Выполняется  до истечения или прекращения гарантийного срока службы Оборудования.</p>
		<p>Гарантийный срок – определен в документации Оборудования. Может быть прекращен по вине Потребителя или продлен Производителем или АСЦ при определенных условиях.</p>
		<p>ЗИП – Запасные части, Инструменты и Принадлежности Оборудования. Прайс на ЗИП (ссылка).</p>
		<p>Потребитель – организация, приобретающая, использующая, реализующая Оборудование.</p>
		<p>Договор АСЦ – основной документ, регламентирующий отношения между Производителем и АСЦ. Образец договора (ссылка).</p>
		<p><a href="/personal/authorized_service_center/request/" title="Подать заявку" class="orange_button">Подать заявку</a></p>
	<?endif;?>
<?endif;?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>