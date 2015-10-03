<?php namespace UWAA\View\ThumbnailBrowser\Thumbnail;

use \UWAA\View\ThumbnailBrowser\ThumbnailBrowser;
use \UWAA\View\UI;

class VeteransEventsIsotope extends ThumbnailBrowser implements Thumbnail 
{

	protected $args;
    

    private $UI;
    private $isTest;

    //Properties Used to Build The Thumbnail For the Homepage
    protected $postTitle;
    protected $postURL;
    protected $postCalloutText;
    protected $postDate;
    protected $postSubtitle;
    protected $postImageThumbnailURL;
    protected $postExcerpt;
    protected $alternateLink;
    protected $isPartnerEvent;
    protected $postImageAltText;
    

    public function __construct($isTest=FALSE)
    {
        
        $this->isTest = $isTest;
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
        $this->postSubtitle = parent::getPostSubtitle($query);
        $this->postExcerpt = wp_kses($this->shortenExcerpt(get_the_excerpt(), 180), $this->allowedHTMLTags);
        $this->postTerms = strtolower(implode( " ", $this->getListOfTerms()));
        $this->alternateLink = esc_url(get_post_meta(get_the_ID(), 'mb_alternate_link', true));
        $this->isPartnerEvent = get_post_meta(get_the_ID(), 'mb_isPartnerEvent', true);
        $this->postImageAltText = $this->UI->returnImageAltTag(get_the_ID());
        
        echo $this->buildTemplate();

    endwhile;

    wp_reset_postdata();    

  }

// TODO Change this for Vets Week Stuff...
  private function getListOfTerms()
    {

        $terms = get_the_terms(get_the_id(), 'events');
        $termArray = array(); 
        
        if ( $terms && !is_wp_error( $terms ) ) :
        	foreach ( $terms as $term ) {
                $termArray[] = $term->slug;
                }               
        endif;

     	return $termArray;
     }

  protected function setArguments()
  {
    $args = array (
      'post_type' => array('events'),
      'orderby' => 'meta_value_num',      
      'order' => 'ASC',            
      'tax_query' => array(                
        array(
          'taxonomy' => 'category',
          'field'    => 'slug',
          'terms'    => array( 'veterans-week'),
          'operator'  => 'IN'
          )
      ), //End tax query      
      'posts_per_page' => -1,
      'meta_key' => 'mb_start_date',
      'meta_query' => array(      
        array(
          'key' => 'mb_start_date',
          'type' => 'DATE',
          'value' => date("Y-m-d", strtotime('-1 day')), // Set today's date (note the similar format)
          'compare' => '>=', // Return the ones greater than today's date          
          )
      ),
      );

    
    if ($this->isTest == TRUE) {         
      $testPostStatusArray = array( 'pending', 'draft', 'future', 'publish' );
      $args['post_status'] = $testPostStatusArray;      
    }   
    
    return $args;
  }

  private function determineAlternateLink() {
    if($this->isPartnerEvent == 1) {
      return $this->alternateLink;
    }
    return $this->postURL;
  }

  private function renderAbbreviatedMonth($date) {
    $monthPattern = "/(nov|dec|oct)/i";
    preg_match($monthPattern, $date, $monthMatch);
    if(is_string($monthMatch[1])) {
      return $monthMatch[1];
    }   
  }

  private function renderDateNumerals($date) {    
    $dayPattern = "/\b\d{1,2}(?=st|nd|rd|th|\b)/i";
    preg_match($dayPattern, $date, $dayMatch);        
    if(is_string($dayMatch[0])) {
      return $dayMatch[0];
    }
  }

  private function renderVetsDateCallout($vetsCalloutMonth, $vetsCalloutDateNumerals) {
    if (is_string($vetsCalloutMonth)){
      return '
      <span class="uwaa-btn btn-slant-right btn-gold vets-callout-container">
        <div class="vets-callout-month">'.$vetsCalloutMonth.'</div>
        <div class="vets-callout-date-numerals">'.$vetsCalloutDateNumerals.'</div>
      </span>';
    }
    return;
  }


	public function
   buildTemplate(){
  $callout = $this->renderCallout();
  $image = $this->renderImage(true);
  $link = $this->determineAlternateLink();
  $date = $this->renderDate();

  $vetsCalloutMonth = $this->renderAbbreviatedMonth($this->postDate);
  $vetsCalloutDateNumerals = $this->renderDateNumerals($this->postDate);

  $dateCallout = $this->renderVetsDateCallout($vetsCalloutMonth, $vetsCalloutDateNumerals);

  // 
  
	$template = <<<ISOTOPE
<div class="post-thumbnail-slide veterans-events">
	<a href="$link" title="$this->postTitle">
    <div class="image-frame">
      $callout      
		  $image
      $dateCallout
    </div>
		<div class="copy">		
		<h4 class="title">$this->postTitle</h4>
		$date
		<p>$this->postExcerpt</p>    
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