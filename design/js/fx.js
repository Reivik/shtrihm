$(function(){  
	//изменение селекта в продуктах при выборе
	$('select[name=section_id]').change(function(){
		var value = $(this).val();
		if($('div.product_select select[name=product_id]').hasClass('main_select'))
		{
			$('div.product_select').empty();
		}
		else
		{
			var id = $('div.product_select select[name=product_id]').attr('id');
			$('div.product_select').children().appendTo('div.'+id);	
		}
		
		$('div.sel'+value).children().appendTo('div.product_select');	
	});
	
	//Изменени инпута на странице /personal/add_introduction/ при выборе файла
	$('body').on('change', 'form[name=add_introduction] .photo_block input[type="file"]', function(){
		var file = $(this).val();
		$(this).parent('div').children('input[type=text]').val(file);
	});
});