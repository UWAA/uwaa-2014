<?php namespace UWAA\View;

class ThumbnailBrowser
{

    private $UI;
    
    private $args;

    //Properties Used to Build The Thumbnail
    private $currentPostID;
    private $postTitle;
    private $postURL;
    private $postCalloutText;
    private $postDate;
    private $postSubtitle;
    private $postImageThumbnailURL;
    private $postExcerpt;

    //Also an array to put all this stuff
    private $postThubnailArray = array();

    public function __construct()
    {
        $this->UI = new \UWAA\View\UI;
    }

    private function setCurrentPostID() 
  {
    $this->currentPostID = get_the_ID();    
  }

  public function makeThumbnailRow($args)
  {
    $this->getPostsToDisplay($args);
  }
  

  public function renderThumbnail()
  {
    echo $this->buildTemplate();
  }



  //Move this to a WP DataHandler class
  private function getPostsToDisplay($args) {

    $args = $args;

    $query = new \WP_Query($args);

    $this->extractPostInformation($query);
  
  }

  //Default to text entered by an editor, but then check and see if a Tour or Benefit Tag applies and use that instead.
  private function getPostSubtitle($post)
  {
    $postSubtitle = get_post_meta(get_the_ID(), 'thumbnail_subtitle', true);

    if (!empty($postSubtitle)):
        return $postSubtitle;
    endif;

    $postSubtitle = $this->getTourDestination($post);

    return $postSubtitle;
    
  }

  private function getTourDestination($post)
  {
    $toursRegions = [
        'N. America',
        'Latin',
        'America',
        'Europe',
        'Asia',
        'Africa',
        'Oceania'

    ];

    if(has_term($toursRegions, 'destinations')):
        $getTermsArgs = array(          
          'fields' => 'names'
          );
        $tourPostTerms = wp_get_post_terms(get_the_id(), 'destinations', $getTermsArgs);
        // var_dump($tourPostTerms);
        $result = array_values(array_intersect($toursRegions, $tourPostTerms));
        return $result[0];  //might be an array and not a string.
    endif;
  }



  private function extractPostInformation($query) 
  {

        while ( $query->have_posts() ) : $query->the_post();
      if ($this->currentPostID == get_the_ID() ) {
        continue;
      }


        $this->postTitle = strip_tags(get_the_title());
        $this->postURL = get_permalink();
        $this->postCalloutText = strip_tags(get_post_meta(get_the_ID(), 'mb_thumbnail_callout', true));
        $this->postImageThumbnailURL = $this->UI->returnPostFeaturedImageURL(get_post_thumbnail_id(get_the_ID()), 'post-thumbnail');    
        $this->postDate = strip_tags(get_post_meta(get_the_ID(), 'mb_cosmetic_date', true));;
        $this->postSubtitle = $this->getPostSubtitle($query);
        $this->postExcerpt = get_the_excerpt();
        
        $this->renderThumbnail();

    endwhile;

    wp_reset_postdata();    

  }

  private $templateIsotope = <<<ISOTOPE


ISOTOPE;

private function buildTemplate() {

$template = <<<TEMPLATE
<div class="featured-post">
  <a href="{$this->postURL}">
        <div class="image">
            <img src="{$this->postImageThumbnailURL}" alt="">
            <d class="callout">{$this->postCalloutText}</d>
        </div>
        <h3 class="subtitle">{$this->postSubtitle}</h3>
        <h2 class="date">{$this->postDate}</h2>
        <p class="excerpt">{$this->postExcerpt}</p>
  </a>
</div>
TEMPLATE;

return $template;
}

    public function __destruct()
    {

    }
}