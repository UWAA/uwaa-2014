<?php namespace UWAA\CustomPostTypes;

class Events
{
    function __construct()
    {
        add_action( 'init', array($this, 'setup_events_posts'), 1 );
    }  

        public static function setup_events_posts() 
        {             
            $labels = array(
                'name'                => 'Events',
                'singular_name'       => 'Event',
                'menu_name'           => 'Event Post',
                'parent_item_colon'   => 'Parent Item:',
                'all_items'           => 'All Events',
                'view_item'           => 'View Event Details',
                'add_new_item'        => 'Add New Event',
                'add_new'             => 'Add Event',
                'edit_item'           => 'Edit Event',
                'update_item'         => 'Update Event',
                'search_items'        => 'Search Events',
                'not_found'           => 'No Event Found',
                'not_found_in_trash'  => 'No Event found in Trash',
            );
            $args = array(
                'label'               => 'events',
                'description'         => 'These posts hold all Events, including ACR led events as well as constituency groups.',
                'labels'              => $labels,
                'supports'            => array( 'title', 'editor', 'thumbnail', 'revisions', 'excerpt' ),
                'taxonomies'          => array('events'),
                'hierarchical'        => false,
                'public'              => true,
                'show_ui'             => true,
                'show_in_menu'        => true,
                'show_in_nav_menus'   => false,
                'show_in_admin_bar'   => true,
                'menu_position'       => 20,
                'can_export'          => true,
                'menu_icon'           => '',
                'has_archive'         => true,
                'exclude_from_search' => false,
                'publicly_queryable'  => true,
                'query_var'           => 'events',
                'capability_type'     => 'post',
            );
            register_post_type( 'events', $args );
        }

} 