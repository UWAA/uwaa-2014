<?php namespace UWAA\Taxonomies;

class Utilities
{
    
    public function echoListOfTerms($taxonomyName)
    {

        $terms = get_the_terms( $post->ID, "$taxonomyName");
                
        if ( !empty( $terms ) && !is_wp_error( $terms ) ) :   
            foreach ( $terms as $term ) {
                echo " " . strtolower($term->name) . " ";     
                }  
        endif;
     
     }

     public function getArrayOfTerms($taxonomyName) 
     {
         $terms = get_terms("$taxonomyName");
     if ( !empty( $terms ) && !is_wp_error( $terms ) ){
     echo "<ul>";
     foreach ( $terms as $term ) {
       echo "<li>" . $term->name . "</li>";
        
     }
     echo "</ul>";
 }
     }

}