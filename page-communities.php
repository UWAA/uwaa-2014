<?php 
get_header(); 
wp_enqueue_script('communitiesMap');
wp_enqueue_style('mapbox');

?>



<div class="uw-hero-image"></div>

<div class="container uw-body">

  <div class="row">

    <div class="col-md-8 uw-content" role='main'>

      <a href="<?php echo home_url('/'); ?>" title="<?php echo esc_attr( get_bloginfo() ) ?>"><h2 class="uw-site-title"><?php bloginfo(); ?></h2></a>

      <?php get_template_part( 'breadcrumbs' ); ?>

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

            // If comments are open or we have at least one comment, load up the comment template.
            if ( comments_open() || get_comments_number() ) {
              comments_template();
            }

          endwhile;

          get_template_part( 'partials/map' );
        ?>
         
        

         

      </div>

    </div>
    
     <div class="col-md-4 uw-sidebar">
    <?php 
        uw_sidebar_menu();

        get_template_part('partials/communities-no-chapter')

    ?>
    </div>

  </div>

</div>

<?php get_footer(); ?>
