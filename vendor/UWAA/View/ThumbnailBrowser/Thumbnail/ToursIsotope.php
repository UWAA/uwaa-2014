<?php namespace UWAA\View\ThumbnailBrowser\Thumbnail;

use \UWAA\View\ThumbnailBrowser\ThumbnailBrowser;
use \UWAA\View\UI;

class ToursIsotope extends ThumbnailBrowser implements Thumbnail
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
    protected $postTerms;
    protected $isPreliminary;
    protected $postImageAltText;
    protected $tourOperator;
    protected $postTags;
    protected $originalPostOrder;

    public function __construct()
    {
        $this->args = $this->setArguments();
        $this->UI = new UI;

    }

      public function extractPostInformation($query)
  {

        while ( $query->have_posts() ) : $query->the_post();




        $this->postTitle = esc_html(get_the_title(get_the_ID()));
        $this->postURL = get_permalink();
        $this->postCalloutText = esc_html(get_post_meta(get_the_ID(), 'mb_thumbnail_callout', true));
        $this->postImageThumbnailURL = $this->UI->returnPostFeaturedImageURL(get_post_thumbnail_id(get_the_ID()), 'isotopeGrid');
        $this->postDate = esc_html(get_post_meta(get_the_ID(), 'mb_cosmetic_date', true));
        $this->postSubtitle = $this->getPostSubtitle($query);
        $this->postExcerpt = wp_kses($this->shortenExcerpt(get_the_excerpt(), 220), $this->allowedHTMLTags);
        $this->postTerms = strtolower(implode( " ", $this->getListOfTerms()));
        $this->isPreliminary = get_post_meta(get_the_ID(), 'mb_isPreliminaryTour', true);        
        $this->postImageAltText = $this->UI->returnImageAltTag(get_the_ID());
        $this->tourOperator = get_post_meta(get_the_ID(), 'mb_operator', true);
        $this->postTags = get_the_term_list(get_the_id(), 'post_tag', '', ' , ');
        $this->originalPostOrder = $query->current_post;



        echo $this->buildTemplate();

    endwhile;

    wp_reset_postdata();

  }


   protected function getPostSubtitle($post)
  {

   $postSubtitle = $this->getTourDestination($post);

   if (!empty($postSubtitle)):
    return $postSubtitle;
  endif;

  $postSubtitle = get_post_meta(get_the_ID(), 'mb_thumbnail_subtitle', true);
    return $postSubtitle;

  }

  private function getListOfTerms()
    {

        $terms = get_the_terms(get_the_id(), 'destinations');
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
      'post_type' => 'tours',
      'orderby' => 'meta_value',
      'order' => 'ASC',
      'meta_key' => 'mb_start_date',
      'meta_query' => array(
          'key' => 'mb_start_date',
          'type' => 'DATE',
          'value' => date("Ymd"),
          'compare' => '>=',
          ),
      'tax_query' => array(
        array(
          'taxonomy' => 'category',
          'field'    => 'slug',
          'terms'    => array( 'exclude-from-search'),
          'operator'  => 'NOT IN'
          )
      ), //End tax query
      'posts_per_page' => -1,
      );

    return $args;
  }

   protected function renderImage($isotope= false) {
    if ($this->postImageThumbnailURL) {
      return '<img src="' . $this->postImageThumbnailURL . '" "alt="'. $this->postImageAltText.'"/>';
    }
    return '<img src=" ' . get_stylesheet_directory_uri() . '/assets/Travel_Generic_Thumb_275x190.jpg" />';
   }
   

	public function buildTemplate(){
    $callout = $this->renderCallout();
    $image = $this->renderImage();
    $tags= $this->renderTags();
    $postOrder = $this->originalPostOrder + 1;    



    if ($this->isPreliminary == 'preliminary')
    {
            $prelimTemplate = <<<PRELIMISOTOPE
      <div class="post-thumbnail-slide preliminary $this->postTerms" data-order="$postOrder">
    <div class="image-frame">
      $callout
      $image
    </div>
    <div class="copy">
    <h6 class="subtitle">$this->postSubtitle</h6>
    <h4 class="title">$this->postTitle</h4>
    <h4 class="date">$this->postDate</h4>
    <p>$this->postExcerpt</p>
    <p class="operator">$this->tourOperator</p>    

    </div>

</div>
PRELIMISOTOPE;


return $prelimTemplate;
}


        $template = <<<ISOTOPE
<div class="post-thumbnail-slide $this->postTerms" data-order="$postOrder">
  <a class="slide-link" href="$this->postURL" title="$this->postTitle">
    <div class="image-frame">
      $callout
      $image
    </div>
  </a>  
    <div class="copy">
    <a class="copy-link" href="$this->postURL" title="copy">
      <h6 class="subtitle test">$this->postSubtitle</h6>
      <h4 class="title">$this->postTitle</h4>
      <h4 class="date">$this->postDate</h4>
      <p>$this->postExcerpt</p>
      <p class="operator">$this->tourOperator</p>           
      <a class="link-arrow" href="$this->postURL">
        $tags
        <span class="visually-hidden">Link</span>
      </a>      
    </div>
  
</div>

ISOTOPE;
return $template;


}



}