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
(function($) {

var $alumniLink = $('.uw-thinstrip .uw-thin-links li:nth-child(4) a');
$('.uw-thinstrip .uw-thin-links li a').not($alumniLink).hover(function() {
// $('.uw-thinstrip .uw-thin-links li a').hover(function() {
  $alumniLink.css('color', '#FFFFFF');
}, function() {
  $alumniLink.css('color', '#b7a57a');
});  
  
})(jQuery);
addEvent(window, 'load', initForm);

var highlight_array = new Array();

function initForm(){
  initializeFocus();
  var activeForm = document.getElementsByTagName('form')[0];
  addEvent(activeForm, 'submit', disableSubmitButton);
  ifInstructs();
  showRangeCounters();
}

function disableSubmitButton() {
  document.getElementById('saveForm').disabled = true;
}

// for radio and checkboxes, they have to be cleared manually, so they are added to the
// global array highlight_array so we dont have to loop through the dom every time.
function initializeFocus(){
  var fields = getElementsByClassName(document, "*", "field");
  
  for(i = 0; i < fields.length; i++) {
    if(fields[i].type == 'radio' || fields[i].type == 'checkbox') {
      fields[i].onclick = function() {highlight(this, 4);};
      fields[i].onfocus = function() {highlight(this, 4);};
    }
    else if(fields[i].className.match('addr') || fields[i].className.match('other')) {
      fields[i].onfocus = function(){highlight(this, 3);};
    }
    else {
      fields[i].onfocus = function(){highlight(this, 2); };
    }
  }
}

function highlight(el, depth){
  if(depth == 2){var fieldContainer = el.parentNode.parentNode;}
  if(depth == 3){var fieldContainer = el.parentNode.parentNode.parentNode;}
  if(depth == 4){var fieldContainer = el.parentNode.parentNode.parentNode.parentNode;}
  
  addClassName(fieldContainer, 'focused', true);
  var focusedFields = getElementsByClassName(document, "*", "focused");
  
  for(i = 0; i < focusedFields.length; i++) {
    if(focusedFields[i] != fieldContainer){
      removeClassName(focusedFields[i], 'focused');
    }
  }
}

function ifInstructs(){
  var container = document.getElementById('public');
  if(container){
    removeClassName(container,'noI');
    var instructs = getElementsByClassName(document,"*","instruct");
    if(instructs == ''){
      addClassName(container,'noI',true);
    }
    if(container.offsetWidth <= 450){
      addClassName(container,'altInstruct',true);
    }
  }
}

function showRangeCounters(){
  counters = getElementsByClassName(document, "em", "currently");
  for(i = 0; i < counters.length; i++) {
    counters[i].style.display = 'inline';
  }
}

function validateRange(ColumnId, RangeType) {
  if(document.getElementById('rangeUsedMsg'+ColumnId)) {
    var field = document.getElementById('Field'+ColumnId);
    var msg = document.getElementById('rangeUsedMsg'+ColumnId);

    switch(RangeType) {
      case 'character':
        msg.innerHTML = field.value.length;
        break;
        
      case 'word':
        var val = field.value;
        val = val.replace(/\n/g, " ");
        var words = val.split(" ");
        var used = 0;
        for(i =0; i < words.length; i++) {
          if(words[i].replace(/\s+$/,"") != "") used++;
        }
        msg.innerHTML = used;
        break;
        
      case 'digit':
        msg.innerHTML = field.value.length;
        break;
    }
  }
}

/*--------------------------------------------------------------------------*/

//http://www.robertnyman.com/2005/11/07/the-ultimate-getelementsbyclassname/
function getElementsByClassName(oElm, strTagName, strClassName){
  var arrElements = (strTagName == "*" && oElm.all)? oElm.all : oElm.getElementsByTagName(strTagName);
  var arrReturnElements = new Array();
  strClassName = strClassName.replace(/\-/g, "\\-");
  var oRegExp = new RegExp("(^|\\s)" + strClassName + "(\\s|$)");
  var oElement;
  for(var i=0; i<arrElements.length; i++){
    oElement = arrElements[i];    
    if(oRegExp.test(oElement.className)){
      arrReturnElements.push(oElement);
    } 
  }
  return (arrReturnElements)
}

//http://www.bigbold.com/snippets/posts/show/2630
function addClassName(objElement, strClass, blnMayAlreadyExist){
   if ( objElement.className ){
      var arrList = objElement.className.split(' ');
      if ( blnMayAlreadyExist ){
         var strClassUpper = strClass.toUpperCase();
         for ( var i = 0; i < arrList.length; i++ ){
            if ( arrList[i].toUpperCase() == strClassUpper ){
               arrList.splice(i, 1);
               i--;
             }
           }
      }
      arrList[arrList.length] = strClass;
      objElement.className = arrList.join(' ');
   }
   else{  
      objElement.className = strClass;
      }
}

//http://www.bigbold.com/snippets/posts/show/2630
function removeClassName(objElement, strClass){
   if ( objElement.className ){
      var arrList = objElement.className.split(' ');
      var strClassUpper = strClass.toUpperCase();
      for ( var i = 0; i < arrList.length; i++ ){
         if ( arrList[i].toUpperCase() == strClassUpper ){
            arrList.splice(i, 1);
            i--;
         }
      }
      objElement.className = arrList.join(' ');
   }
}

//http://ejohn.org/projects/flexible-javascript-events/
function addEvent( obj, type, fn ) {
  if ( obj.attachEvent ) {
    obj["e"+type+fn] = fn;
    obj[type+fn] = function() { obj["e"+type+fn]( window.event ) };
    obj.attachEvent( "on"+type, obj[type+fn] );
  } 
  else{
    obj.addEventListener( type, fn, false );  
  }
}