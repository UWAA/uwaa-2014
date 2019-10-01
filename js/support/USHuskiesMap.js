(function ($) {

var usCenter = [39.833333, -98.583333];


//bounding work
var southWest = L.latLng(-90, 180),
    northEast = L.latLng(90, -180),
    bounds = L.latLngBounds(southWest, northEast);

    L.mapbox.accessToken = 'pk.eyJ1IjoiYnBlcmljayIsImEiOiJrT2xBSUNzIn0.n-CVAwFlqHGqkiDUxsIdSQ';
    var map = L.mapbox.map('map', 'bperick.d9650d93', {
        tileLayer : {
                    continuousWorld: true,        
                    noWrap: true
                },
        scrollWheelZoom:false,
        doubleClickZoom:false,
        maxBounds: bounds,
        });
    
        map.setView(usCenter, 4);
    

    
    
    

    startLoading();

  
    var endPoint = homeLink.endpointURL;

       

    var markerLayer = L.mapbox.featureLayer().addTo(map).on('ready', finishedLoading);

    markerLayer.loadURL(endPoint);

    markerLayer.on('layeradd', function(e) {
        var marker = e.layer,
            feature = marker.feature;

        //Template for Custom Tooltip        
        var popupContent = '<a href="' + feature.properties.link + '" data-chapter="' + feature.properties.jumper + '">' +
                            '<div class="map-logo ' + feature.properties.logo + '"></div>' +
                            '<p class="map-excerpt">' + feature.properties.excerpt + '</a>' +
                            '<a class="map-link" href="' + feature.properties.link + '">' +
                        '</a></p>';
        
        marker.bindPopup($(popupContent).click(function(){

           var chapterToFind = this.dataset.chapter;           

            var $pageAccordionContent = $('.collapse p');           
            var $accordionWithChapter = $pageAccordionContent.children( "#"+chapterToFind+"" ).parents('.panel');            
            var $indicator = $accordionWithChapter.find(".indicator:first");
            var $content = $accordionWithChapter.children('.collapse');

            $accordionWithChapter.removeClass('closed').addClass('open');
            $indicator.attr("aria-expanded", "true");
            $indicator.text("Expanded");
            $indicator.css({ "position": "absolute", "clip": "rect(1px, 1px, 1px, 1px)" });
            $content.show().attr("aria-hidden", "false");

            $('html, body').animate({                
                scrollTop: $content.offset().top - 100
            }, 500);


        })[0],
        {
        closeButton: true,
        minWidth: 320
        }

        )
    
    });


    function startLoading() {
    loader.className = '';
    }

function finishedLoading() {    
    loader.className = 'done';
    setTimeout(function() {
        // then, after a half-second, add the class 'hide', which hides
        // it completely and ensures that the user can interact with the
        // map again.
        loader.className = 'hide';
    }, 100);
}

    // markerLayer.on('mouseover', function(e) {
    // e.layer.openPopup();
    // });
    
    // markerLayer.on('mouseout', function(e) {
    // e.layer.closePopup();
    // });






    
 

}(jQuery)); 