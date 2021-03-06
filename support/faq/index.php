<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("NEWS_LIST_LEFT", "Y");
$APPLICATION->SetPageProperty("SHOW_BANNERS", "Y");
$APPLICATION->SetTitle("Часто задаваемые вопросы");?> 
<?/*$APPLICATION->IncludeComponent("areal:filter_faq", ".default", array("IBLOCK_ID" => IB_FAQ_SUPPORT));
$APPLICATION->IncludeComponent("bitrix:news.list", "faq_partner", array(
	"IBLOCK_TYPE" => "FAQ",
	"IBLOCK_ID" => IB_FAQ_SUPPORT,
	"NEWS_COUNT" => "10",
	"SORT_BY1" => "IBLOCK_SECTION_ID",
	"SORT_ORDER1" => "ASC",
	"SORT_BY2" => "SORT",
	"SORT_ORDER2" => "ASC",
	"FILTER_NAME" => "arrFilter",
	"FIELD_CODE" => array(
		0 => "",
		1 => "",
	),
	"PROPERTY_CODE" => array(
		0 => "",
		1 => "QUESTION",
		2 => "ANSWER",
		3 => "",
	),
	"CHECK_DATES" => "Y",
	"DETAIL_URL" => "",
	"AJAX_MODE" => "N",
	"AJAX_OPTION_JUMP" => "N",
	"AJAX_OPTION_STYLE" => "Y",
	"AJAX_OPTION_HISTORY" => "N",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "36000000",
	"CACHE_FILTER" => "N",
	"CACHE_GROUPS" => "Y",
	"PREVIEW_TRUNCATE_LEN" => "",
	"ACTIVE_DATE_FORMAT" => "d.m.Y",
	"SET_TITLE" => "N",
	"SET_STATUS_404" => "N",
	"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
	"ADD_SECTIONS_CHAIN" => "N",
	"HIDE_LINK_WHEN_NO_DETAIL" => "Y",
	"PARENT_SECTION" => "",
	"PARENT_SECTION_CODE" => "",
	"INCLUDE_SUBSECTIONS" => "Y",
	"DISPLAY_TOP_PAGER" => "N",
	"DISPLAY_BOTTOM_PAGER" => "Y",
	"PAGER_TITLE" => "Новости",
	"PAGER_SHOW_ALWAYS" => "N",
	"PAGER_TEMPLATE" => ".default",
	"PAGER_DESC_NUMBERING" => "N",
	"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
	"PAGER_SHOW_ALL" => "N",
	"AJAX_OPTION_ADDITIONAL" => ""
	),
	false
);*/?>
	<h2>1.Контрольно-кассовая техника.</h2>
	<p><b>Контро́льно-ка́ссовая маши́на (ККМ)</b> — предназначена для механизации кассовых операций, учета денежных поступлений, регистрации приобретения товара и печати кассового чека. В Российской Федерации правила использования кассовых аппаратов определяет закон «О применении контрольно-кассовой техники при осуществлении наличных денежных расчетов и(или) расчетов с использованием платежных карт».
	<ul>
	<li><b>Фискальный регистратор</b> — это ККМ, способная работать только в составе компьютерно-кассовой системы, получая данные через канал связи. Фискальному регистратору необходима кассовая программа, такая, например, как <a href="https://kkm.solutions/produkty/roznichnaya-torgovlya/shtrikh_m_kassir_5_0/" target="_blank">"ШТРИХ-М:Кассир 5"</a> или, если компьютерно-кассовая система имеет ОС «Android» , то <a href="https://pluskassa.ru" target="_blank">"ПЛЮС Кассир"</a>. Однако, можно использовать и драйвер Фискального регистратора, однако, он используется в основном для сервисной настройки ККМ.</li>
	<li><b>ЧПМ</b> (чекопечатающая машина) — это кассовая машина, не имеющая встроенной фискальной памяти и ЭКЛЗ (ФН), может быть как автономной, так и в составе компьютерно-кассовой системы.</li>
	<li><b>АСПД</b> (Автоматизированная система печати документов) — отличается от чекопечатающей машины (ЧПМ) тем, что работает только в составе компьютерно-кассовой системы.</li>
</ul>
	</p>
	<p>
		<b>Оператор фискальных данных</b> (ОФД) — это юридическое лицо, созданное специально для осуществления приёма, обработки, хранения и передачи фискальных данных в Федеральную налоговую службу (ФНС). <a href="https://ofd-ya.ru" target="_blank">ГК "ШТРИХ-М" сотрудничает с "ОФД -Я"</a>
	</p>
<p>
	<b>Фискальный накопитель</b> - шифровальное (криптографическое) средство защиты фискальных данных в опломбированном корпусе, содержащее ключи фискального признака, обеспечивающее возможность формирования фискального признака, обеспечивающее запись фискальных данных в некорректируемом виде (с фискальным признаком), их энергонезависимое долговременное хранение, формирование и проверку фискальных признаков, расшифровывание и аутентификацию фискальных документов, подтверждающих факт получения оператором фискальных данных фискального документа, переданного контрольно-кассовой техникой, направляемых в контрольно-кассовую технику оператором фискальных данных, а также обеспечивающее возможность шифрования фискальных данных в целях обеспечения конфиденциальности информации, передаваемой оператору фискальных данных. Совместим со всеми моделями касс из нового реестра контрольно-кассовой техники по стандартным интерфейсам: I2С или UART. Гарантийный срок эксплуатации ФН в составе ККТ – 12 месяцев со дня ввода ФН в эксплуатацию (активации ФН в составе ККТ)
	<ul>
	<li><b>Реестр фискальных накопителей</b> - совокупность сведений о каждом изготовленном экземпляре фискального накопителя, который пользователи вправе применять в контрольно-кассовой технике. Общество с ограниченной ответственностью «НТЦ «Измеритель» производит ФН и комплектует ими свои ККТ (опционально) <a href="https://www.nalog.ru/html/sites/www.new.nalog.ru/docs/reestr/reeestrfn22052018.doc" target="_blank">Реестр ФН на сайте www.nalog.ru</a></li>
	<li><b>ФН 13/15/36 месяцев</b> - <a href="https://www.shtrih-m.ru/press_center/news/informatsionnye-pisma-dlya-partnerov/vtoroy-volne-dali-zelenyy-svet-po-fiskalnym-nakopitelyam-na-15-mesyatsev/" target="_blank">статья на сайте" ШТРИХ-М"</a></li>
</ul>
</p>
	<p><b>ФФД</b> - формат фискальных документов. Версии ФФД: 1.0, 1.05, 1.1<br>
		Различия в версиях заключается:<br>
		1. в перечнях реквизитов, которые в соответствии с тем или иным форматом должны включаться в состав фискального документа;<br>
		2. в порядке включения соответствующих реквизитов в состав фискального документа.<br>
		Версия ФФД 1.0 поддерживается всеми ККТ нового образца, а также доработанными кассами ГК «ШТРИХ-М».<br>
		Чем выше версия ФФД,тем более сложная  структура фискального документа. Некоторые признаки в ФФД 1.0 в электронном чеке указывается по желанию пользователя онлайн-кассы, а в соответствии с ФФД 1.1 — уже указываются обязательно.<br>
		В соответствии с положениями <a href="https://www.nalog.ru/rn77/about_fts/docs/6719054/" target="_blank">Приказа ФНС России от 21.03.2017 № ММВ-7-20/229</a> ФФД в версии 1.0 не должен будет применяться с 01.01.2019 года. Следовательно, применению будут подлежать более новые форматы. Однако, мы рекомендуем следить за данным нормативом, возможно, ФНС внесет какие-либо поправки или будут выпущены дополнительные разъяснения или инструкции.<br>
		С 01.01.2019 года  предполагается, что ФНС будет принимать данные следующих форматов ФФД: 1.05 и 1.1.<br>
		Для партнеров компании ГК «ШТРИХ-М» мы рекомендуем (до 01.01.2019) произвести настройку в драйвере ККТ, позволяющую перевести передачу данных с формата 1.0, на формат 1.05. При наличии каких-либо изменений в Законодательстве или комментариях со стороны ФНС будут опубликованы новости.</p>
	<p><b>Онлайн-кассы для ЕНВД и патента:</b><br>
		<a href="https://www.shtrih-m.ru/press_center/news/novinki/kassovaya-reforma-v-otvetakh-onlayn-kassy-dlya-envd/?sphrase_id=167311" target="_blank">Разъяснение от эксперта компании РР "Электро", входящей в группу компаний "ШТРИХ-М"</a></p>
	<p><b><a href="https://exam.shtrih-m-partners.ru/assets/materials/Obshchee_rukovodstvo_po_nastroyke_KKT.pdf" target="_blank">Общее руководство по настройке ККТ «ШТРИХ-М»</a></b></p>
	<p><b><a href="https://www.shtrih-m.ru/support/webinars/" target="_blank">Открытие видеоуроки для пользователей ККТ (технических экспертов)</a></b></p>
	<p><b><a href="https://exam.shtrih-m-partners.ru/base/" target="_blank">Открытые инструкции для пользователей ККТ (технических экспертов)</a></b></p>
<br>
	<h2>2.Весы с печатью этикетки «ШТРИХ-ПРИНТ»</h2>
	<p>РАСШИФРОВКА ТЕРМИНОВ</p>
<p>
	Пример, <b>ШТРИХ-ПРИНТ ФI 15-2.5 Д2И1 (v.4.5) (2 Мб!)</b>
</p>
	 <b>ШТРИХ-ПРИНТ</b> - название серии<br>
	<b>ФI</b> - исполнение весов. Бывает несколько видов:<ul>
	<li>ФI - фасовочные с 1 дисплеем</li>
	<li>М - с 2 дисплеями на стойке и клавиатурой на корпусе</li>
	<li>Без буквы - классическое исполнение (2 дисплея и клавиатура расположены на стойке)</li>
	<li>С - самообслуживание</li>
	<li>ПВ - подвесные весы</li>
</ul>
	<b>15</b> - значение НПВ (15 кг)<br>
	<b> 2.5</b> - дискретность весов (2.5 грамма)<br>
	<b> Д2</b> - вид дисплея. Бывает несколько видов:<ul>
	<li>Д1 - вакуумно-флюоресцентный</li>
	<li>Д2 - жидкокристаллический</li>
	<li>Д3 – светодиодный</li>
</ul>
<br>
<p>
	<b>Что означают буквы и цифры в наименованиях весов с печатью серии "ШТРИХ-РС200"?</b></p>
<p>
	<b>ШТРИХ-PC200CE Pole (Wi-Fi, 2 Gb) 15-2,5 C7H-M7B</b></p>
	<b> ШТРИХ-PC200</b> - название серии<br>
	<b>Pole</b> – исполнение весов, коммерческое название. Бывает несколько видов:<ul>
	<li>Bench (скамейка) – оба дисплея располагаются ниже платформы;</li>
	<li>Pole (полюс) – дисплеи расположены на разных полюсах от платформы;</li>
	<li>Elevated (башня) – оба дисплея наверху;</li>
</ul>
	<b>Wi-Fi</b> – кроме USB, RS-232 и Ethernet в стандартной комплектации присутствует Wi-Fi;<br>
	<b>2 Gb</b> – размер встроенной флеш-карты;<br>
	<b>15-2,5</b> – метрологические характеристики НПВ-15кг; до 6 кг – 2г; от 6 до 15кг – 5г;<br>
	<b>C7H</b> – расположение дисплеев по сертификату. Бывает несколько видов:<ul>
	<li>C7H – монитор оператора (сенсорный, 7”, нижнее расположение);</li>
	<li>C7H – монитор оператора (Сенсорный, 7”, Нижнее расположение);</li>
	<li>M7B – монитор покупателя (Монитор, 7”, Верхнее расположение);</li>
</ul>
	<br><br>
	<h3>ПЕРЕЧЕНЬ ИЗМЕНЕНИЙ В ВЕСАХ ШТРИХ-ПРИНТ вер. 4.5 от 16.05.2016</h3>
<p>
	Данный перечень носит информативный характер, полную информацию о возможностях весов можно почерпнуть из поставляемой документации - руководства оператора, руководства администратора, руководства программиста и описания протокола обмена, а также файлов помощи, идущих в комплекте с поставляемым программным обеспечением.<br>
	Перечень изменений:<br>
	1. Добавлена возможность использовать штатное расширение штрих-кода EAN13 - EAN5. EAN5 может содержать либо массу, либо дату окончания срока годности в специальном формате, подробнее см. документацию.<br>
	2. Добавлены новые функции, которые можно привязать к клавишам быстрого доступа:<br>
	- вызов редактора срока годности<br>
	- вызов редактора даты реализации<br>
	- вызов редактора фиксированной массы<br>
	3. Добавлена возможность этикетирования с фиксированной массой, см. п. 2.<br>
	4. Добавлены интерфейсные функции в протокол обмена:<br>
	- запись и чтение параметра "Использовать EAN5"<br>
	- получение серийного номера весов<br>
	- получение номера пустого ПЛУ (*)<br>
	- получение номера ПЛУ по коду товара (*)<br>
	* Примечание. Указанные функции предназначены для случая, когда запись данных о товарах организована без хранения соответствия номера ПЛУ и кода товара и требуется добавить новый товар или изменить существующий, без стирания товарной базы. В этом случае, если объем изменений небольшой, можно использовать указанные функции. Чтобы обновить один товар, или записать один новый товар без стирания всей товарной базы, теперь есть возможность получить номер ПЛУ, в котором записан товар с искомым кодом товара, или найти первую свободную ячейку, в которую можно записать новый товар. При большом объеме добавляемых / изменяемых данных использовать эти функции нецелесообразно, так как они выполняют поиск по таблице товаров весов и выполняются относительно медленно.
</p><br>
<h3>
	ПЕРЕЧЕНЬ ИЗМЕНЕНИЙ В ВЕСАХ ШТРИХ-ПРИНТ вер. 4.5 от 14.05.2015</h3>
	<p>Данный перечень носит информативный характер, полную информацию о возможностях весов можно почерпнуть из поставляемой документации - руководства оператора, руководства администратора, руководства программиста и описания протокола обмена, а также файлов помощи, идущих в комплекте с поставляемым программным обеспечением.<br>
	Перечень изменений:<br>
	1. Увеличено количество пользовательских форматов этикеток, теперь их пять.<br>
	2. Увеличено количество графических изображений, теперь их четыре; добавлена возможность печатать их в любой комбинации, которая указывается в аттрибутах товара.<br>
	3. Добавлено понятие Даты Изготовления. Дата срока годности отсчитывается теперь от Даты Изготовления. По умолчанию Дата Изготовления равна Дате Упаковывания. Добавлена функция для клавиши быстрого доступа, позволяющая вызвать редактор для ввода/сброса Даты Изготовления вручную.<br>
	4. Добавлена возможность хранить в таблице товаров весов Дату Изготовления вместо Группового Кода, регулируется новым параметром Назначение Группового Кода в меню весов. Это дает возможность загружать Дату Изготовления для товаров через интерфейс. При выборе товара такая дата изготовления автоматически вступит в действие и будет отображена на распечатанной этикетке.<br>
	5. Для таблицы товаров весов добавлены новые поля: Формат ШК, Формат этикетки и Тип префикса ШК. Выбрав в этих полях значения, отличные от "По умолчанию", можно для данного товара указать отличный от указанного в меню весов формат этикетки и формат штрих-кода.<br>
	6. Для клавиш быстрого доступа добавлены новые функции:<br>
	- ввод свободного ШК<br>
	- ввод даты изготовления, см. п.3<br>
	- редактор ввода номера ПЛУ для выбора товара (для самообслуживания)<br>
	- редактор ввода кода товара для выбора товара (для самообслуживания)<br>
	- изменение параметра "Печать по выбору ПЛУ"<br>
	7. В меню добавлена возможность перехода в пункты меню по специальному короткому номеру, см. руководство администратора.<br>
	8. Добавлены объекты для печати на этикетке:<br>
	- изображения 3 и 4<br>
	- срок годности в днях<br>
	- дата изготовления<br>
	- масса брутто<br>
	- расчетная масса нетто<br>
	- валютный эквивалент стоимости<br>
	- статические надписи для срока годности, даты изготовления, массы брутто<br>
	- пользовательские строки, 5 шт, 30 символов макс. каждая.<br>
	9. Добавлена настройка шрифтов, для всех текстовых объектов возможно указать любой из встроенных 7 шрифтов, используя Редактор Этикеток и один из пользовательских форматов этикетки весов.<br>
	10. Изменена инициализация весов с возможностью выдачи перечня ошибок при старте.<br>
	11. Изменена работа параметра "Смещение печати"<br>
	12. Добавлено значение "Выборочно" для параметра "Датчик этикетки", позволяющее ожидать снятия напечатанной этикетки только при печати нескольких штучных этикеток, не блокируя печать этикетки в весовом режиме.<br>
	13. Параметр меню "Печать по выбору ПЛУ" теперь доступен для всех конструктивных исполнений, не только для ШТРИХ-ПРИНТ С.<br>
	14. Вследствие пунктов 1..6 и 8..13 проведены соответствующие изменения в протоколе обмена, руководстве программиста, драйвере, и прикладном ПО.<br>
	15. Добавлена блочная загрузка сообщений, убыстряющая процесс загрузки сообщений (аналогично уже существующей блочной загрузке товаров). Реализована в драйвере и прикладном ПО.<br>
	16. Ряд команд управления выведен из под действия обычного пароля, для их использования потребуется специальный пароль. См. Руководство программиста и Описание протокола обмена.<br>
	17. В загрузчике добавлена возможность синхронизации даты и времени.<br>
	18. В пакет поставляемого ПО добавлена утилита копирования параметров весов, облегчающая администратору настройку парка весов в локальной сети.
	</p>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>