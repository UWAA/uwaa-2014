<?php namespace UWAA\API;
/**
 * Used to generate valid GeoJSON information for the API.
 *
 */

class GeoJSON
{   
  
  protected $mapBoxToken;
  protected $mapBoxEndpoint;


  function __construct() {
    $this->mapBoxToken = $_ENV['MapboxAPIToken'];
    $this->mapBoxEndpoint = "http://api.tiles.mapbox.com/v4/geocode/mapbox.places-v1/";
    

  }
   

    private function parseCoordinates($string) {
      if ($string) {
        //I think it is odd that you need to reverse which value comes first...  
        return $coordinates = array_map('floatval', array_reverse(explode(",", $string)));     
     }
  }
    /**
     * Constructor.
     *
     * @param Geometry $geometry
     * @param array $properties
     * @param mixed $id
     * @param CoordinateResolutionSystem|BoundingBox $arg,...
     */
    protected function getCoordinatesFromString($string) {
      $token = $this->mapBoxToken;
      $query = urlencode($string);
      $endpoint = $this->mapBoxEndpoint;
      $url = $endpoint . $query . ".json?access_token=" . $token;
      
      $input = file_get_contents($url);

      $result = json_decode($input);
      
      if (empty($result->features)){
        return array (1,1);
      }
      $coordinates = $result->features{0}->center;
      return $coordinates;
      

    }

    /**
     * Handles creation of Latitude/Longitude  
     *
     * @param $post
     * @return array $latlong
     */
    protected function getCoordinates($post) {      


      $coordinates = get_post_meta($post->ID, 'mb_lat_long', true);
      $markerPosition = get_post_meta($post->ID, 'mb_marker_position', true);
      $tourTitle = get_the_title($post->ID);
      if (!empty($coordinates) && is_string($coordinates))
        { 
          $coordinates = $this->parseCoordinates($coordinates);
          
          return $coordinates;
        }
      else if (!empty($markerPosition)  && is_string($markerPosition))
        {
          $coordinates = $this->getCoordinatesFromString($markerPosition);
          
          return $coordinates;
        }
      else if (!empty($tourTitle))
        {
          $coordinates = $this->getCoordinatesFromString($tourTitle);
          
          return $coordinates;
      } else {
        return array(1,1);
      }

    }

    /**
     * Builds and echos out a valid GeoJSON feature collection for our API
     * @param  object $query a WP_Query Object
     * @return GEOJSON        a GeoJSON file eched to the screen.
     */
    public function buildGeoJSONPayload($query) {
      $posts = $query->get_posts();
      foreach ($posts as $post):
        setup_postdata( $post );
        try {
        $coordinates = $this->getCoordinates($post);
         } catch(Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
            continue; 
         }
         try {
        $geometry = new \GeoJson\Geometry\Point($coordinates);
         } catch(Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n"; 
            continue; 
         }        
        
        
        // var_dump($post);
        $geometryCollection[] = new \GeoJson\Feature\Feature($geometry, array (
            'title' => htmlspecialchars(get_the_title($post->ID)),
            'link' => get_permalink($post->ID),
            'excerpt' => htmlspecialchars(get_post_meta($post->ID, 'mb_map_excerpt', true)) 
            )
          );
          
      endforeach;

      $testCollection = new \GeoJson\Feature\FeatureCollection($geometryCollection);
        

      echo json_encode($testCollection);
      
    }


}