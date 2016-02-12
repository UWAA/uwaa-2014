<?php namespace UWAA\API;
/**
 * This class container core functionality for the UWAA-site API, which created enpoints necessary to work with third-party services such as Mapbox.  It's primary purpose it to route and build Geojson endpoints for GET requests. 
 *
 */




class RequestHandler
{

  private $wp = null;
  private $memberChecker = null;
  

  function __construct($wp, $memberChecker)
  {
   add_action( 'init', array($this, 'addRequestEndpoints'), 0 );
   add_filter( 'query_vars', array($this, 'createRequestQueryVars'), 0 );
   add_action( 'parse_request', array($this, 'detectAPIQueryRequest'), 0 );
   $this->wp = $wp;
   $this->memberChecker = $memberChecker;
   
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
      add_rewrite_rule('^api/?(tours|benefits|communities|memberValidator)?/?(geojson|json|login|logout)?/?','index.php?api=1&contentSection=$matches[1]&dataType=$matches[2]','top');
  }

  //Only thing about doing this is api is in the query string
  public function detectAPIQueryRequest() {
    if ( isset($this->wp->query_vars['api'])) {
        $this->handleRequest();
        exit;
    }
    return;

  }

  //Do something with this...
  private function handleRequest(){    
    $contentSection = $this->wp->query_vars['contentSection'];
    $dataType = $this->wp->query_vars['dataType'];  
    switch ($contentSection) {
      case 'tours':
        switch ($dataType) {
          case 'geojson':             
            $query = $this->getWPObject('tours');
            $endpoint = new API;
            $endpoint->buildEndpoint($query, new DataEndpoint\GeoJSON\ToursMap);            
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

      case 'communities':
        switch ($dataType) {
          case 'geojson':            
            $query = $this->getWPObject('chapters');
            $endpoint = new API;
            $endpoint->buildEndpoint($query, new DataEndpoint\GeoJSON\ChapterMap);            
            break;
          case 'json' :
            echo "working--JSON-tours";
            break;          
          default:
            header("HTTP/1.0 404 Not Found");
            echo 'Nope Communities';
            break;
        }        
        break;  //case tours 

      case 'benefits':
        echo 'Benefits Request';
        break;

      case 'memberValidator':        
          switch ($dataType) {
            case 'login':
              $this->memberChecker->callMemberChecker();
              break;

            case 'logout':
              $this->memberChecker->memberLogout();
              break;
            
            default:
              # code...
              break;
          }       
        // 
        break;
      //TODO - Make this return to regular WP 404 Page
      default:
        header("HTTP/1.0 404 Not Found");
        echo 'Nope';
        break;

       
    }
    
  }





// * Get a WordP
//   * @param string $postType List of current public query vars
//   * @return array $arrayToMakeIntoJSON 
  
    private function getWPObject($postType) {              
        $transientName = $postType . "TransientQuery";
        
        if ($this->checkTransient($postType) === false) {
          $args = array (
            'post_type' => $postType,
            'orderby' => 'asc',
            'posts_per_page' => '-1',        
            );

        if ($postType === 'tours') {
          $args[] = array (
            'meta_key' => 'mb_start_date',
            'meta_query' => array(
              'key' => 'mb_start_date',
              'type' => 'DATE',
              'value' => date("Y-m-d"), 
              'compare' => '>=', 
            )
          );
        }

        $query = new \WP_query($args);        
        set_transient($transientName, $query, 6 * HOURS_IN_SECONDS);        
        return $query;   
        }     

        $activeTransient= get_transient($transientName);        
        return $activeTransient;       

    }
   
    // Checks to see if there is a transient query stored. Returns true if object.  If not, false.
    private function checkTransient($postType) {
      $queryName = $postType . "TransientQuery";          
      if (is_object(get_transient($queryName)) == FALSE) {                  
        return false;
      }      
      return true;
    }

    



  
}
