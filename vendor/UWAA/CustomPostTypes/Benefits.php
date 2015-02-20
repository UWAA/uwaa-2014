<?php namespace UWAA\CustomPostTypes;

class Benefits
{
    function __construct()
    {
        add_action( 'init', array($this, 'setup_benefits_posts'), 1 );
    }  

        public static function setup_benefits_posts() 
        {             
            $labels = array(
                'name'                => 'Benefits',
                'singular_name'       => 'Benefit',
                'menu_name'           => 'Benefits',
                'parent_item_colon'   => 'Parent Item:',
                'all_items'           => 'All Benefits',
                'view_item'           => 'View Benefit Details',
                'add_new_item'        => 'Add New Benefit',
                'add_new'             => 'Add Benefit',
                'edit_item'           => 'Edit Benefit',
                'update_item'         => 'Update Benefit',
                'search_items'        => 'Search Benefits',
                'not_found'           => 'No Benefit Found',
                'not_found_in_trash'  => 'No Benefit found in Trash',
            );

             $rewrite = array(
                'slug'                => 'membership/benefits',
                'with_front'          => false,
                'pages'               => true,
                'feeds'               => true,
            );
            $args = array(
                'label'               => 'benefits',
                'description'         => 'These posts correspond to individual UW Member Benefits',
                'labels'              => $labels,
                'supports'            => array( 'title', 'editor', 'thumbnail', 'revisions', 'custom-fields', 'excerpt' ),
                'taxonomies'          => array('benefits', 'post_tag'),
                'hierarchical'        => true,
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
                'query_var'           => 'benefits',
                'capability_type'     => 'post',
                'rewrite'             => $rewrite,
            );
            register_post_type( 'benefits', $args );
        }

} 