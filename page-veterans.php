<?php

include(locate_template( 'partials/vets-header.php'));

use \UWAA\View\ThumbnailBrowser\Thumbnail\VeteransEventsIsotope;
use \UWAA\View\ThumbnailBrowser\Thumbnail\VeteransStoriesIsotope;
wp_enqueue_script('isotopeInit');
wp_enqueue_script('covervid');

wp_enqueue_style('google-font-cinzel');
?>

<div class="uw-hero-image vets-video-wrapper">  
  <div class="covervid-wrapper">
    <video class="covervid-video" autoplay loop>        
        <source src="<?php bloginfo("stylesheet_directory"); ?>/assets/video/intro.mp4" type="video/mp4" poster="<?php bloginfo("stylesheet_directory"); ?>/assets/headers/Page_Header_Veterans.jpg">
    </video>
</div>
</div>
<a href="#"><div class="homelink"><a href="#">Veterans<br>Appreciation<br>Week<br><div>nov. 3-11, 2014</div></a></div></a>

<div class="container uw-body">

  <div class="row">

    <div class="col-md-12 uw-content" role='main'><!-- 

      <!-- <a href="<?php echo home_url('/'); ?>" title="<?php echo esc_attr( get_bloginfo() ) ?>"><h2 class="uw-site-title"><?php bloginfo(); ?></h2></a> -->

    <nav class="uw-breadcrumbs" role="navigation" aria-label="breadcrumbs"><ul><li><a href="http://uw.edu" title="University of Washington">Home</a></li><li><a href="<?php site_url();?>" title="Alumni">Alumni</a></li><li></li><li class="current"><span>Veterans Appreciation Week</span></li></ul></nav>
    
    <!-- Stuff for Purple Star Bit -->

    <div class="star-line">
      <?php get_template_part('assets/vet-star', 'line.svg');?>
    </div>

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
        
        <div id="isotope-canvas">
        <?php
          $veteransEventsGrid = new \UWAA\View\ThumbnailBrowser\ThumbnailBrowser;
          $veteransStoriesGrid = new \UWAA\View\ThumbnailBrowser\ThumbnailBrowser;
          // $veteransEventsGrid->renderToolbar('Veterans');          
          $veteransEventsGrid->renderVeteransFilterToolbar();
        ?>
            <div class="isotope tile">
            <?php
            

            $veteransEventsGrid->makeThumbnails(new VeteransEventsIsotope);
            $veteransStoriesGrid->makeThumbnails(new VeteransStoriesIsotope);
            ?>
            </div>
        </div>

      </div>

     --></div>   

  </div>

</div>

<?php get_footer(); ?>
