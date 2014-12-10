<?php namespace UWAA\Taxonomies;

class Utilities
{
    
    public static function getListOfTerms($taxonomyName)
    {

        $terms = get_the_terms( $post->ID, "$taxonomyName");
                
        if ( !empty( $terms ) && !is_wp_error( $terms ) ) :   
            implode(' ', $terms);
        endif;
     
     }

     public static function getArrayOfTerms($taxonomyName) 
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