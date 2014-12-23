<?php namespace UWAA\View\ThumbnailBrowser\Thumbnail;

use \UWAA\View\ThumbnailBrowser\ThumbnailBrowser;
use \UWAA\View\UI;


class Chapters extends ThumbnailBrowser implements Thumbnail 
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

    public function __construct($chapterSlug)
    {
        $this->args = $this->setArguments($chapterSlug);
        $this->UI = new UI;
        // echo $chapterSlug;
    }

  private function setArguments($chapterSlug)
  {
    $args = array (
      'post_type' => array(
        'tours',
        'events',
        'benefits',
        'post'
        ),
      'posts_per_page' => 4, 
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
          'terms'    => array($chapterSlug)

          )
      ) //End tax query    
      );
    
    return $args;
  }  

   

  public function extractPostInformation($query) 
  {

    // var_dump($query);
        while ( $query->have_posts() ) : $query->the_post();
      if ($this->currentPostID == get_the_ID() ) {
        continue;
      }



        $this->postTitle = htmlspecialchars(get_the_title(get_the_ID()));
        $this->postURL = get_permalink();
        $this->postCalloutText = htmlspecialchars(get_post_meta(get_the_ID(), 'mb_thumbnail_callout', true));
        $this->postImageThumbnailURL = $this->UI->returnPostFeaturedImageURL(get_post_thumbnail_id(get_the_ID()), 'gridViewNoSidebar');    
        $this->postDate = htmlspecialchars(get_post_meta(get_the_ID(), 'mb_cosmetic_date', true));
        $this->postSubtitle = parent::getPostSubtitle($query);
        $this->postExcerpt = get_the_excerpt();
        
        echo $this->buildTemplate();

    endwhile;

    wp_reset_postdata();    

  }


public function buildTemplate() {

$callout = $this->renderCallout();

$template = <<<TEMPLATE
<div class="featured-post four-column">
<a href="{$this->postURL}">
    <div class="image-frame">
      <img src="{$this->postImageThumbnailURL}" alt="">
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