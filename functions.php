<?php


if (!isset($UWAA)){
    require( get_stylesheet_directory() . '/setup/class.uwaa.php' );
    $UWAA = new UWAA();
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