<?php namespace UWAA\API\DataEndpoint\GeoJSON;


class ToursMap extends GeoJSON implements \UWAA\API\DataEndpoint\DataEndpoint
{

	public function build($endpointData)
    {
        $payload = json_encode($this->buildFeatureCollection($endpointData), 5);
        $error = json_last_error();
        if (!$payload) {
            echo 'Payload could not be generated';
            switch ($error) {
        case JSON_ERROR_NONE:
            echo ' - No errors';
        break;
        case JSON_ERROR_DEPTH:
            echo ' - Maximum stack depth exceeded';
        break;
        case JSON_ERROR_STATE_MISMATCH:
            echo ' - Underflow or the modes mismatch';
        break;
        case JSON_ERROR_CTRL_CHAR:
            echo ' - Unexpected control character found';
        break;
        case JSON_ERROR_SYNTAX:
            echo ' - Syntax error, malformed JSON';
        break;
        case JSON_ERROR_UTF8:
            echo ' - Malformed UTF-8 characters, possibly incorrectly encoded';
        break;
        default:
            echo ' - Unknown error';
        break;
    }

        }
        echo $payload;
        // debug
        // var_dump($this->buildFeatureCollection($endpointData));
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

            // var_dump($this->endpointData);
            // echo '<br><br>';

         endforeach;

         return $this->endpointData;
    }

	protected function getFeatureContents($post)
    {
        $featureContents = array(
            'title' => utf8_encode(get_the_title($post->ID)),
            'link' => get_permalink($post->ID),
            'excerpt' => utf8_encode(get_post_meta($post->ID, 'mb_map_excerpt', true)),
            'date' => utf8_encode(get_post_meta($post->ID, 'mb_cosmetic_date', true)),
            'marker-color' => '#4b2e83'
        );

        return $featureContents;
    }

}