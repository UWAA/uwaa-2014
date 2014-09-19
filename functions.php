<?php


//TODO - Get PSR-X all up in this.  

require_once(__DIR__ . '/vendor/autoload.php');



if (!isset($UWAA)){
    new UWAA\Loader();
}

if ( ! function_exists( 'uwaa_get_tour_taxonomy_categories') ) :

 function uwaa_get_tour_taxonomy_categories(){

 $terms = get_the_terms( $post->ID, "destinations");
 if ( !empty( $terms ) && !is_wp_error( $terms ) ){
     
     foreach ( $terms as $term ) {
       echo " " . $term->name . " ";       
     }
     
 }

}

 endif;


 if (! function_exists('uwaa_thumbnail_browser') ) :




    endif;