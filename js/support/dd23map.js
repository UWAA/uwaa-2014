L.mapbox.accessToken = 'pk.eyJ1IjoiYnBlcmljayIsImEiOiJrT2xBSUNzIn0.n-CVAwFlqHGqkiDUxsIdSQ';
var map = L.mapbox.map('map', null, {
    center: [47.663, -122.308],
    zoom: 13.5,
    scrollWheelZoom: false
});
    
    L.mapbox.styleLayer('mapbox://styles/bperick/cl3xc38ar000115qmby77jmwd').addTo(map);

map.legendControl.addLegend(document.getElementById('legend').innerHTML);