$(document).ready(function() {


    var currentPage = window.location;
    var currentPage = parseURL(currentPage);

    //Caching Rows
    var $baseSet = $('#join-renew-option-set');
    var $joinSet = $('#join-option-set');    
    var $renewSet = $('#renew-option-set');
    var $store = $('#store');
    var $breadcrumbs = $('#store-breadcrumbs');
    var $reset = $('#reset');
    var $goback = $('#go-back');


    init();


    $('.has-options').click(function(){
        var targetedOptions = this.id;
        var selectedType = $(this).find('h2').html();
        $(this).parents(".option-row").fadeOut(300, function() {
            $(this)
                .siblings("#"+targetedOptions+"-options")
                .fadeIn(300)
                .data('showing', 'TRUE');            
            $goback.fadeIn().css("display","inline-block");
            replaceBreadcrumbs(selectedType);

            });
    });


    $reset.on('click', function(event){        
        reset();
    })

    $goback.on('click', function(event){        
        goBack();
    })

    $('.main-options').click(function(){
        var targetedOptions = this.id;
        var selectedType = $(this).find('h2').html();
         $(this).parents(".option-row").fadeOut(300, function() {
            $store
                .find("#"+targetedOptions+"-option-set")
                .fadeIn(300)
                .data('showing', 'TRUE');
            $reset.fadeIn().css("display","inline-block");
            showBreadcrumbs(selectedType);
        });
    })
  

    function hideNonPrimaryRows() {
        $store.find('.option-row').not('.primary').fadeOut(300);
    }

    function goBack() {

        $store.find(".option-row:visible").fadeOut(300, function() {
            $(this)
                .siblings(".primary")
                .fadeIn(300)
                .data('showing', 'TRUE');
            $goback.fadeOut('300').css({
                display: 'inline-block'
            });
        });


    }



    
    function reset() {
        $store.find('.option-set:visible').fadeOut(300, function(event) {
        $reset.fadeOut(300);
        $goback.fadeOut('300');
        $breadcrumbs.find('span').html('Would you like to join the UWAA, or renew your current membership?');
        hideNonPrimaryRows();  
        init();
        });       
         
      
    }

    function init() {
          if (currentPage.params.hasOwnProperty('renew')) {            
        $renewSet
            .find('.primary').show(function() {
                $renewSet.fadeIn(300);
                $breadcrumbs.find('span').html('Renew your membership');                
            })
            
        } else if (currentPage.params.hasOwnProperty('join'))  {
        $joinSet
            .find('.primary').show(function() {
                $joinSet.fadeIn(300);
                $breadcrumbs.find('span').html('Join UWAA');
            })
            
        } else {
            $store
            .find('.primary').show(function() {                
                $baseSet.fadeIn(300);                
            })  
        }
    }    

    function replaceBreadcrumbs(rawMembershiptype){
        var type = rawMembershiptype.charAt(0).toUpperCase() + rawMembershiptype.slice(1);
        $breadcrumbs.find('span').html('You chose: ' + type + ' Membership');

    }
    
    function showGoBackButton(){
        $goback.fadeIn().css("display","inline-block");
    }

    

    function showBreadcrumbs(rawMembershiptype)
    {
        var type = rawMembershiptype.charAt(0).toUpperCase() + rawMembershiptype.slice(1);        
        switch(type){
            case 'Join':
                $breadcrumbs.find('span').html('Join UWAA');
            break;

            case 'Renew':
                $breadcrumbs.find('span').html('Renew your membership');
            break;

            default:
                ""
        }
        
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