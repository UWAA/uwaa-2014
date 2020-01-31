mapboxgl.accessToken = "pk.eyJ1IjoiYnBlcmljayIsImEiOiJrT2xBSUNzIn0.n-CVAwFlqHGqkiDUxsIdSQ";
var map = new mapboxgl.Map({
    container: 'map',
    style: 'mapbox://styles/mapbox/light-v10',
    center: [0, 0],
    zoom: 0.5, 
    renderWorldCopies: false,
    fadeDuration: 0
});

var nav = new mapboxgl.NavigationControl({
    showCompass: false,
    showZoom: true
});
map.addControl(nav, 'top-left');

var endPoint = homeLink.endpointURL;

map.on('styledata', finishedLoading);

map.on('load', function() {
    map.loadImage(
        'https://a.tiles.mapbox.com/v4/marker/pin-m+4b2e83.png?access_token=pk.eyJ1IjoiYnBlcmljayIsImEiOiJrT2xBSUNzIn0.n-CVAwFlqHGqkiDUxsIdSQ',
        function(error, image) {
            if (error) throw error;
            map.addImage('marker', image);
            map.addSource('tours', {
                type: 'geojson',
                data: endPoint,
                cluster: true,
                clusterMaxZoom: 12, 
                clusterRadius: 40
            });
            map.addLayer({
                id: 'clusters',
                type: 'circle',
                source: 'tours',
                filter: ['has', 'point_count'],
                paint: {
                    'circle-color': [
                        'step',
                        ['get', 'point_count'],
                        '#f0ddaf',
                        5,
                        '#b7a57a',
                        10,
                        '#85754d'
                    ],
                    'circle-radius': [
                        'step',
                        ['get', 'point_count'],
                        25,
                        5,
                        30,
                        10,
                        35
                    ]
                }
            });
            map.addLayer({
                id: 'cluster-count',
                type: 'symbol',
                source: 'tours',
                filter: ['has', 'point_count'],
                layout: {
                    'text-field': '{point_count_abbreviated}',
                    'text-font': ['Open Sans Regular', 'Arial Unicode MS Bold'],
                    'text-size': 16,
                    'text-allow-overlap': true
                },
                paint: {
                    'text-color': '#000',
                    'text-halo-color': '#fff',
                    'text-halo-width': 0.75
                }
            });
            map.addLayer({
                id: 'unclustered-point',
                type: 'symbol',
                source: 'tours',
                filter: ['!', ['has', 'point_count']],
                layout: {
                    'icon-image': 'marker',
                    'icon-size': 1,
                    'icon-allow-overlap': true
                }
            });
        }
    );
});

// inspect a cluster on click
map.on('click', 'clusters', function(e) {
    var features = map.queryRenderedFeatures(e.point, {
        layers: ['clusters']
    });
    var clusterId = features[0].properties.cluster_id;
    map.getSource('tours').getClusterExpansionZoom(
        clusterId,
        function(err, zoom) {
            if (err) return;
            map.easeTo({
                center: features[0].geometry.coordinates,
                zoom: zoom
            });
        }
    );
});
    
map.on('mouseenter', 'clusters', function() {
    map.getCanvas().style.cursor = 'pointer';
});

map.on('mouseleave', 'clusters', function() {
    map.getCanvas().style.cursor = '';
});

var popup = new mapboxgl.Popup({
    closeButton: true,
    closeOnClick: false
});

map.on('mouseenter', 'unclustered-point', function(e) {
    map.getCanvas().style.cursor = 'pointer';
});

map.on('click', 'unclustered-point', function(e) {
    map.getCanvas().style.cursor = 'pointer';

    var coordinates = e.features[0].geometry.coordinates.slice();
    if (e.features[0].properties.preliminary === 'preliminary') {
    var description = '<p class="map-title">' + e.features[0].properties.title +  '</p>' +
                      '<p class="map-date">' + e.features[0].properties.date +  '</p>' +
                      '<p class="map-excerpt">' + e.features[0].properties.excerpt +                             
                      '</p>'; 

} else {        
    var description = '<a href="' + e.features[0].properties.link + '">' +
                    '<p class="map-title">' + e.features[0].properties.title +  '</p>' +                            
                    '<p class="map-date">' + e.features[0].properties.date +  '</p>' +
                    '<p class="map-excerpt">' + e.features[0].properties.excerpt + 
                    '<a class="map-link" href="' + e.features[0].properties.link + '">' +
                    '</a>' +
                    '</p></a>'; 
}

while (Math.abs(e.lngLat.lng - coordinates[0]) > 180) {
    coordinates[0] += e.lngLat.lng > coordinates[0] ? 360 : -360;
}

new mapboxgl.Popup()
    .setLngLat(coordinates)
    .setHTML(description)
    .addTo(map);
});

map.on('mouseleave', 'unclustered-point', function() {
    map.getCanvas().style.cursor = '';
});

function isSecure() {
    return location.protocol == 'https:';
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

if (isSecure()) {
    var endPoint = endPoint.replace(/^http:\/\//i, 'https://');
} 

//----------------------
//------------------




//---ORIGINAL CODE---

// (function ($) {

// var host = window.location.hostname;

//     startLoading();

//     var southWest = L.latLng(-90, 180),
//     northEast = L.latLng(90, -180),
//     bounds = L.latLngBounds(southWest, northEast);

//     L.mapbox.accessToken = 'pk.eyJ1IjoiYnBlcmljayIsImEiOiJrT2xBSUNzIn0.n-CVAwFlqHGqkiDUxsIdSQ';
//     var map = L.mapbox.map('map', 'bperick.d9650d93', {
//         tileLayer : {
//                     continuousWorld: false,        
//                     noWrap: true
//         },
//         scrollWheelZoom:false,
//         doubleClickZoom:false,
//         maxBounds: bounds,
//         minZoom: 2 

//     });
//     map.setView([40, 0], 2);



//     function isSecure() {
//         return location.protocol == 'https:';
//     }


//     var endPoint = homeLink.endpointURL;

//     if (isSecure()) {
//         var endPoint = endPoint.replace(/^http:\/\//i, 'https://');
//     }   

//     var markerLayer = L.mapbox.featureLayer().addTo(map).on('ready', finishedLoading);

//     markerLayer.loadURL(endPoint);

//     markerLayer.on('layeradd', function(e) {
//         var marker = e.layer,
//             feature = marker.feature;

//         //Template for Custom Tooltip        
//         //
//         if (feature.properties.preliminary === 'preliminary') {
//             var popupContent = '<p class="map-title">' + feature.properties.title +  '</p>' +
//                                '<p class="map-date">' + feature.properties.date +  '</p>' +
//                                '<p class="map-excerpt">' + feature.properties.excerpt +                             
//                                '</p>'; 

//         } else {        
//         var popupContent = '<a href="' + feature.properties.link + '">' +
//                             '<p class="map-title">' + feature.properties.title +  '</p>' +                            
//                             '<p class="map-date">' + feature.properties.date +  '</p>' +
//                             '<p class="map-excerpt">' + feature.properties.excerpt + 
//                             '<a class="map-link" href="' + feature.properties.link + '">' +
//                             '</a>' +
//                         '</p></a>'; 
//         }

//         marker.bindPopup(popupContent,{
//         closeButton: true,
//         minWidth: 280
//     });

//     });


//     function startLoading() {
//     loader.className = '';
//     }

// function finishedLoading() {    
//     loader.className = 'done';
//     setTimeout(function() {
//         // then, after a half-second, add the class 'hide', which hides
//         // it completely and ensures that the user can interact with the
//         // map again.
//         loader.className = 'hide';
//     }, 100);
// }



//     // markerLayer.on('mouseout', function(e) {
//     // e.layer.closePopup();
//     // });










// }(jQuery)); 