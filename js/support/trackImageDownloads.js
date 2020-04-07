(function ($) {

    $('.uw-body img').on('contextmenu', function() {        
        AlumniGoogleAnalyticsTracking.fileDownload(this.currentSrc);
    });

    $('body').on('contextmenu', '.uw-overlay img' , function () {
        AlumniGoogleAnalyticsTracking.fileDownload(this.currentSrc);
    })

}(jQuery)); 