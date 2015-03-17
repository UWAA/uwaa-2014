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
        add_action('wp_head', array($this, 'removeUWAnalytics'), 0);
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
    // $excludeSearchMetaQuery = 
    //         array(
    //             'relation' => 'OR',                
    //             array(
    //                 'relation' => 'AND',
    //                 array(
    //                     'key' => 'mb_isPreliminaryTour',                    
    //                     'compare' => 'EXISTS'
    //                 ),                
    //                 array(
    //                     'key' => 'mb_isPreliminaryTour',
    //                     'value' => 'ready_to_publish_tour',
    //                     'compare' => '='
    //                     ),
    //                 ),
    //             array(
    //                 'relation' => 'AND',    
    //                 array(
    //                     'key' => 'mb_isMajorMarket',                    
    //                     'compare' => 'EXISTS'
    //                 ),
    //                 array(
    //                     'key' => 'mb_isMajorMarket',
    //                     'value' => 'MajorMarket',
    //                     'compare' => '='
    //                     ),
    //                 ),
    //             array(
    //                 'relation' => 'AND',
    //                 array(
    //                     'key' => 'mb_isPreliminaryTour',                    
    //                     'compare' => 'NOT EXISTS'
    //                 ),
    //                 array(
    //                     'key' => 'mb_isMajorMarket',                    
    //                     'compare' => 'NOT EXISTS'
    //                 ),

    //                )
            
    // );

    // $meta_query = $excludeSearchMetaQuery;
    $query->set( 'tax_query', $taxquery );    
    // $query->set( 'meta_query', $meta_query );    
    return $query;

    }

    public function renameStoryPosts() 
    {
    
    global $menu;     
    $menu[5][0] = 'Story Posts'; // Change Posts to Story Posts

    }




    public function removeUWAnalytics() 
    {      
        
        // var_dump($GLOBALS['wp_filter']);
        if ( ! function_exists( 'remove_anonymous_object_filter' ) )
            {
                /**
                 * Remove an anonymous object filter.
                 *
                 * @param  string $tag    Hook name.
                 * @param  string $class  Class name
                 * @param  string $method Method name
                 * @return void
                 * http://wordpress.stackexchange.com/questions/57079/how-to-remove-a-filter-that-is-an-anonymous-object
                 */
                function remove_anonymous_object_filter( $tag, $class, $method )
                {
                    $filters = $GLOBALS['wp_filter'][ $tag ];

                    if ( empty ( $filters ) )
                    {
                        return;
                    }

                    foreach ( $filters as $priority => $filter )
                    {
                        foreach ( $filter as $identifier => $function )
                        {
                            if ( is_array( $function)
                                and is_a( $function['function'][0], $class )
                                and $method === $function['function'][1]
                            )
                            {
                                remove_filter(
                                    $tag,
                                    array ( $function['function'][0], $method ),
                                    $priority
                                );                                
                            }
                        }
                    }
                }
            }
        
        remove_anonymous_object_filter('wp_head', 'UW_Analytics', 'loadscript');
        remove_anonymous_object_filter('wp_enqueue_scripts', 'UW_Analytics', 'script');

    }

 


    
}
