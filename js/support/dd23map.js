L.mapbox.accessToken = 'pk.eyJ1IjoiYnBlcmljayIsImEiOiJrT2xBSUNzIn0.n-CVAwFlqHGqkiDUxsIdSQ';
var map = L.mapbox.map('map')
    .setView([47.661, -122.308], 14)
    .addLayer(L.mapbox.styleLayer('mapbox://styles/bperick/cl3xc38ar000115qmby77jmwd'));

map.legendControl.addLegend(document.getElementById('legend').innerHTML);