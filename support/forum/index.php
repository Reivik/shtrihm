<?define("FORUM",true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("NO_LEFT_MENU", "Y");
$APPLICATION->SetTitle("Клиентский форум");?>

<?/*$APPLICATION->IncludeComponent("bitrix:forum", "areal", array(
	"THEME" => "gray",
	"SHOW_TAGS" => "Y",
	"SHOW_AUTH_FORM" => "Y",
	"TMPLT_SHOW_ADDITIONAL_MARKER" => "",
	"USE_LIGHT_VIEW" => "Y",
	"FID" => array(
		0 => "2",
		1 => "1",
	),
	"SEF_MODE" => "Y",
	"SEF_FOLDER" => "/support/forum/",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "3600",
	"CACHE_TIME_USER_STAT" => "60",
	"CACHE_TIME_FOR_FORUM_STAT" => "3600",
	"FORUMS_PER_PAGE" => "10",
	"TOPICS_PER_PAGE" => "10",
	"MESSAGES_PER_PAGE" => "10",
	"IMAGE_SIZE" => "500",
	"ATTACH_MODE" => array(
		0 => "THUMB",
	),
	"ATTACH_SIZE" => "90",
	"SET_TITLE" => "Y",
	"USE_RSS" => "Y",
	"RSS_COUNT" => "30",
	"SHOW_VOTE" => "N",
	"SHOW_RATING" => "Y",
	"RATING_ID" => array(
	),
	"RATING_TYPE" => "like",
	"SHOW_NAVIGATION" => "Y",
	"SHOW_SUBSCRIBE_LINK" => "N",
	"SHOW_LEGEND" => "Y",
	"SHOW_STATISTIC_BLOCK" => array(
		0 => "STATISTIC",
		1 => "BIRTHDAY",
		2 => "USERS_ONLINE",
	),
	"SHOW_NAME_LINK" => "Y",
	"SHOW_FORUMS" => "Y",
	"SHOW_FIRST_POST" => "N",
	"SHOW_AUTHOR_COLUMN" => "N",
	"PATH_TO_SMILE" => "/bitrix/images/forum/smile/",
	"PATH_TO_ICON" => "/bitrix/images/forum/icon/",
	"PAGE_NAVIGATION_TEMPLATE" => "forum",
	"PAGE_NAVIGATION_WINDOW" => "5",
	"AJAX_POST" => "N",
	"WORD_WRAP_CUT" => "23",
	"WORD_LENGTH" => "50",
	"SEO_USER" => "N",
	"USER_PROPERTY" => array(
	),
	"HELP_CONTENT" => "",
	"RULES_CONTENT" => "",
	"CHECK_CORRECT_TEMPLATES" => "Y",
	"RSS_CACHE" => "1800",
	"PATH_TO_AUTH_FORM" => "",
	"TIME_INTERVAL_FOR_USER_STAT" => "10",
	"DATE_FORMAT" => "d.m.Y",
	"DATE_TIME_FORMAT" => "d.m.Y H:i:s",
	"USE_NAME_TEMPLATE" => "N",
	"NAME_TEMPLATE" => "",
	"EDITOR_CODE_DEFAULT" => "N",
	"SEND_MAIL" => "E",
	"SEND_ICQ" => "A",
	"SET_NAVIGATION" => "N",
	"SET_DESCRIPTION" => "Y",
	"SET_PAGE_PROPERTY" => "Y",
	"SHOW_FORUM_ANOTHER_SITE" => "Y",
	"RSS_TYPE_RANGE" => array(
		0 => "RSS1",
		1 => "RSS2",
		2 => "ATOM",
	),
	"RSS_TN_TITLE" => "",
	"RSS_TN_DESCRIPTION" => "",
	"SEF_URL_TEMPLATES" => array(
		"index" => "",
		"list" => "forum#FID#/",
		"read" => "forum#FID#/topic#TID#/",
		"message" => "messages/forum#FID#/topic#TID#/message#MID#/",
		"help" => "help/",
		"rules" => "rules/",
		"message_appr" => "messages/approve/forum#FID#/topic#TID#/",
		"message_move" => "messages/move/forum#FID#/topic#TID#/message#MID#/",
		"pm_list" => "pm/folder#FID#/",
		"pm_edit" => "pm/folder#FID#/message#MID#/user#UID#/#mode#/",
		"pm_read" => "pm/folder#FID#/message#MID#/",
		"pm_search" => "pm/search/",
		"pm_folder" => "pm/folders/",
		"rss" => "rss/#TYPE#/#MODE#/#IID#/",
		"search" => "search/",
		"subscr_list" => "subscribe/",
		"active" => "topic/new/",
		"topic_move" => "topic/move/forum#FID#/topic#TID#/",
		"topic_new" => "topic/add/forum#FID#/",
		"topic_search" => "topic/search/",
		"user_list" => "users/",
		"profile" => "user/#UID#/edit/",
		"profile_view" => "user/#UID#/",
		"user_post" => "user/#UID#/post/#mode#/",
		"message_send" => "user/#UID#/send/#TYPE#/",
	)
	),
	false
);*/?><br />
<!-- div class="main_offer">
	<?/*$APPLICATION->IncludeComponent(
		"areal:special.offers", 
		".default", 
		array( 
			"COUNT_IN_LINE" => 2,
			"SHOW_ALL" => "N"
		)
	);*/?>
</div -->
    <h2>ПАРТНЁРСКИЙ ФОРУМ ШТРИХ-М СТАНОВИТСЯ ОТКРЫТЫМ ДЛЯ ВСЕХ</h2>
<img src="<?=SITE_TEMPLATE_PATH?>/img/forum.png" alt="" width="300" style="float:left;"/>
<br>
<p>Форум на сайте, как площадка для свободного общения, обсуждения тем, обмена мнениями и опытом решения задач давно востребован среди партнёров компании "ШТРИХ-М".</p>
    <p>Однако в свете последних изменений, в частности вступления в силу новых поправок в 54-ФЗ, появления новой кассовой техники, функционала, программного обеспечения и многого другого, форум стал немного "тесноват" для оперативного получения ответов на интересующие вопросы. Чтобы он был более удобным для участников и полностью соответствовал современным запросам, его решили немного доработать и дать "новую прописку".</p>
    <p>Теперь в нём несколько разделов, которые посвящены отдельному классу и бренду контрольно-кассовой техники: ШТРИХ-М, ЯРУС, РР-Электро, Ритейл, Элвес, а также особенностям обслуживания в зависимости от сфер бизнеса и нового порядка применения ККТ.</p>
    <p>Служба технической поддержки, которая является модератором форума, будет не только оперативно реагировать на запросы, но также получит возможность более эффективно выработать пути решения актуальных задач, поскольку будет видеть полную картину возможных затруднений при эксплуатации ККТ.</p>
    <p>Форум переехал на новую площадку - <a href="https://shtrih-m-partners.ru/" target="_blank">www.shtrih-m-partners.ru</a>. Задавать вопросы, обмениваться мнениями на форуме могут все зарегистрированные партнёры компании, решающее слово остаётся за модератором, а вот доступ ко всей информации свободно открыт для всех желающих - <a href="https://forum.shtrih-m-partners.ru" target="_blank">по ссылке</a>.</p>
    <p>Как показывает практика, похожие вопросы возникают и у обычных пользователей ККТ, для них форум станет возможностью получить необходимые знания "из первых рук", не тратя при этом дополнительно время и силы.</p>
 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>