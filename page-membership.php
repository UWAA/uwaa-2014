<?php 
$UWAA->Memberchecker->getSession();
get_header(); 
wp_enqueue_script(array('superHero'));
use \UWAA\View\ThumbnailBrowser\Thumbnail\Membership;
?>

<div id="spacer"></div>
<?php uw_mobile_front_page_menu(); ?>



<div class="membership-header uw-homepage-slider-container">
<?php

if(class_exists('\UWAA\Slideshow\Slideshow')):

$superhero = new \UWAA\Slideshow\Slideshow("membership-superhero");

include(locate_template('content-membership-slideshow.php'));

endif;

?>


  
</div>

<div class="container uw-body">

  <div class="row">

    <div class="col-md-8 uw-content" role='main'>

   <?php get_template_part('partials/sidebar', 'page-breadcrumbs') ?>
   
      <div class="uw-body-copy">

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

    </div>
    
     <div class="col-md-4 uw-sidebar">
    <?php    
         include(locate_template( 'partials/join-renew.php' )); 
        uw_sidebar_menu();
        
        

    ?>

      

    </div>
     

  </div>

   <div class="row 5-column">
       <?php
      

      $thumbnailRow = new \UWAA\View\ThumbnailBrowser\ThumbnailBrowser;

      $thumbnailRow->makeThumbnails(new Membership);

      ?>

  </div>

</div>

<?php get_footer(); ?>
