<?php namespace UWAA\View\ThumbnailBrowser\Thumbnail;

use \UWAA\View\ThumbnailBrowser\ThumbnailBrowser;
use \UWAA\View\UI;


class Homepage extends ThumbnailBrowser implements Thumbnail 
{   
    
    protected $args;
    private $UI;

    //Properties Used to Build The Thumbnail For the Homepage
    private $currentPostID;
    private $postTitle;
    private $postURL;
    private $postCalloutText;
    private $postDate;
    private $postSubtitle;
    private $postImageThumbnailURL;
    private $postExcerpt;    

    public function __construct()
    {
        $this->args = $this->setArguments();
        $this->UI = new UI;
    }

  private function setArguments()
  {
    $args = array (
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
          'terms'    => array( 'Home')

          )
      ) //End tax query    
      );

    return $args;
  }  

   

  public function extractPostInformation($query) 
  {
        while ( $query->have_posts() ) : $query->the_post();
      if ($this->currentPostID == get_the_ID() ) {
        continue;
      }


        $this->postTitle = strip_tags(get_the_title(get_the_ID()));
        $this->postURL = get_permalink();
        $this->postCalloutText = strip_tags(get_post_meta(get_the_ID(), 'mb_thumbnail_callout', true));
        $this->postImageThumbnailURL = $this->UI->returnPostFeaturedImageURL(get_post_thumbnail_id(get_the_ID()), 'postExcerptRowOfFive');    
        $this->postDate = strip_tags(get_post_meta(get_the_ID(), 'mb_cosmetic_date', true));;
        $this->postSubtitle = parent::getPostSubtitle($query);
        $this->postExcerpt = get_the_excerpt();
        
        echo $this->buildTemplate();

    endwhile;

    wp_reset_postdata();    

  }


public function buildTemplate() {

$template = <<<TEMPLATE
<div class="featured-post">
<a href="{$this->postURL}">
    <div class="image-frame">
      <img src="{$this->postImageThumbnailURL}" alt="">
      <span>{$this->postCalloutText}</span>
    </div>
  <div class="copy">
 <h5 class="subtitle">{$this->postSubtitle}</h5>
 <h4 class="title">{$this->postTitle}</h4> 
 <h4 class="date">{$this->postDate}</h4>
 <p class="excerpt">{$this->postExcerpt}</p>
 </div>
 </a>
  
</div>
TEMPLATE;

return $template;
}

    public function __destruct()
    {

    }
}