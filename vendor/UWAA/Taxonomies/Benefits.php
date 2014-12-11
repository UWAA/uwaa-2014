<?php namespace UWAA\Taxonomies;

class Benefits
{
    function __construct()
    {
        add_action( 'init', array($this, 'setup_benefits_taxonomy'), 0 );
    }  

        public static function setup_benefits_taxonomy() 
        {             
        $labels = array(
            'name'                       => _x( 'Benefits Categories', 'Taxonomy General Name'),
            'singular_name'              => _x( 'Benefits Category', 'Taxonomy Singular Name'),
            'menu_name'                  => __( 'Benefits Categories'),
            'all_items'                  => __( 'All Benefits Categories'),
            'parent_item'                => __( 'Parent location'),
            'parent_item_colon'          => __( 'Parent location:'),
            'new_item_name'              => __( 'New Benefits Category Name'),
            'add_new_item'               => __( 'Add New Benefits Category'),
            'edit_item'                  => __( 'Edit Benefits Category'),
            'update_item'                => __( 'Update Benefits Category'),
            'separate_items_with_commas' => __( 'Separate Benefits Categories with commas'),
            'search_items'               => __( 'Search Benefits Categories'),
            'add_or_remove_items'        => __( 'Add or remove destinations'),
            'choose_from_most_used'      => __( 'Choose from the most used benefits categories'),
            'not_found'                  => __( 'Benefits Category not found'),
        );
        

        $args = array(
            'labels'                     => $labels,
            'hierarchical'               => true,
            'public'                     => true,
            'show_ui'                    => true,
            'show_admin_column'          => true,
            'show_in_nav_menus'          => true,
            'show_tagcloud'              => false,
            'rewrite'                    => false,
        );
           
            register_taxonomy( 'benefits', array( 'benefits' ), $args );
        }

} 