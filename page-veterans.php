<?php

include(locate_template( 'partials/vets-header.php'));


use \UWAA\View\ThumbnailBrowser\Thumbnail\VeteransEventsIsotope;
use \UWAA\View\ThumbnailBrowser\Thumbnail\VeteransStoriesIsotope;

wp_enqueue_script('isotopeInit');
wp_enqueue_script('isotopeInitVets');
wp_enqueue_script('covervid');
wp_enqueue_style('google-font-cinzel');
?>

<div class="uw-hero-image vets-video-wrapper">  
  <div class="covervid-wrapper">
    <video class="covervid-video" id="waving-flag-video" muted poster="<?php bloginfo("stylesheet_directory"); ?>/assets/headers/Page_Header_Veterans.jpg">
        <source src="<?php bloginfo("stylesheet_directory"); ?>/assets/video/flagVideo.webm" type="video/webm" >
        <source src="<?php bloginfo("stylesheet_directory"); ?>/assets/video/flagVideo.mp4" type="video/mp4" >
    </video>
</div>
</div>
<a href="#" class="homelink">
  
    Veterans<br>Appreciation<br>
      <div class="subtitle">
         Seattle <span style="color:#b7a57a;">|</span> Bothell <span style="color:#b7a57a;">|</span> Tacoma
     </div> 
  
</a>
     

<div class="container uw-body">

  <div class="row">

    <div class="col-md-12 uw-content" role='main'>

    <nav class="uw-breadcrumbs" role="navigation" aria-label="breadcrumbs"><ul><li><a href="http://uw.edu" title="University of Washington">Home</a></li><li><a href="<?php site_url();?>" title="Alumni">Alumni</a></li><li></li><li class="current"><span>Veterans Appreciation</span></li></ul></nav>
    
    <!-- Stuff for Purple Star Bit -->

    <div class="star-line"></div>

      <div class="uw-body-copy">

           <?php
          // Start the Loop.
          while ( have_posts() ) : the_post();

            /*
             * Include the post format-specific template for the content. If you want to
             * use this in a child theme, then include a file called called content-___.php
             * (where ___ is the post format) and that will be used instead.
             */
          
          the_title( '<h1 class="page-title">', '</h1>' );

          the_content();

           

          endwhile;
          
        ?>

        <h2>Veterans Events</h2>
        
        <div id="isotope-canvas-vets-events">
        <?php
          $veteransEventsGrid = new \UWAA\View\ThumbnailBrowser\ThumbnailBrowser;
          $veteransStoriesGrid = new \UWAA\View\ThumbnailBrowser\ThumbnailBrowser;
         
          $veteransEventsGrid->renderVeteransFilterToolbar();
        ?>
            <div class="isotope tile">
            <?php
            $veteransEventsGrid->makeThumbnails(new VeteransEventsIsotope);
            
            ?>
            </div>
        </div>


        <h2>Veterans Stories</h2>
        <div id="isotope-canvas">

        <div class="isotope tile">

        <?php $veteransStoriesGrid->makeThumbnails(new VeteransStoriesIsotope);
        ?>
          
        </div>
          

        </div>

      </div>

     </div>   

  </div>

</div>

<?php get_footer(); ?>
