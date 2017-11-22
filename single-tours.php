<?php get_header(); 
  // Start the Loop.
  while ( have_posts() ) : the_post();
  
  

?>
<a name="pagination-top"></a>


<div class="uwaa-hero-image <?php echo get_post_meta(get_the_id(), 'mb_header_text_color', true); ?> " style="background-image:url('<?php $UWAA->UI->getPostFeaturedImageURL(get_post_thumbnail_id($post->ID), 'original')?>');"></div>

<div class="container uw-body">

  <div class="row">

    <div class="col-md-8 uw-content" role='small'>

        <?php include(locate_template( 'partials/sidebar-single-breadcrumbs.php')); ?>

      <div class="uw-body-copy">
            <?php


            new \UWAA\View\Pagination('tours', get_the_ID());
                // // Start the Loop.
                // while ( have_posts() ) : the_post();

                    /*
                     * Include the post format-specific template for the content. If you want to
                     * use this in a child theme, then include a file called called content-___.php
                     * (where ___ is the post format) and that will be used instead.
                     */
                    get_template_part( 'content-tours' );

                    // If comments are open or we have at least one comment, load up the comment template.
                    if ( comments_open() || get_comments_number() ) {
                        comments_template('/comments.php');
                    }

                
            ?>

      </div>

    </div>

    <div class="col-md-4 uw-sidebar">
    <?php 

    new \UWAA\View\Pagination('tours', get_the_ID());

    $mapURL = get_post_meta(get_the_id(), 'mb_operator_map', true);
    $bigMapURL = get_post_meta(get_the_id(), 'mb_operator_big_map', true);
     if ($mapURL) {
      echo '<div class="widget">';
      // echo '<a href=" ' . esc_attr($bigMapURL) . '  "><img src=" ' . esc_attr($mapURL) . ' " title="Map of tour region" alt="Map of tour region" /></a>';
      echo '<img src=" ' . esc_attr($mapURL) . ' " title="Map of tour region" alt="Map of tour region" />';
      echo '</div>';
     }
        dynamic_sidebar( 'travel_sidebar' );
       
        the_widget("UWAA\Widgets\SocialSidebar");

        get_template_part('partials/forms', 'travel-newsletter');
        endwhile;
    ?>
    </div>


  </div>

</div>

<?php 
get_template_part('partials/tours-footer');
get_footer(); 

?>
