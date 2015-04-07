<?php namespace UWAA\View\ThumbnailBrowser\Thumbnail;

use \UWAA\View\ThumbnailBrowser\ThumbnailBrowser;
use \UWAA\View\UI;

class StoryIsotope extends ThumbnailBrowser implements Thumbnail 
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
        $this->postExcerpt = esc_html($this->shortenExcerpt(get_the_excerpt(), 220));
        $this->postTerms = strtolower(implode( " ", $this->getListOfTerms()));
        $this->postSubtitle = $this->getPostSubtitle($query);
        
        echo $this->buildTemplate();

    endwhile;

    wp_reset_postdata();    

  }

  private function getListOfTerms()
    {

        $terms = get_the_terms(get_the_id(), 'category');
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
      'post_type' => 'post',
      'orderby' => 'date',      
      'order' => 'DESC',  
      'posts_per_page' => -1,
      'tax_query' => array(
        'relation' => 'AND',
        // array(
        //   'taxonomy' => 'destinations',
        //   'field'    => 'name',
        //   'terms'    => array( 'asia')
        // ),
        array(
          'taxonomy' => 'category',
          'field'    => 'slug',
          'terms'    => array( 'exclude-from-search'),
          'operator'  => 'NOT IN'
          )
      ) //End tax query 
      );

    return $args;
  }  


  public function buildTemplate(){
    $callout = $this->renderCallout();
    $image = $this->renderImage();
	$template = <<<ISOTOPE
<div class="post-thumbnail-slide $this->postTerms">
	<a href="$this->postURL" title="$this->postTitle">
    <div class="image-frame">
      $callout
		  $image
    </div>
		<div class="copy">
    <h6 class="subtitle">$this->postSubtitle</h6>
		<h4 class="title">$this->postTitle</h4>
		<h4 class="date">$this->postDate</h4>
		<p>$this->postExcerpt</p>
		</div>
	</a>
</div>

ISOTOPE;
return $template;
}


}