<?php namespace UWAA\Taxonomies;

class Utilities
{
    
    public function echoListOfTerms($taxonomyName)
    {

        $terms = get_the_terms( $post->ID, "$taxonomyName");
                
        if ( !empty( $terms ) && !is_wp_error( $terms ) ) :   
            foreach ( $terms as $term ) {
                echo " " . $term->name . " ";     
                }  
        endif;
     
     }

     public function getArrayOfTerms($taxonomyName) 
     {

     }

}