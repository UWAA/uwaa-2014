<?php namespace UWAA\Slideshow;


use \UWAA\View\UI as UI;
class Slideshow
{

    protected $location;
    protected $args;
  
    function __construct($location)
    {
        $this->location = $location;
        $this->args = $this->getArgs();
        
    }

protected function getArgs() {

    
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

protected function getArrayOfData() {

  $UI = new UI;

  return array (
        'id' => get_the_id(),
        'title' => get_the_title(),
        'image' => $UI->returnPostFeaturedImageURL(get_post_thumbnail_id(get_the_id()), 'original'),
        'text' => get_the_excerpt(),
        'link' => get_the_permalink(get_the_id()),
        'alternateLink' => get_post_meta(get_the_ID(), 'mb_alternate_link', true),
        'header_text_color' => get_post_meta(get_the_ID(), 'mb_header_text_color', true),
        'subtitle' => get_post_meta(get_the_ID(), 'mb_thumbnail_subtitle', true),
        'date' => get_post_meta(get_the_ID(), 'mb_cosmetic_date', true),
        );
}

public function get_latest_slideshow()
  {
    
   
    
    $slideshow = new \WP_Query($this->args);

    if ( $slideshow->have_posts()  ) :

    
    while ( $slideshow->have_posts() ) : $slideshow->the_post();
    
    $slidesContent = $this->getArrayOfData();

    $load = (object) $slidesContent;

    $slides[] = $load;

    endwhile;
    endif;
    
    wp_reset_postdata();


    return $slides ? json_decode( json_encode( array_reverse( $slides ) ) ) : array();

  }

}