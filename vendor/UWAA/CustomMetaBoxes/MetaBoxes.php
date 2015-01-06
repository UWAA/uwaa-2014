<?php namespace UWAA\CustomMetaBoxes;

class MetaBoxes
{

    function __construct() {
        $this->add_pullquote_meta();
        $this->add_tours_meta();
        $this->add_tours_map_meta();
        $this->add_regional_chapter_meta();
        $this->add_benefit_meta();
        $this->add_event_meta();
        $this->add_header_text_toggle();
        add_action('admin_menu', array($this, 'removeUnusedMetaBoxes'), 0);
        add_action('edit_form_after_title', array($this, 'moveEditorBox'), 0);
        add_filter('do_meta_boxes', array($this, 'renameFeaturedImage'), 0);

    }

        public function renameFeaturedImage() {

            $screen = get_current_screen();
            remove_meta_box( 'postimagediv', $screen, 'side' );
            add_meta_box('postimagediv', __('Post Header/Thumbnail Image'), 'post_thumbnail_meta_box', $screen, 'side', 'high');
        }        

        public function moveEditorBox() {
            global $post, $wp_meta_boxes;
            do_meta_boxes(get_current_screen(), 'advanced', $post);
            unset($wp_meta_boxes[get_post_type($post)]['advanced']);
        }

        public function removeUnusedMetaBoxes()
        {
            $pagesToRemoveBoxesFrom = array(
                'post',
                'page',
                'events',
                'tours'
                );
            $boxesToRemove = array(
                'postcustom',
                'trackbacksdiv',
                'categorydiv'                
                );

            foreach ($pagesToRemoveBoxesFrom as $page):
                foreach ($boxesToRemove as $box): 
                    remove_meta_box($box, $page, 'normal');
                endforeach;
            endforeach;

            remove_meta_box('formatdiv', 'post', 'normal');
            // remove_meta_box('tagsdiv-post_tag', 'post', 'normal');
            
        }

        protected function add_tours_meta() {
            new \UWAA\CustomPostData('tours', array(
                'title' => 'Tour Information',
                'pages' => array('tours'),
                'context' => 'advanced',
                'priority' => 'high',
                'fields' => array(
                    array(
                        'name' => 'Start Date',
                        'id'=> 'start_date',
                        'type'=> 'text',
                        'desc'=> 'The date this tour starts.  This is used to determine thumbnail order on browse pages.  (upcoming tours/events/etc.)  Formatting is very important.  e.g. 10/19/2014'
                        ),
                    array(
                     'name' => 'Cosmetic Tour Start Date',
                     'id'=> 'cosmetic_date',
                     'type'=> 'text',
                     'desc'=> "Appears over header image, ont the tour map, and in promotion thumbnails "
                    ),
                    array(
                        'name' => 'Tour Operator',
                        'id'=> 'operator',
                        'type'=> 'text',
                        'desc'=> "The name of the tour operator."
                        ),
                    array(
                        'name' => 'Tour Price',
                        'id'=> 'price',
                        'type'=> 'text',
                        'desc'=> "The price of the tour. E.g. \"From $200\" "
                        ),
                    array(
                        'name' => 'Thumbnail Callout Box',
                        'id'=> 'thumbnail_callout',
                        'type'=> 'text',
                        'desc'=> "This text will show up in the small purple line on the thumbnail."
                        ),
                    array(
                        'name' => 'Content Head',
                        'id'=> 'thumbnail_subtitle',
                        'type'=> 'text',
                        'desc'=> "Small gold text that appears below the image in a featured post.  Defaults to region specified in \"Tour Sorting Categories\" , or can be overwritten with this field."
                        ),                                                             
                    array(
                        'name' => 'Tour Map Image',
                        'id'=> 'operator_map',
                        'type'=> 'text',
                        'desc'=> "Provide the URL for the Tour Map you have uploaded to WordPress (via the Media Gallery or this page)."
                        ),
                                       

                )
            )
            );

        }

        protected function add_tours_map_meta() {
            new \UWAA\CustomPostData('thumbnail_information', array(
                'title' => 'Map-Specific Information',
                'pages' => array( 'tours'),  
                'context' => 'normal',
                'priority' => 'default',
                'fields' => array(
                    array(
                        'name' => 'Latitude/Longitude',
                        'id'=> 'lat_long',
                        'type'=> 'text',
                        'desc'=> 'The latitude, longitude coordinates for the trip.  Use this to precisely position the map-marker.'
                        ),
                    array(
                        'name' => 'Map Title',
                        'id'=> 'marker_position',
                        'type'=> 'text',
                        'desc'=> "Title For the Map. If you omit Lat/Long, this will be used to place the marker on the tour map."
                        ),
                    array(
                        'name' => 'Map Excerpt',
                        'id'=> 'map_excerpt',
                        'type'=> 'text',
                        'desc'=> "This is the text that will show up in the map. Limit to XX characters. "
                        )                    
                )
            )
            );

        }


        //Not called, drop soon  @TODO
        protected function add_chapter_map_meta() {
            new \UWAA\CustomPostData('map_information', array(
                'title' => 'Map-Specific Information',
                'pages' => array( 'tours'),  //add events, regional pages as they are ready
                'context' => 'core',
                'priority' => 'default',
                'fields' => array(
                    array(
                        'name' => 'Latitude/Longitude',
                        'id'=> 'lat_long',
                        'type'=> 'text',
                        'desc'=> 'The latitude, longitude coordinates for the trip.  Use this to precisely position the map-marker.'
                        ),                    
                    array(
                        'name' => 'Map Excerpt',
                        'id'=> 'map_excerpt',
                        'type'=> 'text',
                        'desc'=> "This is the text that will show up in the map under the Chapter logo. Limit to XX characters."
                        )                    
                )
            )
            );
}


         protected function add_thumbnail_meta() {
            new \UWAA\CustomPostData('thumbnail_information', array(
                'title' => 'Post Thumbnail Information',
                'pages' => array( 'benefits', 'post'),  //add events, regional pages as they are ready
                'context' => 'advanced',
                'priority' => 'default',
                'fields' => array(
                    array(
                        'name' => 'Start Date',
                        'id'=> 'start_date',
                        'type'=> 'text',
                        'desc'=> 'The date this event/tour starts.  This is used to determine thumbnail order on browse pages.  (upcoming tours/events/etc.)  Formatting is very important.  e.g. 10/19/2014'
                        ),
                    array(
                     'name' => 'Cosmetic Event Date',
                     'id'=> 'cosmetic_date',
                     'type'=> 'text',
                     'desc'=> "Appears below the tour thumbnail, and on event and travel posts in the page main content area. Cosmetic, and not used to sort the thumbnails."
                    ),
                    array(
                        'name' => 'Thumbnail Callout Box',
                        'id'=> 'thumbnail_callout',
                        'type'=> 'text',
                        'desc'=> "This text will show up in the small purple line on the thumbnail."
                        ),
                    array(
                        'name' => 'Content Head',
                        'id'=> 'thumbnail_subtitle',
                        'type'=> 'text',
                        'desc'=> "Small gold text that appears below the image in a featured post.  For Tours, this will default to the region of the tour, or can be overwritten with this field.  Homepage featured posts should have this."
                        ),                    
                )
            )
            );

        }

        protected function add_pullquote_meta() {
            new \UWAA\CustomPostData('pullquote_elements', array(
                'title' => 'Post Pull Quote',
                'pages' => array('tours', 'events' , 'benefits', 'post', 'chapters'),  //add events, regional pages as they are ready
                'context' => 'normal',
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
                        'name' => 'Map Position',
                        'id'=> 'marker_position',
                        'type'=> 'text',
                        'desc'=> "If the chapter's location has a different name than the title (e.g. Bay Area vs. San Francisco), enter a location here to help the map place the marker in the correct spot."
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
                        'desc'=> "(optional) The name of the Second Chapter Leader, follow UWAA Style for grad year/school."
                        ),                    
                    array(
                        'name' => 'Chapter Leader 2 Email',
                        'id'=> 'chapter_leader_2_email',
                        'type'=> 'text',
                        'desc'=> "(optional) The e-mail address of the second chapter leader."
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
                    array(
                        'name' => 'Latitude/Longitude',
                        'id'=> 'lat_long',
                        'type'=> 'text',
                        'desc'=> 'IF you are havingg issues getting the map marker to show up in the correct spot, then put in a lat long.'
                        ), 

                )
            )
            );

        }

        protected function add_benefit_meta() {
            new \UWAA\CustomPostData('benefits', array(
                'title' => 'Benefit Information',
                'pages' => array('benefits'),
                'context' => 'normal',
                'priority' => 'high',
                'fields' => array(
                    array(
                        'name' => 'How to get your benefit:',
                        'id'=> 'benefit_promotion',
                        'type'=> 'textarea',
                        'desc'=> "Text to be displayed only if the user is logged in.  Such as promotional codes/offer details."
                        ),                
                    array(
                        'name' => 'Benefit Provider Logo:',
                        'id'=> 'benefit_provider_logo',
                        'type'=> 'text',
                        'desc'=> "URL for the uploaded Benefit Provider Logo"
                        ),
                    array(
                        'name' => 'Thumbnail Callout Box',
                        'id'=> 'thumbnail_callout',
                        'type'=> 'text',
                        'desc'=> "This text will show up in the small purple line on the thumbnail."
                        ), 
                     

                )
            )
            );

        }


        protected function add_event_meta() {
            new \UWAA\CustomPostData('events', array(
                'title' => 'Event Post Information',
                'pages' => array('events'),  //add events, regional pages as they are ready
                'context' => 'advanced',
                'priority' => 'high',
                'fields' => array(
                    array(
                        'name' => 'Start Date',
                        'id'=> 'start_date',
                        'type'=> 'text',
                        'desc'=> 'The date this event.  This is used to determine thumbnail order on browse pages.  (upcoming tours/events/etc.)  Formatting is very important.  e.g. 10/19/2014'
                        ),
                    array(
                     'name' => 'Cosmetic Event Start Date',
                     'id'=> 'cosmetic_date',
                     'type'=> 'text',
                     'desc'=> "Appears over header image and under promotion thumbnails."
                    ),                    
                    array(
                        'name' => 'Callout Box',
                        'id'=> 'thumbnail_callout',
                        'type'=> 'text',
                        'desc'=> "This text will show up in the small purple line on the thumbnail."
                        ),
                    array(
                        'name' => 'Content Head',
                        'id'=> 'thumbnail_subtitle',
                        'type'=> 'text',
                        'desc'=> "Small gold text that appears below the image in a featured post thumbnail.  E.g. New York Huskies, Member 101 Series."
                        ),                                     
                    array(
                     'name' => 'Location',
                     'id'=> 'event_location',
                     'type'=> 'text',
                     'desc'=> "H5 - Where the event will be held - e.g. Kane Hall 120, UW Seattle Campus"
                    ), 
                    array(
                        'name' => 'Event Time',
                        'id'=> 'event_time',
                        'type'=> 'text',
                        'desc'=> 'Start-Finish time of the event - e.g. 7-9 p.m.'
                        ),

                    )
            )
            );

        }

        protected function add_header_text_toggle() {
            new \UWAA\CustomPostData('header_toggle', array(
                'title' => 'Event Post Information',
                'pages' => array('events', 'tours'),  //add events, regional pages as they are ready
                'context' => 'normal',
                'priority' => 'high',
                'fields' => array(
                    array(
                        'name' => 'Header Text Color',
                        'id'=> 'header_text_color',
                        'type'=> 'select',
                        'default' => 'white_text',
                        'options' => array(
                                'purple-header-overlay' => 'Purple Text', 
                                'white-header-overlay' => 'White Text'
                                ),
                        'desc'=> 'Text overlays the hero image on this post type.  Choose between Purple and White text'
                        ),
                    )
            )
            );

        }







}