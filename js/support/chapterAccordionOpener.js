(function($) {   

    var currentPage = window.location;
    var goodPages = ['u-s-huskies', 'international-huskies'];

    var path = currentPage.pathname.split('/').filter(function(n){ return n !== ''; }).pop();

    var isOkayToFire = goodPages.indexOf(path);

    
    //This function should only run on one page.
    if (isOkayToFire != -1) {

    console.log('firing');

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

    console.log(currentPage);

    // console.log(currentPage.params);
    
    //Another check, we are only going to search for a chapter if the URL has one.
    if (currentPage.hash != '') {

        

        // var chapterToFind = currentPage.params.chapter.replace("%20", " ");
        var chapterToFind = currentPage.hash;



        var $pageAccordionContent = $('#accordion .panel .collapse p');
        
        var $accordionWithChapter = $pageAccordionContent.children("#"+chapterToFind+"").parents('.panel');        
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