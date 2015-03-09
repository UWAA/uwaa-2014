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