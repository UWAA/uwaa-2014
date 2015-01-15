(function ($) {

var host = window.location.hostname;



    L.mapbox.accessToken = 'pk.eyJ1IjoiYnBlcmljayIsImEiOiJrT2xBSUNzIn0.n-CVAwFlqHGqkiDUxsIdSQ';
    var map = L.mapbox.map('map', 'bperick.d9650d93', {
        tileLayer : {
                    continuousWorld: false,        
                    noWrap: true
        },
        scrollWheelZoom:false,
        doubleClickZoom:false,
       
    });
    map.setView([40, 0], 2);



    //TODO Single Origin Policy, and abstract.  
    var markerLayer = L.mapbox.featureLayer().addTo(map);

    markerLayer.on('layeradd', function(e) {
        var marker = e.layer,
            feature = marker.feature;

        //Template for Custom Tooltip        
        var popupContent = '<a href="' + feature.properties.link + '">' +
                            '<p class="map-title">' + feature.properties.title +  '</p>' +
                            '<p class="map-date">' + feature.properties.date +  '</p>' +
                            '<p class="map-excerpt">' + feature.properties.excerpt + 
                            '<a class="map-link" href="' + feature.properties.link + '">' +
                            '</a>' +
                        '</p></a>'; 

        marker.bindPopup(popupContent,{
        closeButton: true,
        minWidth: 320
    });

    });

   
    
    // markerLayer.on('mouseout', function(e) {
    // e.layer.closePopup();
    // });


markerLayer.loadURL(homeLink.endpointURL);




    
 

}(jQuery)); 