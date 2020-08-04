<?php namespace UWAA\View\ThumbnailBrowser;

class ThumbnailBrowser
{

  protected $allowedHTMLTags = array(
          'a' => array(
            'href' => array(),
            'title' => array()
          ),
          'br' => array(),
          'em' => array(),
          'strong' => array(),
  );




	public function makeThumbnails(Thumbnail\Thumbnail $thumbnail)
  	{
    $this->getPostsToDisplay($thumbnail->args, $thumbnail);
  	}



	protected function setCurrentPostID()
  	{
    $this->currentPostID = get_the_ID();
  	}


  	//Move this to a WP DataHandler class
  	protected function getPostsToDisplay($args, $thumbnail) {
    $query = new \WP_Query($args);

    //CAN HOOK IN HERE TO FIX DISPLAY
    //echo $query->have_posts();
    if ( $query->have_posts() == FALSE ) {
        $thumbnail->displayNothing();
    }

    $thumbnail->extractPostInformation($query);
  }

  //Default to text entered by an editor, but then check and see if a Tour or Benefit Tag applies and use that instead.
  protected function getPostSubtitle($post)
  {
    $postSubtitle = get_post_meta(get_the_ID(), 'mb_thumbnail_subtitle', true);

    if (!empty($postSubtitle)):
        return $postSubtitle;
    endif;

    $postSubtitle = $this->getTourDestination($post);

    return $postSubtitle;

  }

  protected function getTourDestination($post)
  {
    $toursRegions = array(
        'N. America',
        'Latin America',
        'Europe',
        'Asia',
        'Africa',
        'Oceania'

    );

    if(has_term($toursRegions, 'destinations')):
        $getTermsArgs = array(
          'fields' => 'names'
          );
        $tourPostTerms = wp_get_post_terms(get_the_id(), 'destinations', $getTermsArgs);
        $result = array_values(array_intersect($toursRegions, $tourPostTerms));
        return $result[0];
    endif;
  }

      public function renderToolbar($toolbar)
    {
      echo $this->getSortingToolbarTemplate($toolbar);
    }

    protected function renderCallout(){
    if ($this->postCalloutText){
      return '<span class="uwaa-btn btn-slant-left btn-purple">'.$this->postCalloutText.'</span>';
    }
    return;
   }

   protected function renderTags() {
     if ($this->postTags) {
       return '<div class="visually-hidden" aria-hidden="true" >'.$this->postTags.'</div>';
     }
     return;
   }

    protected function renderDate(){
    if ($this->postDate){
      return '<h4 class="date">' .$this->postDate. '</h4>';
    }
    return;
   }

    protected function renderImage($isotope = false) {
    if ($this->postImageThumbnailURL) {


      return '<img src="' . $this->postImageThumbnailURL . '" "alt="'. $this->postImageAltText.'"/>';
    }

    if ($isotope) {
        return '<img src=" ' . get_stylesheet_directory_uri() . '/assets/Generic_Thumb_275x190.jpg" />';
    }
    return '<img src=" ' . get_stylesheet_directory_uri() . '/assets/Generic_Thumb_275x190.jpg" />';
   }

    protected function getSortingToolbarTemplate($typeOfToolbar)
    {

      $buttons = $this->renderFilterButtons($typeOfToolbar);
      $template = <<<TOOLBAR
      <div class="filter-row">
      <div id="filters">
      <h2 class="filter-head">FILTER:</h2>
        $buttons
      </div>
      </div>

TOOLBAR;

      return $template;
    }

    protected function renderFilterButtons($typeOfToolbar)
    {
      //Included because Posts are filtered by categories
      $template = '<ul class="filter-group"><li class="filter-button is-checked" data-filter="">All '. $typeOfToolbar .'</li>';

      if ($typeOfToolbar == 'category') {
        $template = '<ul class="filter-group"><li class="filter-button is-checked" data-filter="">All Stories</li>';
      }

      if ($typeOfToolbar == 'Events') {
        $template = '<ul class="filter-group"><li class="filter-button is-checked" data-filter="">All Digital Events</li>';
      }


      $terms = get_terms(strtolower($typeOfToolbar));


      $terms = wp_list_filter($terms, array('slug'=>'exclude-from-search'),'NOT');
      $terms = wp_list_filter($terms, array('slug'=>'exclude-from-community-row'),'NOT');
      $terms = wp_list_filter($terms, array('slug'=>'uncategorized'),'NOT');
      $terms = wp_list_filter($terms, array('slug'=>'tall-regional-branding'),'NOT');
      $terms = wp_list_filter($terms, array('slug'=>'short-regional-branding'),'NOT');
      $terms = wp_list_filter($terms, array('slug'=>'content-for-app'),'NOT');
      $terms = wp_list_filter($terms, array('slug'=>'no-regional-branding'),'NOT');
      $terms = wp_list_filter($terms, array('slug'=>'alumni-veterans'),'NOT');
      $terms = wp_list_filter($terms, array('slug'=>'student-veterans'),'NOT');
      $terms = wp_list_filter($terms, array('slug'=>'general-public'),'NOT');
      $terms = wp_list_filter($terms, array('slug'=>'facultystaff'),'NOT');

        if ( !empty( $terms ) && !is_wp_error( $terms ) ) :
            foreach ( $terms as $term ) {

                  $template .= sprintf('<li class="filter-button" data-filter=".%s">%s</li>', strtolower($term->slug), $term->name);

        }

        endif;

      $template .= '</ul>';
      return $template;
    }

    public function renderSearchBox($typeOfToolbar)
    {
      $template = '<div id="isotope-search" class="uw-search-bar-container hidden-xs">
<form>
<label class="screen-reader" for="quicksearch">Enter search text to filter tours</label>
<input id="quicksearch" type="search" placeholder="Search '.$typeOfToolbar.'" autocomplete="off">
</form>
<input type="submit" value="search" class="search" tabindex="-1">
</div>';


      echo $template;
    }

    public function renderGridListPrintIcons()
    {
      $template = '
        <div class="grid-list-print-icons">
          <div class="button grid-button is-checked hidden-sm hidden-xs">
            <div class="icon grid"></div>
            <div class="label">Overview</div>
          </div>
          <div class="button list-button hidden-sm hidden-xs">
            <div class="icon list"></div>
            <div class="label">List</div>
          </div>
          <div class="button print-button hidden-sm hidden-xs">
            <div class="icon print"></div>
            <div class="label">Print</div>
          </div>
          <div class="button text-button button-hidden hidden-xs" id="email-signup">
            <div class="label">Join our <span></span> email list</div>
            <div class="label close-text">Close</div>
          </div>
        </div>';

        echo $template;
    }

    protected function shortenExcerpt($string, $excerptLength) {

      $shortenedString = substr($string, 0, $excerptLength);

      return $shortenedString;
    }

    protected function getPartnerEventClass($id) {
        $isPartnerEvent = get_post_meta($id, 'mb_isPartnerEvent', true);
        $partnerEventURL = get_post_meta($id, 'mb_alternate_link', true);
        $homeURL = '/washington\.edu\/alumni/';
        $partnerEventGoesToSameSite = preg_match($homeURL, $partnerEventURL);
        
        $classValue = '';

        if ($isPartnerEvent && !$partnerEventGoesToSameSite) {
          $classValue = 'partner-post';
        }

        return $classValue;          

    }

    // Hardcoded grossness for Vets Week Page

     public function renderVeteransFilterToolbar()
    {

      $buttons = $this->renderFilterButtons($typeOfToolbar);
      $sortingOptions = array(
        array(
        "name" => "Alumni Veterans",
        "slug" => "alumni-veterans"
        ),
        array(
        "name" => "Student Veterans",
        "slug" => "student-veterans"
        ),
         array(
        "name" => "General Public",
        "slug" => "general-public"
        ),
        array(
        "name" => "Faculty/Staff",
        "slug" => "facultystaff"
        ),

      );

      //Included because Posts are filtered by categories
      $buttons = '<ul class="filter-group"><li class="filter-button is-checked" data-filter="">All</li>';

      foreach ($sortingOptions as $option) {

                  $buttons .= sprintf('<li class="filter-button" data-filter=".%s">%s</li>', strtolower($option['slug']), $option['name']);

        }

        $buttons .= '</ul>';

       $template = <<<TOOLBAR
      <div class="filter-row">
      <div id="filters">
      <h2 class="filter-head">FILTER:</h2>
        $buttons



      </div>
      </div>

TOOLBAR;



      $template .= '</ul>';
      echo $template;
    }

     public function displayNothing() {
         return;
     }

     protected function returnVariableFormatInformation(string $type = 'string') {

      if ($type == 'int') {
        switch ($this->format) {
          case 5:
            return 5;
            break;

            case 4:
            return 4;
            break;
          
          default:
            return 5;
            break;
        }        
      }

      if ($type == '2x') {
        switch ($this->format) {
          case 5:
            return 10;
            break;

            case 4:
            return 8;
            break;
          
          default:
            return 10;
            break;
        }        
      }

      if ($type == 'thumbnailSize') {
        switch ($this->format) {
          case 5:
            return 'postExcerptRowOfFive';
            break;

            case 4:
            return 'postExcerptRowOfFour';
            break;
          
          default:
            return 10;
            break;
        }        
      }

      if ($type == 'class') {
        switch ($this->format) {
          case 5:
            return 'five-column';
            break;

            case 4:
            return 'four-column';
            break;
          
          default:
            return 'five-column';
            break;
        }        
      }

      switch ($this->format) {
          case 5:
            return 'Five';
            break;

            case 4:
            return 'Four';
            break;
          
          default:
            return 'Five';
            break;
        }

    }
}