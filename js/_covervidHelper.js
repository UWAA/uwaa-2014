jQuery(document).ready(function($) {

    var currentPage = window.location.pathname;
    var path = '/veterans/';    

    if (currentPage === path) {        
        $('.covervid-video').coverVid(670, 380);
    }    
    
});  

    
    


    
