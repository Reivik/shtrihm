$('input[name=phone]').mask('+9 (999) 999 99 99');

$("input[name=email]").blur(function(){
		var email = $(this).val(); // Получаем e-mail пользователя
		var pattern = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
		if(pattern.test(email)) {
		$("input[name=email]").val(email);
		} else {
		$("input[name=email]").val('Введите корректный email');
		}
	}); 
