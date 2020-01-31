<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Личный кабинет");?> <?if(!$USER->IsAuthorized()):?> 	<?$APPLICATION->SetPageProperty("NO_LEFT_MENU", "N");?> 	<?$APPLICATION->SetTitle("Авторизация");
	$APPLICATION->IncludeComponent(
		"bitrix:system.auth.form",
		"",
		Array(
			"REGISTER_URL" => "/partners_info/registration/",
			"FORGOT_PASSWORD_URL" => "/login/change_password.php",
			"PROFILE_URL" => "/personal/",
			"SHOW_ERRORS" => "Y"
		),
		false
	);?> <?else:?> 	<?if(in_array(UG_AKP, CUser::GetUserGroup($USER->GetID())) || in_array(UG_PO, CUser::GetUserGroup($USER->GetID())) || in_array(UG_YC, CUser::GetUserGroup($USER->GetID())) || in_array(UG_TP, CUser::GetUserGroup($USER->GetID()))):?> 		<?$APPLICATION->SetPageProperty("SHOW_BANNERS", "Y");?> 		 
<h2>Правила пользования &quot;Кабинетом&quot;.</h2>
 
<p align="justify">Уважаемые дамы и господа! 
  <br />
 </p>
 
<p align="justify">В первую очередь, хотелось бы вам напомнить, что &quot;Кабинет&quot; - это закрытый раздел, предназначенный исключительно для работы сотрудников компании партнера и компании &quot;ШТРИХ-М&quot;. Пожалуйста, не передавайте свои логины и пароли посторонним лицам для ознакомления с закрытыми разделами сайта.</p>
 
<p align="justify">Если вы не будете придерживаться этого правила, то компания &quot;ШТРИХ-М&quot; оставляет за собой право аннулировать все логины и пароли к данному сайту всем сотрудникам компании партнера.</p>
 Если у вас возникают вопросы по работе с закрытыми разделами сайта, то найти ответы на них вы сможете перейдя по пункту меню слева &quot;<a href="/personal/faq/" >Часто задаваемые вопросы</a>&quot;. 
<br />
 
<p> 
  <br />
 </p>
 	<?else:?> 		<?$APPLICATION->SetPageProperty("NO_LEFT_MENU", "N");?> 		<?ShowError("Вы не имеете права доступа в личный кабинет партнера.");?> 	<?endif;?> <?endif;?> <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>