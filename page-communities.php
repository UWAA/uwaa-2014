<?php 
get_header();
wp_enqueue_script(array('communitiesMap')); 
wp_enqueue_style('mapbox');



wp_localize_script( 'mapbox', 'homeLink', 
  array( 
    'endpointURL' => apply_filters('remove_cms', home_url('/api/communities/geojson'))
  ) 
);

$communitiesSidebarMenu = $UWAA->UI->buildCommunitySidebar();

?>



<div class="uw-hero-image communities"></div>

<div class="container uw-body">

  <div class="row">

    <div class="col-md-8 uw-content" role='main'>

    <h2 class="uw-site-title">Communities</h2>

  <?php get_template_part('partials/sidebar', 'page-breadcrumbs') ?>

  
      <div class="uw-body-copy">

        <?php
          // Start the Loop.
          while ( have_posts() ) : the_post();

            /*
             * Include the post format-specific template for the content. If you want to
             * use this in a child theme, then include a file called called content-___.php
             * (where ___ is the post format) and that will be used instead.
             */
            
            echo '<div class="mobile-menu-row">';
            include(locate_template( 'content-page-communities.php' ));
            echo '</div>';

            // If comments are open or we have at least one comment, load up the comment template.
            if ( comments_open() || get_comments_number() ) {
              comments_template('/comments.php');
            }

          endwhile;

          get_template_part( 'partials/map' );
        ?>

        <h3 style="margin-top:60px;">Is your contact information current?</h3>
        <p>Don't miss out on all the Husky happenings around the world. Please take a moment to update your information.</p>
        <div class="uwaa-btn-wrapper"><a class="uwaa-btn btn-slant-right btn-purple" href="https://www.washington.edu/alumni/services/update-your-information/" target="_blank">Update your information</a></div>
         

      </div>

    </div>
    
     <div class="col-md-4 uw-sidebar">
    <?php    
        
       $communitiesSidebarMenu = $UWAA->UI->buildCommunitySidebar();

        $communitiesSidebarMenu->renderCommunitiesChapterMenu(); 
        dynamic_sidebar( 'communities' );

        the_widget("UWAA\Widgets\SidebarSeeYourChapter");
        

    ?>

     
      </div>

    </div>

  </div>



<?php get_footer(); ?>
