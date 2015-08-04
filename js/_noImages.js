// Accessibility Tweak to help browsers that don't load images.


$( document ).ready(function() {
    var width = document.getElementById("flag").offsetWidth;

    if (width <= 0) {
            $('body').addClass('no-images');
    }

});
