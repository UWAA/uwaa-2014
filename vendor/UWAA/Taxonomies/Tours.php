<?php namespace UWAA\Taxonomies;

class Tours
{
    function __construct()
    {
        add_action( 'init', array($this, 'setup_tours_taxonomy'), 0 );
    }  

        public static function setup_tours_taxonomy() 
        {             
        $labels = array(
            'name'                       => _x( 'Tour Categories', 'Taxonomy General Name'),
            'singular_name'              => _x( 'Tour Category', 'Taxonomy Singular Name'),
            'menu_name'                  => __( 'Tour Categories'),
            'all_items'                  => __( 'All Tour Categories'),
            'parent_item'                => __( 'Parent location'),
            'parent_item_colon'          => __( 'Parent location:'),
            'new_item_name'              => __( 'New Tour Category Name'),
            'add_new_item'               => __( 'Add New Tour Category'),
            'edit_item'                  => __( 'Edit Tour Category'),
            'update_item'                => __( 'Update Tour Category'),
            'separate_items_with_commas' => __( 'Separate Tour Categories with commas'),
            'search_items'               => __( 'Search Tour Categories'),
            'add_or_remove_items'        => __( 'Add or remove destinations'),
            'choose_from_most_used'      => __( 'Choose from the most used tour categories'),
            'not_found'                  => __( 'Tour Category not found'),
        );
        
        $rewrite = array(
        'slug'                       => 'tours/destinations',
        'with_front'                 => true,
        'hierarchical'               => true,
        );

        $args = array(
            'labels'                     => $labels,
            'hierarchical'               => true,
            'public'                     => true,
            'show_ui'                    => true,
            'show_admin_column'          => true,
            'show_in_nav_menus'          => true,
            'show_tagcloud'              => false,
            'rewrite'                    => $rewrite,
        );
           
            register_taxonomy( 'destinations', array( 'tours' ), $args );
        }

} 