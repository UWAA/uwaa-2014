(function ($) {


    L.mapbox.accessToken = 'pk.eyJ1IjoiYnBlcmljayIsImEiOiJrT2xBSUNzIn0.n-CVAwFlqHGqkiDUxsIdSQ';
    var map = L.mapbox.map('map', 'bperick.d9650d93', {
        // tileLayer : {'bperick.d9650d93',
        //             continuousWorld: false,        
        //             noWrap: true
        //             }
       
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
                            '<p>' + feature.properties.excerpt + '</p>' +
                            '<a href="' + feature.properties.link + '">' +
                            'Learn More' +
                        '</a>'; 

        marker.bindPopup(popupContent,{
        closeButton: false,
        minWidth: 320
    });

    });

//Janky Test Stuff, but necessary for getting this working.
var host = window.location.hostname;

switch (host) {
    case "dev.alumni.washington.edu" : 
    markerLayer.loadURL('http://dev.alumni.washington.edu/wordpress/api/tours/geojson');
    break;

    case "54.69.164.216" :
    markerLayer.loadURL('http://54.69.164.216/uwaa_test/api/tours/geojson');
    break;

    default: 
    console.log ("Error Getting GEOJSON.  Host: "+host+"");

}





    
 

}(jQuery)); 