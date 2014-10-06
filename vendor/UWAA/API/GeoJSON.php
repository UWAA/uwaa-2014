<?php namespace UWAA\API;
/**
 * This class container core functionality for the UWAA-site API, which created enpoints necessary to work with third-party services such as Mapbox.  It's primary purpose it to route and build Geojson endpoints for GET requests. 
 *
 */

class GeoJSON
{   
  


/** Get a WordPress Object and 
  * @param string $postType List of current public query vars
  * @return array $arrayToMakeIntoJSON 
  */
    public function getWPObject() {
        
        $args = array (
        'post_type' => 'tours',
        'orderby' => 'rand',
        );
        var_dump($this);
        $query = new \WP_Query($args);
        var_dump($query);

    }


}