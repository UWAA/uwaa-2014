jQuery(document).ready(function($) {

    if(!$.isFunction($.fn.coverVid) ) {        
        return;        
    }

    var currentPage = window.location.pathname;    
    var currentSearch = window.location.search;
    var isPreview = currentSearch.match(/preview/);
    var path = '/alumni/veterans/';

    if (currentPage === path || Array.isArray(isPreview)) {        


        $('.covervid-video').coverVid(670, 380);
    }
    
});  

    
    


    
