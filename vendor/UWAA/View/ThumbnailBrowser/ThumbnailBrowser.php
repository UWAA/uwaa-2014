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
    $postSubtitle = get_post_meta(get_the_ID(), 'thumbnail_subtitle', true);

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
        // var_dump($tourPostTerms);
        $result = array_values(array_intersect($toursRegions, $tourPostTerms));
        return $result[0];  
    endif;
  }


public function buildSortingToolbar($taxonomyName){
        
        echo '<p><input type="text" id="quicksearch" placeholder="Search Tours" /></p>';

        echo '<div id="filters" class="button-group">';



        //This builds a clear-filters button  (passes a blank filter to Isotope)
        echo '<button class="button btn filter-button" data-filter="">All  Filters</button>';
        $terms = get_terms("$taxonomyName");
        if ( !empty( $terms ) && !is_wp_error( $terms ) ) :
            foreach ( $terms as $term ) {
                echo sprintf('<button class="button btn filter-button" data-filter=".%s">%s</button>', strtolower($term->slug), $term->name);
        }
        echo '</div>';
        echo '<button class="button btn list-button">List View</button>';
        echo '<button class="button btn tile-button">Tile View</button>';
        
        
        endif;
    }

      public function renderToolbar($toolbar)
    {
      echo $this->getSortingToolbarTemplate($toolbar);
    }

    private function getSortingToolbarTemplate()
    {
      
      $buttons = $this->renderFilterButtons('Tours');
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

    private function renderFilterButtons($typeOfThumbnailsToSort) 
    {
      $template = '<ul class="filter-group"><li class="filter-button" data-filter="">All '. $typeOfThumbnailsToSort .'</li>';

      $terms = get_terms("destinations");
        if ( !empty( $terms ) && !is_wp_error( $terms ) ) :
            foreach ( $terms as $term ) {
                $template .= sprintf('<li class="filter-button" data-filter=".%s">%s</li>', strtolower($term->slug), $term->name);
        }     
        
        endif;

      $template .= '</ul>';
      return $template;
    }




}