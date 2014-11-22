<?php namespace UWAA\Widgets;

/**
 * UWAA Featured Tour Sidebar Widget
 * Currently a placeholder.  This will be updated to pull in featured image and content from 
 * Other sections of the site.  
 */

class SidebarFeaturedTour extends \WP_Widget
{

  const URL = '//www.washington.edu/maps/embed/?code=';
  private $content;
  

  function __construct()
  {
      parent::WP_Widget( 'uwaa-sidebar-tours', __('Featured Tours'), array(
      'description' => __('Display featured tours in the the sidebar.'),
      'classname'   => 'uwaa-widget-sidebar-tours'
    ) );
      
  }

  public function widget( $args, $instance )
  {
    extract( $args );
    extract( $instance );


//Build this out with real data from the tours, and bind templating so that it only pull what is needed.  Consider putting that code elsewhere.
    //DI for the needed variables....
  
   $this->content .= '<div class="uwaa-featured-tour">';
                  
   $this->content .= get_template_part( 'partials/featured-sidebar-post.php' );
   $this->content .= '</div>';

    echo $before_widget . $this->content . $after_widget;
    }
 
}


register_widget( 'UWAA\Widgets\SidebarFeaturedTour' );
