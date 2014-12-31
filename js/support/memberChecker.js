// checker.js
$(document).ready(function(){
$('form#loginForm').on('submit', function(event) {
// @TODO  Pull  canvas stuff.  Here for debugging
var canvas = $('#output'),
    form = $(this);

    

     $.ajax({
            type: form.attr('method'),
            url: 'sti_memberservices.php',
            data: form.serialize(),

            // Remove for prod @TODO
            success: function(data) {
                canvas.html(data);
                        
                    
            },
            //Remove for prod @TODO
            error: function(data){
                canvas.html(data);
           
            }
        });
     event.preventDefault();

});
});