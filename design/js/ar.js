$(function () {
    $(".SectName").click(function () {
        var k = $(this).attr('id');
        $(".SectName").each(function () {
            if ($(this).attr('id') != k) $(this).find('.departmentEmployees').hide();
        });
        $(this).find('.departmentEmployees').toggle();
    });
	$('a.testr').click(function(event){
		$(this).next().click();
		event.preventDefault();
	});
    $('.departmentEmployees').hide();
    $('.departmentEmployees:first').show();
    $(".name").click(function () {
        var k = $(this).attr('id');
        $(".name").each(function () {
            if ($(this).attr('id') != k) $(this).find('.description').hide();
        });
        $(this).find('.description').toggle();
    }

    );
    $('.description').hide();


    $("#respond").click(function () {
        $("#respond").hide();
        $("#form_vac").show();
    });
	$("form[name=vacancy_form] input[name=file]").change(function(){
		$(this).prev().prev().val($(this).val());
	});
    $("form[name=vacancy_form]").submit(function () {
        var error = 0;

        valid = true;

        if (!$("input[name=fio]").val()) {
            error = 1;
        }

        if (!$("input[name=mail]").val()) {
            error = 1;
        }

        if ($("#select_town :selected").val() == 0) {
            error = 1;
        }
        if ($("input[name=mail]").val()) {
            var re = /[0-9a-z_]+@[0-9a-z\-_^.]+\.[0-9a-z]/i;
            if (re.test($("input[name=mail]").val())) $("#email_error").hide();
            else {
                $("#email_error").show();
                valid = false;
            }
        }

        if (error == 1) {
            $("#empty_fields").show();
            valid = false;
        } else $("#empty_fields").hide();

        $("input[name=region_text]").val($("#select_region :selected").text());
        $("input[name=town_text]").val($("#region_partner :selected").text());

        return valid;
    });

});