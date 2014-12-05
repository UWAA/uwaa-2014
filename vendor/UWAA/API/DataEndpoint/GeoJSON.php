<?php namespace \UWAA\API\DataEndpoint;


class GeoJSON implements DataEndpoint {

    protected $mapBoxToken;
    protected $mapBoxEndpoint;


    function __construct() 
    {
        $this->mapBoxToken = $_ENV['MapboxAPIToken'];
        $this->mapBoxEndpoint = "http://api.tiles.mapbox.com/v4/geocode/mapbox.places-v1/";
    }
   
    public function build($featureCollection)
    {
        echo json_encode($featureCollection);
    }

    public function load($query)
    {
        $posts = $query->get_posts();
        foreach ($posts as $post):
            setup_postdata( $post );
            $title' => htmlspecialchars(get_the_title($post->ID)),
            $link' => get_permalink($post->ID),
            $excerpt' => htmlspecialchars(get_post_meta($post->ID, 'mb_map_excerpt', true)) 

            try {
                $coordinates = $this->getCoordinates($post);
            } catch (Exception $e) 
                {
                echo 'Caught exception: ',  $e->getMessage(), "\n";
                continue; 
                }

            try {
                $geometry = new \GeoJson\Geometry\Point($coordinates);
            } catch(Exception $e) 
                {
                echo 'Caught exception: ',  $e->getMessage(), "\n"; 
                continue;
                }          

         endforeach;

         return $featuresArray;
    }


    private function parseCoordinates($string) 
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

    protected function buildGeometryCollection() 
    {

    }

}