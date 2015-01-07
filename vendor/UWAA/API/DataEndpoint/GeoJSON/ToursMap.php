<?php namespace UWAA\API\DataEndpoint\GeoJSON;


class ToursMap extends GeoJSON implements \UWAA\API\DataEndpoint\DataEndpoint
{

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

	protected function getFeatureContents($post)
    {
        $featureContents = array(
            'title' => esc_html(get_the_title($post->ID)),
            'link' => get_permalink($post->ID),
            'excerpt' => esc_html(get_post_meta($post->ID, 'mb_map_excerpt', true)),
            'date' => esc_html(get_post_meta($post->ID, 'mb_cosmetic_date', true)),
            'marker-color' => '#4b2e83'
        );

        return $featureContents;
    }

}