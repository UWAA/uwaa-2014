<?php namespace UWAA\CustomMetaBoxes;

class MetaBoxes
{

    function __construct() {
        $this->add_tours_meta();
        $this->add_thumbnail_meta();
    }

        protected function add_tours_meta() {
            new \UWAA\CustomPostData('tours', array(
                'title' => 'Tour Information',
                'pages' => array('tours'),
                'context' => 'normal',
                'priority' => 'high',
                'fields' => array(
                    array(
                        'name' => 'Latitude/Longitude',
                        'id'=> 'lat_long',
                        'type'=> 'text',
                        'desc'=> 'The latitude, longitude coordinates for the trip.  Use this to precisely position the marker.'
                        ),
                    array(
                        'name' => 'Tour Thumbnail/Map Title',
                        'id'=> 'marker_position',
                        'type'=> 'text',
                        'desc'=> "Title . If you omit Lat/Long, this will be used to place the marker on the tour map."
                        ),
                    array(
                        'name' => 'Map Excerpt',
                        'id'=> 'map_excerpt',
                        'type'=> 'text',
                        'desc'=> "This is the text that will show up in the map. Limit to XX characters. "
                        ),                    
                    array(
                        'name' => 'Tour Operator',
                        'id'=> 'operator',
                        'type'=> 'text',
                        'desc'=> "The name of the tour operator."
                        ),                

                )
            )
            );

        }

         protected function add_thumbnail_meta() {
            new \UWAA\CustomPostData('thumbnail_information', array(
                'title' => 'Thumbnail Information',
                'pages' => array('tours', 'benefits'),  //add events, regional pages as they are ready
                'context' => 'side',
                'priority' => 'default',
                'fields' => array(
                    array(
                        'name' => 'Start Date',
                        'id'=> 'start_date',
                        'type'=> 'text',
                        'desc'=> 'The date this event/tour starts.  This is used to determine thumbnail order on browse pages.  (upcoming tours/events/etc.)'
                        ),
                    array(
                     'name' => 'Date Range Text',
                     'id'=> 'cosmetic_date',
                     'type'=> 'text',
                     'desc'=> "Appears below the tour thumbnail.  Cosmetic, and not used to sort the thumbnails."
                    ),
                    array(
                        'name' => 'Callout Box Text',
                        'id'=> 'thumbnail_callout',
                        'type'=> 'text',
                        'desc'=> "This text will show up in the small purple line on the thumbnail."
                        ),                    
                )
            )
            );

        }




}