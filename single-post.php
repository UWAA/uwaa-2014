<?php get_header(); ?>
<a name="pagination-top"></a>

<?php 

//@TODO  Make a better system for these communities headers
$featureImage = $UWAA->UI->returnPostFeaturedImageURL(get_post_thumbnail_id($post->ID), 'original');
if (has_category('Tall Regional Branding')) {
  echo '<div class="uwaa-chapter-header profile">';
  //TODO rename the profile class so the LESS matches the category
  get_template_part('partials/profile-header');
  echo '</div>';
} elseif (has_category('Short Regional Branding')) {
  echo '<div class="uwaa-chapter-header">';
  get_template_part('partials/chapter-header');
  echo '</div>';
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

                <h1>
                  <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title() ?></a>
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
            ?>

            <span class="next-page"><?php next_posts_link( 'Next page', '' ); ?></span>

      </div>

    </div>
    
    <div class="col-md-4 uw-sidebar">
    <?php 

    new \UWAA\View\Pagination('post', get_the_ID());

    the_widget("UWAA\Widgets\SidebarPullQuote");
    
    the_widget("UWAA\Widgets\SocialSidebar");
        
    ?>
    </div>

  </div>

</div>

<?php get_footer(); ?>
