<?php get_header(); 
use \UWAA\View\ThumbnailBrowser\Thumbnail\ToursIsotope;
wp_enqueue_script('isotopeInit');
?>



<div class="uw-hero-image travel"></div>

<div class="container uw-body">

  <div class="row">

    <div class="col-md-12 uw-content" role='main'>

      <h2 class="uw-site-title">UW Alumni Tours</h2>

      <div class="row uwaa-home-branding-row">
    <div class="col-sm-6">
      <?php get_template_part( 'breadcrumbs' ); ?>
    </div>
    <div class="col-sm-6 uwaa-home-branding">
      <!-- <div class="logo hidden-xs hidden-sm"> -->
        <?php //get_template_part('assets/uwaa', 'logo.svg');?>
      <!-- </div> -->
      <em>Produced by the Alumni Association for all UW Alumni</em>
    </div> 
  </div>

      <h1><?php the_title() ?></h1>

      <div class="uw-body-copy">
        <div id="isotope-canvas">

      
        <?php
          $tourGrid = new \UWAA\View\ThumbnailBrowser\ThumbnailBrowser;
          
          $tourGrid->renderGridListPrintIcons();
          $tourGrid->renderSearchBox('Tours');
          $tourGrid->renderToolbar('Destinations');
          
        ?>
            <div class="isotope tile">
            <?php
            

            $tourGrid->makeThumbnails(new ToursIsotope);
            ?>
            </div>
        </div>

      </div>

    </div>   

  </div>

</div>

<?php get_footer(); 
get_template_part('partials/tours-footer');
?>
