<?php namespace UWAA\View\ThumbnailBrowser\Thumbnail;

use \UWAA\View\ThumbnailBrowser\ThumbnailBrowser;
use \UWAA\View\UI;

class ResourceIsotope extends ThumbnailBrowser implements Thumbnail
{

	protected $args;


    private $UI;

    //Properties Used to Build The Thumbnail For the Homepage
    protected $postTitle;
    protected $postURL;
    protected $postCalloutText;
    protected $postDate;
    protected $startDate;
    protected $postSubtitle;
    protected $postImageThumbnailURL;
    protected $postExcerpt;
    protected $postImageAltText;
    protected $postTags;
    protected $alternateURL;


    public function __construct()
    {
        $this->args = $this->setArguments();
        $this->UI = new UI;

    }

      public function extractPostInformation($query)
  {    

        while ( $query->have_posts() ) : $query->the_post();


        $this->postTitle = strip_tags(get_the_title(get_the_ID()));
        $this->postURL = get_permalink();
        $this->postCalloutText = strip_tags(get_post_meta(get_the_ID(), 'mb_thumbnail_callout', true));
        $this->postImageThumbnailURL = $this->UI->returnPostFeaturedImageURL(get_post_thumbnail_id(get_the_ID()), 'isotopeGrid');
        $this->postDate = strip_tags(get_post_meta(get_the_ID(), 'mb_cosmetic_date', true));
        $this->startDate = $this->formatDateForSorting($query);
        $this->postExcerpt = esc_html($this->shortenExcerpt(get_the_excerpt(), 220));
        $this->postTerms = strtolower(implode( " ", $this->getListOfTerms()));
        $this->postSubtitle = $this->getPostSubtitle($query);
        $this->postImageAltText = $this->UI->returnImageAltTag(get_the_ID());
        $this->postTags = get_the_term_list(get_the_id(), 'post_tag', '', ' , ');
        $this->alternateURL = strip_tags(get_post_meta(get_the_ID(), 'mb_alternate_link', true));



        echo $this->buildTemplate();

    endwhile;

    wp_reset_postdata();

  }

  private function getListOfTerms()
    {

        $terms = get_the_terms(get_the_id(), 'resources');
        $termArray = array();

        if ( $terms && !is_wp_error( $terms ) ) :
        	foreach ( $terms as $term ) {
                $termArray[] = $term->slug;
                }
        endif;

        $isPartnerEvent = get_post_meta(get_the_id(), 'mb_isPartnerEvent', true);

        if ($isPartnerEvent) {
          $termArray[] = 'partner-post';
        }

     	return $termArray;
     }


  private function setArguments()
  {
    $args = array (
      'post_type' => array('post', 'events', 'benefits'),
      'orderby' => 'title',
      'order' => 'ASC',
      'posts_per_page' => -1,
      'tax_query' => array(
        'relation' => 'AND',
        array(
          'taxonomy' => 'resources',          
          'operator' => 'EXISTS'
        ),
        array(
          'taxonomy' => 'category',
          'field'    => 'slug',
          'terms'    => array( 'exclude-from-search'),
          'operator'  => 'NOT IN'
          )
        ), //End tax query 
      // 'meta_key' => 'mb_start_date',
      'meta_query' => array(
        'relation' => 'OR',
          array(
            'key' => 'mb_start_date',
            'type' => 'DATE',
            'value' => date("Y-m-d"),
            'compare' => '>=',
          ),
          array(
            'relation' => 'OR',
            array(
              'key' => 'mb_start_date',            
              'compare' => 'NOT EXISTS',
              'value' => ''
            ),
            array(
              'key' => 'mb_start_date',
              'value' => ''
            )
            ),           
        ),
      );

    return $args;
  }

  private function getURL() {
    if($this->alternateURL != ""){
      return $this->alternateURL;
    }
    return $this->postURL;
  }


  public function buildTemplate(){
    $callout = $this->renderCallout();
    $image = $this->renderImage(true);
    $link = $this->getURL();
    $date = $this->renderDate();
    $sortDate = $this->startDate;
    $tags= $this->renderTags();
	$template = <<<ISOTOPE
<div class="post-thumbnail-slide $this->postTerms" $sortDate>
	<a href="$link" title="$this->postTitle">
    <div class="image-frame">
      $callout
		  $image
    </div>
		<div class="copy">
    <h6 class="subtitle">$this->postSubtitle</h6>
		<h4 class="title">$this->postTitle</h4>
		$date
    <p>$this->postExcerpt</p>
    $tags
    <a class="link-arrow" href="$link">
      <span class="visually-hidden">Link</span>
    </a>
		</div>
	</a>
</div>

ISOTOPE;
return $template;
}


}