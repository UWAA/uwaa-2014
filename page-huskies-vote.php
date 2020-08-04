<?php
// Huskies Vote Single-Page Template

get_header(); 

use \UWAA\View\ThumbnailBrowser\Thumbnail\HuskiesVoteResources;  //event archetype
use \UWAA\View\ThumbnailBrowser\Thumbnail\HuskiesVoteEvents;  //story archetype

?>

<?php
$featureImage = $UWAA->UI->returnPostFeaturedImageURL(get_post_thumbnail_id($post->ID), 'original');

if ($featureImage) { ?>
<div class="uwaa-hero-image <?php echo get_post_meta(get_the_id(), 'mb_header_text_color', true); ?> " style="background-image:url('<?php $UWAA->UI->getPostFeaturedImageURL(get_post_thumbnail_id($post->ID), 'original')?>');"></div>

<?php    
}
else {
  $defaultHeader = TRUE;
  get_template_part( 'header', 'image' ); 
}

?>

<div class="container uw-body">

  <div class="row">

    <div class="col-md-8 uw-content" role='main'>

      <!-- <a href="<?php echo home_url('/'); ?>" title="<?php echo esc_attr( get_bloginfo() ) ?>"><h2 class="uw-site-title"><?php bloginfo(); ?></h2></a> -->
      
      

      <div id="main_content" class="uw-body-copy">

      <h6 class="intro-head"> <?php echo get_post_meta($post->ID, 'mb_thumbnail_subtitle', true) ?></h6>

                <h1>
                  <?php the_title() ?>
                </h1>

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

       <h3>Events</h3>
            <p><?php the_field('custom_text_one') ?></p>
            <div class="row">
                
                <?php


                $thumbnailRowTwo = new \UWAA\View\ThumbnailBrowser\ThumbnailBrowser;

                $thumbnailRowTwo->makeThumbnails(new HuskiesVoteEvents);

                ?>

            </div>

            <h3>Resources</h3>
            <p><?php the_field('custom_text_two') ?></p>
            <div class="row">
                
                <?php


                $thumbnailRowThree = new \UWAA\View\ThumbnailBrowser\ThumbnailBrowser;

                $thumbnailRowThree->makeThumbnails(new HuskiesVoteResources);

                ?>

            </div>

    </div>

    <div class="col-md-4 uw-sidebar">
            <?php        echo sprintf( '<nav id="desktop-relative" aria-label="mobile menu that is not visible in the desktop version" class="uwaa-hidden-xs-up">%s</nav>', uw_list_pages() );;

            dynamic_sidebar( 'huskies-vote_sidebar' );

            ?>



        </div>

  </div>

</div>

<?php get_footer(); ?>
