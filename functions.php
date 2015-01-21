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



// if ( ! function_exists( 'uwaa_list_pages') ) :

  function uwaa_list_pages()
  {
    global $UWAA;
    global $post;

    

    wp_nav_menu( array(
    'theme_location'  => \UW_Dropdowns::LOCATION
    ,'container' => false
    // ,'container_class' => 'pagenav'
    // ,'depth' => -1
    // , 'menu_class' => 'children'
    , 'sub_menu' => true
    , 'show_parent' => true
    , 'container_id'    => ''
    , 'walker'       => $UWAA->SidebarMenuWalker
    , 'items_wrap' => '<ul class="uw-sidebar-menu first-level"><li class="pagenav"><a href=" ' .get_bloginfo('url') . '" title="Home" class="homelink">Home</a><ul id="%1$s" class="%2$s">%3$s</li></ul>' 
 ));


  }

// endif;

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
    
    // find the top level parent
    if ( ! isset( $args->direct_parent ) ) {
      $prev_root_id = $root_id;
      while ( $prev_root_id != 0 ) {
        foreach ( $sorted_menu_items as $menu_item ) {
          if ( $menu_item->ID == $prev_root_id ) {
            $prev_root_id = $menu_item->menu_item_parent;
            // don't set the root_id to 0 if we've reached the top of the menu
            if ( $prev_root_id != 0 ) $root_id = $menu_item->menu_item_parent;
            break;
          } 
        }
      }
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