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
jQuery(document).ready(function($) {

    var currentPage = window.location.pathname;
    var path = '/veterans/';    

    if (currentPage === path) {        
        $('.covervid-video').coverVid(670, 380);
    }    
    
});  

    
    


    

/* HTML5 Placeholder jQuery Plugin - v2.1.1
 * Copyright (c)2015 Mathias Bynens
 * 2015-02-19
 */
!function(a){"function"==typeof define&&define.amd?define(["jquery"],a):a(jQuery)}(function(a){function b(b){var c={},d=/^jQuery\d+$/;return a.each(b.attributes,function(a,b){b.specified&&!d.test(b.name)&&(c[b.name]=b.value)}),c}function c(b,c){var d=this,f=a(d);if(d.value==f.attr("placeholder")&&f.hasClass(m.customClass))if(f.data("placeholder-password")){if(f=f.hide().nextAll('input[type="password"]:first').show().attr("id",f.removeAttr("id").data("placeholder-id")),b===!0)return f[0].value=c;f.focus()}else d.value="",f.removeClass(m.customClass),d==e()&&d.select()}function d(){var d,e=this,f=a(e),g=this.id;if(""===e.value){if("password"===e.type){if(!f.data("placeholder-textinput")){try{d=f.clone().attr({type:"text"})}catch(h){d=a("<input>").attr(a.extend(b(this),{type:"text"}))}d.removeAttr("name").data({"placeholder-password":f,"placeholder-id":g}).bind("focus.placeholder",c),f.data({"placeholder-textinput":d,"placeholder-id":g}).before(d)}f=f.removeAttr("id").hide().prevAll('input[type="text"]:first').attr("id",g).show()}f.addClass(m.customClass),f[0].value=f.attr("placeholder")}else f.removeClass(m.customClass)}function e(){try{return document.activeElement}catch(a){}}var f,g,h="[object OperaMini]"==Object.prototype.toString.call(window.operamini),i="placeholder"in document.createElement("input")&&!h,j="placeholder"in document.createElement("textarea")&&!h,k=a.valHooks,l=a.propHooks;if(i&&j)g=a.fn.placeholder=function(){return this},g.input=g.textarea=!0;else{var m={};g=a.fn.placeholder=function(b){var e={customClass:"placeholder"};m=a.extend({},e,b);var f=this;return f.filter((i?"textarea":":input")+"[placeholder]").not("."+m.customClass).bind({"focus.placeholder":c,"blur.placeholder":d}).data("placeholder-enabled",!0).trigger("blur.placeholder"),f},g.input=i,g.textarea=j,f={get:function(b){var c=a(b),d=c.data("placeholder-password");return d?d[0].value:c.data("placeholder-enabled")&&c.hasClass(m.customClass)?"":b.value},set:function(b,f){var g=a(b),h=g.data("placeholder-password");return h?h[0].value=f:g.data("placeholder-enabled")?(""===f?(b.value=f,b!=e()&&d.call(b)):g.hasClass(m.customClass)?c.call(b,!0,f)||(b.value=f):b.value=f,g):b.value=f}},i||(k.input=f,l.value=f),j||(k.textarea=f,l.value=f),a(function(){a(document).delegate("form","submit.placeholder",function(){var b=a("."+m.customClass,this).each(c);setTimeout(function(){b.each(d)},10)})}),a(window).bind("beforeunload.placeholder",function(){a("."+m.customClass).each(function(){this.value=""})})}});

$('input, textarea').placeholder();
// Accessibility Tweak to help browsers that don't load images.


$( document ).ready(function() {
    var width = document.getElementById("flag").offsetWidth;

    if (width <= 0) {
            $('body').addClass('no-images');
    }

});

var AlumniGoogleAnalyticsTracking = (function($) {

  return {
    init: function() {
      
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-1576494-1', 'auto');
      ga('send', 'pageview');    

    },

    podcastPlay: function(label) {
      ga('send',
        'event',
        'Media Action',
        'Podcast Play',
        label
        )
    },


    bindAnalyticsEvents: function() {
      $(document).ready(function() {

      
           $('audio').bind('play', function(){
            AlumniGoogleAnalyticsTracking.podcastPlay(this.currentSrc);      
            });  

      });
    }

};
    


})(jQuery);

AlumniGoogleAnalyticsTracking.init();
AlumniGoogleAnalyticsTracking.bindAnalyticsEvents();
(function($) {

    var $addressCheckBox = $('.tours-form-print');
    var $enewsCheckBox = $('.tours-form-enews');
    var $addressFields = $('.tours-address-fields');
    var $emailField = $('.tours-email-field');
    var $submitButton = $('#tours-signup .submit-button');

    $addressCheckBox.click(function() {
        if($addressCheckBox.is(':checked')) {
            $addressFields.show();
            $submitButton.css('display', 'inline-block');
        } else {
            if($enewsCheckBox.prop('checked') === false) {
                $submitButton.hide();
            }
            $addressFields.hide();
        }
    });

    $enewsCheckBox.click(function() {
        if($enewsCheckBox.is(':checked')) {            
            $emailField.show();
            $submitButton.css('display', 'inline-block');        
        } else {
            if($addressCheckBox.prop('checked') === false) {
                $submitButton.hide();
            }
            $emailField.hide();
        }
    });

    $submitButton.click(function() {
        $('#form13').submit();
    });


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