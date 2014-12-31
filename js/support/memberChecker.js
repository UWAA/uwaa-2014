// checker.js
$(document).ready(function(){
$('form#loginForm').on('submit', function(event) {
// @TODO  Pull  canvas stuff.  Here for debugging
var canvas = $('#output'),
    form = $(this);   

     $.ajax({            
            type: form.attr('method'),
            action: 'callMemberChecker'            ,
            url: callMemberCheckerAJAX.ajaxurl,
            data: form.serialize(),
            // Remove for prod @TODO
            success: function(data) {
                console.log('success');
                canvas.html(data);
                        
                    
            },
            //Remove for prod @TODO
            error: function(data){
                console.log('error');
                canvas.html(data);
           
            }
        });
     event.preventDefault();

});

});