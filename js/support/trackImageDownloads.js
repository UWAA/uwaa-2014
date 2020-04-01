(function ($) {

    $('.uw-body img').bind('contextmenu', function() {        
        AlumniGoogleAnalyticsTracking.fileDownload(this.currentSrc);
    })

}(jQuery)); 