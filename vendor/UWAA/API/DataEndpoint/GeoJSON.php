<?php namespace UWAA\API\DataEndpoint;


class GeoJSON implements DataEndpoint {

    protected $mapBoxToken;
    protected $mapBoxEndpoint;
    public $endpointData;


    function __construct() 
    {
        $this->mapBoxToken = $_ENV['MapboxAPIToken'];
        $this->mapBoxEndpoint = "http://api.tiles.mapbox.com/v4/geocode/mapbox.places-v1/";
        $this->endpointData = array();
    }
   
    public function build($endpointData)
    {
        echo json_encode($this->buildFeatureCollection($endpointData));
    }

    public function load($query)
    {
        $posts = $query->get_posts();
        foreach ($posts as $post):
            setup_postdata( $post );
            
            $featureContents = $this->getFeatureContents($post);

            try {
                $coordinates = $this->getCoordinates($post);
            } catch (Exception $e) 
                {
                echo 'Caught exception: ',  $e->getMessage(), "\n";
                continue; 
               }
            try {
               $geometry = new \GeoJson\Geometry\Point($coordinates);
            
         } catch(Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n"; 
            continue; 
         } 

               

            $this->endpointData[] = $this->buildGeometryCollection($geometry, $featureContents); 

         endforeach;

         return $this->endpointData;
    }


    private function parseCoordinates($string) 
    {
        if ($string) 
        {
            //I think it is odd that you need to reverse which value comes first...  
            return $coordinates = array_map('floatval', array_reverse(explode(",", $string)));     
        }
    }

    private function lookupCoordinatesFromString($string) 
    {
        $token = $this->mapBoxToken;
        $query = urlencode($string);
        $endpoint = $this->mapBoxEndpoint;
        $url = $endpoint . $query . ".json?access_token=" . $token;
     
        $input = file_get_contents($url);
        $result = json_decode($input);
    
        if (empty($result->features))
        {
            return array (1,1);  //@TODO Hacky...
        }
    
    $coordinates = $result->features{0}->center;

    return $coordinates;     

    }

    private function getCoordinates($post) {      
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
      } else {
        return array(1,1);
      }
    }

    private function getFeatureContents($post)
    {
        $featureContents = [
            'title' => htmlspecialchars(get_the_title($post->ID)),
            'link' => get_permalink($post->ID),
            'excerpt' => htmlspecialchars(get_post_meta($post->ID, 'mb_map_excerpt', true))
        ];

        return $featureContents;
    }

    private function buildGeometryCollection($geometry, $featureContents) 
    {
        return new \GeoJson\Feature\Feature($geometry, $featureContents);
        
    }

    private function buildFeatureCollection($endpointData)
    {
        return new \GeoJson\Feature\FeatureCollection($endpointData);
    }

}