/* -------------------------------------
	Галерея с неравномерным шагом
	autor: Alexandr Golovko 
	www.xiper.net
----------------------------------------	
*/
(function(jQuery){
    
    jQuery.fn.flsGallery = function(options) {
 		/*if(jQuery.browser.safari && document.readyState != "complete") {
			setTimeout(arguments.callee, 100 );
			return;
		}*/
		var ap_time=0;
		var stop_auto=false;
		var settings = jQuery.extend({
			btnNext: "#btnNext",
			btnPrev: "#btnPrev",
			mouseWheel: true,
			speed: 200,
			auto: false,
			stop_option: false,
			circular: false,
			visible: 3
        }, options);
 
        this.each(function(){
			jQuery(this).wrapInner("<div class='flsGalleryInner'></div>");
			var containerWidth = jQuery(this).width();
            var current = 0;
            var currentNext = 0;
			var totalWidth = 0;
			var points = new Array();
			var count;	
			var i;	
			var autoScroll = true;
			function initial(padding) {
				i=0;
				totalWidth = 0;
				delete points;
				points = new Array();
				points[0]=0;
				
				if(!padding)
					padding = 0;
				totalWidth = totalWidth + padding;
				jQuery(".flsGalleryInner li").each(function(){
					totalWidth += jQuery(this).width();
					i++;
					points[i] = totalWidth;
					
					//totalWidth += jQuery(this).outerWidth(true);
				});
				if(css(jQuery(".flsGalleryInner"), 'paddingLeft'))
					left = css(jQuery(".flsGalleryInner"), 'paddingLeft');
				else left = 0;
				jQuery(".flsGalleryInner").css("width", totalWidth+2+left);
				count =i++;
			}
			initial();
	
			if (containerWidth > totalWidth) jQuery(settings.btnNext).addClass('disabled');
			
			if(settings.auto) {
				autoScroll = setInterval(function() { 
					if(!stop_auto)
						goNext();
				}, settings.auto+settings.speed);
				if(settings.stop_option) {
					jQuery("#flsGallery").hover(
						function() {
							autoScroll = false;
							clearInterval(autoScroll);
						},
						function() {
							autoScroll = true;
							/*initial(0);
							autoScroll = setInterval(function() {
								goNext();
							}, settings.auto+settings.speed);
							//settings.circular = true;*/
						}
					);
				}
			}			
			
			if(settings.btnPrev)
            	jQuery(settings.btnPrev).click(function() {
					if(settings.auto) {
						autoScroll = false;
						clearInterval(autoScroll);
					}
					stop_auto=true;
					goPrev();
	            });

        	if(settings.btnNext)
            	jQuery(settings.btnNext).click(function() {
					if(settings.auto) {
						autoScroll = false;
						clearInterval(autoScroll);
					}
					stop_auto=true;
					goNext();
				});


			if(settings.mouseWheel) {
				jQuery('.flsGalleryInner').bind('mousewheel', function(event, delta) {
					return delta>0 ? goPrev() : goNext();
				});
			}

			function goNext() {
				if (!jQuery(settings.btnNext).hasClass('disabled')  || (ap_time+settings.speed<new Date().getTime()))
				{	
					var i=0;
					if(!current) current = 0;
					while(points[i]-current <= containerWidth) {
						i++;
					}
					
					if(i== 0 || i > count) {
						if(css(jQuery(".flsGalleryInner"), 'paddingLeft'))
							sdvig = css(jQuery(".flsGalleryInner"), 'paddingLeft');
						else sdvig = 0;
						sdvig = sdvig + width(jQuery(".flsGalleryInner ul li:first"));
						jQuery(".flsGalleryInner ul li:first").appendTo(".flsGalleryInner ul");
						jQuery(".flsGalleryInner").css("padding-left", sdvig);
						initial(sdvig);
						i--;
					}
					else {
						if (i == count && !settings.circular) {
							jQuery(settings.btnNext).addClass('disabled');
						}
					}
					jQuery(settings.btnPrev).removeClass('disabled');
					goRight(containerWidth - points[i]);
					current = points[i] - containerWidth;
					
				}
			}
			
			function goPrev() {
				
				if (!jQuery(settings.btnPrev).hasClass('disabled')  || (ap_time+settings.speed<new Date().getTime()))
				{
					var i=0;  
					while (points[i] < current ) {
						i++;
					}
					current = points[i-1];
					
					if (i == 1) {
						current = 0;
						jQuery(".flsGalleryInner").css("padding-left", 0);
						initial();
					}
					if(i == 0) {
						jQuery(".flsGalleryInner ul").prepend(jQuery(".flsGalleryInner ul li").last());
						initial();
						jQuery(".flsGalleryInner").css("left", -points[i+1]);
						goLeft(points[i]);
					}
					else {
						jQuery(settings.btnNext).removeClass('disabled');
						goLeft(points[i-1]);					
					}
					
					jQuery(settings.btnNext).removeClass('disabled');
				}	
			}

			function goRight(pixel) {
				if(!autoScroll) {
					jQuery(settings.btnNext).addClass('disabled');
					jQuery(settings.btnPrev).addClass('disabled');
					jQuery(settings.btnPrev).addClass('no_dark');
					var now = new Date();
					ap_time=now.getTime();
				}
				jQuery(".flsGalleryInner").animate(
					{
						left: pixel
					},
					settings.speed,
					function() {
						if(!autoScroll) {
							jQuery(settings.btnNext).removeClass('disabled');
							jQuery(settings.btnPrev).removeClass('disabled');
							jQuery(settings.btnPrev).removeClass('no_dark');
						}
					}
				);
			}

			function goLeft(pixel) {
				if(!autoScroll) {
					jQuery(settings.btnNext).addClass('disabled');
					jQuery(settings.btnNext).addClass('no_dark');
					jQuery(settings.btnPrev).addClass('disabled');
					var now = new Date();
					ap_time=now.getTime();
				}
				jQuery(".flsGalleryInner").animate(
					{
						left: -pixel
					},
					settings.speed,
					function() {
						if(!autoScroll) {
							jQuery(settings.btnNext).removeClass('disabled');
							jQuery(settings.btnNext).removeClass('no_dark');
							jQuery(settings.btnPrev).removeClass('disabled');
						}
					}
				);			
			}
			function width(el) {
				return  el[0].offsetWidth + css(el, 'marginLeft') + css(el, 'marginRight');
			};
			function css(el, prop) {
				return parseInt($.css(el[0], prop)) || 0;
			};
        });
        
        return this;
        
    };
    
})(jQuery);