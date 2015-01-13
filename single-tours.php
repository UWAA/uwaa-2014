<?php get_header(); 
  // Start the Loop.
  while ( have_posts() ) : the_post();
  
  

?>



<div class="uwaa-hero-image <?php echo get_post_meta(get_the_id(), 'mb_header_text_color', true); ?> " style="background-image:url('<?php $UWAA->UI->getPostFeaturedImageURL(get_post_thumbnail_id($post->ID), 'original')?>');"></div>

<div class="container uw-body">

  <div class="row">

    <div class="col-md-8 uw-content" role='small'>

      <div class="row uwaa-home-branding-row">
    <div class="col-sm-6">
      <?php
        $UWAA->UI->Breadcrumbs->UWAABreadcrumbs();
       ?>
    </div>
    <div class="col-sm-6 uwaa-home-branding">
      <!-- <div class="logo hidden-xs hidden-sm"> -->
        <?php //get_template_part('assets/uwaa', 'logo.svg');?>
      <!-- </div> -->
      <em>Produced by the Alumni Association for all UW Alumni</em>
    </div> 
  </div>

      <div class="uw-body-copy">
            <?php
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
    $mapURL = get_post_meta(get_the_id(), 'mb_operator_map', true);    
     if ($mapURL) {
      echo '<div class="widget">';
      echo '<img src=" ' . esc_attr($mapURL) . ' " title="Map of tour region" alt="Map of tour region" />';
      echo '</div>';
     }
        dynamic_sidebar( 'travel_sidebar' );
       
        the_widget("UWAA\Widgets\SocialSidebar");
        endwhile;
    ?>
    </div>


  </div>

</div>

<?php get_footer(); ?>
