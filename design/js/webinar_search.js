$(document).ready(function(){
    var $elements = $('.webinars_list_item');
    $('#webinar_search').on('keyup input', function() {
        var value = this.value;
        $elements.hide();
		$elements.each(function(index, element){
			if ( $(this).find('.text_item h2').text().toLowerCase().indexOf(value.toLowerCase()) != -1 ) {
				$(this).show();
			}
			if ( $(this).find('.text_item p').text().toLowerCase().indexOf(value.toLowerCase()) != -1 ) {
				$(this).show();
			}
		});
    });
});