(function ($) {

    var path = window.location.pathname.split('/').filter(function (n) { return n !== ''; }).pop()
    var globalCenter = [20, 15];
    var usCenter = [39.833333, -98.583333];
    var uiMenu = $("#mapNavigation");

    //bounding work
    var southWest = L.latLng(-90, 180),
        northEast = L.latLng(90, -180),
        bounds = L.latLngBounds(southWest, northEast);

    L.mapbox.accessToken = 'pk.eyJ1IjoiYnBlcmljayIsImEiOiJrT2xBSUNzIn0.n-CVAwFlqHGqkiDUxsIdSQ';
    var map = L.mapbox.map('map', 'bperick.d9650d93', {
        tileLayer: {
            continuousWorld: true,
            noWrap: true
        },
        scrollWheelZoom: false,
        doubleClickZoom: false,
        maxBounds: bounds,
    });
    if (path === 'international-huskies') {
        map.setView(globalCenter, 2);
    } else if (path === 'u-s-huskies') {
        map.setView(usCenter, 4);
    } else {
        uiMenu.css('display', 'block');
        map.setView([39.833333, -98.583333], 4);
    }


    $('#usNav').on('click', function () {
        map.setView(usCenter, 4);
    });

    $('#asiaNav').on('click', function () {
        map.setView(globalCenter, 2);
    });

    startLoading();


    var markerLayer = L.mapbox.featureLayer().addTo(map).on('ready', finishedLoading);

    markerLayer.loadURL(homeLink.endpointURL);

    markerLayer.on('layeradd', function (e) {
        var marker = e.layer,
            feature = marker.feature;

        //Template for Custom Tooltip        
        var popupContent = '<a href="' + feature.properties.link + '">' +
            '<div class="map-logo ' + feature.properties.logo + '"></div>' +
            '<p class="map-excerpt">' + feature.properties.excerpt + '</a>' +
            '<a class="map-link" href="' + feature.properties.link + '">' +
            '</a></p>';

        marker.bindPopup(popupContent, {
            closeButton: true,
            minWidth: 320
        });

    });


    function startLoading() {
        loader.className = '';
    }

    function finishedLoading() {
        loader.className = 'done';
        setTimeout(function () {
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