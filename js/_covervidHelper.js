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


        $('.covervid-video').coverVid(670, 380);
    }
    
});  

    
    


    
