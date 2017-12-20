<?php namespace UWAA\View\ThumbnailBrowser\Thumbnail;

use \UWAA\View\ThumbnailBrowser\ThumbnailBrowser;
use \UWAA\View\UI;


class CommonGroundEvent extends ThumbnailBrowser implements Thumbnail
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
    protected $postImageAltText;


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

      'tax_query' => array(
        array(
          'taxonomy' => 'uwaa_content_promotion',
          'field'    => 'slug',
          'terms'    => array( 'common-ground-event')

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
        $this->postImageAltText = $this->UI->returnImageAltTag(get_the_ID());

        echo $this->buildTemplate();

    endwhile;

    wp_reset_postdata();

  }


public function buildTemplate() {

$callout = $this->renderCallout();
$image = $this->renderImage();
$date = $this->renderDate();
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
 $date
 <p class="excerpt">{$this->postExcerpt}</p>
 <a class="link-arrow" href="$link">
      <span class="visually-hidden">Link</span>
    </a>
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