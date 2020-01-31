function submit_forum_filter_form() {
	check_dates();
	$('form[name="forum_form"]').submit();
}
function check_dates()
{
	var from_day=$('#day_from option:selected').val();
	var from_month=$('#month_from option:selected').val();
	var from_year=$('#year_from option:selected').val();
	var to_day=$('#day_to option:selected').val();
	var to_month=$('#month_to option:selected').val();
	var to_year=$('#year_to option:selected').val();
	if(from_day!="0" && from_month!="0" && from_year!="0")
	{
		var from_date=from_day+"."+from_month+"."+from_year;
		$('#from_date').val(from_date);
	}
	if(to_day!="0" && to_month!="0" && to_year!="0")
	{
		var to_date=to_day+"."+to_month+"."+to_year;
		$('#to_date').val(to_date);
	}
}
$(function(){
	$('.closeNotify').click(function(){
		$.post("/ajax.php", {form_type: "CLOSE_CITY_WINDOW"});
		$('.cityNotyfyWindow').hide();
	});
	$('.second_section label, .third_section label').click(function(){
		var $par = $(this).parents('.line').prevAll('.c_off');
		var $par_third = $(this).parents('.third_section').prevAll('.c_off');
		if($par)
			$par.click();
		if($par_third)
			$par_third.click();
	});
	
	$('.main_section > label').click(function(){
		if($(this).hasClass('c_on')){
			$(this).parent().find('.second_section .c_on, .third_section .c_on').each(function(){
				$(this).click();
			});
		}
	});
	$('.accreditation label.label_check').click(function(){
		if($(this).next().is('.productCountInfo')){
			$(this).next().toggle();
		}else{
			var id=$(this).find('input').val();
			var html="<div class='productCountInfo'>"+
				"<label class='field_label'>Количество ККМ данной модели на обслуживании</label><br/>"+
				"<input type='text' name='COUNTERS["+id+"][NOW]' value=''/><br/>"+
				"<label class='field_label'>Планируемый среднемесячный объем закупок</label><br/>"+
				"<input type='text' name='COUNTERS["+id+"][PLAN]' value=''/>"+
			"</div>";
			$(this).after(html);
		}
	});
});