(function($) {

    $('.tours-form-print').click(function() {
        if($('.tours-form-print').is(':checked')) {
            $('.tours-address-fields').show();
            $('.tours-enews-fields').hide();
        }
    });

    $('.tours-form-enews').click(function() {
        if($('.tours-form-enews').is(':checked')) {
            $('.tours-address-fields').hide();
            $('.tours-enews-fields').show();

        }
    });

    $('#tours-signup .submit-button').click(function() {
        $('#form13').submit();
    });


})(jQuery);