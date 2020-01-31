<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
IncludeTemplateLangFile(__FILE__);
?>
					<div class="clear"></div>
<?$APPLICATION->IncludeComponent("areal:clients.main", "client", Array(
	"IBLOCK_ID" => IB_CLIENTS,
	"PAGE" => "/press_center/clients/"
	),
	false
);?>
				</div>	<?/*pageCont*/?>
				<?$path = explode("/",$_SERVER["REQUEST_URI"]);?>
				<?if(($APPLICATION->GetProperty('NO_LEFT_MENU') != "N" || $APPLICATION->GetProperty('NEWS_LIST_LEFT') == "Y" || $APPLICATION->GetProperty('SHOW_CLIENTS') == "Y" || $APPLICATION->GetProperty('NEWS_LIST_LEFT') == "Y" || $APPLICATION->GetProperty('SHOW_CALENDAR_EVENT') == "Y" || $APPLICATION->GetProperty('SUBSCRIBE_FORM') == "Y" || $APPLICATION->GetProperty('VEBINARS_LIST_LEFT') == "Y") && $path[1] != "login"):?>
						<div class="clear"></div>
					</div>
				<?endif;?>
				<?if($path[1] == "catalog" && $APPLICATION->GetProperty('NO_LEFT_MENU') == "N" && strpos($path[2], "ompare.php") != 1):?>
					</div>
				<?endif;?>				


			<div class="clear"></div>
		</section>

		<footer>

			<div class="headTop" style="margin:0;border-bottom:1px solid #9d9d9d;">
					<?$APPLICATION->IncludeComponent("bitrix:news.list","main_head_slider",Array(
						"DISPLAY_DATE" => "N",
						"DISPLAY_NAME" => "Y",
						"DISPLAY_PICTURE" => "Y",
						"DISPLAY_PREVIEW_TEXT" => "N",
						"AJAX_MODE" => "N",
						"IBLOCK_TYPE" => "about",
						"IBLOCK_ID" => IB_SITES,
						"NEWS_COUNT" => "",
						"SORT_BY1" => "SORT",
						"SORT_ORDER1" => "ASC",
						"SORT_BY2" => "SORT",
						"SORT_ORDER2" => "ASC",
						"FILTER_NAME" => "arrFilter",
						"FIELD_CODE" => Array(),
						"PROPERTY_CODE" => Array("LINK"),
						"CHECK_DATES" => "N",
						"DETAIL_URL" => "",
						"PREVIEW_TRUNCATE_LEN" => "",
						"ACTIVE_DATE_FORMAT" => "d.m.Y",
						"SET_TITLE" => "N",
						"SET_STATUS_404" => "Y",
						"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
						"ADD_SECTIONS_CHAIN" => "N",
						"HIDE_LINK_WHEN_NO_DETAIL" => "Y",
						"PARENT_SECTION" => "",
						"PARENT_SECTION_CODE" => "",
						"CACHE_TYPE" => "A",
						"CACHE_TIME" => "3600",
						"CACHE_FILTER" => "Y",
						"CACHE_GROUPS" => "Y",
						"DISPLAY_TOP_PAGER" => "N",
						"DISPLAY_BOTTOM_PAGER" => "N",
						"PAGER_TITLE" => "",
						"PAGER_SHOW_ALWAYS" => "N",
						"PAGER_TEMPLATE" => "",
						"PAGER_DESC_NUMBERING" => "N",
						"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
						"PAGER_SHOW_ALL" => "N",
						"AJAX_OPTION_JUMP" => "N",
						"AJAX_OPTION_STYLE" => "Y",
						"AJAX_OPTION_HISTORY" => "N",
						"AJAX_OPTION_ADDITIONAL" => ""
					));?>
					<div class="lang"><a href="" class="eng"><img src="/images/eng.png" alt=""/>Eng</a></div>
				</div>				

			<div class="footerTop">
				<div class="footerLeft">
					<div class="copy"><?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/copyright.php"), false);?></div>
					<?
					$APPLICATION->IncludeComponent("bitrix:menu","bottom", array(
						"ROOT_MENU_TYPE" => "top",
						"MAX_LEVEL" => "1",
						),
						false
					);
					?>
					<div class="socials">
						<span>Поделиться:</span>
						<div class="share42init"></div>
					</div>
				</div>
				<div class="footerCenter">
					<?
					$APPLICATION->IncludeComponent("bitrix:menu","bottom",array(
						"ROOT_MENU_TYPE" => "bottom",
						"MAX_LEVEL" => "1",
						),
						false
					);
					?>
				</div>
				<div class="footerRight">
					<div class="phone">+7 (495) 787-60-90</div>
					<p><a class="e-mail" title="info" href="#shtrih-m.ru" ></a></p>
					<!-- Rating@Mail.ru logo -->
					<!-- a href="http://top.mail.ru/jump?from=749068" class="mail_counter">
					<img src="//top-fwz1.mail.ru/counter?id=749068;t=374;l=1" 
					style="border:0;" height="18" width="88" alt="Рейтинг@Mail.ru" /></a -->
					<!-- //Rating@Mail.ru logo -->
					<!-- Yandex.Metrika informer -->
<a href="https://metrika.yandex.ru/stat/?id=25873994&amp;from=informer"
target="_blank" rel="nofollow"><img src="https://informer.yandex.ru/informer/25873994/1_0_202020FF_000000FF_1_visits"
style="width:80px; height:15px; border:0;" alt="Яндекс.Метрика" title="Яндекс.Метрика: данные за сегодня (визиты)" /></a>
<!-- /Yandex.Metrika informer -->
					<?/*<a class="author" href="http://www.arealidea.ru" target="_blank" title="Arealidea" <?if($_SERVER["REQUEST_URI"] != "/" && $_SERVER["SCRIPT_NAME"] != "/index.php"):?> rel="nofollow" <?endif;?>><img src="/design/images/arealidea.png" width="115" height="9" alt=""></a>*/?>
				</div>
				<div class="clear"></div>
			</div>
			<div class="rights">
				<?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/footer_right.php"), false);?>
			</div>
		</footer>
	</div>
	<a class='scrollTop' href='#header' style='display:none;'></a>

<!-- Yandex.Metrika counter -->
<script type="text/javascript">
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter25873994 = new Ya.Metrika({
                    id:25873994,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true,
                    webvisor:true
                });
            } catch(e) { }
        });

        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = "https://mc.yandex.ru/metrika/watch.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/25873994" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
</body>
</html>