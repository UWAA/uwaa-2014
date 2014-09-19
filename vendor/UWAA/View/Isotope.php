<?php namespace UWAA\View;

class Isotope
{
    function __construct() 
    {

    }

    public function buildSortingToolbar($taxonomyName){
        echo '<div id="filters" class="button-group">';
        $terms = get_terms("$taxonomyName");
        if ( !empty( $terms ) && !is_wp_error( $terms ) ) :
            foreach ( $terms as $term ) {
                echo sprintf('<button class="button btn" data-filter=".%s">%s</button>', $term->name, $term->name);
        }
        echo '</div>';
        
        endif;
    }


} 