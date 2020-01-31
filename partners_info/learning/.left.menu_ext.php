<?
$aMenuLinks = Array(
	Array(
		"Контакты учебного центра",
		"/partners_info/learning/contacts/",
		Array(),
		Array(),
		""
	),
	Array(
		"Обучение по темам",
		"/partners_info/learning/theme/",
		Array(),
		Array(),
		""
	),
	Array(
		"График обучений",
		"/partners_info/learning/timetable/",
		Array(),
		Array(),
		""
	),
	Array(
		"Подать заявку на обучение",
		"/partners_info/learning/request/",
		Array(),
		Array(),
		""
	),
);
	if($USER->IsAuthorized()) {
		$arGroups = CUser::GetUserGroup($USER->GetID());
		if(in_array(UG_PO, $arGroups) || in_array(UG_YC, $arGroups) || in_array(UG_AKP, $arGroups)) {
			$dop_array = array(
				Array(
					"Онлайн экзамен",
					"/partners_info/learning/examination/",
					Array(),
					Array(),
					""
				),
				Array(
					"Мои результаты",
					"/partners_info/learning/examination/my_results/",
					Array(),
					Array(),
					""
				),
				Array(
					"Аттестованные специалисты",
					"/partners_info/learning/specialistes/",
					Array(),
					Array(),
					""
				)
			);
			$aMenuLinks = array_merge($aMenuLinks, $dop_array);
		}
	}
	/*if(in_array(UG_PO, $arGroups) || in_array(UG_YC, $arGroups) || in_array(UG_PP, $arGroups) || in_array(UG_TP, $arGroups) || in_array(UG_AKP, $arGroups) || in_array(UG_VEBINAR_CREATOR, $arGroups)) {*/
	$dop_array_2 = array(
		Array(
			"Вебинары",
			"/partners_info/learning/webinars/",
			Array(),
			Array(),
			"false"
		),
		Array(
			"Архив вебинаров",
			"/partners_info/learning/webinars_archive/",
			Array(),
			Array(),
			"false"
		),
		Array(
			"Новости учебного центра",
			"/partners_info/learning/news/",
			Array(),
			Array(),
			""
		)
	);
	$aMenuLinks = array_merge($aMenuLinks, $dop_array_2);
?>