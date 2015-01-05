<?php namespace UWAA\CustomPostTypes;

class Tours
{
    function __construct()
    {
        add_action( 'init', array($this, 'setup_tours_posts'), 1 );
        
    }  

        public static function setup_tours_posts() 
        {             
            $labels = array(
                'name'                => 'Tours',
                'singular_name'       => 'Tour',
                'menu_name'           => 'Tour Post',
                'parent_item_colon'   => 'Parent Item:',
                'all_items'           => 'All Tours',
                'view_item'           => 'View Tour Details',
                'add_new_item'        => 'Add New Tour',
                'add_new'             => 'Add Tour',
                'edit_item'           => 'Edit Tour',
                'update_item'         => 'Update Tour',
                'search_items'        => 'Search Tours',
                'not_found'           => 'No Tour Found',
                'not_found_in_trash'  => 'No tour found in Trash',
            );

            $rewrite = array(
                'slug'                => 'travel/tours',
                'with_front'          => false,
                'pages'               => true,
                'feeds'               => true,
            );

            $args = array(
                'label'               => 'tours',
                'description'         => 'These posts correspond to individual UW Alumni Tours',
                'labels'              => $labels,
                'supports'            => array( 'title', 'editor', 'thumbnail', 'revisions', 'custom-fields', 'excerpt',  ),
                'taxonomies'          => array( 'destinations'),
                'hierarchical'        => false,
                'public'              => true,
                'show_ui'             => true,
                'show_in_menu'        => true,
                'show_in_nav_menus'   => false,
                'show_in_admin_bar'   => true,
                'menu_position'       => 20,
                'can_export'          => true,
                'menu_icon'           => '',
                'has_archive'         => false,
                'exclude_from_search' => false,
                'publicly_queryable'  => true,
                'query_var'           => 'tours',
                'rewrite'             => $rewrite,
                'capability_type'     => 'post',
            );
            register_post_type( 'tours', $args );
        }


} 