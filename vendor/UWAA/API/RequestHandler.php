<?php namespace UWAA\API;
/**
 * This class container core functionality for the UWAA-site API, which created enpoints necessary to work with third-party services such as Mapbox.  It's primary purpose it to route and build Geojson endpoints for GET requests. 
 *
 */




class RequestHandler
{

  private $wp = null;
  

  function __construct($wp)
  {
   add_action( 'init', array($this, 'addRequestEndpoints'), 0 );
   add_filter( 'query_vars', array($this, 'createRequestQueryVars'), 0 );
   add_action( 'parse_request', array($this, 'parseAPIRequest'), 0 );
   $this->wp = $wp;
   
 } 

/** Add public query vars
  * @param array $vars List of current public query vars
  * @return array $vars 
  */
  public function createRequestQueryVars($vars) {
       $vars[] = 'api';
       $vars[] = 'contentSection';
       $vars[] = 'dataType';
       return $vars;
        
  }

  public function addRequestEndpoints() {
      add_rewrite_rule('^api/?(tours|benefits|communities)?/?(geojson|json)?/?','index.php?api=1&contentSection=$matches[1]&dataType=$matches[2]','top');
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
            $endpoint = new API;
            $endpoint->buildEndpoint($query, new DataEndpoint\GeoJSON);            
            break;
          case 'json' :
            echo "working--JSON-tours";
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

    }

    



  
}
