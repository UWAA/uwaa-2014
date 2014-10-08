<?php namespace UWAA\API;
/**
 * This class container core functionality for the UWAA-site API, which created enpoints necessary to work with third-party services such as Mapbox.  It's primary purpose it to route and build Geojson endpoints for GET requests. 
 *
 */




class API
{

  private $wp = null;
  

  function __construct($wp)
  {
   add_action( 'init', array($this, 'addAPIEndpoints'), 0 );
   add_filter( 'query_vars', array($this, 'createAPIQueryVars'), 0 );
   add_action( 'parse_request', array($this, 'parseAPIRequest'), 0 );
   $this->wp = $wp;
   
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
    if ( isset($this->wp->query_vars['api'])) {
        $this->handle_request();
        exit;
    }
    return;

  }

  //Do something with this...
  private function handle_request(){    
    $contentSection = $this->wp->query_vars['contentSection'];
    $dataType = $this->wp->query_vars['dataType'];  
    switch ($contentSection) {
      case 'tours':
        switch ($dataType) {
          case 'geojson':
            $query = $this->getWPObject('tours');
            GeoJSON::buildGeoJSONPayload($query);
            break;
          case 'json' :
            echo "working--JSON";
            break;          
          default:
            header("HTTP/1.0 404 Not Found");
            echo 'Nope';
            break;
        }        
        break;  //case tours

      case 'benefits':
        echo 'Benefits Request';
        break;
      //TODO - Make this return to regular WP 404 Page
      default:
        header("HTTP/1.0 404 Not Found");
        echo 'Nope';
        break;
    }
    
  }



//TODO- Investigate whether or not there should be a cache check here or if we don't need to worry about it.
//TODO- Not Random, add more args to pass through.
// * Get a WordPress Object and 
//   * @param string $postType List of current public query vars
//   * @return array $arrayToMakeIntoJSON 
  
    private function getWPObject($postType) {
        
        $args = array (
        'post_type' => $postType,
        'orderby' => 'asc',
        );
        $query = new \WP_query($args);
        return $query;
        //GeoJSON::extractGEOJSONDetails($query);

    }

    // private function extractGEOJSONDetails($query) {
    //   $posts = $query->get_posts();
    //   $featureLayer = array(
    //     'type'=> 'FeatureCollection',
    //     'features' => array(),
    //   );



      
    //   $randomLatLong = array(rand(-100, 100),rand(-100, 100));

    //   foreach ($posts as $post):
    //     setup_postdata( $post ); 
    //     $marker = array(
    //       'type' => 'Feature',
    //       'properties' => array (
    //         'title' => get_the_title()
    //         ),
    //       'geometry' => new \GeoJson\Geometry\Point($randomLatLong)
    //       );     
    //       array_push($featureLayer['features'], $marker);
    //       echo get_post_meta($post->ID, 'mb_lat_long', true); 
    //   endforeach;
      
         
          

    //   echo json_encode($featureLayer);
    //   var_dump($posts);
    // }




  
}
