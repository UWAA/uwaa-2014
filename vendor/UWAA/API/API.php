<?php namespace UWAA\API;
/**
 * This class container core functionality for the UWAA-site API, which created enpoints necessary to work with third-party services such as Mapbox.  It's primary purpose it to route and build Geojson endpoints for GET requests. 
 *
 */


use \GeoJson;

class API
{

  
  

  function __construct()
  {
   add_action( 'init', array($this, 'addAPIEndpoints'), 0 );
   add_filter( 'query_vars', array($this, 'createAPIQueryVars'), 0 );
   add_action( 'parse_request', array($this, 'parseAPIRequest'), 0 );
   $wp = $this->wp();   
  }

  public function wp()  {
    global $wp;
 
    return $wp;
  }

  public function newQuery($args) {

    return new \WP_Query($args);
  }

/** Add public query vars
  * @param array $vars List of current public query vars
  * @return array $vars 
  */
  public function createAPIQueryVars($vars) {
       $vars[] = 'api';
       $vars[] = 'contentSection';
       $vars[] = 'dataType';
       return $vars;
        
  }

  public function addAPIEndpoints() {
      add_rewrite_rule('^api/?(tours|benefits|)?/?geojson?/?','index.php?api=1&contentSection=$matches[1]&dataType=$matches[2]','top');
  }

  //Only thing about doing this is api is in the query string
  public function parseAPIRequest() {
    $wp = $this->wp();
    // $this->wp;
    if ( isset($wp->query_vars['api'])) {
        $this->handle_request();
        exit;
    }
    return;

  }

  //Do something with this...
  private function handle_request(){
    $wp = $this->wp();
    $contentSection = $wp->query_vars['contentSection'];
    $dataType = $wp->query_vars['dataType'];  
    switch ($contentSection) {
      case 'tours':
        $this->getWPObject('tours');
        break;

      case 'benefits':
        echo 'Benefits Request';
        break;
      //TODO - Make this return to regular WP
      default:
        header("HTTP/1.0 404 Not Found");
        echo 'Nope';
        break;
    }
    
  }



//TODO- Investigate whether or not there should be a cache check here or if we don't need to worry about it.
//TODO- Not Random, add more args to pass through.
/** Get a WordPress Object and 
  * @param string $postType List of current public query vars
  * @return array $arrayToMakeIntoJSON 
  */
    private function getWPObject($postType) {
        
        $args = array (
        'post_type' => $postType,
        'orderby' => 'asc',
        );
        $query = $this->newQuery($args);
        $this->extractGEOJSONDetails($query);

    }

    private function extractGEOJSONDetails($query) {
      $posts = $query->get_posts();
      $featureLayer = array(
        'type'=> 'FeatureCollection',
        'features' => array(),
      );

      // while ($query->have_posts()): $query->the_post();  
      $randomLatLong = array(rand(-100, 100),rand(-100, 100));

      foreach ($posts as $post):
        $marker = array(
          'type' => 'Feature',
          'properties' => array (
            'title' => get_the_title($post->ID)
            ),
          'geometry' => new GeoJson\Geometry\Point($randomLatLong)
          );     
          array_push($featureLayer['features'], $marker);
      endforeach;
      // endwhile;

      echo json_encode($featureLayer);




    }




  
}
