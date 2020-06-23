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
        add_filter('get_image_tag_class', array($this, 'add_image_class'));
        add_action('after_setup_theme', array($this, 'attachment_default_settings'));
        add_filter('the_permalink_rss', array($this, 'overwriteCTAButtonLink'));
        add_action('wp_head', array($this, 'hidePage'), 4);
        add_action('wp_head', array($this, 'addFacebookPixel'), 5);
        add_filter('ppp_nonce_life', array($this, 'extendPreviewTime') );
        add_action( 'wp_body_open', array($this, 'addGTMNoscriptTracking' ) );
        

        $this->addExcerptsToPosts();
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
        $query->set('post__not_in', array(32169, 29667));  
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
    if (isset($qv['feed']) && isset($qv['jointfeed']) == 'tpc_membergrams') {
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

    public function hidePage()
    {
        if(is_page('dawgdashmemberpage')) {
            echo '<meta name="robots" content="noindex,nofollow">';
        }

    }


    public function redirectMembergramDirectQueries()
    {

        


            if( is_singular( array('membergrams', 'tpcmembergrams') ) || is_post_type_archive(array('membergrams', 'tpcmembergrams') ) )  
        {
            // if (! is_admin() ) {
                wp_redirect( home_url( '/' ) );
            exit();

            // }
            
        
        }       
        

    }



public function redirectDirectAccessToMembergrams( $query ) {    
    if ( ('tpcmembergrams' == $query->query_vars['post_type'] || 'membergrams' == $query->query_vars['post_type'] ) && ! is_admin() ) {

        if ( 'feed' != $query->query_vars['feed'] ) {

            wp_redirect( home_url( '/' ) );
            exit();

        }
        
    }
    
    return $query;
}



public function add_image_class($class){
    $class .= ' inline';
    return $class;
}



public function attachment_default_settings() {
  update_option('image_default_link_type', 'none' );  
}

public function overwriteCTAButtonLink($post_permalink) {
    $content = get_post_meta(get_the_id() , 'mb_membergram_cta_link', true); 
            if ($content)
                  {
            return $content;
        } else {
            return $post_permalink;
        }
    }

    public function pageLevelRedirect() {
        if (!is_page() ) {
            return;
        }
    $isRedirecting = get_post_meta(get_the_id() , 'mb_is_page_redirecting', true);
    $redirectTarget = get_post_meta(get_the_id() , 'mb_redirect_slug', true);
            if ($isRedirecting)
                  {
            wp_redirect( home_url( '/' . $redirectTarget , '301' ) );
            exit();
        } else {
            return;
        }
    }

    public function addExcerptsToPosts() {
        add_post_type_support( 'page', 'excerpt' );
    }

    public function addFacebookPixel() {

        if (get_post_field( 'post_name', get_post() ) == 'join-or-renew') {
            ?>
        <!-- Facebook Pixel Code -->
        <script>
          !function(f,b,e,v,n,t,s)
          {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
          n.callMethod.apply(n,arguments):n.queue.push(arguments)};
          if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
          n.queue=[];t=b.createElement(e);t.async=!0;
          t.src=v;s=b.getElementsByTagName(e)[0];
          s.parentNode.insertBefore(t,s)}(window, document,'script',
          'https://connect.facebook.net/en_US/fbevents.js');
          fbq('init', '376455499971217');
          fbq('track', 'PageView');
          fbq('track', 'InitiateCheckout');
        </script>
        <noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=376455499971217&ev=PageView&noscript=1" /></noscript>
        <!-- End Facebook Pixel Code -->

        <?php
        }
        
    }

    public function extendPreviewTime() {
        return 60 * 60 * 24 * 7;
    }


    public function addGTMNoscriptTracking() {
        echo '<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5PKKG9"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->';
    }
    

   

}
