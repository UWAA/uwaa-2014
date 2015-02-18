<?php 
get_header(); 
wp_enqueue_script(array('communitiesMap'));
wp_enqueue_style('mapbox');
wp_localize_script( 'mapbox', 'homeLink', array( 'endpointURL' => home_url('/api/communities/geojson')  ) );
$communitiesSidebarMenu = $UWAA->UI->buildCommunitySidebar();


?>

<div class="uw-hero-image communities"></div>

<div class="container uw-body">

  <div class="row">

    <div class="col-md-8 uw-content" role='main'>
      <h2 class="uw-site-title">Communities</h2>

      <div class="uw-body-copy">

     <?php get_template_part('partials/sidebar', 'page-breadcrumbs') ?>

        <?php
          // Start the Loop.
          while ( have_posts() ) : the_post();

            /*
             * Include the post format-specific template for the content. If you want to
             * use this in a child theme, then include a file called called content-___.php
             * (where ___ is the post format) and that will be used instead.
             */
            // get_template_part( 'content', 'page' );
            // 
             include(locate_template( 'content-page-communities.php' ));

            // If comments are open or we have at least one comment, load up the comment template.
            if ( comments_open() || get_comments_number() ) {
              comments_template('/comments.php');
            }

          endwhile;

          get_template_part( 'partials/map' );
        ?>

      </div>

    </div>
    
     <div class="col-md-4 uw-sidebar">







    <?php    

       

        $communitiesSidebarMenu->renderCommunitiesChapterMenu();  
        
      
       dynamic_sidebar( 'communities_sidebar' );
        

    ?>

    <div id="no-chapter-widget" class="widget widget_text">
          <h2 class="widgettitle">Don&rsquo;t See Your Chapter?</h2>
          <div class="uwaa-btn-wrapper"><a class="uwaa-btn btn-slant-right btn-purple" href="mailto:jdotson@uw.edu&subject=Online%20Chapter%20Inquiry">Let Us Know!</a></div>
        </div>
      </div>

     
      </div>

    </div>

  </div>



<?php get_footer(); ?>
