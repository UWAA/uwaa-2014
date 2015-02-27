<?php namespace UWAA;

/*
*  Special helper classes we employ in the theme
 */

 

class Utilities
{

       

    function __construct()
    {
        add_filter('pre_get_posts',array($this,'SearchFilter'));
        add_action( 'admin_menu', array($this, 'renameStoryPosts'));
        add_filter('site_option_active_sitewide_plugins', array($this, 'modify_sitewide_plugins'));
        
        
    }   

    // https://tommcfarlin.com/get-permalink-by-slug/
    public function get_permalink_by_title( $title )
    {

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


    public function SearchFilter($query)

    {
    if ( !$query->is_search )
        return $query;

    $taxquery = array(
        array(            
            array(
                'taxonomy' => 'category',
                'field'    => 'slug',
                'terms'    => array( 'exclude-from-search'),
                'operator'  => 'NOT IN'
            ),
            
        )
    );
    // @TODO Get this working!  Need to exclude prelim tours from site search...
    // $excludeSearchMetaQuery = array(
    //     // 'relation' => 'OR',
    //     array(
    //             'key' => 'mb_isPreliminaryTour',
    //             'value' => 'preliminary',
    //             'compare' => '!='
    //         ),
    // );

    $meta_query = $excludeSearchMetaQuery;
    $query->set( 'tax_query', $taxquery );
    // $query->set( 'meta_query', $meta_query );
    // var_dump($meta_query);
    return $query;

    }

    public function renameStoryPosts() 
    {
    
    global $menu;     
    $menu[5][0] = 'Story Posts'; // Change Posts to Recipes

    }




    public function modify_sitewide_plugins($value) 
    {
    unset($value['uw-analytics/analytics.php']);
    unset($value['analytics/analytics.php']);
    return $value;
    }

 


    
}
