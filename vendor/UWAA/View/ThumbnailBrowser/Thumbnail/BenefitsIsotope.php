<?php namespace UWAA\View\ThumbnailBrowser\Thumbnail;

use \UWAA\View\ThumbnailBrowser\ThumbnailBrowser;
use \UWAA\View\UI;

class BenefitsIsotope extends ThumbnailBrowser implements Thumbnail
{

	protected $args;


    private $UI;

    //Properties Used to Build The Thumbnail For the Homepage
    protected $postTitle;
    protected $postURL;
    protected $postCalloutText;
    protected $postDate;
    protected $postSubtitle;
    protected $postImageThumbnailURL;
    protected $postExcerpt;
    protected $postImageAltText;
    protected $postTags;

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
        $this->postDate = strip_tags(get_post_meta(get_the_ID(), 'mb_cosmetic_date', true));;
        $this->postExcerpt = wp_kses($this->shortenExcerpt(get_the_excerpt(), 220), $this->allowedHTMLTags);
        $this->postTerms = strtolower(implode( " ", $this->getListOfTerms()));
        $this->postImageAltText = $this->UI->returnImageAltTag(get_the_ID());
        $this->postTags = get_the_term_list(get_the_id(), 'post_tag', '', ' , ');


        echo $this->buildTemplate();

    endwhile;

    wp_reset_postdata();

  }

  private function getListOfTerms()
    {

        $terms = get_the_terms(get_the_id(), 'benefits');
        $termArray = array();

        if ( $terms && !is_wp_error( $terms ) ) :
        	foreach ( $terms as $term ) {
                $termArray[] = $term->slug;
                }
        endif;

     	return $termArray;
     }

  private function setArguments()
  {
    $args = array (
      'post_type' => 'benefits',
      'orderby' => 'title',
      'order' => 'ASC',
      'posts_per_page' => -1,
    'tax_query' => array(
        array(
          'taxonomy' => 'uwaa_content_promotion',          
          'operator' => 'NOT IN',
          'field' => 'slug',
          'terms' => 'warmup-only'
        ),
    )
    );

    return $args;
  }


  public function buildTemplate(){
    $callout = $this->renderCallout();
    $image = $this->renderImage();
    $tags= $this->renderTags();
    $link = $this->postURL;
	$template = <<<ISOTOPE
<div class="post-thumbnail-slide $this->postTerms">
	<a href="$this->postURL" title="$this->postTitle">
    <div class="image-frame">
      $callout
		  $image
    </div>
		<div class="copy">
		<h4 class="title">$this->postTitle</h4>
		<h4 class="date">$this->postDate</h4>
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