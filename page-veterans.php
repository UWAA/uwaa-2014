<?php

include(locate_template( 'partials/vets-header.php'));

use \UWAA\View\ThumbnailBrowser\Thumbnail\VeteransEventsIsotope;
use \UWAA\View\ThumbnailBrowser\Thumbnail\VeteransStoriesIsotope;
wp_enqueue_script('isotopeInit');
wp_enqueue_script('covervid');
?>

<div class="uw-hero-image vets-video-wrapper">  
  <div class="covervid-wrapper">
    <video class="covervid-video" autoplay loop>        
        <source src="<?php bloginfo("stylesheet_directory"); ?>/assets/video/intro.mp4" type="video/mp4">
    </video>
</div>
</div>

<div class="container uw-body">

  <div class="row">

    <div class="col-md-12 uw-content" role='main'>

      <!-- <a href="<?php echo home_url('/'); ?>" title="<?php echo esc_attr( get_bloginfo() ) ?>"><h2 class="uw-site-title"><?php bloginfo(); ?></h2></a> -->
      <h2 class="uw-site-title">Vets Page</h2>

    <?php include(locate_template( 'partials/sidebar-single-breadcrumbs.php')); ?>
    
      <h1>Membership Benefits</h1>

      <div class="uw-body-copy">
        
        <div id="isotope-canvas">
        <?php
          $veteransEventsGrid = new \UWAA\View\ThumbnailBrowser\ThumbnailBrowser;
          $veteransStoriesGrid = new \UWAA\View\ThumbnailBrowser\ThumbnailBrowser;
          $veteransEventsGrid->renderGridListPrintIcons();
          $veteransEventsGrid->renderToolbar('Veterans');
          // $benefitsGrid->buildSortingToolbar('destinations'); 
        ?>
            <div class="isotope tile">
            <?php
            

            $veteransEventsGrid->makeThumbnails(new VeteransEventsIsotope);
            $veteransStoriesGrid->makeThumbnails(new VeteransStoriesIsotope);
            ?>
            </div>
        </div>

      </div>

    </div>   

  </div>

</div>

<?php get_footer(); ?>
