<?php namespace UWAA\Taxonomies;

class Media
{
    function __construct()
    {
        add_action( 'init', array($this, 'setup_media_taxonomy'), 0 );
    }  

        public static function setup_media_taxonomy() 
        {             
        $labels = array(
            'name'                       => _x( 'Media Categories', 'Taxonomy General Name'),
            'singular_name'              => _x( 'Media Category', 'Taxonomy Singular Name'),
            'menu_name'                  => __( 'Media Categories'),
            'all_items'                  => __( 'All Media Categories'),
            'parent_item'                => __( 'Parent location'),
            'parent_item_colon'          => __( 'Parent location:'),
            'new_item_name'              => __( 'New Media Category Name'),
            'add_new_item'               => __( 'Add New Media Category'),
            'edit_item'                  => __( 'Edit Media Category'),
            'update_item'                => __( 'Update Media Category'),
            'separate_items_with_commas' => __( 'Separate Media Categories with commas'),
            'search_items'               => __( 'Search Media Categories'),
            'add_or_remove_items'        => __( 'Add or remove media categories'),
            'choose_from_most_used'      => __( 'Choose from the most used Media categories'),
            'not_found'                  => __( 'Media Category not found'),
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
           
            register_taxonomy( 'uwaa_media_taxonomy', array( 'attachment' ), $args );
        }

} 