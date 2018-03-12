<?php namespace UWAA;

/*
*  Special helper classes we employ in the theme
 */

 

class Utilities
{

       

    function __construct()
    {
        add_filter('pre_get_posts',array($this,'SearchFilter'));
        add_filter('query_vars', array($this, 'addUWAAQueryVariables'));
        add_filter('request', array($this, 'addUWAACustomPostsToFeed'), 11, 2);
        add_filter('request', array($this, 'createJoinedFeedType'), 10, 2);
        add_action( 'admin_menu', array($this, 'renameStoryPosts'));
        add_action('wp_head', array($this, 'removeUWAnalytics'), 0);
        add_filter( 'manage_tours_posts_columns' , array($this , 'addTourExpiryDateColumnToTourList'), 10, 2);
        add_action( 'manage_tours_posts_custom_column' , array($this , 'addTourExpiryDateValueToTourList'), 10, 2);
        add_filter( 'manage_edit-tours_sortable_columns', array($this ,'makeTourEndDateSortable') );
        add_action( 'save_post', array($this, 'excludePreliminaryandMinorFromSearch'), 20 );
        add_filter('get_shortlink', array($this, 'returnUWFriendlyLink'), 10, 4);
        add_filter('get_sample_permalink_html', array($this, 'addGetPermalinkButton'), 5, 2);        
        add_action( 'template_redirect', array($this, 'redirectMembergramDirectQueries' ));
        add_action( 'parse_request',array($this, 'redirectDirectAccessToMembergrams') );
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
        $isAdmin = is_admin();
    if ( !$query->is_search )
        return $query;

    if (!$isAdmin) {

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
        
        $query->set( 'tax_query', $taxquery );        
        return $query;
        }
    }


    public function excludePreliminaryandMinorFromSearch($post_id)
    {

        // only do this for TOURS or CHAPTERS        
        $post = get_post($post_id);

        $post_type = $post->post_type;

        if ($post_type == 'tours' OR $post_type == 'chapters' )  {
            
        
        //nonce checks for the meta boxes have already occured...
        if( get_post_meta( $post_id, 'mb_isPreliminaryTour', true ) != 'ready_to_publish_tour' OR get_post_meta( $post_id, 'mb_isMajorMarket', true ) != 'majorMarket' OR get_post_meta( $post_id, 'mb_isPartnerEvent', true ) != true   ) {
        wp_set_object_terms( $post_id, 'exclude-from-search', 'category', true );
        }

        if( get_post_meta( $post_id, 'mb_isPreliminaryTour', true ) == 'ready_to_publish_tour' OR get_post_meta( $post_id, 'mb_isMajorMarket', true ) == 'majorMarket' OR get_post_meta( $post_id, 'mb_isPartnerEvent', true ) == false  ) {
        wp_remove_object_terms( $post_id, 'exclude-from-search', 'category', true );
        }

        }

    }

    public function renameStoryPosts() 
    {
    
    global $menu;     
    $menu[5][0] = 'Story Posts'; // Change Posts to Story Posts

    }




    public function removeUWAnalytics() 
    {      
        
        
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

    public function addUWAACustomPostsToFeed($qv) 
    {
    if (isset($qv['feed']) && !isset($qv['post_type']))
        $qv['post_type'] = array(
            'post',
            'page',
            'tours',
            'chapters',
            'benefits',
            'events',
            'public' => true
            );        
    return $qv;
    }



    public function createJoinedFeedType($qv) 
    {        
    if (isset($qv['feed']) && $qv['jointfeed'] == 'tpc_membergrams') {
            $qv['post_type'] = array(
            'tpcmembergrams',
            'membergrams',            
            'public' => true
            );
        }        
    return $qv;
    }




    public function Redirect($url, $permanent = false)
{
    header('Location: ' . $url, true, $permanent ? 301 : 302);

    exit();
}

public function returnUWFriendlyLink($shortlink, $id, $context) {
    
    
    
    if ( 'query' == $context && is_singular( 'tours' ) || is_singular( 'events' ) || is_singular( 'chapters' ) || is_singular( 'benefits' ) ) {
 
        
        $post_id = get_queried_object_id();
 
    }
    elseif ( 'post' == $context ) {
 
        // If context is post use the passed $id
        $post_id = $id;
 
    }


    $shortlink = FALSE;
    return $shortlink;
}

public function addGetPermalinkButton($arg, $post_id) {

    if(!is_admin()) {
        return;

    }

    $script = "prompt(&#39;URL:&#39;, jQuery('#no-cms-permalink').val()); return false;";

    $arg .= "<input id=\"no-cms-permalink\" type=\"hidden\" value=\"".preg_replace('/\/cms\//', '/', get_permalink())."\" />";

    $arg .= "<a href=\"#\" id='get-permalink-btn'  class='button button-small' onclick=\"".$script."\">Get Permalink</a>\n";

    return $arg;


}




    public function addTourExpiryDateColumnToTourList($columns) {      
          
          // die();
        // unset($columns['title']);
        
    
        return array_merge($columns,
            array(
                'end_date' => __('Tour End Date')
            )
    
        );
        
    }

    public function addTourExpiryDateValueToTourList($column, $post_id) {

        $date_format = 'Y/m/d';

        $shortDate = date($date_format, strtotime(get_post_meta( $post_id, 'mb_end_date', true )));
        $longDate = date("Y/m/d H:i", strtotime(get_post_meta( $post_id, 'mb_end_date', true )));
        
        switch ( $column ) {
            case 'end_date':
                echo "Tour Ends:<br>";
                echo '<abbr title="'.$longDate.'">'.$shortDate.'</abbr>';
            break;
            

        }
    }

    public function makeTourEndDateSortable($columns) {
        return wp_parse_args( array( 'end_date' => 'ended'), $columns );     

    }

    public function addUWAAQueryVariables($vars)
    {
        $vars[] = 'jointfeed';
        return $vars;
    }



    public function redirectMembergramDirectQueries()
    {
        if( is_singular( array('membergrams', 'tpcmembergrams') ) || is_post_type_archive(array('membergrams', 'tpcmembergrams') ) )
    {
        wp_redirect( home_url( '/' ) );
        exit();
        
    }

    }



public function redirectDirectAccessToMembergrams( $query ) {    
    if ( 'feed' != $query->query_vars['feed'] && ( ('tpcmembergrams' == $query->query_vars['post_type'] || 'membergrams' == $query->query_vars['post_type'] ) ) ) {
        wp_redirect( home_url( '/' ) );
        exit();
    }
    
    return $query;
}

   

}
