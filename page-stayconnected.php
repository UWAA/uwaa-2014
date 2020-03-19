<?php get_header(); 
use \UWAA\View\ThumbnailBrowser\Thumbnail\ResourceIsotope;
wp_enqueue_script('isotopeInit');
?>



<div class="uw-hero-image stay-connected"></div>

<div class="container uw-body">

  <div class="row">

    <div class="col-md-12 uw-content" role='main'>

      <!-- <a href="<?php echo home_url('/'); ?>" title="<?php echo esc_attr( get_bloginfo() ) ?>"><h2 class="uw-site-title"><?php bloginfo(); ?></h2></a> -->
      <h2 class="uw-site-title">Resources for Resilient Huskies</h2>

    <?php include(locate_template( 'partials/sidebar-single-breadcrumbs.php')); ?>
      

      <div class="uw-body-copy">

      <div class="resource-content">

      <?php
          // Start the Loop.
          while ( have_posts() ) : the_post();

            /*
             * Include the post format-specific template for the content. If you want to
             * use this in a child theme, then include a file called called content-___.php
             * (where ___ is the post format) and that will be used instead.
             */
            get_template_part( 'content', 'page' );


          endwhile;
        
        ?>

        </div>
        
        
        <div id="isotope-canvas">
        <?php
          $resourceGrid = new \UWAA\View\ThumbnailBrowser\ThumbnailBrowser;
          $resourceGrid->renderGridListPrintIcons();
          $resourceGrid->renderSearchBox('resources');
          $resourceGrid->renderToolbar('resources');          
        ?>
            <div class="isotope tile">
            <?php
            

            $resourceGrid->makeThumbnails(new ResourceIsotope);
            ?>
            </div>
        </div>

      </div>

    </div>   

  </div>

</div>

<?php get_footer(); ?>
