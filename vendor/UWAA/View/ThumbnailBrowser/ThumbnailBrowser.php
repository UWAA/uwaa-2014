<?php namespace UWAA\View\ThumbnailBrowser;

class ThumbnailBrowser
{


	

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
        $result = array_values(array_intersect($toursRegions, $tourPostTerms));
        return $result[0];  
    endif;
  }

      public function renderToolbar($toolbar)
    {
      echo $this->getSortingToolbarTemplate($toolbar);
    }

    private function getSortingToolbarTemplate($typeOfToolbar)
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

    private function renderFilterButtons($typeOfToolbar) 
    {
      $template = '<ul class="filter-group"><li class="filter-button is-checked" data-filter="">All '. $typeOfToolbar .'</li>';

      $terms = get_terms(strtolower($typeOfToolbar));
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




}