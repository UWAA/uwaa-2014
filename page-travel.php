<?php 
get_header(); 
wp_enqueue_script(array('mapbox-gl-js', 'toursMap', 'superHero'));
wp_enqueue_style('mapbox-gl-js'); //Map


wp_localize_script( 'mapbox', 'homeLink',  //Map
  array( 
    'endpointURL' => apply_filters('remove_cms', home_url('/api/tours/geojson'))  
    ) 
  );

?>


<div id="spacer"></div>
<?php uw_mobile_front_page_menu(); ?>



<?php 


if(class_exists('\UWAA\Slideshow\TravelSlideshow')):

$superhero = new \UWAA\Slideshow\TravelSlideshow("travel-superhero");

include(locate_template('content-slideshow.php'));

endif;

?>

<div class="container uw-body">

  <div class="row">

    <div class="col-md-8 uw-content" role='main'>

     

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
            get_template_part( 'content', 'page' );


          endwhile;
          // get_template_part( 'partials/map' );  //Map
        ?>
        

         

      </div>
    </div>
    
     <div class="col-md-4 uw-sidebar">
    <?php 
        // echo sprintf( '<nav id="desktop-relative" aria-label="mobile menu that is not visible in the desktop version" class="uwaa-hidden-xs-up">%s</nav>', uw_list_pages() );;
        echo sprintf( '<nav id="desktop-relative" aria-label="mobile menu that is not visible in the desktop version" class="uwaa-hidden-xs-up">%s</nav>', uw_list_pages() );
        dynamic_sidebar( 'travel_sidebar' );

        get_template_part('partials/forms', 'travel-newsletter');


    ?>





    </div>

  </div>

</div>

<?php 
get_template_part('partials/tours-footer');
get_footer();
?>
