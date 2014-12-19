(function($) {

var allPanels = $('#accordion > .panel > .collapse').hide();

  $(".accordion-heading").keypress (function (event)      //using keyboard
  {
   if ( event.which == 13 || event.which == 9 )
   {
    var $indicator = $(this).find(".indicator:first");
    var $content = $(this).siblings(".collapse");

    if ( $indicator.attr("aria-expanded") == "false")
    {
      $indicator.attr ("aria-expanded", "true");
      $indicator.text ("Expanded");
      $indicator.css({"position": "absolute", "clip": "rect(1px, 1px, 1px, 1px)"});
      $content.show () .attr ("aria-hidden", "false");
  }
  else if ( $indicator.attr("aria-expanded") == "true")
  {
      $indicator.attr ("aria-expanded", "false");
      $indicator.text ("Collapsed");
      $indicator.css({"position": "absolute", "clip": "rect(1px, 1px, 1px, 1px)"});
      $content.hide()
      .attr ("aria-hidden", "true");
} // if
 }// if
}) // function

$(".accordion-heading").click (function () {          //using mouse
    var $indicator = $(this).find(".indicator:first");
    var $content = $(this).siblings(".collapse");

    if ( $indicator.attr("aria-expanded") == "false") {
        $indicator.attr ("aria-expanded", "true");
        $indicator.text ("Expanded");
        $indicator.css({"position": "absolute", "clip": "rect(1px, 1px, 1px, 1px)"});
        $content.show ().attr ("aria-hidden", "false");
    } else if ( $indicator.attr("aria-expanded") == "true") {
        $indicator.attr ("aria-expanded", "false");
        $indicator.text ("Collapsed");
        $indicator.css({"position": "absolute", "clip": "rect(1px, 1px, 1px, 1px)"});
        $content.hide()
        .attr ("aria-hidden", "true");
} // if
//$indicator.focus();
}); // click .panel




})(jQuery);