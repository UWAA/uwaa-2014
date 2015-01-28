<?php namespace UWAA\Slideshow;


use \UWAA\View\UI as UI;
class CommunitiesSlideshow extends Slideshow
{


  
  public $allChapters;

  function __construct($location)
  {
    $this->allChapters = $this->getArrayOfRegionalChapterSlugs();
    parent::__construct($location);
  }

    
  protected function getArrayOfData() {

    $UI = new UI; 
  
  $postPromotionSlugs = wp_get_post_terms(get_the_id(), 'uwaa_content_promotion', array("fields" => "slugs"));  
  
  $targetedChapter = array_intersect($postPromotionSlugs, $this->allChapters);  
  $chapterSlug = array_pop($targetedChapter);
  $chapter = get_page_by_path($chapterSlug, OBJECT, 'chapters' );  
  
  
  
  $output =  array (
        'id' => get_the_id(),
        'title' => get_the_title(),
        //needs to be the feature image for the chapter
        'image' => $UI->getPostFeaturedImageURL(get_post_thumbnail_id($chapter->ID), 'original'),
        //needs to the logo for the chapter
        'logo' => $chapterSlug,
        'text'  => get_the_excerpt(),
        'link' => get_the_permalink(get_the_id()),
        'header_text_color' => get_post_meta(get_the_ID(), 'mb_header_text_color', true),
        'subtitle' => get_post_meta(get_the_ID(), 'mb_thumbnail_subtitle', true),
        'date' => get_post_meta(get_the_ID(), 'mb_cosmetic_date', true),
        'date' => get_post_meta(get_the_ID(), 'mb_cosmetic_date', true),        
        );


  return $output;
}


    protected function getArrayOfRegionalChapterSlugs() {

        
        $chapters = array();

        $args=array(
        'post_type' => 'chapters',
        'post_status' => 'publish',
        'posts_per_page' => -1,
        'orderby' => 'rand'        
        );

    
        $slugQuery = get_posts($args);
        
            foreach($slugQuery as $post):
    
            $chapters[] = basename(get_permalink($post->ID));
    
            endforeach;
            wp_reset_postdata();   
    
    
    return $chapters;
    }





  

 
}