<?php


$isPartnerEvent = get_post_meta($post->ID, 'mb_isPartnerEvent', true);



if ($isPartnerEvent) {
  $url = apply_filters('remove_cms', get_post_meta($post->ID, 'mb_alternate_link', true));
  $UWAA->Utilities->Redirect($url, true);
}


get_header();
wp_enqueue_script('footballScheduleOpener');

// if DawgDash Post


if(strtolower(get_the_title()) == 'alaska airlines dawg dash') {
    wp_enqueue_script('seattleMap');
}

?>
<a name="pagination-top"></a>

<?php 

//@TODO  Make a better system for these communities headers
$featureImage = $UWAA->UI->returnPostFeaturedImageURL(get_post_thumbnail_id($post->ID), 'original');
if (has_category('Tall Regional Branding')) {
    echo '<div class="uwaa-chapter-header profile">';
  //TODO rename the profile class so the LESS matches the category
    include(locate_template('partials/profile-header.php'));
    echo '</div>';
  } elseif (has_category('Short Regional Branding')) {
    echo '<div class="uwaa-chapter-header">';
    include(locate_template('partials/chapter-header.php'));
  echo '</div>';
  } elseif (has_category('Veterans Week')) {
    $vetsHome = get_site_url("/veterans/");
    wp_enqueue_style('google-font-cinzel');  
    include(locate_template('partials/vets-single-header.php'));
  }
 elseif ($featureImage) {
    ?>
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
    
    <div <?php uw_content_class(); ?> role='main' >

      <?php if ($defaultHeader) { uw_site_title(); }; ?>

          <?php include(locate_template( 'partials/sidebar-single-breadcrumbs.php')); ?>


      <div id='main_content' class="uw-body-copy">

            <?php

            new \UWAA\View\Pagination('post', get_the_ID());

                // Start the Loop.
                while ( have_posts() ) : the_post();

                ?>

                <h6 class="intro-head"> <?php echo get_post_meta($post->ID, 'mb_thumbnail_subtitle', true) ?></h6>

                <h1>
                  <?php the_title() ?>
                </h1>


              

              <?php
                    /*
                     * Include the post format-specific template for the content. If you want to
                     * use this in a child theme, then include a file called called content-___.php
                     * (where ___ is the post format) and that will be used instead.
                     */
                     if ( is_archive() )
                      the_excerpt();
                    else
                      the_content();

                    // If comments are open or we have at least one comment, load up the comment template.
                    if ( comments_open() || get_comments_number() ) {
                        comments_template();
                    }

                endwhile;

              if (has_category('Veterans Week')) {
                echo do_shortcode('[uwaa-button url="/alumni/veterans?filter=veterans-events" color="purple" type="slant-right"]More Vet Events[/uwaa-button]');
                echo do_shortcode('[uwaa-button url="/alumni/veterans?filter=veterans-stories" color="gold" type="slant-left"]More Vet Stories[/uwaa-button]');
              }
              
            ?>

            <span class="next-page"><?php next_posts_link( 'Next page', '' ); ?></span>

      </div>

    </div>
    
    <div class="col-md-4 uw-sidebar">
    <?php 

    if (!is_single(array('UW Impact higher education survey', 'uw-impact-higher-education-survey', '938', '9502'))) {
    new \UWAA\View\Pagination('post', get_the_ID());

    the_widget("UWAA\Widgets\SidebarPullQuote");
    
    the_widget("UWAA\Widgets\SocialSidebar");

    the_widget("UWAA\Widgets\SidebarFeaturedPost");
    }    
        
    ?>
    </div>


   

  </div>

   <?php
    if (has_category('Veterans Week')) {
    ?>
      <div class="star-line"></div>
    <?php
    } 
    ?>

</div>

<?php get_footer(); ?>
