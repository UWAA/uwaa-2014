<?php 
get_header(); 
wp_enqueue_script('superHero');
use \UWAA\View\ThumbnailBrowser\Thumbnail\Homepage;

?>



<?php 


if(class_exists('\UWAA\Slideshow\Slideshow')):

$superhero = new \UWAA\Slideshow\Slideshow("home-superhero");

include(locate_template('content-slideshow.php'));

endif;

?>

<div class="container uw-body">

  <div class="row">

    <div class="col-md-12 uw-content" role='main'>


      <?php get_template_part( 'breadcrumbs' ); ?>


      
      
      

      <div class="uw-body-copy">

  <div class="row 5-column">
       <?php
      

      $thumbnailRow = new \UWAA\View\ThumbnailBrowser\ThumbnailBrowser;

      $thumbnailRow->makeThumbnails(new Homepage);

      ?>

</div>


        
      </div>

    </div>
    
    

  </div>

</div>

<div id="message-row">
  <div class="content">
<?php
          // Start the Loop.
          while ( have_posts() ) : the_post();

            /*
             * Include the post format-specific template for the content. If you want to
             * use this in a child theme, then include a file called called content-___.php
             * (where ___ is the post format) and that will be used instead.
             */
            the_content();

            // If comments are open or we have at least one comment, load up the comment template.
            if ( comments_open() || get_comments_number() ) {
              comments_template();
            }

          endwhile;

          
        ?>
</div>

  
</div>

<?php get_footer(); ?>
