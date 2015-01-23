$(document).ready(function() {


    var currentPage = window.location;
    var currentPage = parseURL(currentPage);

    //Caching Rows
    var $joinSet = $('#join-option-set');    
    var $renewSet = $('#renewal-option-set');
    var $store = $('#store');
    var $breadcrumbs = $('#store-breadcrumbs');
    var $reset = $('#reset');
    // var join-options = document.getElementByID(join);
    // var join-options = document.getElementByID(join);


    init();


    $('.has-options').click(function(){
        var targetedOptions = this.id;
        var selectedType = $(this).find('h2').html();
        console.log(selectedType);
        $(this).parents(".option-row").hide(function() {
            $(this)
                .siblings("#"+targetedOptions+"-options")
                .fadeIn(600)
                .data('showing', 'TRUE');
            showBreadcrumbs(selectedType);
            });
    });

    $reset.click(function(){
        reset();
    })
  

    
    function reset() {
        $store.find('.option-row:visible').hide();
        $breadcrumbs.hide();
        console.log('resetting');
        init();      
      
    }

    function init() {
          if (currentPage.params.hasOwnProperty('renew')) {
        $renewSet
            .find('.primary').show(function() {
                $renewSet.fadeIn(600);    
            })
            
        } else {
        $joinSet
            .find('.primary').show(function() {
                $joinSet.fadeIn(600);    
            })
            
        }
    }

    $('.uwaa-btn-wrapper').click(function() {
        init();
    });
    

    

    function showBreadcrumbs(rawMembershiptype)
    {
        var type = rawMembershiptype.charAt(0).toUpperCase() + rawMembershiptype.slice(1);
        console.log(type);
        $breadcrumbs.show();
        $breadcrumbs.find('span').html(''+type + ' Membership');
    }


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

});