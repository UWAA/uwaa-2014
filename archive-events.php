<?php get_header(); 
use \UWAA\View\ThumbnailBrowser\Thumbnail\EventsIsotope;
wp_enqueue_script(array('isotopeInit','subman'));
?>

<div class="uw-hero-image events"></div>

<div class="container uw-body">

  <div class="row">

    <div class="col-md-12 uw-content" role='main'>

    <div class="col-md-12" style="margin-bottom:20px;background-color:#e8e3d3;">
      <h3 style="color:#4b2e83">Traffic Alert: SR 99 Closure</h3>
      <p>After January 11, the SR99 viaduct closure will disrupt local and regional traffic patterns. We advise you to plan your trip to UW accordingly during this three-week period.</p>
     </div>

    <h2 class="uw-site-title">Events</h2>
    
     <?php include(locate_template( 'partials/sidebar-single-breadcrumbs.php')); ?>     

      <div class="uw-body-copy">

        <div id="lecture-signup-wrapper">
        <div class="lecture-signup-cover">
          <p>Sign up to receive information about UW Public Lectures.</p>
        <div class="lecture-signup lecture-signup-closed" id="lecture-signup">        
         <script type="text/javascript">
            $(function() { 
              SUBMANBUILDER.makeIframe({
                subscriptionID: [328],           //REQUIRED: Subscription ID(s) for sign up e.g. [25, 27] for sign up to multiple sub prefs
                fromName: "UW Email Sign Up",   //RECOMMENDED: From name of the confirmation email
                fromEmail: "uwalumni@uw.edu",   //RECOMMENDED: From email of the confirmation email
                showPlaceHolders: false,        //OPTIONAL: Show placeholder text inside the text boxes
                hideLabels: false,              //OPTIONAL: Hide form labels
                returnURL: "",                  //OPTIONAL: Set if confirmation page is different than sign up page
                placeholderID: "lecture-signup"
              });
            });
          </script>

        </div>
        </div>
        </div>
       


        <div id="isotope-canvas">
        
        <?php
          $eventGrid = new \UWAA\View\ThumbnailBrowser\ThumbnailBrowser;
          $eventGrid->renderGridListPrintIcons();
          $eventGrid->renderSearchBox('Events');
          $eventGrid->renderToolbar('Events');
          
        ?>
            <div class="isotope tile">
            <?php
            

            $eventGrid->makeThumbnails(new EventsIsotope);
            ?>
            </div>
            <div id="iframe-emphasis-background" class="emphasis-background"></div>
        </div>

      </div>

    </div>   

  </div>


</div>

<?php get_footer(); ?>
