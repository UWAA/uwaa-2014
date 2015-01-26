<?php get_header(); 
use \UWAA\View\ThumbnailBrowser\Thumbnail\EventsIsotope;
wp_enqueue_script(array('isotopeInit', 'superHero'));
?>

<div id="spacer"></div>
<?php uw_mobile_front_page_menu(); ?>

<?php

if(class_exists('\UWAA\Slideshow\EventsSlideshow')):

$superhero = new \UWAA\Slideshow\EventsSlideshow("events-superhero");

include(locate_template('content-slideshow.php'));

endif;

?>

<div class="container uw-body">

  <div class="row">

    <div class="col-md-12 uw-content" role='main'>
    
     <?php include(locate_template( 'partials/sidebar-single-breadcrumbs.php')); ?>
      

      <h1>Events</h1>

      <div class="uw-body-copy">


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
        </div>

      </div>

    </div>   

  </div>

</div>

<?php get_footer(); ?>
