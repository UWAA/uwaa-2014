<?php namespace UWAA\Taxonomies;

class AppRegionalTag
{
    function __construct()
    {
        add_action( 'init', array($this, 'setup_appRegionalTag_taxonomy'), 0 );
    }  

        public static function setup_appRegionalTag_taxonomy() 
        {             
        $labels = array(
            'name'                       => _x( 'Member App Geotags', 'Taxonomy General Name'),
            'singular_name'              => _x( 'Member App Geotag', 'Taxonomy Singular Name'),
            'menu_name'                  => __( 'Member App Geotags'),
            'all_items'                  => __( 'All Content Sections'),
            'parent_item'                => __( 'Parent Geotag'),
            'parent_item_colon'          => __( 'Parent Geotag:'),
            'new_item_name'              => __( 'New Geotag'),
            'add_new_item'               => __( 'Add New Geotag'),
            'edit_item'                  => __( 'Edit Geotag'),
            'update_item'                => __( 'Update Geotag'),
            'separate_items_with_commas' => __( 'Separate Geotags with commas'),
            'search_items'               => __( 'Search Geotags'),
            'add_or_remove_items'        => __( 'Add or remove geotags'),
            'choose_from_most_used'      => __( 'Choose from the most used geotags'),
            'not_found'                  => __( 'Geotag not found'),
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
           
            register_taxonomy( 'app_geotag', array( 'events', 'benefits' ), $args );
        }

} 