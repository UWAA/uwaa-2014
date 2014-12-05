<?php namespace UWAA\Taxonomies;

class ContentSection
{
    function __construct()
    {
        add_action( 'init', array($this, 'setup_ContentSection_taxonomy'), 0 );
    }  

        public static function setup_content_taxonomy() 
        {             
        $labels = array(
            'name'                       => _x( 'UWAA Content Sections', 'Taxonomy General Name'),
            'singular_name'              => _x( 'UWAA Content Section', 'Taxonomy Singular Name'),
            'menu_name'                  => __( 'UWAA Content Sections'),
            'all_items'                  => __( 'All Content Sections'),
            'parent_item'                => __( 'Parent Section'),
            'parent_item_colon'          => __( 'Parent section:'),
            'new_item_name'              => __( 'New Content Section'),
            'add_new_item'               => __( 'Add New Content Section'),
            'edit_item'                  => __( 'Edit Content Section'),
            'update_item'                => __( 'Update Content Section'),
            'separate_items_with_commas' => __( 'Separate Content Sections with commas'),
            'search_items'               => __( 'Search Content Sections'),
            'add_or_remove_items'        => __( 'Add or remove content sections'),
            'choose_from_most_used'      => __( 'Choose from the most used content sections'),
            'not_found'                  => __( 'Content Section not found'),
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
           
            register_taxonomy( 'uwaa_content_taxonomy', array( 'attachment' ), $args );
        }

} 