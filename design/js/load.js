

function isValidEmailAddress(emailAddress) {
    var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
    return pattern.test(emailAddress);
    }

$(document).ready(function(){
//Валидация формы
	    //console.log("sssssssssss");
		$('[href="#fn13"]').click(function () {
	     		var complect_name=$(this).closest(".complect_list_price").prevAll(".complect_block").eq(0).find("h4").eq(0).text();
				var price_sum=$(this).closest(".complect_list_price").find(".comp_full").eq(1).find("span").eq(0).text();
				$('textarea[name="form_textarea_237"]').val(complect_name+' на сумму '+price_sum.toLocaleString());

				//var region_db="";
				//var city_db="";
				$('input[name=form_text_240]').search_place_input({regions : region_db,});
				$('input[name=form_text_239]').search_place_input({cityes : city_db,});

				//var input_product = $('textarea[name="form_textarea_237"]');
				//var input_sum = $(this).closest(".complect_list_price").find(".comp_full").e(1).find("span").eq(1).text();
				//var index;
				//input_product.val();
			    //input_product.css('display','none');
				//input_sum.css('display','none');

			    //input_product.after('<div class="fake_input_product_online_till">'+'<ul>'+'</ul>'+'<i id="add_fake_product">+</i>'+'</div><p class="sum_online_till"></p>');
			    //input_product.after('<div class="fake_list_product_online_till">'+'<ul>'+'</ul>'+'</div>');
			    
				//for (index = 0; index < array_product.length; ++index) {
					//$('.fake_list_product_online_till ul').append('<li>'+array_product[index][0]+'</li>');
				//}

				
	            //console.log(complect_name);
	            //console.log("complect_name");
	            //return false;
	            //$(".form_zakaz_new").find(".form_field_tovar textarea").html(complect_name + " ФН-13")
	    });

	    $('[href="#fn36"]').click(function () {

	    	
	     		var complect_name=$(this).closest(".complect_list_price").prevAll(".complect_block").eq(0).find("h4").eq(0).text();
	     		var price_sum=$(this).closest(".complect_list_price").find(".comp_full").eq(1).find("span").eq(1).text();
				$('textarea[name="form_textarea_236"]').val(complect_name+' на сумму '+price_sum.toLocaleString());

				//var region_db="";
				//var city_db="";
				$('input[name=form_text_244]').search_place_input({regions : region_db,});
				$('input[name=form_text_243]').search_place_input({cityes : city_db,});
	            //console.log(complect_name);
	            //$(".form_zakaz_new").find(".form_field_tovar textarea").html(complect_name + " ФН-36")
	            //console.log("complect_name");
	            //return false;
	    });

	    $('[href="#close"]').click(function () {
	    	//$('#fn36').css('opacity',0);
	    	//$('#fn13').css('opacity',0);

	    	//return false;

	    });
	    $('.till_form_elves').submit(function(){
	    	//console.log("sssssssssss");
		    var done = true;
		    /*if(!$('input[name=form_text_208]').search_place_input('check')){
			    done = false;
		    }*/
		    /*if(!$('input[name=form_text_207]').search_place_input('check')){
			    done = false;
		    }*/

		    if(isValidEmailAddress($('input[name=form_text_207]').val())){
		    	 done = false;
		    	 console.log("false");
		    }else{
		    	console.log("true");
		    }

		    if(done){
			    ///ФОРМА ПРОШЛА УСПЕШНУЮ ПРОВЕРКУ
		    }
			return done;
		});

	    $(".form_field_tovar textarea").attr("readonly",true)
		//настройки формы есть вопросы 
		$('input[name=form_text_208]').mask('+9 (999) 999 99 99');
		$('.phone-mask input').mask('+9 (999) 999 99 99');

		
		//$('input[name=form_text_207]').attr('pattern', '[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$');
		$('input[name=form_text_207]').attr('pattern', '[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,6}$');
		$('input[name=form_text_208]').prop('required', true);
		$('input[name=form_text_207]').prop('required', true);
});

$(window).load(function(){
	resizeFrame();
	$('body #page').css("visibility", "visible");
});

$(window).resize(function(){
	resizeFrame();	
});

function resizeFrame() {
	var window_size = $(window).width();
	if($('.consult').size() > 0)
		var el = $('.consult');
	else if($(".content .aside").size() > 0)
		var el = $(".content .aside").first();
	else if($(".cityNotyfyWindow").size() > 0)
		var el = $(".cityNotyfyWindow").first();
	if(el)
		var content_width = $('body #page').width() + el.width() + 20;
	else
		var content_width = $('body #page').width();
	console.log("content_width = "+content_width);
	if (window_size > 1480) {
		$('body #page').css("margin", "0 auto");
		$('.consult').show();
		$(".content .aside").show();
		$(".cityNotyfyWindow").show();
	}
	else {
		if(window_size >= content_width && window_size <= 1480) {
			$('body #page').css("margin-left", parseInt((window_size - content_width)/2));
			$('.consult').show();
			$(".content .aside").show();
			$(".cityNotyfyWindow").show();
		}
		else {
			$('body #page').css("margin", "0 auto");
			$('.consult').hide();
			$(".content .aside").hide();
			$(".cityNotyfyWindow").hide();
		}
	}
}
