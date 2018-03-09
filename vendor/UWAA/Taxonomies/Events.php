<?php namespace UWAA\Taxonomies;

class Events
{
    function __construct()
    {
        add_action( 'init', array($this, 'setup_events_taxonomy'), 0 );
    }  

        public static function setup_events_taxonomy() 
        {             
        $labels = array(
            'name'                       => _x( 'Event Sorting Categories', 'Taxonomy General Name'),
            'singular_name'              => _x( 'Event Sorting Category', 'Taxonomy Singular Name'),
            'menu_name'                  => __( 'Event Sorting Categories'),
            'all_items'                  => __( 'All Event Categories'),
            'parent_item'                => __( 'Parent location'),
            'parent_item_colon'          => __( 'Parent location:'),
            'new_item_name'              => __( 'New Event Category Name'),
            'add_new_item'               => __( 'Add New Event Category'),
            'edit_item'                  => __( 'Edit Event Category'),
            'update_item'                => __( 'Update Event Category'),
            'separate_items_with_commas' => __( 'Separate Event Categories with commas'),
            'search_items'               => __( 'Search Event Categories'),
            'add_or_remove_items'        => __( 'Add or remove destinations'),
            'choose_from_most_used'      => __( 'Choose from the most used event categories'),
            'not_found'                  => __( 'Event Category not found'),
        );
        
       $args = array(
            'labels'                     => $labels,
            'hierarchical'               => true,
            'public'                     => true,
            'show_ui'                    => true,
            'show_admin_column'          => true,
            'show_in_nav_menus'          => true,
            'show_tagcloud'              => false,
            
        );
           
            register_taxonomy( 'events', array( 'events' ), $args );
        }

} 