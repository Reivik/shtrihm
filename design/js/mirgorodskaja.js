$(window).load(function(){

	$(".three_buttons").hide();
	$(".accreditation.first-cont").hide();
	$(".accreditation.second-cont").hide();

	$('.bwWrapper').each(function() {
		$(this).BlackAndWhite({
			hoverEffect:true,
			webworkerPath: false,
			responsive:true
		});
	});

	$('.bwWrapper2').each(function() {
		$(this).BlackAndWhite({
			hoverEffect:true,
			webworkerPath: false,
			responsive:true
		});
	});
	
	function grayscale(src){
		var canv=document.createElement('canvas');
		var ctx=canv.getContext('2d');
		var img_Obj=new Image();
		img_Obj.src=src;
		canv.width=img_Obj.width;
		canv.height=img_Obj.height;
		ctx.drawImage(img_Obj, 0, 0);
		var img_pxl = ctx.getImageData(0, 0, canv.width,canv.height);
		
		for(var y=0; y < img_pxl.height; y++){
			for(var x=0; x < img_pxl.width; x++){
				var i=(y*4)*img_pxl.width+x*4;
				var avg=(img_pxl.data[i]+img_pxl.data[i+1]+img_pxl.data[i+2])/3;
				img_pxl.data[i]=img_pxl.data[i+1]=img_pxl.data[i+2]=avg;
			}
		}		
		ctx.putImageData(img_pxl, 0, 0, 0, 0, img_pxl.width, img_pxl.height);		
		return canv.toDataURL();
	}
});
$(window).ready(function(){
	var e = $(".scrollTop");  
	var speed = 500;
	e.click(function(){  
		$("html:not(:animated)" +( !$.browser.opera ? ",body:not(:animated)" : "")).animate({ scrollTop: 0}, 500 );  
		return false;
	});  
	//появление  
	function show_scrollTop(){  
		( $(window).scrollTop()>300 ) ? e.fadeIn(600) : e.hide();  
	}  
	$(window).scroll( function(){show_scrollTop()} ); show_scrollTop(); 

	//проверка телефонов и чисел	
	$('input.date_asc').mask("99.99.9999");
	
	$("input.inn_asc").keydown(function(event) {
        if ( event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 27 || 
            (event.keyCode == 65 && event.ctrlKey === true) || 			
            (event.keyCode == 86 && event.ctrlKey === true) ||              
            (event.keyCode >= 35 && event.keyCode <= 39)) {                 
                 return;
        }
        else {
            if ((event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 ) || $(this).val().length > 11) {
                event.preventDefault(); 
            }
        }
    });
	
	$("input.inn_asc").blur(function(){
		if($(this).val().length != 0 && $(this).val().length != 10 && $(this).val().length != 12 || /[^0-9]/.test($(this).val()))
		{
			alert("Неправильно введен ИНН.");
			$(this).focus();
		}
	});
	
	$('input.phone_asc, input.phone').mask("+7 (999) 999-99-99? доб. 9999");
	$('input.date_vebinar').mask("99.99.9999 99:99");
	$('input[type="text"].number').on("keypress", function(event) {
		var keyResult = event.which;
		if(keyResult < 48 || keyResult > 57) 
			return false;
	});
	$("form.filter_form .search .inputContainer").hover(
		function() {
			$(this).closest(".search").find("button[type='submit']").css('width', '97px');
		},
		function() {
			$(this).closest(".search").find("button[type='submit']").css('width', '98px');			
		}
	);
	setMailBoxes();
	
	//переключение вкладок в карточке товара с постраничной навигацией
	setHashCatalog();
	
	//защита форм от спама
	$("form.protection").each(function() {
		if($(this).find("input[name='sessid']").val())
			$(this).append("<input type='hidden' name='jssid' value='"+$(this).find("input[name='sessid']").val()+"'>");
	});
	
	//подсвечивание input и textarea при попадании фокуса
	$(".inputContainer input[type=text], .inputContainer input[type='password']").focus(function() {
		$(this).parent().addClass("focus");
	});
	$(".inputContainer input[type=text], .inputContainer input[type='password']").blur(function() {
		$(this).parent().removeClass("focus");
	});
	
	$('.textareaContainer textarea').focusin(function() {
		$(this).parent().addClass("focus");
	}).focusout(function() {
		$(this).parent().removeClass("focus");
	});
	
	
	//селекты
	$('select').selectbox();
	$('#statuses').selectbox('detach');
	
	$('#imulated').change(function(){    
		$('.im_input input').val($(this).val());
	});
	$('.im_input input').click(function(){    
		$('#imulated').trigger('click');
	});

	//placeholder для IE
	$('input[placeholder], textarea[placeholder]').placeholder();
		
	//Табы
	$("#product_detail").tabs({
		//activate: function( event, ui ) {
		//	window.location.hash=ui.newTab.attr("aria-controls");
		//	setHashCatalog();
		//}
	});
	
	$("#introduction").tabs();
	//$("#main_list").tabs();
	$("#clients_table").tabs();


	$("#product_detail a[role='presentation']").click(function(e) {
    	e.preventDefault();
	});

	//картинки-карусели
	$(".jCarouselLite").jCarouselLite({
		btnNext: ".pNext",
		btnPrev: ".pPrev",
		visible: 3,
		circular: false
	});
	
	jQuery("#flsGallery").flsGallery({
		mousewhell: false,
		speed: 1000,
		auto: 10000,
		stop_option: true,
		circular: true,
		visible: 3
	});
	
	//слайдер картинок
	c = $('.sliderItems');
	$('.sliderItems').after('<ul class="sliderNav"></ul>').cycle({
		timeout: 30000,
		pager:  '.sliderNav',
		pagerAnchorBuilder: function(idx, slide) { 
			return '<li><a href="#">' +  + '</a></li>';
		}
	}).after('<div class="clear"></div>');
	
	//слайдер картинок sliderItemsBest
	c = $('.sliderItemsBest');
	$('.sliderItemsBest').after('<ul class="sliderNav"></ul>').cycle({
		timeout: 5000,
		pager:  '.sliderNav',
		pagerAnchorBuilder: function(idx, slide) { 
			return '<li><a href="#">' +  + '</a></li>';
		}
	}).after('<div class="clear"></div>');
	$(".solutionLogo .sliderNav li a").on("click", function() {
		$('.sliderItems').cycle("pause");
	});
	//увеличение картинки
	$("a.gallery").fancybox(
		{
			"padding":25,
			"cyclic":true
		}
	);
	$(".solutionLogo a.main_image").fancybox();
	$('#fancybox-right,#fancybox-left').mouseover(function(){
			$(this).children('.fancybox-nav-hover').show();
		}).mouseout(function(){
			$(this).children('.fancybox-nav-hover').hide();
		});
	//подгрузка картинок в большое окошко
	$("a.for_fancy").on("click", function(event) {
		event.preventDefault();
		$(".productPhotosInfo a.gallery").hide().removeClass("main_image");
		$(".productPhotosInfo a[name="+$(this).attr("name")+"]").each(function(){
			if(!$(this).hasClass('for_fancy'))
				$(this).show().addClass("main_image");
		});
	});
	
	//скрыть в шапке поля при наведении при других странах	
/*
	$('li#regions').mouseover(function(){

	if(document.getElementById("intemediate").value == "true"){
		$('ul#ul_regions').hide();	
		$('ul#ul_towns').hide();
// 		$_SESSION["intemediate"] = "false";
		}
	});
*/
	
	//смена страны
	$('#ul_countries li a').on("click", function(event){
		event.preventDefault();
		$.get(
			"/ajax.php", 
			{
				form_type: "CHANGE_COUNTRY", 
				id: $(this).attr("id"),
				name: $(this).attr("title")
			}, 
			function(data) {
				if(data.STATUS == 1)
					window.location.reload();
			}, 
			'json'
		);

	});	
	
	//смена региона
	$('#ul_regions li a').on("click", function(event){
		event.preventDefault();
		$.get(
			"/ajax.php", 
			{
				form_type: "CHANGE_REGION", 
				id: $(this).attr("id"),
				name: $(this).attr("title")
			}, 
			function(data) {
				if(data.STATUS == 1)
					window.location.reload();
			}, 
			'json'
		);

	});
	
	//смена города
	$('#ul_towns li a').on("click", function(event){
		event.preventDefault();
		$.post(
			"/ajax.php", 
			{
				form_type: "CHANGE_CITY", 
				id: $(this).attr("id"),
				name: $(this).attr("title")
			}, 
			function(data) {
				if(data.STATUS == 1)
					window.location.reload();
			}, 
			'json'
		);
	});
	
	//выезжающий фильтр в каталогах
	$('.filter .title').click(function() {
	   $('.filterCont').slideToggle(200);
	});
	
	//первоначальное определение селектов-регионов-стран
	/*if($("select.country").size() > 0) {
		$('select.country').each(function() {
			changeRegionByCountry($(this));
		});
	}
	else {
		$('select.region').each(function(index) {
			if(!$(this).prop("id"))
				$(this).prop("id", "region_"+index);
			//changeTownByRegion($(this));
			changeRegionByCountry(false, $(this));
		});
	}*/
	
	//смена регионов как реакция на смену стран в селектах в формах
	$('select.country').on("change", function() {
		changeRegionByCountry($(this));
	});
	
	
	//первоначальное определение селектов-городов-регионов
	$('select.region').each(function(index) {
		if(!$(this).prop("id"))
			$(this).prop("id", "region_"+index);
		if($(this).closest("div").hasClass("country-region-town"))
			changeRegionByCountry($(this).closest("div.country-region-town").find("select.country"));
		else 
			changeRegionByCountry(false, $(this));
		//changeTownByRegion($(this));
	});
	
	//смена городов как реакция на смену регионов в селектах в формах
	$('select.region').on("change", function() {
		changeTownByRegion($(this));
	});
	
	//появление разделов в мероприятиях
	$('#name_section').click(function (e) {
		if($("#section_detail").css("display") == "none") {
			$(this).addClass("active");
			$("#section_detail").show();
		}
		var yourClick = true;
		$(document).bind('click.myEvent', function (e) {
			if (!yourClick && $(e.target).closest('.event_section').length == 0) {
				$("#section_detail").hide();
				$("#name_section").removeClass("active");
				$(document).unbind('click.myEvent');
			}
			yourClick = false;
		});
	});
	
	//календарь событий в мероприятиях
	if($.datepicker) {
		$.datepicker.regional['ru'] = {
			closeText: 'Закрыть',
			prevText: '&#x3c;Пред',
			nextText: 'След&#x3e;',
			currentText: 'Сегодня',
			monthNames: ['Январь','Февраль','Март','Апрель','Май','Июнь',
				'Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь'],
			monthNamesShort: ['Янв','Фев','Мар','Апр','Май','Июн',
				'Июл','Авг','Сен','Окт','Ноя','Дек'],
			dayNames: ['воскресенье','понедельник','вторник','среда','четверг','пятница','суббота'],
			dayNamesShort: ['вск','пнд','втр','срд','чтв','птн','сбт'],
			dayNamesMin: ['Вс','Пн','Вт','Ср','Чт','Пт','Сб'],
			dateFormat: 'dd.mm.yy',
			firstDay: 1,
			isRTL: false
		};
		$.datepicker.setDefaults($.datepicker.regional["ru"]);
		$("#datepicker").datepicker({				
			"onSelect": function (dateText, inst) {
				var currentDate = $.datepicker.formatDate('dd.mm.yy', $("#datepicker").datepicker("getDate"));
				if(currentDate) {
					$.post(
						"/ajax.php", 
						{
							form_type: "CHANGE_EVENT_CALENDAR", 
							date: currentDate
						}, 
						function(data) {
							$("#event_list").empty();
							$("#event_list").html(data);
						}, 
						'html'
					);
				} 
			}
		});
	}

	$('#region_0').on('change', function(e) {
		$('label.label_check').each(function() {
			var inp = this.getElementsByTagName('input')[0];
			if(this.className == 'label_check last c_on') {
				this.className = 'label_check last c_off';
				inp.removeAttribute("checked");
			}
			if(this.className == 'label_check c_on') {
				this.className = 'label_check c_off';
				inp.removeAttribute("checked");
			}
		});
		$(".three_buttons").hide();
		$(".accreditation.first-cont").hide();
		$(".accreditation.second-cont").hide();
	});

	$('#REGION__').on('change', function(e) {
		$('label.label_check').each(function() {
			var inp = this.getElementsByTagName('input')[0];
			if(this.className == 'label_check last c_on') {
				this.className = 'label_check last c_off';
				inp.removeAttribute("checked");
			}
			if(this.className == 'label_check c_on') {
				this.className = 'label_check c_off';
				inp.removeAttribute("checked");
			}
		});
		if (this.options[this.selectedIndex].value == 0) {
			$(".three_buttons").hide();
		} else { 
			$(".three_buttons").show();
		}
		$(".accreditation.first-cont").hide();
		$(".accreditation.second-cont").hide();
	});

	$('button.service-partner').on('click', function(e) {
		e.preventDefault();
		$('label.label_check').each(function() {
			var inp = this.getElementsByTagName('input')[0];
			if(this.className == 'label_check last c_on') {
				this.className = 'label_check last c_off';
				inp.removeAttribute("checked");
			}
			if(this.className == 'label_check c_on') {
				this.className = 'label_check c_off';
				inp.removeAttribute("checked");
			}
		});
		$(this).toggleClass('active');
		if ($(this).hasClass('active')) {
			$('#item_-1').attr('checked', true);
			$("#submit_step1").removeAttr("disabled");
			$(".accreditation.first-cont").show();
			$(".accreditation.second-cont").hide();
			$('button.integrator').removeClass('active');
			$('button.asc').removeClass('active');
		} else {
			$("#submit_step1").attr("disabled", true);
			$(".accreditation.first-cont").hide();
			$(".accreditation.second-cont").hide();
		}
	});

	$('button.asc').on('click', function(e) {
		e.preventDefault();
		$('label.label_check').each(function() {
			var inp = this.getElementsByTagName('input')[0];
			if(this.className == 'label_check last c_on') {
				this.className = 'label_check last c_off';
				inp.removeAttribute("checked");
			}
			if(this.className == 'label_check c_on') {
				this.className = 'label_check c_off';
				inp.removeAttribute("checked");
			}
		});
		$(this).toggleClass('active');
		if ($(this).hasClass('active')) {
			$('#item_-2').attr('checked', true);
			$("#submit_step1").removeAttr("disabled");
			$(".accreditation.first-cont").show();
			$(".accreditation.second-cont").show();
			$('button.service-partner').removeClass('active');
			$('button.integrator').removeClass('active');
		} else {
			$("#submit_step1").attr("disabled", true);
			$(".accreditation.first-cont").hide();
			$(".accreditation.second-cont").hide();
		}
	});

	$('button.integrator').on('click', function(e) {
		e.preventDefault();
		$('label.label_check').each(function() {
			var inp = this.getElementsByTagName('input')[0];
			if(this.className == 'label_check last c_on') {
				this.className = 'label_check last c_off';
				inp.removeAttribute("checked");
			}
			if(this.className == 'label_check c_on') {
				this.className = 'label_check c_off';
				inp.removeAttribute("checked");
			}
		});
		$(".accreditation.first-cont").hide();
		$(".accreditation.second-cont").hide();
		$(this).toggleClass('active');
		if ($(this).hasClass('active')) {
			$('#item_0').attr('checked', true);
			$("#submit_step1").removeAttr("disabled");
			$('button.service-partner').removeClass('active');
			$('button.asc').removeClass('active');
		} else 	$("#submit_step1").attr("disabled", true);
	});

	//красивые чекбоксы
	$('label.label_check').each(function() {
		var inp = this.getElementsByTagName('input')[0];
		if(inp.checked == true) $(this).addClass("c_on");
		else $(this).addClass("c_off");		
	});
	$('label.label_check').on('click', function(e) {
		var inp = this.getElementsByTagName('input')[0];
		if(inp.disabled == false) {
			if (this.className == 'label_check c_off') {
				this.className = 'label_check c_on';
				inp.setAttribute("checked", "checked");
			}
			else if(this.className == 'label_check last c_off'){
				this.className = 'label_check last c_on';
				inp.setAttribute("checked", "checked");
			}
			else if(this.className == 'label_check last c_on'){
				this.className = 'label_check last c_off';
				inp.removeAttribute("checked");
			}
			else {
				this.className = 'label_check c_off';
				inp.removeAttribute("checked");
			};
		}		
		if(inp.id == "c_filials") {
			if(inp.getAttribute('checked') != "checked") {
				if($(".filials").size() == 0) {
					$('#add_f').hide();
					$('.about .filials').remove();
				}
				else {
					$('#add_f').hide();
					$(".about .filials").hide();
				}
			}
			else {
				if($(".about .filials").size() == 0) {					
					$('#add_f').show();
					addDoubleField('.clone.filials', '.about .c_fillials');					
				}
				else 
					$(".about .filials").show();
			}
		}		
		if($(this).attr("alt") == "sections" || $(this).attr("alt") == "items") {
			$(this).closest(".products").find('div.'+inp.id).toggle();
		}
		
		if($(this).find("span").hasClass("compareLink") == true) {
			if(inp.getAttribute('checked') == "checked") {
				var id = $(this).find("span").attr("id");
				var DETAIL_URL = $(this).find("span").attr("href");
				$.post(
					"/ajax.php", 
					{
						form_type: "ADD_TO_COMPARE_LIST", 
						id: id,
						NAME: "CATALOG_COMPARE_LIST",
						IBLOCK_ID: 4,
						DETAIL_URL: DETAIL_URL
					}, 
					function(data) {
						$("a.in_compare").attr('href', data.URL);
						if(data.STATUS == 1) {
							$("span#"+id).hide();
							$('a[name="'+id+'"]').show();
						}
					},
					"json"
				);
			}
			else {
				var id = $(this).find("span").attr("id");
				var DETAIL_URL = $(this).find("span").attr("href");
				$.post(
					"/ajax.php", 
					{
						form_type: "DELETE_FROM_COMPARE_LIST", 
						id: id,
						NAME: "CATALOG_COMPARE_LIST",
						IBLOCK_ID: 4,
						DETAIL_URL: DETAIL_URL
					}, 
					function(data) {
						$("a.in_compare").attr('href', data.URL);
						if(data.STATUS == 1) {
							$('a[name="'+id+'"]').hide();
							$("span#"+id).show();
						}
					},
					"json"
				);
			}
		}
		if(inp.id.indexOf('people_programm_') + 1) {
			$("ul."+inp.id).toggle();
		}
		
		if($(this).closest("form").hasClass("protection") == true && $(this).closest("form").hasClass("lk") == true) {
			changePersonalForm($(this).closest("form"));
		}
		
		if(inp.id == "user_all_checked") {
			if(inp.getAttribute('checked') == "checked")
				$("div.user_all_checked").hide();
			else
				$("div.user_all_checked").show();
			
		}
		e.preventDefault();
	});

	//красивые радиобоксы
	$('label.label_radio').each(function() {
		var inp = this.getElementsByTagName('input')[0];
		if(inp.checked == true) $(this).addClass("r_on");
		else $(this).addClass("r_off");		
	});
	if($('form[name="regform"] input[name="user"]:checked').val() == "user") {
		$('form[name="regform"] #partner_form').hide();
		$('form[name="regform"] #user_form').show();
	}
	else if($('form[name="regform"] input[name="user"]:checked').val() == "partner") {
		$('form[name="regform"] #user_form').hide();
		$('form[name="regform"] #partner_form').show();
	}
	
	$('label.label_radio').on('click', function(e) {
		e.preventDefault();
		var inp = this.getElementsByTagName('input')[0];
		if (this.className == 'label_radio r_off' || inp.checked) {
			var ls = this.parentNode.getElementsByTagName('label');
            for (var i = 0; i < ls.length; i++) {
                var l = ls[i];
                if (l.className.indexOf('label_radio') == -1)  continue;
                l.className = 'label_radio r_off';
            };
			this.className = 'label_radio r_on';
			inp.setAttribute("checked", "checked");
		} else {
			this.className = 'label_radio r_off';
			inp.removeAttribute("checked");
		};
		if(inp.id == "regform_user" || inp.id == "regform_partner") {
			if(inp.value == "user") {
				$('form[name="regform"] #partner_form').hide();
				$('form[name="regform"] #user_form').show();
			}
			else if(inp.value == "partner") {
				$('form[name="regform"] #user_form').hide();
				$('form[name="regform"] #partner_form').show();
			}
		}
	});
	
	//поздравления
	$('.congratulations-list article').on('click', function(e) {
		e.preventDefault();
		//$('.congratulations-list article').removeClass('active');
		//$('.congratulations-list article').removeClass('active');
		$(this).toggleClass('active');
	});
	$('.congratulations-list article  .all a').click(function(){window.location.href=$(this).attr('href');return false;});
	/*$('.congratulations-list a span.close').on('click', function(e) {
		//alert($(this).closest('article').attr('class'));
		$(this).closest('article').removeClass('active');
		e.preventDefault();
	});*/
	
	
	$(".content .aside").each(function(i,elem) {
		if(i == 0)
			$(this).css("top", 50+"px");
		else {
			var prev_position = $(this).prev(".content .aside, .consult").position();
			$(this).css("top", prev_position.top+$(this).prev().height()+50+"px");
		}
	});
	
	
	$('.showMoreLink').click(function(e){
		e.preventDefault();
		if($('.special .showMore a').attr('class') == 'showMoreLink')
		{
		    $('.special .showMore a').text('Свернуть');
			$('.more_special').stop().slideToggle();
			$('.special .showMore a').removeClass("showMoreLink").addClass('hideMoreLink');			
		}
		else
		{
		    $('.special .showMore a').text('Показать еще');
			$('.more_special').stop().slideToggle();
			$('.special .showMore a').removeClass('hideMoreLink').addClass("showMoreLink");			
		}
    });
	
	//добавление филиалов компании при регистрации
	if($(".about .filials").size() != 0)
		$('#add_f').show();
	else
		$('#add_f').hide();
		
	
	
	//добавление филиалов  при регистрации
  	$('#add_f').live('click', function(e) {
		e.preventDefault();
		addDoubleField('.clone.filials', '.about .c_fillials');
		$('input.phone').mask("+7 (999) 999-99-99? доб. 9999");
		$('input[type="text"].number').on("keypress", function(event) {
			if(event.keyCode < 48 || event.keyCode > 57) return false;
		});
	});
	
   	$('.about').on('click','#rem_f',function() {
		$(this).closest('.filials').remove();
	});

  	$('#add_p').live('click', function(e) {
		e.preventDefault();
		addDoubleField('.clone.people', '.peoples');
		$('input.phone').mask("+7 (999) 999-99-99? доб. 9999");
		$('input[type="text"].number').on("keypress", function(event) {
			if(event.keyCode < 48 || event.keyCode > 57) return false;
		});
	});	
	
	$('.peoples_all').on('click','#rem_p',function() {
		$(this).closest('.people').remove();
	});
	
	//добавление филиалов в личном кабинете
	$('#add_filial_personal').on('click', function(e) {
		e.preventDefault();
		addDoubleField('.clone.filials tr', '.about table');
	});	
	//удаление филиала в личном кабинете
	$('.about.filial_personal').on('click','#rem_f',function() {
		var filial_id = $(this).closest('.filials').find("input.filial_id").val();
		if(filial_id > 0) {
			$('form[name="change_profile"]').append('<input type="hidden" name="delete_filial[]" value="'+filial_id+'" />');
		}
		$(this).closest('.filials').remove();
	});	
	//удаление сотрудника в личном кабинете
	$('.about').on('click','#rem_p',function() {
		var people_id = $(this).closest('.peoples').find("input.people_id").val();
		if(people_id > 0) {
			$('form[name="change_staff"]').append('<input type="hidden" name="delete_people[]" value="'+people_id+'" />');
		}
		$(this).closest('.peoples').remove();
	});
	//добавление сотрудников в личном кабинете
	$('#add_peoples_personal').on('click', function(e) {
		e.preventDefault();
		addPeople();
	});
		
	$('button[name="add_field"]').on("click", function(e) {
		e.preventDefault();
		addDoubleField('.clone.add_field', '.user_fields');	
	});
	
	//появление разделов в регистрации
	$('#name_section_reg').click(function (e) {
		if($("#section_detail_reg").css("display") == "none") {
			$(this).addClass("active");
			$("#section_detail_reg").show();
		}
		else {
			$(this).removeClass("active");
			$("#section_detail_reg").hide();
		}
		var yourClick = true;
		$(document).bind('click.myEvent', function (e) {
			if (!yourClick && $(e.target).closest('.section_registration').length == 0) {
				$("#section_detail_reg").hide();
				$("#name_section_reg").removeClass("active");
				$(document).unbind('click.myEvent');
			}
			yourClick = false;
		});
	});
	
	//добавление полей
	$('button[name="add_file"]').on("click", function(e) {
		e.preventDefault();
		var c=new Date();
		var ms;
		ms = c.getTime().toString().substr(6);
		$('.clone.input.file').clone(true).removeClass('clone').appendTo('.photo_block').show().find('input[type="file"]').each(function(index)
		{
			var newn=$(this).attr('name').replace("__","_"+ms);
			$(this).attr('name',newn);
		});		
	});
	
	$('button[name="add_contacts"]').on('click', function(e){
		e.preventDefault();
		addDoubleField('.clone.five_input_container', '.add_contacts_header');		
	});
	$('button[name="add_listener"]').on('click', function(e){
		e.preventDefault();
		addDoubleField('.clone.listener_about_person', '.listener_about');		
	});
	$('button[name="add_directions"]').on('click', function(e){
		e.preventDefault();
		addDoubleField('.clone.directions', '.activity_directions');		
	});
	$('button[name="add_regions"]').on('click', function(e){		
		e.preventDefault();
		$(".region, .town").selectbox("detach");
		addDoubleField('.clone.regions_quantity', '.regions_activities');
		$(".region, .town").selectbox("attach");		
	});
	$('.delete_contacts').on('click', function(e) {
		e.preventDefault();
		$(this).closest(".five_input_container").remove();
	});
	$('.delete_listener_about_person').on('click', function(e) {
		e.preventDefault();
		$(this).closest(".listener_about_person").remove();
	});
	$('.delete_directions').on('click', function(e) {
		e.preventDefault();
		$(this).closest(".directions").remove();
	});
	$('.delete_regions_quantity').on('click', function(e) {
		e.preventDefault();
		$(this).closest(".regions_quantity").remove();
	});	
	
	$('a.showMorePreview').on("click", function(e) {
		e.preventDefault();
		$(this).closest("td").find("div.preview_news").removeClass("full");
		$(this).hide();
		$(this).closest("td").find("a.hideMorePreview").css("display", "block");
	});
	$('a.hideMorePreview').on("click", function(e) {
		e.preventDefault();
		$(this).closest("td").find("div.preview_news").addClass("full");
		$(this).hide();
		$(this).closest("td").find("a.showMorePreview").css("display", "block");
	});
	$('#add_specialities').live('click', function(e) {
		e.preventDefault();
		addDoubleField('.clone.specialities', '#specialities');
	});
	$('.delete_speciality').on('click', function(e) {
		e.preventDefault();
		$(this).closest(".specialities").remove();
	});
	$('#add_postav').live('click', function(e) {
		e.preventDefault();
		addDoubleField('.clone.postavschiki', '#postavschiki');
	});
	$('.delete_postavschiki').on('click', function(e) {
		e.preventDefault();
		$(this).closest(".postavschiki").remove();
	});
	
	//форма опубликовать внедрение
	$('button[name="search_partner"]').on('click', function(e) {
		e.preventDefault();
		var text = $('input[name="search_partner_name"]').val();
		$.post(
			"/ajax.php", 
			{
				form_type: "FIND_PARTNER", 
				text: text
			}, 
			function(data) {
				$("#partners_list").html(data);
			}, 
			'html'
		);
	});
	
	$('#partners_list.admin_partner div.partner').on("click", function() {
		var id = $(this).find("input[name='partner_id']").val();
		if(id > 0)
			$('input[name="admin_now_company"]').val(id).val();
		$('form[name="admin_partner_filter"]').append("<input type='hidden' name='new_send' value='1' />");
		$('form[name="admin_partner_filter"]').submit();
	});
	$(".pageCont #partners_list div.partner").click(function() {
		$(".pageCont .partner_form .partner").removeClass('active');
		$(this).addClass("active");
		var partner_id = $(this).find("input[name='partner_id']").val();
		$('input[name="INTRODUCTION[PROPERTY][PARTNER]"]').val(partner_id);
	});
	
	$(".consult .theme_consult").click(function() {
		$(".consult .theme_consult table").hide();
		////var html = $(this).html();
		//$(html).insertAfter("div.title");
		$(this).find("table").show();
		$(this).clone(true).insertBefore($('.theme_consult:first'));
		$(this).remove();
	});
	
	$("form.protection.lk").each(function() {
		$(this).find("input, select").change(function() {
			changePersonalForm($(this));
		});
	});
	$("#personal_cabinet a").click(function(e) {
		//e.preventDefault();
		if($('input[name="changed_form_lk"]').val() == 1) {
			$("#personal_cabinet .list_last.ui-tabs-panel").prepend("<div class='messErr'>На данной странице есть несохраненные данные.</div>");
			$('input[name="changed_form_lk"]').val(0);
			return false;
		}
		/*else {
			($(this).attr("href"));
		}*/
	});
	
	$("#to_bbb").click(function(e) {
		$(this).hide();
	});
	
	//раскрывающиеся таблицы в разделе "Скачать"
	$("#download a.title").on("click", function(e) {
		e.preventDefault();
		var el = $(this).closest(".section_block");
		$("#download .section_block").each(function() {
			if($(this).attr("data-id") != el.attr("data-id")) {
				$(this).removeClass("active");
				$(this).find('.table-file').slideUp("slow");
			}
			else {
				if(el.hasClass("active") == false) {
					el.addClass("active");
					el.find('.table-file').slideDown("slow");
				}
				else {
					el.removeClass("active");
					el.find('.table-file').slideUp("slow");
				}
			}
		});
	});
});

function changeRegionByCountry(select, region){
	if(!region)
		region = false;
	if(!select && region) {
		var title = region.prop("id");
		var select_id = 15358;
	}
	else {
		var title = select.attr('title');
		var select_id = select.find('option:selected').val();
	}
	
	$("select#"+title).selectbox("detach");
	var objSel = document.getElementById(title);
	$("#"+title).css("display", "block").css("border", "1px solid red");
	if ( objSel.selectedIndex != -1)
		var selected_ind = objSel.options[objSel.selectedIndex].value;
	else var selected_ind = 0;												
	objSel.options.length = 0;
	if(select_id!=0){
		var regions_array = new Array();
		for(var i=0; i < regions.length; i++) {
			if((select_id != 0 && regions[i]["country"] == select_id) || select_id == 0)
				regions_array[regions_array.length] = {"name": regions[i]["name"], "id": regions[i]["id"]};
		}
		$("#"+title).closest(".field").show();
		if(regions_array.length > 0) {
			objSel.options[objSel.options.length] = new Option("Все регионы", 0);
			for(var j=0; j<regions_array.length; j++) {
				objSel.options[objSel.options.length] = new Option(regions_array[j]["name"], regions_array[j]["id"]);
				if(regions_array[j]["id"] == selected_ind) {
					objSel.value = selected_ind;
				}
			}
		}
		else {
			objSel.options[0] = new Option(regions_array[0]["name"], regions_array[0]["id"], true);
			$("#"+title).closest(".field").hide();
		}
	}
	else{
		objSel.options[0] = new Option("Все регионы", 0);
	}
	$("select#"+title).selectbox("attach");
	$(".select_remake").selectbox("attach");
		
	$('select.region').each(function() {
		changeTownByRegion($(this));
	});
}
function changeTownByRegion(select) {
	$('.hidecity').show();
	var title = select.attr('title');
	$("select#"+title).selectbox("detach");
	var select_id = select.find('option:selected').val();		
	var objSel = document.getElementById(title);
	if ( objSel.selectedIndex != -1)
		var selected_index = objSel.options[objSel.selectedIndex].value;
	else var selected_index = 0;
	objSel.options.length = 0;
	if(select_id!=0){
		var towns_array = new Array();
		for(var i=0; i < towns.length; i++) {
			if((select_id != 0 && towns[i]["region"] == select_id) || select_id == 0)
				towns_array[towns_array.length] = {"name": towns[i]["name"], "id": towns[i]["id"]};
		}
		$("#"+select.attr('title')).closest(".field").show();		
		if(towns_array.length > 0) {
				objSel.options[objSel.options.length] = new Option("Все города", 0);
				for(var j=0; j<towns_array.length; j++) {
					objSel.options[objSel.options.length] = new Option(towns_array[j]["name"], towns_array[j]["id"]);
					if(towns_array[j]["id"] == selected_index) {
						objSel.value = selected_index;
					}
				}
			/*if(towns_array.length == 1){
				$('.hidecity').hide();
			}*/
			if(towns_array[0].id == 198){
				$('.hidecity').hide();
			}
		}
		else {
			objSel.options[0] = new Option(towns_array[0]["name"], towns_array[0]["id"], true);
			$("#"+select.attr('title')).closest(".field").hide();
		}
	}
	else{
		objSel.options[0] = new Option("Все города", 0);
	}
	
	$("select#"+title).selectbox("attach");
	$(".select_remake").selectbox("attach");
}
function addDoubleField(container_where, container_to) {
	var c=new Date();
	var ms;
	ms = c.getTime().toString().substr(6);
	$(".country, .region, .town, .select_remake").selectbox("detach");
	$(container_where).clone(true, true).removeClass('clone').appendTo(container_to).show().find('input, select, textarea').each(function(index)
	{
		if(this.nodeName == "SELECT" && $(this).hasClass("country") == true && $(this).attr("title") != "") {
			var newcontitle=$(this).attr('title').replace("__", ms);
			$(this).attr('title',newcontitle);			
		}
		if(this.nodeName == "SELECT" && $(this).hasClass("region") == true && $(this).attr("title") != "") {
			var newRegionTitle=$(this).attr('title').replace("__", ms);
			var newRegionID=$(this).attr('id').replace("__", ms);
			$(this).attr('title',newRegionTitle);
			$(this).attr('id',newRegionID);
		}
		if(this.nodeName == "SELECT" && $(this).hasClass("town") == true && $(this).attr("id") != "") {
			var newid = $(this).attr('id').replace("__", ms);			
			$(this).attr('id', newid);
		}		
		var newn=$(this).attr('name').replace("[]","["+ms+"]");
		$(this).attr('name',newn);		
	});
	$('input.phone_asc, input.phone').mask("+7 (999) 999-99-99? доб. 9999");
	
	$('input.date_asc').mask("99.99.9999");
	
	$("input.inn_asc").keydown(function(event) {
        if ( event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 27 || 
            (event.keyCode == 65 && event.ctrlKey === true) || 			
            (event.keyCode == 86 && event.ctrlKey === true) ||              
            (event.keyCode >= 35 && event.keyCode <= 39)) {                 
                 return;
        }
        else {
            if ((event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 ) || $(this).val().length > 11) {
                event.preventDefault(); 
            }
        }
    });
	$(".country, .region, .town, .select_remake").selectbox("attach");
}
function addPeople() {
	var c=new Date();
	var ms;
	ms = c.getTime().toString().substr(6);
	$(".select_remake").selectbox("detach");
	$('.clone.peoples tr').clone(true).appendTo('.about table').show().find('input, select').each(function(index)
	{
		var newn=$(this).attr('name').replace("[]","["+ms+"]");
		$(this).attr('name',newn);
	});
	$(".select_remake").selectbox("attach");
	$('input.phone_asc, input.phone').mask("+7 (999) 999-99-99? доб. 9999");
}
function getClientWidth() {
  return document.compatMode=='CSS1Compat' && !window.opera?document.documentElement.clientWidth:document.body.clientWidth;
}
function submit_clients_form() {
	$('form[name="clients_filter"]').submit();
}
function submit_learning_contacts_filter_form() {
	$('form[name="learning_contacts_form"]').submit();
}
function setMailBoxes()
{
	var as=document.getElementsByTagName('a'), dmn, nm;
	for(var i=0;i<as.length;i++)
		if(as[i].className=='e-mail')
			{
				dmn=as[i].href.substr(as[i].href.search('#')+1);
				nm=as[i].title;					
				as[i].href='mailto:'+nm+'@'+dmn;
				as[i].title='Написать письмо';					
				if(!as[i].innerHTML) as[i].innerHTML=nm+'@'+dmn;
			}
}
function setHashCatalog() {
	$("a.catalog_hash").each(function() {
		var hash = $(this).attr("href").split("#")[1];
		var href = $(this).attr("href").split("#")[0];
		//if(hash)
			$(this).attr("href", href+window.location.hash);
	});
}
function changePersonalForm(form) {
	form.append("<input type='hidden' name='changed_form_lk' value='1' />");
}

$(document).ready(function(){
    $('.video_block_detail').click(function(){
        var link_video = $(this).data('link');
        $('.video_modal').addClass('active');
        $('.video_modal_inner iframe').attr('src', link_video);
    });
});
$(document).ready(function(){
    $('.video_modal_close').click(function(){
        $('.video_modal').removeClass('active');
        $('.video_modal_inner iframe').attr('src', '');
    });
});
$(document).ready(function(){
    $('.video_modal').click(function(){
        $('.video_modal').removeClass('active');
        $('.video_modal_inner iframe').attr('src', '');
    });
});
$(document).ready(function(){
	$('.webinar_switcher span').click(function(){
		var aim = $(this).data('aim');
		if (!$(this).hasClass('active')) {
            $('.webinar_switcher span').removeClass('active');
			$(this).addClass('active');
			$('.webinars_list').removeClass('active');
			$('.' + aim + '').addClass('active');
		}

	});
});