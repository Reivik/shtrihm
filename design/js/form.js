var products_online_till_array = [];
var array_product=[];
function product_online_till_refresh(){
	var input_product = $('textarea[name="form_textarea_174"]');
	if(input_product.length>0){

		
		var input_value = '';
		var product_count = 0;
		var price_sum = 0;
		for (index = 0; index < products_online_till_array.length; ++index) {
			var delimiter = '\n';
			if(index==0){
				delimiter = '';
			}
			
			product_count = (product_count + (products_online_till_array[index][1]*1));
			
			price_sum = price_sum+((products_online_till_array[index][2]*1)*products_online_till_array[index][1]);
			
			input_value = input_value+delimiter+products_online_till_array[index][0]+':  '+products_online_till_array[index][1]+' * '+products_online_till_array[index][2]+' = '+ ((products_online_till_array[index][2]*1)*products_online_till_array[index][1]) + ' руб.';
		}
		input_product.val(input_value);

		if($('input[name="form_text_173"]').length>0){
			$('input[name="form_text_173"]').val(price_sum);
			$('.sum_online_till').text('ИТОГО: товаров '+product_count+' на сумму '+price_sum.toLocaleString()+' руб.');
		}

	}

	var input_product2 = $('textarea[name="form_textarea_220"]');
	if(input_product2.length>0){

		
		var input_value = '';
		var product_count = 0;
		var price_sum = 0;
		for (index = 0; index < products_online_till_array.length; ++index) {
			var delimiter = '\n';
			if(index==0){
				delimiter = '';
			}
			
			product_count = (product_count + (products_online_till_array[index][1]*1));
			
			price_sum = price_sum+((products_online_till_array[index][2]*1)*products_online_till_array[index][1]);
			
			input_value = input_value+delimiter+products_online_till_array[index][0]+'';
		}
		input_product2.val(input_value);

		if($('input[name="form_text_219"]').length>0){
			$('input[name="form_text_219"]').val(price_sum);
			$('.sum_online_till').text('');
		}

	}

	
}

function product_online_till_refresh_ros(){
	var input_product = $('textarea[name="form_textarea_174"]');
	if(input_product.length>0){

		
		var input_value = '';
		var product_count = 0;
		var price_sum = 0;
		for (index = 0; index < products_online_till_array.length; ++index) {

			//if(products_online_till_array[index]=="Онлайн касса Ростелеком"){


					var delimiter = '\n';
					if(index==0){
						delimiter = '';
					}
					
					product_count = (product_count + (products_online_till_array[index][1]*1));
					
					price_sum = price_sum+((products_online_till_array[index][2]*1)*products_online_till_array[index][1]);
					
					input_value = input_value+delimiter+products_online_till_array[index][0]+':  '+products_online_till_array[index][1]+' * '+products_online_till_array[index][2]+' = '+ ((products_online_till_array[index][2]*1)*products_online_till_array[index][1]) + ' руб.';
				}
				input_product.val(input_value);

				if($('input[name="form_text_173"]').length>0){
					$('input[name="form_text_173"]').val(price_sum);
					$('.sum_online_till').text('ИТОГО: товаров '+product_count+' на сумму '+price_sum.toLocaleString()+' руб.');
					//$('.sum_online_till').text('');
				}
			//}

	}

	
	
}

function product_online_till_refresh_ros_22(){
	var input_product = $('textarea[name="form_textarea_220"]');
	if(input_product.length>0){

		
		var input_value = '';
		var product_count = 0;
		var price_sum = 0;
		for (index = 0; index < products_online_till_array.length; ++index) {

			//if(products_online_till_array[index]=="Онлайн касса Ростелеком"){


					var delimiter = '\n';
					if(index==0){
						delimiter = '';
					}
					
					product_count = (product_count + (products_online_till_array[index][1]*1));
					
					price_sum = price_sum+((products_online_till_array[index][2]*1)*products_online_till_array[index][1]);
					
					input_value = input_value+delimiter+products_online_till_array[index][0]+':  '+products_online_till_array[index][1]+' * '+products_online_till_array[index][2]+' = '+ ((products_online_till_array[index][2]*1)*products_online_till_array[index][1]) + ' руб.';
				}
				input_product.val(input_value);

				if($('input[name="form_textarea_220"]').length>0){
					$('input[name="form_textarea_220"]').val(price_sum);
					$('.sum_online_till').text('ИТОГО: товаров '+product_count+' на сумму '+price_sum.toLocaleString()+' руб.');
					//$('.sum_online_till').text('');
				}
			//}

	}

	
	
}

function product_online_till_add_ros(name){
	var price;
	var index;
	var new_product = true;
	for (index = 0; index < array_product.length; ++index) {
		if(array_product[index].indexOf(name) != -1){
			price = array_product[index][1];
		}
	}
	//products_online_till_array=""
	//console.log(products_online_till_array);
	for (index = 0; index < products_online_till_array.length; ++index) {	
		if(products_online_till_array[index]=="Онлайн касса Ростелеком"){
			if(products_online_till_array[index].indexOf(name) != -1){
				new_product = false;
				products_online_till_array[index][1] = (products_online_till_array[index][1]*1)+1;
				$('.fake_input_product_online_till ul li:eq('+index+') input').val(products_online_till_array[index][1]);
				break;
			}else{
				new_product = true;
			}
		}
	}
	if(new_product){
		price = (price*1);
		products_online_till_array.push([name,1,price]);
		$('.fake_input_product_online_till ul').html(
		'<li>'+
			'<p>'+name+'</p>'+
			'<input type="number" name="name_input" value="1" min="1"/>'+
			'<span>'+price.toLocaleString()+'</span>'+
			'<span>'+price.toLocaleString()+'</span>'+
			'<i>-</i>'+
		'</li>');
	}	
	product_online_till_refresh_ros();

}

function product_online_till_add_ros2(name){
	var price;
	var index;
	var new_product = true;
	for (index = 0; index < array_product.length; ++index) {
		if(array_product[index].indexOf(name) != -1){
			price = array_product[index][1];
		}
	}
	//products_online_till_array=""
	//console.log(products_online_till_array);
	for (index = 0; index < products_online_till_array.length; ++index) {	
		//if(products_online_till_array[index]=="Онлайн касса Ростелеком"){
			if(products_online_till_array[index].indexOf(name) != -1){
				new_product = false;
				products_online_till_array[index][1] = (products_online_till_array[index][1]*1)+1;
				$('.fake_input_product_online_till ul li:eq('+index+') input').val(products_online_till_array[index][1]);
				break;
			}else{
				new_product = true;
			}
		//}
	}
	if(new_product){
		price = (price*1);
		products_online_till_array.push([name,1,price]);
		$('.fake_input_product_online_till ul').html(
		'<li>'+
			'<p>'+name+'</p>'+
			'<input type="number" name="name_input" value="1" min="1"/>'+
			//'<span>'+price.toLocaleString()+'</span>'+
			//'<span>'+price.toLocaleString()+'</span>'+
			'<i>-</i>'+
		'</li>');
	}	
	product_online_till_refresh_ros();

}

function product_online_till_add_ros22(name){
	var price;
	var index;
	var new_product = true;
	for (index = 0; index < array_product.length; ++index) {
		if(array_product[index].indexOf(name) != -1){
			price = array_product[index][1];
		}
	}
	//products_online_till_array=""
	//console.log(products_online_till_array);
	for (index = 0; index < products_online_till_array.length; ++index) {	
		//if(products_online_till_array[index]=="Онлайн касса Ростелеком"){
			if(products_online_till_array[index].indexOf(name) != -1){
				new_product = false;
				products_online_till_array[index][1] = (products_online_till_array[index][1]*1)+1;
				$('.fake_input_product_online_till ul li:eq('+index+') input').val(products_online_till_array[index][1]);
				break;
			}else{
				new_product = true;
			}
		//}
	}
	if(new_product){
		price = (price*1);
		products_online_till_array.push([name,1,price]);
		$('.fake_input_product_online_till ul').html(
		'<li>'+
			'<p>'+name+'</p>'+
			'<input type="number" name="name_input" value="1" min="1"/>'+
			//'<span>'+price.toLocaleString()+'</span>'+
			//'<span>'+price.toLocaleString()+'</span>'+
			'<i>-</i>'+
		'</li>');
	}	
	product_online_till_refresh_ros_22();

}

function product_online_till_add(name){
	var price;
	var index;
	var new_product = true;
	for (index = 0; index < array_product.length; ++index) {
		if(array_product[index].indexOf(name) != -1){
			price = array_product[index][1];
		}
	}
	for (index = 0; index < products_online_till_array.length; ++index) {	
		if(products_online_till_array[index].indexOf(name) != -1){
			new_product = false;
			products_online_till_array[index][1] = (products_online_till_array[index][1]*1)+1;
			$('.fake_input_product_online_till ul li:eq('+index+') input').val(products_online_till_array[index][1]);
			break;
		}else{
			new_product = true;
		}
	}
	if(new_product){
		price = (price*1);
		products_online_till_array.push([name,1,price]);
		$('.fake_input_product_online_till ul').append(
		'<li>'+
			'<p>'+name+'</p>'+
			'<input type="number" name="name_input" value="1" min="1"/>'+
			'<span>'+price.toLocaleString()+'</span>'+
			'<span>'+price.toLocaleString()+'</span>'+
			'<i>-</i>'+
		'</li>');
	}	
	product_online_till_refresh();

}



function product_online_till_add2(name){
	var price;
	var index;
	var new_product = true;
	for (index = 0; index < array_product.length; ++index) {
		if(array_product[index].indexOf(name) != -1){
			price = array_product[index][1];
		}
	}
	for (index = 0; index < products_online_till_array.length; ++index) {	
		if(products_online_till_array[index].indexOf(name) != -1){
			new_product = false;
			products_online_till_array[index][1] = (products_online_till_array[index][1]*1)+1;
			$('.fake_input_product_online_till ul li:eq('+index+') input').val(products_online_till_array[index][1]);
			break;
		}else{
			new_product = true;
		}
	}
	if(new_product){
		price = (price*1);
		products_online_till_array.push([name,1,price]);
		$('.fake_input_product_online_till ul').append(
		'<li>'+
			'<p>'+name+'</p>'+
			'<input type="number" name="name_input" value="1" min="1"/>'+
			//'<span>'+price.toLocaleString()+'</span>'+
			//'<span>'+price.toLocaleString()+'</span>'+
			'<i>-</i>'+
		'</li>');
	}	
	product_online_till_refresh();

}

/*
 * Search place input JQuery plugin
 * Author: MooW studio
 * Site: moowstudio.ru
*/
(function($){
	var current_region = '';
	var current_region_id = '';
	var current_city = '';
	var regions;
	var cityes;
	
	var methods = {
		init : function(options) {
			return this.each(function(){
				$(this).css('display','none');
				if($(this).nextAll(".fake_select_search_place_input").eq(0).length==0){
					$(this).after('<div class="fake_select_search_place_input"><input type="text" class="search_place_input_current_text" autocomplete="off"></p><i class="search_place_input_show_button fa fa-chevron-down"></i></div><div class="search_place_input_list"><ul></ul></div>');
				}

				//var tt_item=$(this);
				//console.log(tt_item.name)	
				//console.log($('.search_place_input_list ul.regions li').length);
				if(options.regions !== undefined && options.regions !== '' && $(this).next(".fake_select_search_place_input").next(".search_place_input_list").children("li").length==0){ // && $('.search_place_input_list ul.regions li').length==0
					//$('.search_place_input_list ul.regions').html("");
					//$(this).next(".fake_select_search_place_input").next(".search_place_input_list").children("ul").html("");

					$(this).next(".fake_select_search_place_input").next(".search_place_input_list").children("ul").addClass('regions');
					$(this).addClass('search_place_input region');
					regions = options.regions;
					if(options.current_region !== undefined && options.current_region !== ''){
						current_region = options.current_region;
					}
					//console.log($(this).next(".fake_select_search_place_input").next(".search_place_input_list").children("ul.regions"));
					//
					$.each(regions, function(){
				        $(this).nextAll(".search_place_input_list").find(".regions").append('<li data-name="'+this.name.toLowerCase()+'" data-id="'+this.id+'" data-country="'+this.country+'">111'+this.name+'</li>');
				    });
				}
				
				if(options.cityes !== undefined && options.cityes !== '' && $(this).next('.search_place_input_list ul.cityes').length==0){ // && $('.search_place_input_list ul.cityes').length==0
					//$('.search_place_input_list ul.cityes').html("");
				$(this).next('.search_place_input_list ul.cityes').html("");

					$(this).next(".fake_select_search_place_input").next(".search_place_input_list").children("ul").addClass('cityes');
					$(this).addClass('search_place_input city');
					cityes = options.cityes;
					if(options.current_city !== undefined && options.current_city !== ''){
						current_city = options.current_city;
					}
					//
					$.each(cityes, function(){
				        $('.search_place_input_list ul.cityes').append('<li data-name="'+this.name.toLowerCase()+'" data-id="'+this.id+'" data-region="'+this.region+'">'+this.name+'</li>');
				    });
				}  
				
				//Открыть список
				$(this).next(".fake_select_search_place_input").on('click',function(){
					$(this).children('input').focus();
					$('.search_place_input_list').css('display','none');
					var this_object = $(this).next('.search_place_input_list');
					if(this_object.css('display')=='block'){
						this_object.css('display','none');							
					}else{
						this_object.css('display','block');
					}
				});
				
				//Выбор из списка
				$(document).on('click','.search_place_input_list ul li',function(){
					console.log("ffff")
					$(this).parents('.search_place_input_list').prev().prev().search_place_input('change',{
						name: $(this).text(),
					});
					$(this).parent().parent(".search_place_input_list").css('display','none').prev().prev().css('border-color','').next().next().next('.search_place_input_error').remove();
				});
				
				//Поиск
				$(this).next(".fake_select_search_place_input").children('input').on('keyup',function(){
					var search = 'li[data-name *= "'+$(this).val().toLowerCase()+'"]';
					$(this).parents('.fake_select_search_place_input').next('.search_place_input_list').css('display','block');
					$(this).parents('.fake_select_search_place_input').next('.search_place_input_list').children('ul').children('li').css('display','none');
					if($(this).parents('.fake_select_search_place_input').prev().hasClass('city')){
						var search = 'li[data-name *= "'+$(this).val().toLowerCase()+'"][data-region = "'+current_region_id+'"]';
					}
					$(this).parents('.fake_select_search_place_input').next('.search_place_input_list').children('ul').children(search).css('display','block');
				});
			});
		},
		change : function(options) {
			return this.each(function(){
				
				var correct = false;
				$('.search_place_input_list').scrollTop(0);

				if($(this).hasClass('region')){
					$.each(regions, function() {
						if(this.name == options.name){
							current_region_id = this.id;
							current_region = this.name;
							correct = true;
							return false;
						}
					});
					if(correct){
						$('.search_place_input_list ul.cityes li').css('display','none');
						$('.search_place_input_list ul.cityes li[data-region='+current_region_id+']').css('display','block');
						$('.search_place_input.city').val('');
						$('.search_place_input.city').next('.fake_select_search_place_input').children('input').val('');
					}
				}

				if($(this).hasClass('city')){
					current_city = options.name;
					$.each(cityes, function() {
						if(this.name == options.name){
							current_city = this.name;
							correct = true;
							return false;
						}
					});
				}
				
				if(correct){
					$(this).val(options.name);
					$(this).next(".fake_select_search_place_input").children("input").val(options.name);						
				}
			});
		},
		check : function() {
			if($(this).val() == ''){
				$(this).css('border-color','red');
				$(this).nextAll('.search_place_input_list').after('<p class="search_place_input_error">Выберите значение из списка, ручной ввод возможен только для поиска</p>');
				return false;				
			} else {
				return true;
			}
		}
	};

	var methodsMain = {
		init : function(options) {
			return this.each(function(){
				$(this).css('display','none');
				if($(this).nextAll(".fake_select_search_place_input").eq(0).length==0){
					$(this).after('<div class="fake_select_search_place_input"><input type="text" class="search_place_input_current_text" autocomplete="off"></p><i class="search_place_input_show_button fa fa-chevron-down"></i></div><div class="search_place_input_list"><ul></ul></div>');
				}

				//var tt_item=$(this);
				//console.log(tt_item.name)	
				//console.log($('.search_place_input_list ul.regions li').length);
				if(options.regions !== undefined && options.regions !== '' && $(this).next('.search_place_input_list ul.regions li').length==0){ // && $('.search_place_input_list ul.regions li').length==0
					$(this).next('.search_place_input_list ul.regions').html("");

					$(this).next(".fake_select_search_place_input").next(".search_place_input_list").children("ul").addClass('regions');
					$(this).addClass('search_place_input region');
					regions = options.regions;
					if(options.current_region !== undefined && options.current_region !== ''){
						current_region = options.current_region;
					}
					//console.log(regions);
					//
					$.each(regions, function(){
				        $('.search_place_input_list ul.regions').append('<li data-name="'+this.name.toLowerCase()+'" data-id="'+this.id+'" data-country="'+this.country+'">'+this.name+'</li>');
				    });
				}
				
				if(options.cityes !== undefined && options.cityes !== '' && $(this).next('.search_place_input_list ul.cityes').length==0){ // && $('.search_place_input_list ul.cityes').length==0
					$(this).next('.search_place_input_list ul.cityes').html("");

					$(this).next(".fake_select_search_place_input").next(".search_place_input_list").children("ul").addClass('cityes');
					$(this).addClass('search_place_input city');
					cityes = options.cityes;
					if(options.current_city !== undefined && options.current_city !== ''){
						current_city = options.current_city;
					}
					//
					$.each(cityes, function(){
				        $('.search_place_input_list ul.cityes').append('<li data-name="'+this.name.toLowerCase()+'" data-id="'+this.id+'" data-region="'+this.region+'">'+this.name+'</li>');
				    });
				}  
				
				//Открыть список
				$(this).next(".fake_select_search_place_input").on('click',function(){
					$(this).children('input').focus();
					$('.search_place_input_list').css('display','none');
					var this_object = $(this).next('.search_place_input_list');
					if(this_object.css('display')=='block'){
						this_object.css('display','none');							
					}else{
						this_object.css('display','block');
					}
				});
				
				//Выбор из списка
				$(this).next(".fake_select_search_place_input").next('.search_place_input_list').children("ul").children("li").on('click',function(){
					$(this).parents('.search_place_input_list').prev().prev().search_place_input('change',{
						name: $(this).text(),
					});
					$(this).parent().parent(".search_place_input_list").css('display','none').prev().prev().css('border-color','').next().next().next('.search_place_input_error').remove();
				});
				
				//Поиск
				$(this).next(".fake_select_search_place_input").children('input').on('keyup',function(){
					var search = 'li[data-name *= "'+$(this).val().toLowerCase()+'"]';
					$(this).parents('.fake_select_search_place_input').next('.search_place_input_list').css('display','block');
					$(this).parents('.fake_select_search_place_input').next('.search_place_input_list').children('ul').children('li').css('display','none');
					if($(this).parents('.fake_select_search_place_input').prev().hasClass('city')){
						var search = 'li[data-name *= "'+$(this).val().toLowerCase()+'"][data-region = "'+current_region_id+'"]';
					}
					$(this).parents('.fake_select_search_place_input').next('.search_place_input_list').children('ul').children(search).css('display','block');
				});
			});
		},
		change : function(options) {
			return this.each(function(){
				
				var correct = false;
				$('.search_place_input_list').scrollTop(0);

				if($(this).hasClass('region')){
					$.each(regions, function() {
						if(this.name == options.name){
							current_region_id = this.id;
							current_region = this.name;
							correct = true;
							return false;
						}
					});
					if(correct){
						$('.search_place_input_list ul.cityes li').css('display','none');
						$('.search_place_input_list ul.cityes li[data-region='+current_region_id+']').css('display','block');
						$('.search_place_input.city').val('');
						$('.search_place_input.city').next('.fake_select_search_place_input').children('input').val('');
					}
				}

				if($(this).hasClass('city')){
					current_city = options.name;
					$.each(cityes, function() {
						if(this.name == options.name){
							current_city = this.name;
							correct = true;
							return false;
						}
					});
				}
				
				if(correct){
					$(this).val(options.name);
					$(this).next(".fake_select_search_place_input").children("input").val(options.name);						
				}
			});
		},
		check : function() {
			if($(this).val() == ''){
				$(this).css('border-color','red');
				$(this).nextAll('.search_place_input_list').after('<p class="search_place_input_error">Выберите значение из списка, ручной ввод возможен только для поиска</p>');
				return false;				
			} else {
				return true;
			}
		}
	};
	
	$.fn.search_place_input = function(method) {
		if(methods[method]){
			return methods[method].apply( this, Array.prototype.slice.call( arguments, 1 ));
		} else if (typeof method === 'object' || ! method) {
			return methods.init.apply( this, arguments );
		} else {
			$.error('Метод с именем ' +  method + ' не найден');
		}    
	};

	$.fn.search_place_input_new = function(methodsNew) {
		if(methodsMain[methodsNew]){
			return methodsMain[methodsNew].apply( this, Array.prototype.slice.call( arguments, 1 ));
		} else if (typeof methodsNew === 'object' || ! methodsNew) {
			return methodsMain.init.apply( this, arguments );
		} else {
			$.error('Метод с именем ' +  methodsNew + ' не найден');
		}    
	};


	
})(jQuery);




$(document).ready(function(){
	//if($('form[name=ONLINE_BILL]:visible').length>0){
		var input_product = $('textarea[name="form_textarea_174"]');
		var input_sum = $('input[name="form_text_173"]');
		var index;
		
	    input_product.css('display','none');
		input_sum.css('display','none');

	    input_product.after('<div class="fake_input_product_online_till">'+'<ul>'+'</ul>'+'<i id="add_fake_product">+</i>'+'</div><p class="sum_online_till"></p>');
	    input_product.after('<div class="fake_list_product_online_till">'+'<ul>'+'</ul>'+'</div>');
	    
		for (index = 0; index < array_product.length; ++index) {
			$('.fake_list_product_online_till ul').append('<li>'+array_product[index][0]+'</li>');
		}

	    $('#add_fake_product').click(function(){
		    $('.fake_list_product_online_till').css('display','block');
	    });
	    
	    $('.fake_list_product_online_till li').click(function(){
		    product_online_till_add($(this).text());
			$('.fake_list_product_online_till').css('display','none');
		    if($('.fake_input_product_online_till ul').find('li').length > 1){
			    $('.form_zakaz_new .form_field .fake_input_product_online_till ul li i').css('display','inline-block');
		    }
		});
		
		$('.fake_list_product_online_till').mouseleave(function(){
		    $('.fake_list_product_online_till').css('display','none');
		});
		
		$(".fake_input_product_online_till ul").on("click","i",function(){    
			var index_element = $(this).parent().index();
		    $(this).parent().remove();
		    products_online_till_array.splice(index_element, 1);
		    if(products_online_till_array.length == 1){
			    $('.form_zakaz_new .form_field .fake_input_product_online_till ul li i').css('display','none');
		    }
		    product_online_till_refresh();
	    });
	    
	    $('.fake_input_product_online_till ul').on("change","input",function(){
		    var price = 0;
		    var index_element = $(this).parent().index();
			products_online_till_array[index_element][1] = $(this).val();
			price = (products_online_till_array[index_element][1]*products_online_till_array[index_element][2]);
			$(this).parent().children('span:eq(1)').text(price.toLocaleString());
			if($(this).val()<=0) $(this).val(1);
			product_online_till_refresh();
	    });
	    
	    //Волидация формы
	    
	    $('form[name=ONLINE_BILL]').submit(function(){
		    var done = true;
		    if(!$('input[name=form_text_172]').search_place_input('check')){
			    done = false;
		    }
		    if(!$('input[name=form_text_171]').search_place_input('check')){
			    done = false;
		    }
		    if(done){
			    ///ФОРМА ПРОШЛА УСПЕШНУЮ ПРОВЕРКУ
		    }
			return done;
		});

	  $('form[name=ONLINE_BILL_KVSDC]').on('submit',function(){
	  	//console.log("ONLINE_BILL_KVSDC");
		    var done = true;
		    if(!$('input[name=form_text_218]').search_place_input('check')){
			    done = false;
		    }
		    if(!$('input[name=form_text_217]').search_place_input('check')){
			    done = false;
		    }
		    if(done){
			    ///ФОРМА ПРОШЛА УСПЕШНУЮ ПРОВЕРКУ
		    }
			return done;
		});

	  

		
	    
	    //Настройки формы
	    
	    $('.form_zakaz_new input').prop('required', true);
	    $('textarea[name="form_textarea_174"]').prop('required', true);
	    $('input[name=form_text_66]').mask('+9 (999) 999 99 99');
		$('input[name=form_text_67]').attr('pattern', '[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$');
		$('input[name=form_text_172]').prop('required', false);
		$('input[name=form_text_171]').prop('required', false);
		$('input[name=form_text_172]').search_place_input({regions : region_db,});
		$('input[name=form_text_171]').search_place_input({cityes : city_db,});

		
	//}
});


$(document).ready(function(){

	

	//if($('form[name=ONLINE_BILL_KVSDC]:visible').length>0){


			var input_product2 = $('textarea[name="form_textarea_220"]');
			var input_sum2 = $('input[name="form_text_219"]');
			var index2;
			
		    input_product2.css('display','none');
			input_sum2.css('opacity','0');

		    input_product2.after('<div class="fake_input_product_online_till">'+'<ul>'+'</ul>'+'<i id="add_fake_product">+</i>'+'</div><p class="sum_online_till"></p>');
		    input_product2.after('<div class="fake_list_product_online_till">'+'<ul>'+'</ul>'+'</div>');
		    
			for (index2 = 0; index2 < array_product.length; ++index2) {
				$('.fake_list_product_online_till ul').append('<li>'+array_product[index2][0]+'</li>');
			}

		    /*$('#add_fake_product').click(function(){
			    $('.fake_list_product_online_till').css('display','block');
		    });*/
		    
		    /*$('.fake_list_product_online_till li').click(function(){
			    product_online_till_add2($(this).text());
				$('.fake_list_product_online_till').css('display','none');
			    if($('.fake_input_product_online_till ul').find('li').length > 1){
				    $('.form_zakaz_new .form_field .fake_input_product_online_till ul li i').css('display','inline-block');
			    }
			});
			
			$('.fake_list_product_online_till').mouseleave(function(){
			    $('.fake_list_product_online_till').css('display','none');
			});
			
			$(".fake_input_product_online_till ul").on("click","i",function(){    
				var index_element = $(this).parent().index();
			    $(this).parent().remove();
			    products_online_till_array.splice(index_element, 1);
			    if(products_online_till_array.length == 1){
				    $('.form_zakaz_new .form_field .fake_input_product_online_till ul li i').css('display','none');
			    }
			    product_online_till_refresh();
		    });
		    
		    $('.fake_input_product_online_till ul').on("change","input",function(){
			    var price = 0;
			    var index_element = $(this).parent().index();
				products_online_till_array[index_element][1] = $(this).val();
				price = (products_online_till_array[index_element][1]*products_online_till_array[index_element][2]);
				$(this).parent().children('span:eq(1)').text(price.toLocaleString());
				if($(this).val()<=0) $(this).val(1);
				product_online_till_refresh();
		    });*/
		    
		    //Волидация формы
		    
		  
		    
		    //Настройки формы
		    
		    //$('.form_zakaz_new input').prop('required', true);
		    $('textarea[name="form_textarea_220"]').prop('required', true);
		    $('input[name=form_text_213]').mask('+9 (999) 999 99 99');
			$('input[name=form_text_214]').attr('pattern', '[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$');
			$('input[name=form_text_218]').prop('required', false);
			$('input[name=form_text_217]').prop('required', false);
			//console.log("dsfsfdsfdsfsdfsd");

			//setTimeout(function(){
				$('input[name=form_text_218]').search_place_input_new({regions : region_db,});
				$('input[name=form_text_217]').search_place_input_new({cityes : city_db,});
			//}, 100);
			

	//}
});

	//Закрыть форму
		function CloseForm() {
		$("body").removeClass('body_stop');
		$('#modal').css('display', 'none');
		$('form[name=ONLINE_BILL]').attr('action', '/catalog/online-till/');
		$('.send_button').attr('name', 'web_form_submit');
		}

		function CloseFormNew() {
		$("body").removeClass('body_stop');
		$('#modal_new').css('display', 'none');
		$('form[name=ONLINE_BILL_KVSDC]').attr('action', '/catalog/online-till/');
		$('.send_button').attr('name', 'web_form_submit');
		}

	//Цели метрики 
		var namefield = $('input[name="form_text_56"]');
		namefield.onchange = function () {
		yaCounter25873994.reachGoal('form_complete'); return true;
		}
		var forma = $('.js-form-address');
			forma.onsubmit = function () {
		yaCounter25873994.reachGoal('form_send'); return true;
		}

		var namefield1 = $('input[name="form_text_211"]');
		namefield1.onchange = function () {
		yaCounter25873994.reachGoal('form_complete'); return true;
		}