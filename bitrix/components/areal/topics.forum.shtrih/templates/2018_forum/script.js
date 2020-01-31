$(document).ready(function(){
	var posBottomLi;
	var displayLi = false;
	
	//info
	/* var posBlockText = $(".main_seo_table").offset().top + $(".main_seo_table").height() - $('.info-company').height()-40;
	$('.info-company').offset({top: posBlockText}); */
	//var posBlockArticles = $(".block.articles:last").offset().top + $(".block.articles:last").height();
	var posBlockArticles = $(".info.info-company").offset().top;// + $(".block.articles:last").height();
	var height = posBlockArticles - $(".topics-forum").offset().top - 53;
		
	var lastPostDate = $(".topics-forum input[name=last_topic_date]").val();
	var compPath = $(".topics-forum input[name=comp_path]").val();
	var html = "";
	
	function hiddenLi(){
		$(".topics-forum .blockCont ul li:visible").each(function(){
			posBottomLi = $(this).offset().top + $(this).innerHeight();
			if(posBottomLi > posDivAllTopic || displayLi)
			{
				$(this).css({"visibility":"hidden"});
				displayLi = true; 
			}
		});
	}

	function getDataXml(){
		
		$.ajax({
			type: "POST",
			url: compPath + "/ajax.php",
			data: {lastPostDate: lastPostDate},
			success: function(data){
				if(data)
				{
					$(".topics-forum").addClass("shadow");
					lastPostDate = data["LAST_DATE"];
					displayLi = false;
					html = "";
					for(var p in data["ITEMS"]) {
						html += '<li><a href="'+data["ITEMS"][p]["LINK"]+'" title="" target="_blank">'+data["ITEMS"][p]["TITLE"]+'</li>';
						
					}
					$(".topics-forum .blockCont ul").empty();
					$(".topics-forum .blockCont ul").prepend(html);
					
					hiddenLi();
					setTimeout(function(){
						$(".topics-forum").removeClass("shadow");
					}, 500)
				}
			},
			dataType: "json"
		});
	}
	
	height = (height < 205) ? 205 : height;
	$(".topics-forum .blockCont").css({"height":height, "overflow":"hidden"});
	
	posDivAllTopic = $(".topics-forum .all-topics").offset().top;
	hiddenLi();
	setInterval(getDataXml, 60000);
});