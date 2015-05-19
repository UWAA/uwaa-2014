(function($) {

    $('.tours-form-print').click(function() {
        if($('.tours-form-print').is(':checked')) {
            $('.tours-address-fields').show();
        } else {
            $('.tours-address-fields').hide();
        }
    });

    $('.tours-form-enews').click(function() {
        if($('.tours-form-enews').is(':checked')) {            
            $('.tours-enews-fields').show();
        } else {
            $('.tours-enews-fields').hide();
        }
    });

    $('#tours-signup .submit-button').click(function() {
        $('#form13').submit();
    });


})(jQuery);