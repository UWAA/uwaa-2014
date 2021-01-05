<?php 
get_header(); 
wp_enqueue_script('superHero');
// wp_enqueue_script('homepageSnow');
use \UWAA\View\ThumbnailBrowser\Thumbnail\Homepage;
use \UWAA\View\ThumbnailBrowser\Thumbnail\HomepageEvents;
use \UWAA\View\ThumbnailBrowser\Thumbnail\HomepageNewsAndPublications;

?>


<div id="spacer"></div>
<h1 class="offscreen">Alumni - University Of Washington</h1>
<?php if ( ! is_front_page() ) :uw_mobile_menu(); else : uw_mobile_front_page_menu(); endif; ?>

<?php 


if(class_exists('\UWAA\Slideshow\Slideshow')):
$superhero = new \UWAA\Slideshow\Slideshow("home-superhero");

include(locate_template('content-slideshow.php'));

endif;

?>

   <div class="container-fluid home-thumbnail-row-container">

      <div class="row 5-column home-thumbnail-row home-row">

        <div class="container uwaa-home-body-container">
          
          <div class="row">

            <div class="col-md-12 uw-content">

              <div class="row-title-row">
                <div class="row-hr"></div>

                <div class="row-title-text news">
                  <h2><?php the_field('custom_text_one') ?></h2>
                </div>
                <a class="see-all-link" href="<?php echo home_url( '/events'); ?>">see all events</a>

              </div>

                <?php

                  $thumbnailRow = new \UWAA\View\ThumbnailBrowser\ThumbnailBrowser;

                  $thumbnailRow->makeThumbnails(new HomepageEvents);

                ?>

            </div>
          </div>

        </div>
          
      </div>
    </div>

    <div class="container-fluid home-thumbnail-row-container row-gold-background">

      <div class="row 5-column home-thumbnail-row home-row">

        <div class="container uwaa-home-body-container">
          
          <div class="row">

            <div class="col-md-12 uw-content">

              <div class="row-title-row">
                <div class="row-hr"></div>

                <div class="row-title-text news">
                  <h2><?php the_field('custom_text_two') ?></h2>
                </div>

              </div>

                <?php

                  $thumbnailRow = new \UWAA\View\ThumbnailBrowser\ThumbnailBrowser;

                  $thumbnailRow->makeThumbnails(new Homepage);

                ?>

            </div>
          </div>

        </div>
          
      </div>
    </div>

    <div class="container-fluid home-thumbnail-row-container">

      <div class="row 5-column home-thumbnail-row home-row">

        <div class="container uwaa-home-body-container">
          
          <div class="row">

            <div class="col-md-12 uw-content">

              <div class="row-title-row">
                <div class="row-hr"></div>

                <div class="row-title-text news">
                  <h2><?php the_field('custom_text_three') ?></h2>
                </div>
                <a class="see-all-link" href="<?php echo home_url('/stories'); ?>">see all stories</a>

              </div>

                <?php

                  $thumbnailRow = new \UWAA\View\ThumbnailBrowser\ThumbnailBrowser;

                  $thumbnailRow->makeThumbnails(new HomepageNewsAndPublications);

                ?>

            </div>
          </div>

        </div>
          
      </div>
    </div>


<div class="container-fluid">

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
          

          endwhile;

          
        ?>
</div>

  
</div>

</div>

<?php get_footer(); ?>
