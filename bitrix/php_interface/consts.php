<?
define("LOG_FILENAME", $_SERVER["DOCUMENT_ROOT"]."/log.txt");
// consts
// iblock
define("IB_PRODUCTS", 4);				// Продукты (каталог)
define("IB_SOLUTIONS", 5);				// Решения
define("IB_NEWS", 7);					// Новости
define("IB_INTRO", 8);					// Внедрения
define("IB_COMPANY", 9);				// Компании
define("IB_STATUS_COMPANY", 11);		// Статусы
define("IB_MANAGERS", 12);				// Менеджеры
define("IB_CLIENTS", 13);				// Клиенты
define("IB_COUNTRIES", 54);				// Страны
define("IB_REGIONS", 14);				// Регионы
define("IB_CITIES", 15);				// Города
define("IB_SITES", 16);					// Сайты
define("IB_BANNERS", 17);				// Баннеры
define("IB_SPECIALS", 18);				// Спецпредложения
define("IB_FAQ_SUPPORT", 19);			// Вопросы поддержка
define("IB_FAQ_PARTNERS", 20);			// Вопросы партнерам
define("IB_DOWNLOAD_FILES", 21);		// Файлы для скачивания
define("IB_FILIALS", 36);				// Филиалы компаний
define("REVIEWS", 27);					// Отзывы
define("IB_PEOPLES", 35);				// Сотрудники
define("IB_EVENTS", 38);				// Мероприятия
define("IB_CONGRATULATIONS", 37);		// Поздравления
define("IB_CALENDAR_EVENT", 39);		// События в календаре
define("IB_PARTNER_LEVEL", 10);			// Уровни партнерства
define("IB_TOP_SALERS", 40);			// Лидеры продаж
define("IB_ACHIEVEMENTS", 41);			// Достижения
define("IB_SERTIFIED_SPECIALIES", 34);	// Сертифицированные специалисты
define("IB_ADVERTISIN", 42);			// Рекламная продукция
define("IB_PRINTING_PRODUCTS", 43);		// Полиграфическая продукция
define("IB_ASC", 44);					// Заявки на сертификацию АЦС
define("IB_LEARNING_APPLICATION", 46); 	// Заявки на сертификацию АЦС
define("IB_DOCS", 45);					// Документы
define("IB_APP_ACCREDITATION", 47);		// Заявки на аккредитацию СЦ
define("IB_APP_PROLONGATION", 48);		// Анкеты на пролонгацию
define("IB_CONTACTS", 26);				// Контакты
define("IB_VACANCY", 33);		        // Вакансии
define("IB_REQUEST_VACANCY", 51);		// Заявки на вакансии
define("IB_SECTION_PAGES", 52);		// Заявки на вакансии

//Группы пользователей
define("UG_ADMIN", 1);				// Админ
define("UG_ALL", 2);					// Все пользователи
define("UG_PP", 7);					// Простой партнер
define("UG_PO", 8); 					// Партнерский отдел
define("UG_YC", 9);					// Учебный центр
define("UG_TP", 10);					// Тех поддержка
define("UG_AKP", 11);				// Администратор компании партнера
define("UG_VEBINAR_CREATOR", 14);	// Организатор вебинаров
define("UG_ONLINE_CONSULT", 12);		// Онлайн консультант
define("UG_FORUM", 18);				// Организатор форума

//Обучение
define("IB_PROGRAMMS", 31); 		//Программы
define("IB_WEBINAR", 30);			//Архив вебинаров
define("IB_LEARNING_CENTER", 29);	//Учебные центры	
define("IB_TIMETABLE", 28);			//График обучения


// Resize Image
// News
define("RSZ_NEWS_PREW_WIDTH",59);
define("RSZ_NEWS_PREW_HEIGHT",59);
define("RSZ_NEWS_DETAIL_WIDTH",690);
define("RSZ_NEWS_DETAIL_HEIGHT",690);
// Introduction
define("RSZ_INTR_PREW_WIDTH",100);
define("RSZ_INTR_PREW_HEIGHT",100);
define("RSZ_INTR_DETAIL_WIDTH",690);
define("RSZ_INTR_DETAIL_HEIGHT",690);

// Lists consts
define("L_LOCATION_SINGLY",13);				// Отдельно стоящее здание
define("L_LOCATION_FIRST",14);				// На первом этаже жилого дома
define("L_LOCATION_OUTBUILDING",15);		// Пристройка к дому

define("MOSCOW_REGION", "Москва");
define("MOSCOW", "Москва");
define("RF", "RU");
define("RUSF", "Российская Федерация");

define("BBB_IP", "video.shtrih-m.ru");
//define("BBB_IP", "10.20.2.5");
define("BBB_SALT", "big54blue00button01");

define("FX_SHOW_FORUM", 1); //отображение блока с темами форума на главной странице

?>
