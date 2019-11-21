(function ($) {

    // build Jquery object of all the links  to the member store 

    var $joinLinks = $('a[href]').filter(function (index) {
        return $(this).attr('href').includes('join-or-renew')
    });

    // Parse the current URL
    var urlParameters = ( new URL(document.location).searchParams );

    // remove UTM tags, if present
    if (urlParameters.search.includes('utm')) {
        
        urlParameters.each(function () {
            console.log($(this));
        });
    }
    

    if (location.search.includes('appealcode')) {

        $joinLinks.each(function () {
            var href = $(this).attr('href');

            if (href.indexOf('?') !== -1) {
                // Query string exists, append current query string
                href += '&' + location.search.replace(/^\?/, '');
            } else {
                // No query string yet, add it
                href += location.search;
            }

            $(this).attr('href', href);
        });
        
    }

    





}(jQuery)); 