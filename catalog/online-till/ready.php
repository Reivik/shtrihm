<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Заявка на онлайн кассы");
$APPLICATION->AddHeadString('<link rel="stylesheet" href="/design/css/jquery.kladr.min.css" type="text/css" />');
?>
<div class="answer">
	<p>Спасибо! Ваша заявка отправлена.<br />
		Наши сотрудники свяжутся с вами в ближайшее время!<br /><br />
		<a href="/catalog/online-till/">Назад в каталог</a>
	</p>
</div>
<style type="text/css">
	.answer{
		padding: 20px;
    text-align: center;
    font-size: 20px;
    margin-top: 30px;
	}
</style>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>