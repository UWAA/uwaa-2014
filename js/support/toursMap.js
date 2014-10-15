(function ($) {


    L.mapbox.accessToken = 'pk.eyJ1IjoiYnBlcmljayIsImEiOiJrT2xBSUNzIn0.n-CVAwFlqHGqkiDUxsIdSQ';
    var map = L.mapbox.map('map', 'bperick.jn9abl0c', {
       
    });
    map.setView([0, 0], 2);


    var featureLayer = L.mapbox.featureLayer()
    .loadURL('http://dev.alumni.washington.edu/wordpress/api/tours/geojson')
    .addTo(map);
 

}(jQuery)); 