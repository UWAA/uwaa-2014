

var $slideShows = $('#slideshow1, #slideshow2');

var slideSizer = function(w) {
    var $slideHeight = $('.membersLove').height();  
    if (w <= 320) {
        $slideShows.height(100);
        $slideShows.children().height(100);
    } else {
        $slideShows.height($slideHeight);
        $slideShows.children().height($slideHeight);
}
}

$(window).load(function(){

    var w = Math.max(document.documentElement.clientWidth, window.innerWidth || 0)

    slideSizer(w);

});

$(document).ready(function(){
 
var imgRes = {
    sm: "_320x146.jpg",
//  md:"768x398",
    lg:"_1200x498.jpg"
};

var ImgUrl = "https://www.uw.edu/alumni/images/membership/gradpack/GradPack_Slide";



//Get width of viewport
var w = Math.max(document.documentElement.clientWidth, window.innerWidth || 0)
var $slideHeight = $('.slide').height();


var imgArr = [];
var preloadArr = [];
var numberOfSlides = 6;







//Based on initial viewport size, change which set of stuff is loaded.
function chooseImageSet(w) {
    for (var i=0; i < numberOfSlides; i++) {
        if (w <= 320) {
            imgArr[i] = ImgUrl+i+imgRes.sm;         
     
        
    } else {
            imgArr[i] = ImgUrl+i+imgRes.lg;         
        }
    }
}

function preloadImages(){ 
     
     for(i=0; i < imgArr.length; i++){
        preloadArr[i] = new Image();
        preloadArr[i].src = imgArr[i];
     }
     return preloadArr;
}


chooseImageSet(w);
preloadImages();

 
 
 
 
 var currImg = 2;



var intID = setInterval(changeImg, 3000);
var foregroundVisible = true;
var $foreground =  $('#header-fore');
var $background =  $('#header-bg');

function changeImg() {


    ///First pass through the function, Fade out the foreground, change the src, and set the background to visible.
    

    if (foregroundVisible === true) {
    $foreground.fadeOut(1000, function(){
        $foreground.css('background-image','url(' + preloadArr[currImg++%preloadArr.length].src +') ') 
    });
        foregroundVisible = false;
    return;
    } else {

        $foreground.fadeIn(1000, function(){
        $background.css('background-image','url(' + preloadArr[currImg++%preloadArr.length].src +') ')
        });
        foregroundVisible = true;
    return;
    }
}

function flushImages() {
    $foreground.fadeIn(1000, function(){
    $background.css('background-image','url(' + preloadArr[currImg++%preloadArr.length].src +') ')
    });
    foregroundVisible = true;
}


 
$("#slideshow1 > div:gt(0)").hide();
$("#slideshow2 > div:gt(0)").hide();

setInterval(function() { 
  $('#slideshow1 > div:first')
    .fadeOut(1000)
    .next()
    .fadeIn(1000)
    .end()
    .appendTo('#slideshow1');
},  3000);

setInterval(function() { 
  $('#slideshow2 > div:first')
    .fadeOut(1000)
    .next()
    .fadeIn(1000)
    .end()
    .appendTo('#slideshow2');
},  6000);





$(window).resize(function(){
    $('#header-fore', 'header-bg').stop();
    var w = Math.max(document.documentElement.clientWidth, window.innerWidth || 0)
    chooseImageSet(w);
    preloadImages();
    flushImages();
});
});



 $(window).resize(function(){
    var w = Math.max(document.documentElement.clientWidth, window.innerWidth || 0)
    var $slideHeight = $('.membersLove').height();
    
    slideSizer(w);

    if (w < 768 ) {
        $('.header-fixed, .join-row-fixed, .thin-fixed, #patch .fixed').hide();
    } else{
        return;
    }

});
$(".content-row h1, .content-row p").each(function() {
    var wordArray = $(this).html().split(' ');
    if (wordArray.length > 1) {
        wordArray[wordArray.length-2] += '&nbsp;' + wordArray[wordArray.length-1];

        var lastWord = wordArray.pop();
        lastWord = lastWord.replace(/.*((?:<\/\w+>)*)$/, '$1');
        $(this).html(wordArray.join(' ') + lastWord);
    }
});