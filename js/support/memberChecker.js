// checker.js
$(document).ready(function(){

$('input#memberCheckerLogout').on('click', function() {
    console.log('Clicked');
    $('form#memberloginForm').submit();
});

$('form#memberloginForm').on('submit', function(event) {
// @TODO  Pull  canvas stuff.  Here for debugging
var canvas = $('#form-message'),
    form = $(this);   

     $.ajax({            
            type: form.attr('method'),
            // action: 'callMemberChecker'            ,
            url: callMemberCheckerAJAX.ajaxurl,
            data: form.serialize(),
            dataType: 'json',
            // Remove for prod @TODO
            success: function(data) {

                if(!data.error) {
                    location.reload();
                } 
                canvas.html(data.message);
                    
            },
            //Remove for prod @TODO
            error: function(data){
                console.log('error');
                canvas.html(data);
           
            }
        });
     event.preventDefault();

});

$('#memberCheckerLogout').on('click', function() {
    console.log('Clicked');
    $('form#memberlogout').submit();
});

$('form#memberlogout').on('submit', function(event) {
    var canvas = $('#output'),
    form = $(this);   

     $.ajax({            
            type: form.attr('method'),
            url: callMemberCheckerAJAX.ajaxurl,
            data: form.serialize(),

            success: function(data) {
                console.log('success');
                location.reload();
            },

                error: function(data){
                console.log('error');
                canvas.html(data);
            }            
        });
     event.preventDefault();

});



});