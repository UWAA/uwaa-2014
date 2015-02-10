<?php namespace UWAA;

/*
*  Special helper classes we employ in the theme
 */

 

class Utilities
{

       

    function __construct()
    {
        
        
    }   

    // https://tommcfarlin.com/get-permalink-by-slug/
    public function get_permalink_by_title( $title ) {

    // Initialize the permalink value
    $permalink = null;

    // Try to get the page by the incoming title
    $page = get_page_by_title( strtolower( $title ) );

    // If the page exists, then let's get its permalink
    if( null != $page ) {
        $permalink = get_permalink( $page->ID );
    } // end if

    return $permalink;

    } // end theme_get_permalink_by_title

    
}
