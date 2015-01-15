(function($) {
//Taking pretty much verbatim, needs some work.
var allPanels = $('#accordion > .closed > .collapse').hide();

  $(".accordion-heading").keypress (function (event)      //using keyboard
  {
   if ( event.which == 13 || event.which == 9 )
   {
    var $indicator = $(this).find(".indicator:first");
    var $content = $(this).siblings(".collapse");
    var $parent = $(this).parent();
    // 

    if ( $indicator.attr("aria-expanded") == "false")
    {
      $indicator.attr ("aria-expanded", "true");
      $indicator.text ("Expanded");
      $indicator.css({"position": "absolute", "clip": "rect(1px, 1px, 1px, 1px)"});
      $content.show () .attr ("aria-hidden", "false");
      $parent.removeClass('closed').addClass('open');
      
  }
  else if ( $indicator.attr("aria-expanded") == "true")
  {
      $indicator.attr ("aria-expanded", "false");
      $indicator.text ("Collapsed");
      $indicator.css({"position": "absolute", "clip": "rect(1px, 1px, 1px, 1px)"});
      $content.hide()
      .attr ("aria-hidden", "true");
      $parent.removeClass('open').addClass('closed');
} // if
 }// if
}) // function

$(".accordion-heading").click (function () {          //using mouse
    var $indicator = $(this).find(".indicator:first");
    var $content = $(this).siblings(".collapse");
    var $parent = $(this).parent();

    if ( $indicator.attr("aria-expanded") == "false") {
        $parent.removeClass('closed').addClass('open');
        $indicator.attr ("aria-expanded", "true");
        $indicator.text ("Expanded");
        $indicator.css({"position": "absolute", "clip": "rect(1px, 1px, 1px, 1px)"});
        $content.show ().attr("aria-hidden", "false");        
        
    } else if ( $indicator.attr("aria-expanded") == "true") {
        $parent.removeClass('open').addClass('closed');
        $indicator.attr ("aria-expanded", "false");
        $indicator.text ("Collapsed");
        $indicator.css({"position": "absolute", "clip": "rect(1px, 1px, 1px, 1px)"});
        $content.hide()
        .attr ("aria-hidden", "true");
        
} // if
//$indicator.focus();
}); // click .panel




})(jQuery);