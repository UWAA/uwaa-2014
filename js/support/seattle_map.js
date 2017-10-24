

var SW = L.latLng(47.6430704492123, -122.334308624268);
var NE = L.latLng(47.6774957780179, -122.274227142334);
var bounds = L.latLngBounds(SW, NE);

var clientWidth = $(window).width();

L.mapbox.accessToken = 'pk.eyJ1IjoiYnBlcmljayIsImEiOiJrT2xBSUNzIn0.n-CVAwFlqHGqkiDUxsIdSQ';
var map = L.mapbox.map('dawgdash-map', 'bperick.io0079f9', {
    tileLayer: {
        detectRetina: true,
    },
    maxBounds: bounds,
    minZoom: 14,
    scrollWheelZoom: false,
    doubleClickZoom: false,
    tap: false
});

if (clientWidth < 480) {
    map.setView([47.6774957780179, -122.6000], 14);
} else {
    map.setView([47.6774957780179, -122.6000], 14);
}






var course_ui = document.getElementById('course-ui');


// //Disable Scroll Wheel Zoom
// map.scrollWheelZoom.disable();



map.featureLayer.on('ready', function () {

    var typesObj = {};
    var types = [];
    var features = map.featureLayer.getGeoJSON().features;


    for (var i = 0; i < features.length; i++) {
        typesObj[features[i].properties.title] = true;
        //typesObj[features[i].geometry.type] = true;
    }
    for (var k in typesObj) {
        types.push(k);
    }

    var checkboxes = [];

    function update() {
        var enabled = {};
        // Run through each checkbox and record whether it is checked. If it is,
        // add it to the object of types to display, otherwise do not.
        for (var i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i].checked) {
                enabled[checkboxes[i].id] = true;
            }
        }
        map.featureLayer.setFilter(function (feature) {
            // If this symbol is in the list, return true. if not, return false.
            // The 'in' operator in javascript does exactly that: given a string
            // or number, it says if that is in a object.
            // 2 in { 2: true } // true
            // 2 in { } // false
            return (feature.properties.title in enabled);
            //return (feature.properties.title in enabled);
        });
    }

    // Create a filter interface.
    for (var ii = 0; ii < types.length; ii++) {
        // Create an an input checkbox and label inside.
        var item = course_ui.appendChild(document.createElement('div'));
        var checkbox = item.appendChild(document.createElement('input'));
        var label = item.appendChild(document.createElement('label'));
        checkbox.type = 'checkbox';
        checkbox.id = types[ii];
        checkbox.checked = true;
        item.className = 'active ui_menu_box';
        // create a label to the right of the checkbox with explanatory text
        label.innerHTML = types[ii];
        label.setAttribute('for', types[ii]);
        // Whenever a person clicks on this checkbox, call the update().
        //checkbox.addEventListener('change', update);
        checkboxes.push(checkbox);
    }

    // This function is called whenever someone clicks on a checkbox and changes
    // the selection of markers to be displayed.


    //Make the entire button clickable, and bind active classes to the 

    //var ui_menu_box = $('#course-ui');







    function toggleAndCheck() {

        $(this).toggleClass('active');

    }

    function justToggle() {

        $(this).parent('div').toggleClass('active');
        return false;

    }

    function checkCheck() {
        var $this = $(this);
        var isChecked = $(this).find('input').prop('checked');
        if (isChecked === true) {
            setTimeout(function () {
                $this.find('input').prop('checked', false).blur();
                update();
            },
                  10);
        } else if (isChecked === false) {
            setTimeout(function () {
                $this.find('input').prop('checked', true).blur();
                update();
            },
                  10);
        }

    }


    function bindUI() {
        $('#course-ui')
            .on('tap', '.ui_menu_box', toggleAndCheck)
            .on('tap', 'label', justToggle)
            .on('touchend mouseup', '.ui_menu_box', checkCheck);
    };


    function unBindUI() {
        $('#course-ui')
           .off('tap', '.ui_menu_box')
           .off('tap', 'label')
           .off('touchend mouseup', '.ui_menu_box');
    }

    map.on('move', unBindUI);
    map.on('moveend', bindUI);

    bindUI();




});//end onReady for FeatureLayer




