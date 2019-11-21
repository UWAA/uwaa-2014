(function ($) {

    var currentPage = window.location;
    var goodPages = ['oregon'];

    var path = currentPage.pathname.split('/').filter(function (n) { return n !== ''; }).pop();

    var isOkayToFire = goodPages.indexOf(path);


    //This function should only run on one page.
    if (isOkayToFire != -1) {   
        $('#oregonChapterPreference').show();
    }


}(jQuery)); 