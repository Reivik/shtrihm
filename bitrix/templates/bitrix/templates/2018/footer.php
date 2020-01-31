		<footer>
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
					<?$APPLICATION->IncludeComponent(
						"bitrix:search.form",
						"shtrih-m",
						Array(
							"USE_SUGGEST" => "N",
							"PAGE" => "/search/"
						),
					false
					);?>
				</div>
				<div class="footerRight">
					<div class="phone">+7 (495) 787-60-90</div>
					<p><a class="e-mail" title="info" href="#shtrih-m.ru" ></a></p>
					<!-- Rating@Mail.ru logo -->
					<a href="http://top.mail.ru/jump?from=749068" class="mail_counter">
					<img src="//top-fwz1.mail.ru/counter?id=749068;t=374;l=1" 
					style="border:0;" height="18" width="88" alt="Рейтинг@Mail.ru" /></a>
					<!-- //Rating@Mail.ru logo -->
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
            w.yaCounter25873994 = new Ya.Metrika({id:25873994,
                    webvisor:true,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true});
        } catch(e) { }
    });

    var n = d.getElementsByTagName("script")[0],
        s = d.createElement("script"),
        f = function () { n.parentNode.insertBefore(s, n); };
    s.type = "text/javascript";
    s.async = true;
    s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

    if (w.opera == "[object Opera]") {
        d.addEventListener("DOMContentLoaded", f, false);
    } else { f(); }
})(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="//mc.yandex.ru/watch/25873994" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
</body>
</html>