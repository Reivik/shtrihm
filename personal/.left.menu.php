<?
//$aMenuLinks = array();
if($USER->IsAuthorized()) {
	if(in_array(UG_AKP, CUser::GetUserGroup($USER->GetID())) || in_array(UG_PO, CUser::GetUserGroup($USER->GetID())) || in_array(UG_PP, CUser::GetUserGroup($USER->GetID())) || in_array(UG_YC, CUser::GetUserGroup($USER->GetID()))) {
		$aMenuLinks[] = Array(
			"Профиль", 
			"profile/", 
			Array(), 
			Array(), 
			"" 
		);
	}
	if(in_array(UG_AKP, CUser::GetUserGroup($USER->GetID())) || in_array(UG_PO, CUser::GetUserGroup($USER->GetID())) || in_array(UG_PP, CUser::GetUserGroup($USER->GetID())) || in_array(UG_YC, CUser::GetUserGroup($USER->GetID()))) {
		$aMenuLinks[] = Array(
			"Данные компании", 
			"company/", 
			Array(), 
			Array(), 
			"" 
		);
	}
	if(in_array(UG_AKP, CUser::GetUserGroup($USER->GetID())) || in_array(UG_PO, CUser::GetUserGroup($USER->GetID())) || in_array(UG_PP, CUser::GetUserGroup($USER->GetID())) || in_array(UG_YC, CUser::GetUserGroup($USER->GetID()))) {
		$aMenuLinks[] = Array(
			"Сотрудники", 
			"staff/", 
			Array(), 
			Array(), 
			"" 
		);
	}
	if(in_array(UG_AKP, CUser::GetUserGroup($USER->GetID())) || 
		in_array(UG_PP, CUser::GetUserGroup($USER->GetID())) || 
			in_array(UG_PO, CUser::GetUserGroup($USER->GetID())) ||
				in_array(UG_YC, CUser::GetUserGroup($USER->GetID())) || 
					in_array(UG_TP, CUser::GetUserGroup($USER->GetID()))
	) {
		$aMenuLinks[] = Array(
			"Опубликовать внедрение", 
			"add_introduction/", 
			Array(), 
			Array(), 
			"" 
		);
	}
	if(in_array(UG_AKP, CUser::GetUserGroup($USER->GetID())) || in_array(UG_PO, CUser::GetUserGroup($USER->GetID()))) {
		$arMenuLinks = Array(
			Array(
				"АСЦ", 
				"authorized_service_center/", 
				Array(), 
				Array(), 
				"" 
			),
			Array(
				"Бланки договоров", 
				"agreement/", 
				Array(), 
				Array(), 
				"" 
			),
			Array(
				"FAQ", 
				"faq/", 
				Array(), 
				Array(), 
				"" 
			),
			Array(
				"Требования к рекламным материалам", 
				"advertising_requirement/", 
				Array(), 
				Array(), 
				"" 
			),
		);
		$aMenuLinks = array_merge($aMenuLinks, $arMenuLinks);
	}
}

?>