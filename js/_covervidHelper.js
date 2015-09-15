jQuery(document).ready(function($) {

    if(!$.isFunction($.fn.coverVid) ) {        
        return;        
    }


    var currentPage = window.location.pathname;    
    var currentSearch = window.location.search;
    var isVetsPage = currentPage.match(/veterans/);
    var isPreview = currentSearch.match(/preview/);
    var path = '/alumni/veterans/';

    if (Array.isArray(isVetsPage) || Array.isArray(isPreview)) {

        $('#waving-flag-video').on('canplay', function() {

            $('.covervid-video').coverVid(854, 480);

            document.getElementById('waving-flag-video').play();

            $('#waving-flag-video').fadeIn(1000);               
            

        _.delay(function(){
        
            $('.covervid-video').fadeOut(2000);
        
        }, 
        6000);




        });

        
    }
    
});  

    
    


    
