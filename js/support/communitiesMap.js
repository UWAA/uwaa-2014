(function ($) {

var path = window.location.pathname.split('/').filter(function(n){ return n !== ''; }).pop()
var asiaCenter = [20.539359, 114.027324];
var usCenter = [39.833333, -98.583333];
var uiMenu = $("#mapNavigation");

    L.mapbox.accessToken = 'pk.eyJ1IjoiYnBlcmljayIsImEiOiJrT2xBSUNzIn0.n-CVAwFlqHGqkiDUxsIdSQ';
    var map = L.mapbox.map('map', 'bperick.d9650d93', {
        tileLayer : {
                    continuousWorld: false,        
                    noWrap: true
                },
        scrollWheelZoom:false,
        doubleClickZoom:false,
        });
    if (path === 'international-huskies') {
        map.setView(asiaCenter, 3);
    } else if (path === 'u-s-huskies') {
        map.setView(usCenter, 4);
    } else {
        uiMenu.css('display', 'block');
        map.setView([39.833333, -98.583333], 4);
    }

    
    $('#usNav').on('click', function() {
        map.setView(usCenter, 4);
    });

    $('#asiaNav').on('click', function() {
        map.setView(asiaCenter, 3);
    });


    //, and abstract.  
    var markerLayer = L.mapbox.featureLayer().addTo(map);

    markerLayer.on('layeradd', function(e) {
        var marker = e.layer,
            feature = marker.feature;

        //Template for Custom Tooltip        
        var popupContent = '<a href="' + feature.properties.link + '">' +
                            '<div class="map-logo '+ feature.properties.logo +'"></div>' +
                            '<p class="map-excerpt">' + feature.properties.excerpt + '</a>' +
                            '<a class="map-link" href="' + feature.properties.link + '">' +                            
                        '</a></p>'; 

        marker.bindPopup(popupContent,{
        closeButton: true,
        minWidth: 320
    });
    
    });

    // markerLayer.on('mouseover', function(e) {
    // e.layer.openPopup();
    // });
    
    // markerLayer.on('mouseout', function(e) {
    // e.layer.closePopup();
    // });


markerLayer.loadURL(homeLink.endpointURL);



    
 

}(jQuery)); 