<?php get_header(); ?>


<?php 

//@TODO  Make a better system for these communities headers
if (has_category('Profile')) {
  echo '<div class="uwaa-chapter-header">';
  get_template_part('partials/chapter-header');
  echo '</div>';
} else {
  get_template_part( 'header', 'image' ); 
}


?>

<div class="container uw-body">

  <div class="row">

    <div <?php uw_content_class(); ?> role='main'>

      <?php if (!has_category('Profile')) { uw_site_title(); }; ?>

      <?php get_template_part( 'breadcrumbs' ); ?>

      <div id='main_content' class="uw-body-copy">

            <?php
                // Start the Loop.
                while ( have_posts() ) : the_post();

                    /*
                     * Include the post format-specific template for the content. If you want to
                     * use this in a child theme, then include a file called called content-___.php
                     * (where ___ is the post format) and that will be used instead.
                     */
                    get_template_part( 'content', get_post_format() );

                    // If comments are open or we have at least one comment, load up the comment template.
                    if ( comments_open() || get_comments_number() ) {
                        comments_template();
                    }

                endwhile;
            ?>

            <span class="next-page"><?php next_posts_link( 'Next page', '' ); ?></span>

      </div>

    </div>

    <?php get_sidebar() ?>

  </div>

</div>

<?php get_footer(); ?>
