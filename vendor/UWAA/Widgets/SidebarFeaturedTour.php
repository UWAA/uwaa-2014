<?php namespace UWAA\Widgets;

/**
 * UWAA Featured Tour Sidebar Widget
 * Currently a placeholder.  This will be updated to pull in featured image and content from 
 * Other sections of the site.  
 */

class SidebarFeaturedTour extends \WP_Widget
{

  const URL = '//www.washington.edu/maps/embed/?code=';

  function __construct()
  {
      parent::WP_Widget( 'uwaa-sidebar-tours', __('Featured Tours'), array(
      'description' => __('Display featured tours in the the sidebar.'),
      'classname'   => 'uwaa-widget-sidebar-tours'
    ) );
  }

  function widget( $args, $instance )
  {
    extract( $args );
    extract( $instance );

//Build this out with real data from the tours, and bind templating so that it only pull what is needed.  Consider putting that code elsewhere.
  
   $content .= '<div class="uwaa-featured-tour"> 
                  <img src="http://fpoimg.com/302x250?text=SidebarImage">
                </div>';

    echo $before_widget . $content . $after_widget;
    }
 
}


register_widget( 'UWAA\Widgets\SidebarFeaturedTour' );
