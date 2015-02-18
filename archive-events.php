<?php get_header(); 
use \UWAA\View\ThumbnailBrowser\Thumbnail\EventsIsotope;
wp_enqueue_script(array('isotopeInit'));
?>

<div class="uw-hero-image events"></div>

<div class="container uw-body">

  <div class="row">

    <div class="col-md-12 uw-content" role='main'>

    <h2 class="uw-site-title">Events</h2>
    
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
