<?php get_header(); 
use \UWAA\View\ThumbnailBrowser\Thumbnail\EventsIsotope;
wp_enqueue_script(array('isotopeInit', 'superHero'));




if(class_exists('\UWAA\Slideshow\EventsSlideshow')):

$superhero = new \UWAA\Slideshow\EventsSlideshow("events-superhero");

include(locate_template('content-slideshow.php'));

endif;

?>

<div class="container uw-body">

  <div class="row">

    <div class="col-md-12 uw-content" role='main'>
    
    <div class="row uwaa-home-branding-row">
    <div class="col-sm-10">
      <?php $UWAA->UI->Breadcrumbs->UWAABreadcrumbs(); ?>
    </div>
    <div class="col-sm-2 uwaa-home-branding">
      <!-- <div class="logo hidden-xs hidden-sm"> -->
        <?php //get_template_part('assets/uwaa', 'logo.svg');?>
      <!-- </div> -->
      <em>Produced by the Alumni Association for all UW Alumni</em>
    </div> 
  </div>
      

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
