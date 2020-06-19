mapboxgl.accessToken = "pk.eyJ1IjoiYnBlcmljayIsImEiOiJrT2xBSUNzIn0.n-CVAwFlqHGqkiDUxsIdSQ";
var usCenter = [-100, 38];
var path = window.location.pathname.split('/').filter(function(n){ return n !== ''; }).pop();
var map = new mapboxgl.Map({
    container: 'map',
    style: 'mapbox://styles/bperick/ckbh38dq004dl1inqeej0mih0',
    center: usCenter,
    zoom: 3, 
    renderWorldCopies: false,
    fadeDuration: 0
});

var nav = new mapboxgl.NavigationControl({
    showCompass: false,
    showZoom: true
});
map.addControl(nav, 'top-left');

var endPoint = homeLink.endpointURL;

map.on('load', function() {
    map.loadImage(
        'https://a.tiles.mapbox.com/v4/marker/pin-m+4b2e83.png?access_token=pk.eyJ1IjoiYnBlcmljayIsImEiOiJrT2xBSUNzIn0.n-CVAwFlqHGqkiDUxsIdSQ',
        function(error, image) {
            if (error) throw error;
            map.addImage('marker', image);
            map.addSource('communities', {
                type: 'geojson',
                data: endPoint
            });
            map.addLayer({
                id: 'unclustered-point',
                type: 'symbol',
                source: 'communities',
                layout: {
                    'icon-image': 'marker',
                    'icon-size': 1,
                    'icon-allow-overlap': true,
                    'icon-ignore-placement': true
                }
            });
            finishedLoading();
        }
    );
});


var firstLoad = true;

function finishedLoading() {
    if (firstLoad) {
        loader.className = 'done';
        setTimeout(function() {
            // then, after a half-second, add the class 'hide', which hides
            // it completely and ensures that the user can interact with the
            // map again.
            loader.className = 'hide';
        }, 100);
    }
    firstLoad = false;
}

map.on('click', 'unclustered-point', function(e) {
    map.getCanvas().style.cursor = 'pointer';

    var features = map.queryRenderedFeatures(e.point, {
        layers: ['unclustered-point']
    });

    var coordinates = e.features[0].geometry.coordinates.slice();

    features.map(function(feat) {
        var popupContent = '<a href="' + feat.properties.link + '" data-chapter="' + feat.properties.jumper +  '">' +
                    '<div class="map-logo ' + feat.properties.logo + '"></div>' +
                    '<p class="map-excerpt">' + feat.properties.excerpt + '</a>' +
                    '<a class="map-link" href="' + feat.properties.link + '">' +
                    '</a></p>';

        $(popupContent).click(function(){
            var chapterToFind = this.dataset.chapter;

            var $pageAccordionContent = $('.collapse p');           
            var $accordionWithChapter = $pageAccordionContent.children( "#"+chapterToFind+"" ).parents('.panel');            
            var $indicator = $accordionWithChapter.find(".indicator:first");
            var $content = $accordionWithChapter.children('.collapse');

            $accordionWithChapter.removeClass('closed').addClass('open');
            $indicator.attr("aria-expanded", "true");
            $indicator.text("Expanded");
            $indicator.css({ "position": "absolute", "clip": "rect(1px, 1px, 1px, 1px)" });
            $content.show().attr("aria-hidden", "false");

            $('html, body').animate({                
                scrollTop: $content.offset().top - 100
            }, 500);
        });
                    
        new mapboxgl.Popup({
            closeButton: true,
            closeOnClick: true,
            })
            .setLngLat(coordinates)
            .setHTML(popupContent)
            .addTo(map); 
    });
    map.flyTo({
        center: coordinates,
    });
});

map.on('mouseenter', 'unclustered-point', function(e) {
    map.getCanvas().style.cursor = 'pointer';
});

map.on('mouseleave', 'unclustered-point', function() {
    map.getCanvas().style.cursor = '';
});

function isSecure() {
    return location.protocol == 'https:';
}

if (isSecure()) {
    var endPoint = endPoint.replace(/^http:\/\//i, 'https://');
} 



   
