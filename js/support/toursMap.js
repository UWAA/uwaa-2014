(function ($) {


    L.mapbox.accessToken = 'pk.eyJ1IjoiYnBlcmljayIsImEiOiJrT2xBSUNzIn0.n-CVAwFlqHGqkiDUxsIdSQ';
    var map = L.mapbox.map('map', 'bperick.jn9abl0c', {
       
    });
    map.setView([0, 0], 2);

    //TODO Single Origin Policy, and abstract.  
    var markerLayer = L.mapbox.featureLayer().addTo(map);

    markerLayer.on('layeradd', function(e) {
        var marker = e.layer,
            feature = marker.feature;

        //Template for Custom Tooltip
        //@TODO Get custom excerpt into JSON feed.
        var popupContent = '<a href="' + feature.properties.link + '">' +
                            feature.properties.title +  '</a>' +
                            '<p>Custom Excerpt</p>' +
                            '<a href="' + feature.properties.link + '">' +
                            'Learn More' +
                        '</a>'; 

        marker.bindPopup(popupContent,{
        closeButton: false,
        minWidth: 320
    });

    });



    markerLayer.loadURL('http://dev.alumni.washington.edu/wordpress/api/tours/geojson');
 

}(jQuery)); 