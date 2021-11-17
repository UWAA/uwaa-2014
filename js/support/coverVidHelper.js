jQuery(document).ready(function($) {

    if(!$.isFunction($.fn.coverVid) ) {        
        return;        
    }

        $('#cyber-video').on('canplay', function() {

            $('.covervid-video').coverVid(854, 480);

            document.getElementById('cyber-video').play();




        });

        
    
    
});  

    
    


    
