(function ($) {

var host = window.location.hostname;

    startLoading();

    var southWest = L.latLng(-90, 180),
    northEast = L.latLng(90, -180),
    bounds = L.latLngBounds(southWest, northEast);

    L.mapbox.accessToken = 'pk.eyJ1IjoiYnBlcmljayIsImEiOiJrT2xBSUNzIn0.n-CVAwFlqHGqkiDUxsIdSQ';
    var map = L.mapbox.map('map', 'bperick.d9650d93', {
        tileLayer : {
                    continuousWorld: false,        
                    noWrap: true
        },
        scrollWheelZoom:false,
        doubleClickZoom:false,
        maxBounds: bounds,
        minZoom: 2 
       
    });
    map.setView([40, 0], 2);

    

    //TODO Single Origin Policy, and abstract.  
    var markerLayer = L.mapbox.featureLayer().addTo(map).on('ready', finishedLoading); 

    

    markerLayer.loadURL(homeLink.endpointURL);

    markerLayer.on('layeradd', function(e) {
        var marker = e.layer,
            feature = marker.feature;

        //Template for Custom Tooltip        
        //
        if (feature.properties.preliminary === 'preliminary') {
            var popupContent = '<p class="map-title">' + feature.properties.title +  '</p>' +
                               '<p class="map-date">' + feature.properties.date +  '</p>' +
                               '<p class="map-excerpt">' + feature.properties.excerpt +                             
                               '</p>'; 

        } else {        
        var popupContent = '<a href="' + feature.properties.link + '">' +
                            '<p class="map-title">' + feature.properties.title +  '</p>' +                            
                            '<p class="map-date">' + feature.properties.date +  '</p>' +
                            '<p class="map-excerpt">' + feature.properties.excerpt + 
                            '<a class="map-link" href="' + feature.properties.link + '">' +
                            '</a>' +
                        '</p></a>'; 
        }

        marker.bindPopup(popupContent,{
        closeButton: true,
        minWidth: 320
    });

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

   
    
    // markerLayer.on('mouseout', function(e) {
    // e.layer.closePopup();
    // });







    
 

}(jQuery)); 