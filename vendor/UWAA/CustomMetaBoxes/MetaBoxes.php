<?php namespace UWAA\CustomMetaBoxes;

class MetaBoxes
{

    function __construct() {
        $this->add_tours_meta();
        $this->add_thumbnail_meta();
        $this->add_pullquote_meta();
        $this->add_regional_chapter_meta();
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
                    array(
                        'name' => 'Operator Provided Map URL',
                        'id'=> 'operator_map',
                        'type'=> 'text',
                        'desc'=> "Provide the URL for the Tour Map you have uploaded via the media gallery (or on this page)."
                        ),
                    array(
                        'name' => 'Operator Signup Form',
                        'id'=> 'operator_form',
                        'type'=> 'text',
                        'desc'=> "Provide the URL for the signup form that for this tour. This could be uploaded through the media gallery or a link to a previously updated form"
                        ),
                    array(
                        'name' => 'Tour Price',
                        'id'=> 'price',
                        'type'=> 'text',
                        'desc'=> "The price of the tour.  Input the number only with a comma."
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

        protected function add_pullquote_meta() {
            new \UWAA\CustomPostData('pullquote_elements', array(
                'title' => 'Pull Quote Information',
                'pages' => array('tours', 'benefits', 'posts'),  //add events, regional pages as they are ready
                'context' => 'side',
                'priority' => 'default',
                'fields' => array(
                    array(
                     'name' => 'Quote Text',
                     'id'=> 'pull-quote-text',
                     'type'=> 'text',
                     'desc'=> "Pull Quote Text"
                    ), 
                    array(
                        'name' => 'Attribution',
                        'id'=> 'pull-quote-attribution',
                        'type'=> 'text',
                        'desc'=> 'To whom this quote is attributed.  Small gold text below quote.  e.g. Members name'
                        )                                     
                )
            )
            );

        }

        protected function add_regional_chapter_meta() {
            new \UWAA\CustomPostData('chapters', array(
                'title' => 'Chapter Information',
                'pages' => array('chapters'),
                'context' => 'normal',
                'priority' => 'high',
                'fields' => array(
                    array(
                        'name' => 'Chapter Map Excerpt',
                        'id'=> 'chapter_map_excerpt',
                        'type'=> 'text',
                        'desc'=> "Teaser text for the communities map.  E.g. 13,813 Alumni and frields in the XYZ area."
                        ), 
                    array(
                        'name' => 'Chapter Leader 1',
                        'id'=> 'chapter_leader_1',
                        'type'=> 'text',
                        'desc'=> "The name of the Chapter Leader, follow UWAA Style for grad year/school."
                        ),                    
                    array(
                        'name' => 'Chapter Leader 1 Email',
                        'id'=> 'chapter_leader_1_email',
                        'type'=> 'text',
                        'desc'=> "The e-mail address of the chapter leader."
                        ),
                    array(
                        'name' => 'Chapter Leader 2',
                        'id'=> 'chapter_leader_2',
                        'type'=> 'text',
                        'desc'=> "(optional) The name of the Chapter Leader, follow UWAA Style for grad year/school."
                        ),                    
                    array(
                        'name' => 'Chapter Leader 2 Email',
                        'id'=> 'chapter_leader_2_email',
                        'type'=> 'text',
                        'desc'=> "(optional) The e-mail address of the chapter leader."
                        ),
                    array(
                        'name' => 'Chapter Logo Thumbnail ID',
                        'id'=> 'chapter_logo_id',
                        'type'=> 'text',
                        'desc'=> "The attachment ID of the Thumbnail Logo.  Used to build map and event thumbnails."
                        ),
                    array(
                        'name' => 'Chapter Facebook Link',
                        'id'=> 'chapter_facebook',
                        'type'=> 'text',
                        'desc'=> "URL for the chapter Facebook page."
                        ),
                    array(
                        'name' => 'Chapter LinkedIn',
                        'id'=> 'chapter_linkedIn',
                        'type'=> 'text',
                        'desc'=> "URL for the chapter LinkIn page."
                        ), 

                )
            )
            );

        }




}