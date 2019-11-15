(function ($) {

    // build Jquery object of all the links  to the member store 

    var $joinLinks = $('a[href]').filter(function (index) {
        return $(this).attr('href').includes('join-or-renew')
    });

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