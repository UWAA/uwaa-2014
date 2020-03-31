<?php namespace UWAA\API\DataEndpoint\GeoJSON;


class GeoJSON {

    protected $mapBoxToken;
    protected $mapBoxEndpoint;
    public $endpointData;


    function __construct() 
    {
        $this->mapBoxToken = $_ENV['MapboxAPIToken'];
        // $this->mapBoxEndpoint = "http://api.tiles.mapbox.com/v4/geocode/mapbox.places-v1/";
        $this->mapBoxEndpoint = "https://api.mapbox.com/geocoding/v5/mapbox.places/";
        $this->endpointData = array();
    }
   
    


    protected function parseCoordinates($string) 
    {
        if ($string) 
        {
            //I think it is odd that you need to reverse which value comes first...  
            return $coordinates = array_map('floatval', array_reverse(explode(",", $string)));     
        }
    }

    protected function lookupCoordinatesFromString($string) 
    {
        $token = $this->mapBoxToken;
        $query = urlencode($string);
        $endpoint = $this->mapBoxEndpoint;
        // $url = $endpoint . $query . ".json?access_token=" . $token;
        $url = $endpoint . $query . ".json?fuzzyMatch=false&access_token=" . $token;
     
        $input = file_get_contents($url);
        $result = json_decode($input);
    
        if (empty($result->features))
        {
            return array (1000,1000);  //@TODO Hacky...
        }
    
    $coordinates = $result->features{0}->center;

    return $coordinates;     

    }

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
          $coordinates = $this->lookupCoordinatesFromString($markerPosition);
          
          return $coordinates;
        }
      else if (!empty($tourTitle))
        {
          $coordinates = $this->lookupCoordinatesFromString($tourTitle);
          
          return $coordinates;
      } 
      else {
        return array(1000,1000);
      }
    }

    protected function getFeatureContents($post)
    {
        return $featureContents;
    }

    protected function buildGeometryCollection($geometry, $featureContents) 
    {
        return new \GeoJson\Feature\Feature($geometry, $featureContents);
        
    }

    protected function buildFeatureCollection($endpointData)
    {
        return new \GeoJson\Feature\FeatureCollection($endpointData);
    }

}