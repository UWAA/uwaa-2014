<?php get_header(); 
use \UWAA\View\ThumbnailBrowser\Thumbnail\ToursIsotope;
wp_enqueue_script('isotopeInit');
?>



<div class="uw-hero-image"></div>

<div class="container uw-body">

  <div class="row">

    <div class="col-md-12 uw-content" role='main'>

      <a href="<?php echo home_url('/'); ?>" title="<?php echo esc_attr( get_bloginfo() ) ?>"><h2 class="uw-site-title"><?php bloginfo(); ?></h2></a>

      <?php get_template_part( 'breadcrumbs' ); ?>

      <div class="uw-body-copy">
        <div id="isotope-canvas">
        <?php
          $UWAA->UI->buildSortingToolbar('destinations'); 
        ?>
            <div class="isotope tile">
            <?php
            $isotopeThumbnails = new \UWAA\View\ThumbnailBrowser\ThumbnailBrowser;

            $isotopeThumbnails->makeThumbnails(new ToursIsotope);
            ?>
            </div>
        </div>

      </div>

    </div>   

  </div>

</div>

<?php get_footer(); ?>
