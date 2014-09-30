<?php namespace UWAA\API;
/**
 * This class container core functionality for the UWAA-site API, which created enpoints necessary to work with third-party services. 
 *
 */

class API
{

  


  function __construct()
  {
   add_action( 'init', array($this, 'addAPIEndpoints'), 0 );
   add_filter( 'query_vars', array($this, 'createAPIQueryVars'), 0 );
   add_action( 'parse_request', array($this, 'parseAPIRequest'), 0 );
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
      add_rewrite_rule('^api/?(tours|benefits|)?/?(geojson|json)?/?','index.php?api=1&contentSection=$matches[1]&dataType=$matches[2]','top');
  }

  public function parseAPIRequest() {
    global $wp;
    if ( isset($wp->query_vars['api'])) {
        $this->handle_request();
        exit;
    }
    return;

  }

  protected function handle_request(){
    global $wp;
    $contentSection = $wp->query_vars['contentSection'];
    $dataType = $wp->query_vars['dateType'];  
    switch ($contentSection) {
      case 'tours':
        echo 'Tours request';
        break;

      case 'benefits':
        echo 'Benefits Request';
        break;
      
      default:
        header("HTTP/1.0 404 Not Found");
        break;
    }
    
  }


  
}
