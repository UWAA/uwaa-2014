<?php


try {    
    
    if (! @include_once(__DIR__. '/vendor/UWAA/.env.php'))
    {
        throw new Exception ("a .env.php file is required for some features of this theme.");
    }
    require_once(__DIR__. '/vendor/UWAA/.env.php');

} catch (Exception $e) {
    echo "Error Message:" . $e->getMessage();
}



//Autoloads all of the UWAA classes, as they follow PSR-0 autoloading standards.  Classes can be called using that \UWAA\Path\To\Class->Method syntax
require_once(__DIR__ . '/vendor/autoload.php');

//Instatiates site-wite classes.  
if (!isset($UWAA)){
    $UWAA = new UWAA\UWAA($wp);
}


//Page Slug Body Class

function add_slug_body_class( $classes ) {

global $post;

if ( isset( $post ) ) {

$classes[] = $post->post_type . '-' . $post->post_name;

}

return $classes;

}

add_filter( 'body_class', 'add_slug_body_class' );


// Allow SVG for Media Uploader
function cc_mime_types($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');  

// Disables the Gutenberg Block Editor
add_filter('use_block_editor_for_post', '__return_false', 10);

// http://christianvarga.com/how-to-get-submenu-items-from-a-wordpress-menu-based-on-parent-or-sibling/
  // add hook
add_filter( 'wp_nav_menu_objects', 'my_wp_nav_menu_objects_sub_menu', 10, 2 );

// filter_hook function to react on sub_menu flag
function my_wp_nav_menu_objects_sub_menu( $sorted_menu_items, $args ) {
  if ( isset( $args->sub_menu ) ) {
    $root_id = 0;
    
    // find the current menu item
    foreach ( $sorted_menu_items as $menu_item ) {
      if ( $menu_item->current ) {
        // set the root id based on whether the current menu item has a parent or not
        $root_id = ( $menu_item->menu_item_parent ) ? $menu_item->menu_item_parent : $menu_item->ID;
        break;
      }
    }
    
    // find parent one level up
    if ( ! isset( $args->direct_parent ) ) {
      $prev_root_id = $root_id;      
        $prev_root_id = $menu_item->menu_item_parent;       
    }

    $menu_item_parents = array();
    foreach ( $sorted_menu_items as $key => $item ) {
      // init menu_item_parents
      if ( $item->ID == $root_id ) $menu_item_parents[] = $item->ID;

      if ( in_array( $item->menu_item_parent, $menu_item_parents ) ) {
        // part of sub-tree: keep!
        $menu_item_parents[] = $item->ID;
      } else if ( ! ( isset( $args->show_parent ) && in_array( $item->ID, $menu_item_parents ) ) ) {
        // not part of sub-tree: away with it!
        unset( $sorted_menu_items[$key] );
      }
    }
    
    return $sorted_menu_items;
  } else {
    return $sorted_menu_items;
  }
}

add_filter('nav_menu_css_class', 'current_type_nav_class', 10, 2 );
function current_type_nav_class($classes, $item) {
    $post_type = get_query_var('post_type');
    if(is_string($post_type)) {
      if ($item->title != '' && $item->title == ucfirst($post_type) ) {
        array_push($classes, 'current_page_item');
    };

    }
    
    return $classes;
}


// MARK - Page-Specific Scripts are included here.
// Can refer to scripts loaded in Scripts.php
// function load_page_specific_scripts() {
//     global $post;
//     wp_register_script( 'fevo_library','https://sdk.fevo.com/v1/fevo.js');
//     wp_register_script( 'uwaa_fevo', get_stylesheet_directory_uri() . '/js/support/uwaaFevo.js', array('fevo_library', 'jquery'));
//     $fevoValues = array(
//       'fevoPublisherKey' => ($_ENV['fevoPublisherKey']),
//       'fevoEventKey' => ($_ENV['fevoEventKey']),
//       );

//     wp_localize_script('uwaa_fevo', 'uwaaFevoProperties', $fevoValues);    

//     if( is_page() || is_single() )
//     {
//         switch($post->post_name) 
//         {
//             case 'sounders':
//               wp_enqueue_script('uwaa_fevo');                
//               break;
//             case 'be-a-member' :
//               wp_enqueue_script('cyberAppealCodePreservation');
//               break;
//             case 'membership' :
//               wp_enqueue_script('cyberAppealCodePreservation');
//               break;
//             case 'join-or-renew' :
//               wp_enqueue_script('cyberAppealCodePreservation');
//               break;
//             case 'oregon':
//               wp_enqueue_script('oregonMailingListEmailForm');
//               break;            
//             // case 'holidays':
//             //   wp_enqueue_script('homepageSnow');
//             //   break;
//             case 'zoom-backgrounds-for-huskies':
//               wp_enqueue_script('trackImageDownloads');
//             break;

//         }
//     } 
// }

// add_action('wp_enqueue_scripts', 'load_page_specific_scripts');


if ( ! function_exists( 'uw_dropdowns') ) :
  function uw_dropdowns()
  {

    echo '<nav id="dawgdrops" aria-label="Main menu"><div class="dawgdrops-inner container" role="application"><a href="'. get_bloginfo('url') .'" ><div class="uwaa-home-logo"></div></a>';

    echo  wp_nav_menu( array(
            'theme_location'  => UW_Dropdowns::LOCATION,
            'container'       => false,
            //'container_class' => 'dawgdrops-inner container',
            'menu_class'      => 'dawgdrops-nav',
            'fallback_cb'     => '',
            'walker'          => new UW_Dropdowns_Walker_Menu()
          ) );

    echo '</div></nav>';
  }
endif;

function uw_meta_tags() {
  return;
}

add_action( 'wp_enqueue_scripts', 'load_dashicons_front_end' );
function load_dashicons_front_end() {
  wp_enqueue_style( 'dashicons' );
}


add_action( 'after_setup_theme', 'register_test_menu' );
function register_test_menu()
    {
        register_nav_menu( 'Test Menu', 'test-menu');
    }