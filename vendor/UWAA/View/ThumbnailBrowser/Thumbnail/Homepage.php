<?php namespace UWAA\View\ThumbnailBrowser\Thumbnail;

use \UWAA\View\ThumbnailBrowser\ThumbnailBrowser;
use \UWAA\View\UI;


class Homepage extends ThumbnailBrowser implements Thumbnail 
{   
    
    protected $args;
    private $UI;

    //Properties Used to Build The Thumbnail For the Homepage
    protected $currentPostID;
    protected $postTitle;
    protected $postURL;
    protected $postCalloutText;
    protected $postDate;
    protected $postSubtitle;
    protected $postImageThumbnailURL;
    protected $postExcerpt;
      

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
          'field'    => 'slug',
          'terms'    => array( 'home-row')

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


        $this->postTitle = esc_html(get_the_title(get_the_ID()));
        $this->postURL = get_permalink();
        $this->postCalloutText = esc_html(get_post_meta(get_the_ID(), 'mb_thumbnail_callout', true));
        $this->postImageThumbnailURL = $this->UI->returnPostFeaturedImageURL(get_post_thumbnail_id(get_the_ID()), 'postExcerptRowOfFive');    
        $this->postDate = esc_html(get_post_meta(get_the_ID(), 'mb_cosmetic_date', true));
        $this->postSubtitle = parent::getPostSubtitle($query);
        $this->postExcerpt = esc_html($this->shortenExcerpt(get_post_meta(get_the_ID(), 'mb_80_character_excerpt', true), 100));        
        
        echo $this->buildTemplate();

    endwhile;

    wp_reset_postdata();    

  }

  protected function renderImage() {
    if ($this->postImageThumbnailURL) {
      return '<img src="' . $this->postImageThumbnailURL . '"/>';
    } 
    return '<img src="http://fpoimg.com/215x155?text=FPO" />';

   }


public function buildTemplate() {

$callout = $this->renderCallout();
$image = $this->renderImage();
$template = <<<TEMPLATE
<div class="featured-post five-column">
<a href="{$this->postURL}">
    <div class="image-frame">
      $image
      $callout
    </div>
  <div class="copy">
 <h6 class="subtitle">{$this->postSubtitle}</h6>
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