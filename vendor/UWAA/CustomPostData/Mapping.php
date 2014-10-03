<?php namespace UWAA\CustomPostData;

use \UWAA\CustomPostData\CustomPostData as Util;

class Mapping {

    public function __construct() {
        $this->add_mapping_metaboxes();

    }


     private static function add_mapping_metaboxes()  {
            Util::add('tours', array(
                'title' => 'Mapping Information',
                'pages' => array('tours'),
                'context' => 'normal',
                'priority' => 'high',
                'fields' => array(
                    array(
                        'name' => 'Latitude/Longitude',
                        'id'=> 'lat_long',
                        'type'=> 'text',
                        'desc'=> 'The latitude, longitude coordinates for the trip'
                        )
                )
            )
            );

        }
}