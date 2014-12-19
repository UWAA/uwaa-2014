<?php namespace UWAA\Slideshow;


use \UWAA\View\UI as UI;
class Slideshow
{

    protected $location;
    protected $args;
  
    function __construct($location)
    {
        $this->location = $location;
        $this->args = $this->setArgs();
        
    }

    // public function get_latest_slideshow() 
// {
//     $UI = new UI;
//     $info = [
//         'id' => '51',
//         'title' =>  'Sample Title',
//         'text' => 'Sample text',
//         'link' => 'Should be a rendered button',
//         'contentHead' => 'Content Head',
//         'overlayColor' => 'purple',
//         'image' => $UI->returnPostFeaturedImageURL(get_post_thumbnail_id(51), 'original')
//     ];

//     $slideContents = (object) $info;


//     $return[] = $slideContents;    

//     return $return;
// }

protected function setArgs() {

    
 return array (
      'post_type' => array(
        'tours',
        'events',
        'benefits',
        'post'
        ),
      'posts_per_page' => 5, 
      
      'orderby' => 'rand',
      // 'tag' => 'Home'
      
      'tax_query' => array(
        // 'relation' => 'AND',
        // array(
        //   'taxonomy' => 'destinations',
        //   'field'    => 'name',
        //   'terms'    => array( 'asia')
        // ),
        array(
          'taxonomy' => 'uwaa_content_promotion',
          'field'    => 'name',
          'terms'    => array($this->location)

          )
      ) //End tax query    
      );
}

public function get_latest_slideshow()
  {
    
    $UI = new UI;
    
    $slideshow = new \WP_Query($this->args);

    if ( $slideshow->have_posts()  ) :

    
    while ( $slideshow->have_posts() ) : $slideshow->the_post();
    
    $slidesContent = array (
        'id' => get_the_id(),
        'title' => get_the_title(),
        'image' => $UI->returnPostFeaturedImageURL(get_post_thumbnail_id(get_the_id()), 'original'),
        'text' => get_the_excerpt(),
        'link' => get_the_permalink(get_the_id())
        );

    $load = (object) $slidesContent;

    $slides[] = $load;

    endwhile;
    endif;

    
    
    wp_reset_postdata();
     return $slides ? json_decode( json_encode( array_reverse( $slides ) ) ) : array();

  }

}