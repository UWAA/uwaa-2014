<?php namespace UWAA\Slideshow;


use \UWAA\View\UI as UI;
class TravelSlideshow extends Slideshow
{

    protected function getArrayOfData() {

  $UI = new UI;
  
  return array (
        'id' => get_the_id(),
        'title' => get_the_title(),
        'image' => $UI->returnPostFeaturedImageURL(get_post_thumbnail_id(get_the_id()), 'original'),
        'text'  => get_the_excerpt(),
        'link' => get_the_permalink(get_the_id()),
        'header_text_color' => get_post_meta(get_the_ID(), 'mb_header_text_color', true),
        'subtitle' => get_post_meta(get_the_ID(), 'mb_thumbnail_subtitle', true),
        'date' => get_post_meta(get_the_ID(), 'mb_cosmetic_date', true),
        
        );
}

  

 
}