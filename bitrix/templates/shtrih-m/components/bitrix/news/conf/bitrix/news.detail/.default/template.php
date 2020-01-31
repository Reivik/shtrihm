<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<p><b>Регистрация:</b></p>
<div class="form_reg">
	<form class="conf_reg_form" action="/catalog/conference/send.php" method="POST">
		<div class="form_line">
			<label for="company">Наименование организации:</label>
			<input type="text" name="company" id="company" required/>
		</div>
		<div class="form_line form_cnt">
			<label for="email">Контактная информация:</label>
			<input type="text" name="name" id="name" placeholder="ФИО" required/>
			<input type="text" name="email" id="email" placeholder="Ваш email" required/>
			<input type="text" name="phone" id="phone" placeholder="Ваш телефон" required/>
			<input type="text" name="city" id="city" placeholder="Ваш город" required/>
			<input type="hidden" name="conf" id="conf" value="<?=$arResult["NAME"]?>">
		</div>
		<input type="hidden" name="no_bot">
		<button class="form_reg_butt" type="submit">Отправить</button>
	</form>
</div>
<script>
$('input[name=phone]').mask('+9 (999) 999 99 99');

$("input[name=email]").blur(function(){
		var email = $(this).val(); // Получаем e-mail пользователя
		var pattern = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
		if(pattern.test(email)) {
		$("input[name=email]").val(email);
		} else {
		$("input[name=email]").val('');
		$("input[name=email]").attr('placeholder', 'Введите корректный email');
		}
	}); 
</script>