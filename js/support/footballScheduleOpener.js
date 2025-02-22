(function($) {   

    var currentPage = window.location;
    var nameOfPage = 'football';

    var path = currentPage.pathname.split('/').filter(function(n){ return n !== ''; }).pop();

    
    //This function should only run on one page.
    if (path === nameOfPage) {

    //http://james.padolsey.com/javascript/parsing-urls-with-the-dom/
    function parseURL(url) {
    var a =  document.createElement('a');
        a.href = url;
        return {
            source: url,
            protocol: a.protocol.replace(':',''),
            host: a.hostname,
            port: a.port,
            query: a.search,
            params: (function(){
                var ret = {},
                    seg = a.search.replace(/^\?/,'').split('&'),
                    len = seg.length, i = 0, s;
                for (;i<len;i++) {
                    if (!seg[i]) { continue; }
                    s = seg[i].split('=');
                    ret[s[0]] = s[1];
                }
                return ret;
            })(),
            file: (a.pathname.match(/\/([^\/?#]+)$/i) || [,''])[1],
            hash: a.hash.replace('#',''),
            path: a.pathname.replace(/^([^\/])/,'/$1'),
            relative: (a.href.match(/tps?:\/\/[^\/]+(.+)/) || [,''])[1],
            segments: a.pathname.replace(/^\//,'').split('/')
        };
    }

    var currentPage = parseURL(currentPage);
    
    //Cache Bust Check
        if (currentPage.hash == 'schedule' || currentPage.hash == 'broadcast' || currentPage.hash == 'warmup' || currentPage.hash == 'parties' || currentPage.hash == 'viewing-parties' || currentPage.hash == 'events') {

        var $pageAccordionContent = $('#accordion .panel .collapse p');
        
        var $accordionWithChapter = $pageAccordionContent.children("#"+currentPage.hash).parents('.panel');
        // var $accordionWithChapter = $pageAccordionContent.children("#" + chapterToFind + "").parents('.panel');
        var $indicator = $accordionWithChapter.find(".indicator:first");
        var $content = $accordionWithChapter.children('.collapse');

            $accordionWithChapter.removeClass('closed').addClass('open');
            $indicator.attr ("aria-expanded", "true");
            $indicator.text ("Expanded");
            $indicator.css({"position": "absolute", "clip": "rect(1px, 1px, 1px, 1px)"});
            $content.show ().attr("aria-hidden", "false");


        $('html, body').animate({
            // scrollTop: $("#"+chapterToFind+"").offset().top - 150
            scrollTop: $content.offset().top - 100
        }, 500);

        
        
    }






        

    }



})(jQuery);