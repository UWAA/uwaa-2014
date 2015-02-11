<?php namespace UWAA\View\ThumbnailBrowser\Thumbnail;

use \UWAA\View\ThumbnailBrowser\ThumbnailBrowser;
use \UWAA\View\UI;


class Communities extends ThumbnailBrowser implements Thumbnail 
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
          'field'    => 'name',
          'terms'    => array( 'Communities')

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



        $this->postTitle = htmlspecialchars(get_the_title(get_the_ID()));
        $this->postURL = get_permalink();
        $this->postCalloutText = htmlspecialchars(get_post_meta(get_the_ID(), 'mb_thumbnail_callout', true));
        $this->postImageThumbnailURL = $this->UI->returnPostFeaturedImageURL(get_post_thumbnail_id(get_the_ID()), 'gridViewNoSidebar');    
        $this->postDate = htmlspecialchars(get_post_meta(get_the_ID(), 'mb_cosmetic_date', true));
        $this->postSubtitle = parent::getPostSubtitle($query);
        $this->postExcerpt = $this->shortenExcerpt(get_the_excerpt(), 100);
        
        echo $this->buildTemplate();

    endwhile;

    wp_reset_postdata();    

  }


 protected function renderImage() {
    if ($this->postImageThumbnailURL) {
      return '<img src="' . $this->postImageThumbnailURL . '"/>';
    } 
    return '<img src="http://fpoimg.com/275x190?text=FPO" />';

   }  


  public function buildTemplate(){
    $callout = $this->renderCallout();
    $image = $this->renderImage();

$template = <<<TEMPLATE
<div class="featured-post four-column">
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