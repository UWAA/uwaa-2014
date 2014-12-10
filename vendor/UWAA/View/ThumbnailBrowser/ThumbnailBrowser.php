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





}