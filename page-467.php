<?php
// Huskies Vote Single-Page Template

get_header(); 

use \UWAA\View\ThumbnailBrowser\Thumbnail\REJReport;  //resources archetype

$url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
      if(!$url){
        $url = get_site_url() . "/wp-content/themes/uw-2014/assets/headers/suzzallo.jpg";
      }
      $mobileimagesrc = get_post_meta($post->ID, "mobileimage");
      $hasmobileimage = '';
      if( !empty($mobileimagesrc) && $mobileimagesrc[0] !== "") {
        $mobileimage = $mobileimagesrc[0];
        $hasmobileimage = 'hero-mobile-image';
      }
      $sidebar = get_post_meta($post->ID, "sidebar");
      $banner = get_post_meta($post->ID, "banner");
      $buttontext = get_post_meta($post->ID, "buttontext");
      $buttonlink = get_post_meta($post->ID, "buttonlink");   ?>


<div class="uw-hero-image hero-height <?php echo $hasmobileimage ?>" style="background-image: url(<?php echo $url ?>);">
    <?php if( isset($mobileimage)) { ?>
      <div class="mobile-image" style="background-image: url(<?php echo $mobileimage ?>);"></div>
    <?php } ?>
    <div id="hero-bg">
      <div id="hero-container" class="container">
      <?php if(!empty($banner) && $banner[0]){ ?>
        <div id="hashtag"><span><span><?php echo $banner[0] ? $banner[0] : ''; ?></span></span></div>
      <?php } ?>
        <h1 class="uw-site-title"><?php the_title(); ?></h1>
        <span class="udub-slant"><span></span></span>
      <?php if(!empty($buttontext) && $buttontext[0]){ ?>
        <a class="uw-btn btn-sm btn-none" href="<?php echo $buttonlink[0] ? $buttonlink[0] : ''; ?>"><?php echo $buttontext[0] ? $buttontext[0] : ''; ?></a>
      <?php } ?>
      </div>
    </div>
</div>

<div class="uw-body">

<div class="container">

  <div class="row">

    <div class="col-md-12 uw-content" role='main'>

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

       </div> <!-- /row -->

</div> <!-- /container -->

</div>

            <div class="container-fluid">
              <div class="row">
                <div class="container">
                  <div class="row">
                    <div class="col-md-12 uw-content">
                    
            
            <div class="row rej-report-row">
                
                <?php


                $thumbnailRowTwo = new \UWAA\View\ThumbnailBrowser\ThumbnailBrowser;

                $thumbnailRowTwo->makeThumbnails(new REJReport);

                ?>

            </div>



                    </div>
                  </div>
                </div>
              </div>
            </div>


         


    </div>
  

  </div>

</div>

<?php get_footer(); ?>
