<?php namespace UWAA\Widgets;

/**
 * UWAA Featured Tour Sidebar Widget
 * Currently a placeholder.  This will be updated to pull in featured image and content from 
 * Other sections of the site.  
 */


class SidebarFeaturedTour extends \WP_Widget
{

  const ID    = 'uwaa-sidebar-feature';
  const TITLE = 'UWAA Sidebar Featured Post';
  const DESC  = 'Display featured posts in the the sidebar.';
  private $content;

  //Data from the post object to be used in our promoted post.  
  private $postTitle;
  private $postThumbnailUrl;
  private $postCalloutText;
  private $postURL;
  

  function __construct()
  {
      parent::WP_Widget(
      $id      = self::ID,
      $name    = self::TITLE,
      $options = array(
        'description' => self::DESC,
        'classname'   => self::ID
      )
    );

      
  }

  private function getPosts() {
    $args = array(
      'post_type' => 'tours'
      );

    $query = new \WP_Query($args);

    $this->extractPostInformation($query);
    return $query;
  }

  private function extractPostInformation($query) 
  {

    while ( $query->have_posts() ) : $query->the_post();
        $this->postTitle = strip_tags(get_the_title());
        $this->postURL = get_permalink();
        $this->postCalloutText = strip_tags(get_post_meta(get_the_ID(), 'mb_thumbnail_callout', true));
    endwhile;

    wp_reset_postdata();    
  }

  public function widget( $args, $instance )
  {
     $this->getPosts();
    // extract( $args );
    // extract( $instance );
    // TODO This will be built with a an argument passed from the widget backend perhaps.
   
//Build this out with real data from the tours, and bind templating so that it only pull what is needed.  Consider putting that code elsewhere.
    //DI for the needed variables....
  
   echo'<div class="uwaa-featured-tour">';
                  
   // $this->content .= get_template_part( 'partials/featured-sidebar-post.php' );
   
   // 
   

echo <<<CONTENT
   <a href="$this->postURL">$this->postTitle - $this->postCalloutText</a>
CONTENT;


echo '</div>';
}


 
}


register_widget( 'UWAA\Widgets\SidebarFeaturedTour' );
