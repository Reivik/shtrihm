$(document).ready(function(){
	var max_r_n = parseInt($("#more_right_news").attr("type"),10);
	var max_l_n = parseInt($("#more_left_news").attr("type"),10);
	
	var max_r_s = parseInt($("#more_right_sroki").attr("type"),10);
	var max_l_s = parseInt($("#more_left_sroki").attr("type"),10);
	
	var news_r = parseInt($("#more_right_news").attr("name"),10);
	var news_l = parseInt($("#more_left_news").attr("name"),10);
	
	var sroki_r = parseInt($("#more_right_sroki").attr("name"),10);
	var sroki_l = parseInt($("#more_left_sroki").attr("name"),10);
	
	if(max_r_s <= 3){
		$("#more_right_sroki").css("display", "none");	
	}
	if(max_l_s  <= 3){
		$("#more_left_sroki").css("display", "none");	
	}
	if(max_r_n <= 3 ){
		$("#more_right_news").css("display", "none");
	}
	if(max_l_n <= 3 ){
		$("#more_left_news").css("display", "none");	
	}

	
	for(i = 0; i < 3; i++){
		$("#"+i+"news_right").css('display','block');
		$("#"+i+"news_left").css('display','block');
		
		$("#"+i+"sroki_right").css('display','block');
		$("#"+i+"sroki_left").css('display','block');
	}	
});

$(document).ready(function(){
	$("#your_spc_id").click(function(){
		$("#first_spisok").slideToggle("fast");
	});
});

$(document).ready(function(){
	$("#online_play").click(function(){
		$("#webinar").slideToggle("slow");
	});
});

$(document).ready(function(){
	$("#online_play_no").click(function(){
		var temp = $("#webinar_chenel").attr('name');
		window.open(temp, '_blank');

	});
});

$(document).ready(function(){
	$("#tema_id").click(function(){
		$("#second_spisok").slideToggle("fast");
	});
});

$(document).ready(function(){
	$(".select").click(function(){
		$("#your_spc_id > .first_span").text($(this).text());
		$("#input_1").attr("value",$(this).text());
		$("#first_spisok").slideUp("slow");
	});
});

$(document).ready(function(){
	$(".select_t").click(function(){
		$("#tema_id > .first_span").text($(this).text());
		$("#input_2").attr("value",$(this).text());
		$("#second_spisok").slideUp("slow");
	});
});

function go(next, prev, type){	
	var num_next = $("#" + next).attr("name");
	var num_prev = $("#" + prev).attr("name");
	var max = $("#" + next).attr("type");
	console.log("Вот она - " + max); 
	num_next = parseInt(num_next,10);
	num_prev = parseInt(num_prev,10);
	max =  parseInt(max,10);
	
	if(num_next <= 8){		
		for(i = num_prev; i < num_next; i++){
			$("#" + i + type).show("slow");
		}
		
		if((max > num_prev)&&(max < num_next)){
			$("#" + next).css("display", "none");
		}
		
		num_next = num_next + 8;
		num_prev = num_prev + 8;
		
		$("#" + next).attr("name", num_next.toString());
		$("#" + prev).attr("name", num_prev.toString());
	}
	else{
		$("." + type).hide("slow");
		
		for(i = num_prev; i < num_next; i++){
			$("#" + i + type).show("slow");
		}
		
		if((max > num_prev)&&(max < num_next)){
			$("#" + next).attr("name", num_next.toString());
			$("#" + prev).attr("name", num_prev.toString());
			
			$("#" + next).css("display", "none");
			$("#" + prev).css("display", "block");
		}
		else{
			num_next = num_next + 8;
			num_prev = num_prev + 8;
			
			$("#" + prev).css("display", "block");
			
			$("#" + next).attr("name", num_next.toString());
			$("#" + prev).attr("name", num_prev.toString());
		}
	}	
}
 
function prev(next, prev, type){
	var num_next = $("#" + next).attr("name");
	var num_prev = $("#" + prev).attr("name");
	var max = $("#" + next).attr("type");
	
	num_next = parseInt(num_next,10);
	num_prev = parseInt(num_prev,10);
	max =  parseInt(max,10);
	
	if(num_prev > 0){
		num_next = num_next - 8;
		num_prev = num_prev - 8;
		
		$("#" + next).css("display", "block");		
	}
	
	$("#" + next).attr("name", num_next.toString());
	$("#" + prev).attr("name", num_prev.toString());
	
	var num_next = $("#" + next).attr("name");
	var num_prev = $("#" + prev).attr("name");
	var max = $("#" + next).attr("type");
	
	num_next = parseInt(num_next,10);
	num_prev = parseInt(num_prev,10);
	max =  parseInt(max,10);
	
	$("." + type).hide("slow");
	console.log("Вот она - " + num_prev); 
	if(num_prev == 0){
		console.log("Popal");
		$("#" + prev).css("display", "none");
	}
	
	for(i = num_prev; i < num_next; i++){
		$("#" + i + type).show("slow");
	} 
	
	num_next = num_next + 8;
	num_prev = num_prev + 8;

	$("#" + next).attr("name", num_next.toString());
	$("#" + prev).attr("name", num_prev.toString());
}

$(document).ready(function(){
	$("#zapis").on('click',function(event){
		$("#change_h").text("Записаться на вебинар");
		$("#button_submit").attr("name", "zapis_na_veb");
	});
});