(function($) {

var $alumniLink = $('.uw-thinstrip .uw-thin-links li:nth-child(4) a');
$('.uw-thinstrip .uw-thin-links li a').not($alumniLink).hover(function() {
// $('.uw-thinstrip .uw-thin-links li a').hover(function() {
  $alumniLink.css('color', '#FFFFFF');
}, function() {
  $alumniLink.css('color', '#b7a57a');
});  
  
})(jQuery);