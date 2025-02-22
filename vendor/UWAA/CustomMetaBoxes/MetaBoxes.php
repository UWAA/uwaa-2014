<?php namespace UWAA\CustomMetaBoxes;

class MetaBoxes
{

    protected $post;

    function __construct() {

        global $post;

        $this->post = $post;
        $this->add_pullquote_meta();
        $this->add_tours_meta();
        $this->add_tours_map_meta();
        $this->add_regional_chapter_meta();
        $this->add_benefit_meta();
        $this->add_event_meta();
        $this->add_header_text_toggle();
        $this->add_major_market_toggle();
        $this->add_post_custom_actions();
        $this->add_special_opengraph_tags();
        $this->add_membergram_meta();
        $this->add_page_level_redirect();

        add_action('admin_menu', array($this, 'removeUnusedMetaBoxes'), 0);
        add_action('edit_form_after_title', array($this, 'moveEditorBox'), 0);
        add_filter('do_meta_boxes', array($this, 'renameFeaturedImage'), 0);
        add_action('pre_get_posts', array($this, 'add_gradpack_content_meta'), 0);
    }

        public function renameFeaturedImage() {

            $screen = get_current_screen();
            remove_meta_box( 'postimagediv', $screen, 'side' );
           
          if($screen->base != 'dashboard' ) {     
            add_meta_box('postimagediv', __('Post Header/Thumbnail Image'), 'post_thumbnail_meta_box', $screen, 'side', 'high');
          }
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
                // 'categorydiv'
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
                        'name' => 'Preliminary tour toggle',
                        'id'=> 'isPreliminaryTour',
                        'type'=> 'select',
                        'default' => 'preliminary',
                        'options' => array(
                                'preliminary' => 'Preliminary Tour',
                                'ready_to_publish_tour' => 'Ready to Publish'
                                ),
                        'desc'=> 'Use this to determine if the tour should be landable from the updoming tour page.'
                    ),
                    array(
                        'name' => 'Start Date',
                        'id'=> 'start_date',
                        'type'=> 'text',
                        'desc'=> 'The date this tour starts.  This is used to determine thumbnail order on browse pages.  (upcoming tours/events/etc.)  Formatting is very important.  e.g. 10/19/2014'
                        ),
                    array(
                        'name' => 'End Date',
                        'id'=> 'end_date',
                        'type'=> 'text',
                        'desc'=> 'The date this tour ends, before any extension. Essential for the Member App  Formatting is very important.  e.g. 10/19/2014'
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
                        'name' => 'Tour Operator Phone Number',
                        'id'=> 'phone number',
                        'type'=> 'text',
                        'desc'=> "The Phone number of the tour operator. E.g. \"206-684-5476\" "
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
                    array(
                        'name' => 'Tour Map Big Image',
                        'id'=> 'operator_big_map',
                        'type'=> 'text',
                        'desc'=> "Provide the URL for the Big Tour Map you have uploaded to WordPress (via the Media Gallery or this page). This is the image that will show in the lightbox on click."
                        ),
                     array(
                        'name' => '80 Character Excerpt',
                        'id'=> '80_character_excerpt',
                        'type'=> 'textarea',
                        'desc'=> "Used in elements with limited text areas.  Such as home-page boxes and chapter story/event rows.  If you are promoting this event using content promotion, this must be filled out."
                        )


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
                        'name' => 'Map Pin Location Name',
                        'id'=> 'marker_position',
                        'type'=> 'list',
                        'desc'=> "Pin location on the map. If you omit Lat/Long, this will be used to place the marker on the tour map."
                        ),
                    array(
                        'name' => 'Latitude/Longitude',
                        'id'=> 'lat_long',
                        'type'=> 'text',
                        'desc'=> 'The latitude, longitude coordinates for the trip.  Use this to precisely position the map-marker if a city does not work'
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
                        'name' => 'International vs. US Toggle',
                        'id'=> 'internationalOrUS',
                        'type'=> 'select',
                        'default' => 'international',
                        'options' => array(
                                'international' => 'International Huskies',
                                'us' => 'US Huskies'
                                ),
                        'desc'=> 'Used to support the new map features on the US Huskies Page and International Huskies Page.  Without this, you could not get to the omaha chapter from the international huskies page.'
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
                        'name' => 'Chapter Leader 3',
                        'id'=> 'chapter_leader_3',
                        'type'=> 'text',
                        'desc'=> "(optional) The name of the Third Chapter Leader, follow UWAA Style for grad year/school."
                        ),
                    array(
                        'name' => 'Chapter Leader 3 Email',
                        'id'=> 'chapter_leader_3_email',
                        'type'=> 'text',
                        'desc'=> "(optional) The e-mail address of the third chapter leader."
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
                        'desc'=> "URL for the chapter LinkedIn page."
                        ),
                    array(
                        'name' => 'Chapter Twitter',
                        'id'=> 'chapter_twitter',
                        'type'=> 'text',
                        'desc'=> "URL for the chapter Twitter feed."
                        ),
                    array(
                        'name' => 'Chapter Facebook Alternate Name',
                        'id'=> 'chapter_facebook_name',
                        'type'=> 'text',
                        'desc'=> "Specialized name for the chapter Facebook group.  E.g. NY Huskies"
                        ),
                    array(
                        'name' => 'Chapter LinkedIn Alternate Name',
                        'id'=> 'chapter_linkedIn_name',
                        'type'=> 'text',
                        'desc'=> "Specialized name for the chapter LinkedIn group.  E.g. NY Huskies"
                        ),
                    array(
                        'name' => 'Chapter Twitter Alternate Name',
                        'id'=> 'chapter_twitter_name',
                        'type'=> 'text',
                        'desc'=> "Specialized name for the chapter Twitter feed.  E.g. NY Huskies"
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
                        'name' => 'How to get your benefit (Life Members):',
                        'id'=> 'benefit_promotion_life',
                        'type'=> 'textarea',
                        'desc'=> "Text to be displayed only if the user is logged in AND is a life member.  Such as promotional codes/offer details. This content will supersede Annual Member benefits."
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
                    array(
                        'name' => 'Content Head',
                        'id'=> 'thumbnail_subtitle',
                        'type'=> 'text',
                        'desc'=> "Small gold text that appears below the image in a featured post.  For Tours, this will default to the region of the tour, or can be overwritten with this field.  Homepage featured posts should have this."
                        ),
                    array(
                        'name' => '80 Character Excerpt',
                        'id'=> '80_character_excerpt',
                        'type'=> 'textarea',
                        'desc'=> "Used in elements with limited text areas.  Such as home-page boxes and chapter story/event rows.  If you are promoting this event using content promotion, this must be filled out."
                        ),



                )
            )
            );

        }


        protected function add_event_meta() {
            new \UWAA\CustomPostData('events', array(
                'title' => 'Event Post Information',
                'pages' => array('events'),  //add events, regional pages as they are ready
                'context' => 'normal',
                'priority' => 'high',
                'fields' => array(
                     array(
                        'name' => 'Partner Event Toggle',
                        'id'=> 'isPartnerEvent',
                        'type'=> 'select',
                        'default' => false,
                        'options' => array(
                                false => 'Alumni/UWAA Event',
                                true => 'Partner Event'
                                ),
                        'desc'=> 'Use this to make a limited event that will only show up on the calendar, but doesn\'t need a full event page buildout.'
                    ),
                    array(
                        'name' => 'Start Date',
                        'id'=> 'start_date',
                        'type'=> 'text',
                        'desc'=> 'The date this event starts.  This is used to determine thumbnail order on browse pages.  (upcoming tours/events/etc.)  Formatting is very important.  e.g. 10/19/2014'
                        ),
                    array(
                        'name' => 'End Date',
                        'id'=> 'end_date',
                        'type'=> 'text',
                        'desc'=> 'The date this event ends.  This is used to determine thumbnail order on browse pages. Leave blank if the event only occurs on one day.  Formatting is very important.  e.g. 10/19/2014'
                        ),
                    array(
                     'name' => 'Cosmetic Event Date',
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
                        'name' => 'Alternate Link',
                        'id'=> 'alternate_link',
                        'type'=> 'text',
                        'desc'=> 'If this event should link to an external page, write the URL here. Leave this blank for any event with a landing page on our site.'
                        ),
                    array(
                        'name' => '80 Character Excerpt',
                        'id'=> '80_character_excerpt',
                        'type'=> 'textarea',
                        'desc'=> "Used in elements with limited text areas.  Such as home-page boxes and chapter story/event rows.  If you are promoting this event using content promotion, this must be filled out."
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
                        'desc'=> 'Start-Finish time of the event - e.g. 7-9 p.m. Only enter the event time or duration.  No extended language like, "doors open" should go in this field.'
                        ),
                    array(
                        'name' => 'CVENT Event Code',
                        'id'=> 'cvent_event_id',
                        'type'=> 'text',
                        'desc'=> 'If the event is being managed by CVENT, put the "Event Code" here.'
                        )
                    )
            )
            );

        }

        protected function add_header_text_toggle() {
            new \UWAA\CustomPostData('header_toggle', array(
                'title' => 'Event Post Information',
                'pages' => array('events', 'tours', 'post', 'page'),  //add events, regional pages as they are ready
                'context' => 'normal',
                'priority' => 'high',
                'fields' => array(
                    array(
                        'name' => 'Header Text Color',
                        'id'=> 'header_text_color',
                        'type'=> 'select',
                        'options' => array(
                                'white-header-overlay' => 'White Text',
                                'purple-header-overlay' => 'Purple Text'
                                ),
                        'desc'=> 'Text overlays the hero image on this post type.  Choose between Purple and White text'
                        ),
                    )
            )
            );

        }

        protected function add_membergram_meta() {
            new \UWAA\CustomPostData('membergram_cta', array(
                'title' => 'Membergram Features',
                'pages' => array('membergrams', 'tpcmembergrams'),  //add events, regional pages as they are ready
                'context' => 'normal',
                'priority' => 'high',
                'fields' => array(
                    array(                        
                       'name' => 'Call-to-action Button Link',
                        'id'=> 'membergram_cta_link',
                        'type'=> 'text',
                        'desc'=> "Add the link, including the 'http:' here.  This will be the destination for app 'learn more' buttons "
                        
                        ),
                    )
            )
            );

        }

        protected function add_special_opengraph_tags() {
            new \UWAA\CustomPostData('special_og_tags', array(
                'title' => 'One-Off OpenGraph Tags',
                'pages' => array('page', 'post', 'events', 'tours'),  //add events, regional pages as they are ready
                'context' => 'normal',
                'priority' => 'high',
                'fields' => array(
                    array(
                          'name' => 'OpenGraph Title',
                          'id'=> 'special_og_title',
                          'type'=> 'text',
                          'desc'=> "This text will show up in the small purple line on the thumbnail."
                          ),
                    array(
                          'name' => 'OpenGraph Description',
                          'id'=> 'special_og_description',
                          'type'=> 'text',
                          'desc'=> "This text will show up in the small purple line on the thumbnail."
                          ),
                    array(
                          'name' => 'OpenGraph Image',
                          'id'=> 'special_og_image',
                          'type'=> 'text',
                          'desc'=> "This image will appear in Facebook/Twitter Cards, overwriting default OpenGraph image settings."
                          ),
                    )
            )
            );

        }

         protected function add_major_market_toggle() {
            new \UWAA\CustomPostData('major_market', array(
                'title' => 'Major Market Toggle',
                'pages' => array('chapters'),  //add events, regional pages as they are ready
                'context' => 'normal',
                'priority' => 'high',
                'fields' => array(
                    array(
                        'name' => 'Major Market Toggle',
                        'id'=> 'isMajorMarket',
                        'type'=> 'select',
                        'default' => 'notMajorMarket',
                        'options' => array(
                                'notMajorMarket' => 'Not a Major Market',
                                'majorMarket' => 'Is a Major Market'
                                ),
                        'desc'=> 'Use this to toggle between major and non/major markets.  Non-major markets will have their map link direct to the "Other Areas" page'
                        ),
                    )
            )
            );

        }


          protected function add_post_custom_actions() {
              new \UWAA\CustomPostData('post_custom_action', array(
                  'title' => 'Post Special Fields',
                  'pages' => array('post'),
                  'context' => 'normal',
                  'priority' => 'high',
                  'fields' => array(
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
                          'name' => '80 Character Excerpt',
                          'id'=> '80_character_excerpt',
                          'type'=> 'textarea',
                          'desc'=> "Used in elements with limited text areas.  Such as home-page boxes and chapter story/event rows.  If you are promoting this event using content promotion, this must be filled out."
                          ),
                          array(
                          'name' => 'Partner Content Toggle',
                          'id'=> 'isPartnerEvent',
                          'type'=> 'select',
                          'default' => false,
                          'options' => array(
                                  false => 'Alumni/UWAA Content',
                                  true => 'Partner Content'
                                  ),
                          'desc'=> 'Use this to make a limited story post that will only show up on the story page, but doesn\'t need a full buildout.'
                         ),
                         array(
                          'name' => 'Alternate Link',
                          'id'=> 'alternate_link',
                          'type'=> 'text',
                          'desc'=> 'If this content should link to an external page, write the URL here. Leave this blank for any content/story that stays on our site.  This is also used for superhero redirects. Relative URLs(/alumni/definealumni) are supported.'
                         ),
                          array(
                          'name' => 'display_priority',
                          'id'=> 'display_priority',
                          'type'=> 'text',                          
                          'desc'=> 'If filled, this will allow this content to be prioritized for display in certain areas on the site, e.g. Thumbnail Rows on the homepage.  Use sparingly, if at all.'
                          ),
                      ),
                      
              )
              );

          }

          public function add_gradpack_content_meta()
          {


              global $post;



              if(!empty($post) && $post->post_name == 'gradpack')  {

                  new \UWAA\CustomPostData('gradpack_content_meta', array(
                  'title' => 'Gradpack Content',
                  'pages' => array('page'),
                  'context' => 'advanced',
                  'priority' => 'high',
                  'fields' => array(
                      array(
                          'name' => 'Row One Title',
                          'id'=> 'row_one_title',
                          'type'=> 'text',
                          'desc'=> 'The title text for the first row.'
                          ),
                       array(
                          'name' => 'Row One Content',
                          'id'=> 'row_one_content',
                          'type'=> 'textarea',
                          'desc'=> 'The content text for the first row.'
                          ),
                        array(
                          'name' => 'Row Two Title',
                          'id'=> 'row_two_title',
                          'type'=> 'text',
                          'desc'=> 'The title text for the second row.'
                          ),
                       array(
                          'name' => 'Row Two Content',
                          'id'=> 'row_two_content',
                          'type'=> 'textarea',
                          'desc'=> 'The content text for the second row.'
                          ),
                        array(
                          'name' => 'Row Three Title',
                          'id'=> 'row_three_title',
                          'type'=> 'text',
                          'desc'=> 'The title text for the third row.'
                          ),
                       array(
                          'name' => 'Row Three Content',
                          'id'=> 'row_three_content',
                          'type'=> 'textarea',
                          'desc'=> 'The content text for the third row.'
                          ),
                        array(
                          'name' => 'Row Four Title',
                          'id'=> 'row_four_title',
                          'type'=> 'text',
                          'desc'=> 'The title text for the fourth row.'
                          ),
                       array(
                          'name' => 'Row Four Content',
                          'id'=> 'row_four_content',
                          'type'=> 'textarea',
                          'desc'=> 'The content text for the fourth row.'
                          ),
                        array(
                          'name' => 'Row Five Title',
                          'id'=> 'row_five_title',
                          'type'=> 'text',
                          'desc'=> 'The title text for the fifth row.'
                          ),
                       array(
                          'name' => 'Row Five Content',
                          'id'=> 'row_five_content',
                          'type'=> 'textarea',
                          'desc'=> 'The content text for the fifth row.'
                          ),
                        array(
                          'name' => 'Row Six Title',
                          'id'=> 'row_six_title',
                          'type'=> 'text',
                          'desc'=> 'The title text for the sixth row.'
                          ),
                       array(
                          'name' => 'Row Six Content',
                          'id'=> 'row_six_content',
                          'type'=> 'textarea',
                          'desc'=> 'The content text for the sixth row.'
                          ),
                        array(
                          'name' => 'Row Seven Title',
                          'id'=> 'row_seven_title',
                          'type'=> 'text',
                          'desc'=> 'The title text for the seventh row.'
                          ),
                       array(
                          'name' => 'Row Seven Content',
                          'id'=> 'row_seven_content',
                          'type'=> 'textarea',
                          'desc'=> 'The content text for the seventh row.'
                          ),
                        array(
                          'name' => 'Row Eight Title',
                          'id'=> 'row_eight_title',
                          'type'=> 'text',
                          'desc'=> 'The title text for the eighth row.'
                          ),
                       array(
                          'name' => 'Row Eight Content',
                          'id'=> 'row_eight_content',
                          'type'=> 'textarea',
                          'desc'=> 'The content text for the eighth row.'
                          ),
                       array(
                          'name' => 'Row Nine Title',
                          'id'=> 'row_nine_title',
                          'type'=> 'text',
                          'desc'=> 'The title text for the ninth row.'
                          ),
                       array(
                          'name' => 'Row Nine Content',
                          'id'=> 'row_nine_content',
                          'type'=> 'textarea',
                          'desc'=> 'The content text for the ninth row.'
                          ),
                      )
                  ));

              }
          }

          protected function add_page_level_redirect() {
            new \UWAA\CustomPostData('page_redirect', array(
                'title' => 'Page Level redirect',
                'pages' => array('page'),  //add events, regional pages as they are ready
                'context' => 'normal',
                'priority' => 'high',
                'fields' => array(
                    array(
                          'name' => 'Redirect Slug',
                          'id'=> 'redirect_slug',
                          'type'=> 'text',
                          'desc'=> "Enter the slug of the internal redirect you wish this page to hit.  Use this to create items in sidebar page navigation menus."
                          ),
                   array(
                        'name' => 'Header Text Color',
                        'id'=> 'is_page_redirecting',
                        'type'=> 'select',
                        'options' => array(
                                false => 'No, this page will not redirect.',
                                true => 'Yes, force this page to redirect immediately.'
                                ),
                        'desc'=> 'Choose if this page should immediately go somewhere else.'
                        ),
                    )
            )
            );

        }







      }