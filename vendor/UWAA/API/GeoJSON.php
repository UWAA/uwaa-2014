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
   

    private function parseLatLongToArray($string) {
      if ($string) {
        //I think it is odd that you need to reverse which value comes first...  
        return $latlong = array_map('floatval', array_reverse(explode(",", $string))); 
      } else {
        $randomLatLong = array(rand(-100, 100),rand(-100, 100));
        return $randomLatLong;
      }
    }

    private function getLatLongFromMarkerPosition($string) {

    }

    private function getLatLong($post) {
      $latLong = get_post_meta($post->ID, 'mb_lat_long', true);
      $markerPosition = get_post_meta($post->ID, 'mb_marker_position', true);
      if (!empty($markerPosition))
        {
          //Do stuff here with Geocode call
          return [1,1];
        }
      else if (!empty($latLong))
        { 
          $latLong = GeoJSON::parseLatLongToArray(get_post_meta($post->ID, 'mb_lat_long', true));
          return $latLong;
        }
      else {
        return [1,1];
      }

    }

    // @TODO  Will be altered to use the GEOJSON lib more.
    static function buildGeoJSONPayload($query) {
      $posts = $query->get_posts();
      foreach ($posts as $post):
        setup_postdata( $post );
        $latlong = GeoJson::getLatLong($post);
        // $latlong = GeoJSON::parseLatLongToArray(get_post_meta($post->ID, 'mb_lat_long', true));

        $testPoint = new \GeoJson\Geometry\Point($latlong);
        $testGeometries[] = new \GeoJson\Feature\Feature($testPoint, array (
            'title' => get_the_title($post->ID),
            'link' => get_permalink($post->ID)
            )
          );
          $testCollection = new \GeoJson\Feature\FeatureCollection($testGeometries);


      endforeach;
        

      echo json_encode($testCollection);
      
    }


}