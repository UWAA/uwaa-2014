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

      

      <?php // TODO Fix these breadcrumbs and have them default to the section front as opposed to the archive page for "tours"
      // get_template_part( 'breadcrumbs' );
      echo 'TODO- Custom Post Breadcrumbs'; ?>

      <h1>Events</h1>

      <div class="uw-body-copy">
        <div id="isotope-canvas">
        <?php
          $eventGrid = new \UWAA\View\ThumbnailBrowser\ThumbnailBrowser;
          
          $eventGrid->renderSearchBox('Events');
          $eventGrid->renderToolbar('Events');
          // $tourGrid->buildSortingToolbar('destinations'); 
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
