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
    protected $postCalloutText;
    protected $postDate;
    protected $postSubtitle;
    protected $postImageThumbnailURL;
    protected $postExcerpt;
    protected $postImageAltText;
    protected $liveURL;



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
        'post',
        'page'
        ),
      'posts_per_page' => 10,
      'tax_query' => array(
        'relation' => 'AND',
        array(
          'taxonomy' => 'category',
          'field'    => 'term_id',
          'terms'    => array( 5 ),
          'operator' => 'NOT IN',
        ),
        array(
          'taxonomy' => 'uwaa_content_promotion',
          'field'    => 'slug',
          'terms'    => array( 'home-programs')
        )
      ),
      'orderby' => 'rand'
      );

    return $args;
  }



  public function extractPostInformation($query)
  {

    $query = $this->combineQueriesForPriorityPosts($query);
    
        while ( $query->have_posts() ) : $query->the_post();
      if ($this->currentPostID == get_the_ID() ) {
        continue;
      }


        $this->postTitle = esc_html(get_the_title(get_the_ID()));
        $this->postCalloutText = esc_html(get_post_meta(get_the_ID(), 'mb_thumbnail_callout', true));
        $this->postImageThumbnailURL = $this->UI->returnPostFeaturedImageURL(get_post_thumbnail_id(get_the_ID()), 'postExcerptRowOfFive');
        $this->postDate = esc_html(get_post_meta(get_the_ID(), 'mb_cosmetic_date', true));
        $this->postSubtitle = parent::getPostSubtitle($query);
        $this->postExcerpt = esc_html($this->shortenExcerpt(get_post_meta(get_the_ID(), 'mb_80_character_excerpt', true), 100));
        $this->postImageAltText = $this->UI->returnImageAltTag(get_the_ID());

        $this->liveURL = get_permalink();

        if(get_post_meta(get_the_ID(), 'mb_isPartnerEvent', true)) {
          $this->liveURL = get_post_meta(get_the_ID(), 'mb_alternate_link', true);
        }

        echo $this->buildTemplate();

    endwhile;

    wp_reset_postdata();

  }

  private function combineQueriesForPriorityPosts($originalQuery) {
    
    $priorityPosts = $this->getPriorityPosts();
    $originalQueryPosts = $originalQuery->posts;

    //Stop if there are not priority posts and just return the OG query.
    if ($priorityPosts->post_count == 0){
      return $originalQuery;
    }

    //if there are only 5 promoted posts including the priority post, the just remove that from the original query
    $postIDsToDrop = array();

    //find PostIDs for each priority post
    foreach ($priorityPosts->posts as $priorityPost) {
      $postIDsToDrop[] = $priorityPost->ID;
    }    
    
    $i = 0;
    foreach($originalQueryPosts as $originalPost) {      
      if(in_array($originalPost->ID, $postIDsToDrop) ) {        
        unset($originalQuery->posts[$i]);
        $originalQuery->post_count = $originalQuery->post_count -1;
        $i++;        
      } else {
        $i++;
      }
      
      
    }
    unset($i);

    //if there are 5 posts that are different from the prior post, randomly pop one off.
    while (count($originalQuery->posts) >= 5) {
      array_pop($originalQuery->posts);
      $originalQuery->post_count -1;      
    }

    //append (or splice) prior query to front of new query, update current post in query, and return
    $originalQuery->posts = array_merge($priorityPosts->posts, $originalQuery->posts);
    $originalQuery->post_count = count($originalQuery->posts);
    $originalQuery->post = $originalQuery->posts[0];
    wp_reset_postdata();



    
    return $originalQuery;
  }

  private function getPriorityPosts() {

    $prioArgs = array (
      'post_type' => array(
        'tours',
        'events',
        'benefits',
        'post',
        'page'
        ),
      'posts_per_page' => 1,
      'meta_query' => array(
        'relation' => 'AND',
        array (
          'key' => 'mb_display_priority',
          'compare' => '<=',
          'val_num' => '5'
        ),
        array (
          'key' => 'mb_display_priority',
          'compare' => '>',
          'val_num' => '0'
        )

      ),
      
      'tax_query' => array(        
        array(
          'taxonomy' => 'uwaa_content_promotion',
          'field'    => 'slug',
          'terms'    => array( 'home-programs')

          )
        ),      
      );

      $priorityPostQuery = new \WP_Query($prioArgs);

      return $priorityPostQuery;

  }




public function buildTemplate() {

$partnerPost = $this->getPartnerEventClass(get_the_ID());
$callout = $this->renderCallout();
$image = $this->renderImage();
$date = $this->renderDate();
$link = $this->liveURL;
$template = <<<TEMPLATE
<div class="featured-post five-column $partnerPost">
<a href="{$this->liveURL}">
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