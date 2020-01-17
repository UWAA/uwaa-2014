(function($) {

    // var $addressCheckBox = $('.tours-form-print');
    // var $enewsCheckBox = $('.tours-form-enews');
    // var $addressFields = $('.tours-address-fields');
    // var $emailField = $('.tours-email-field');
    var $submitButton = $('#tours-signup .submit-button');

    // $addressCheckBox.click(function() {
    //     if($addressCheckBox.is(':checked')) {
    //         $addressFields.show();
    //         $submitButton.css('display', 'inline-block');
    //     } else {
    //         if($enewsCheckBox.prop('checked') === false) {
    //             $submitButton.hide();
    //         }
    //         $addressFields.hide();
    //     }
    // });

    // $enewsCheckBox.click(function() {
    //     if($enewsCheckBox.is(':checked')) {            
    //         $emailField.show();
    //         $submitButton.css('display', 'inline-block');        
    //     } else {
    //         if($addressCheckBox.prop('checked') === false) {
    //             $submitButton.hide();
    //         }
    //         $emailField.hide();
    //     }
    // });

    
    $submitButton.click(function() {
        $('#form13').submit();
    });


})(jQuery);