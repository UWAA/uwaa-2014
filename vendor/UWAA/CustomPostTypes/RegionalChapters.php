<?php namespace UWAA\CustomPostTypes;

class RegionalChapters
{
    function __construct()
    {
        add_action( 'init', array($this, 'setup_regiona_chapter_posts'), 1 );
        
    }  

        public static function setup_regiona_chapter_posts() 
        {             
            $labels = array(
                'name'                => 'Regional Chapter',
                'singular_name'       => 'Chapter',
                'menu_name'           => 'Chapters',
                'parent_item_colon'   => 'Parent Chapter:',
                'all_items'           => 'All Chapters',
                'view_item'           => 'View Chapter Details',
                'add_new_item'        => 'Add New Chapter',
                'add_new'             => 'Add Chapter',
                'edit_item'           => 'Edit Chapter',
                'update_item'         => 'Update Chapter',
                'search_items'        => 'Search Chapters',
                'not_found'           => 'No Chapter Found',
                'not_found_in_trash'  => 'No chapter found in Trash',
            );

            $rewrite = array(
                'slug'                => 'communities/chapters',
                'with_front'          => false,
                'pages'               => true,
                'feeds'               => true,
            );

            $args = array(
                'label'               => 'chapters',
                'description'         => 'These posts correspond to UW Regional Advancment Chapters',
                'labels'              => $labels,
                'supports'            => array( 'title', 'editor', 'thumbnail', 'revisions', 'custom-fields', 'excerpt' ),
                'taxonomies'          => array( 'uwaa_content_taxonomy' , 'category' ),
                'hierarchical'        => false,
                'public'              => true,
                'show_ui'             => true,
                'show_in_menu'        => true,
                'show_in_nav_menus'   => true,
                'show_in_admin_bar'   => true,
                'menu_position'       => 20,
                'can_export'          => true,
                'menu_icon'           => '',
                'has_archive'         => false,
                'exclude_from_search' => false,
                'publicly_queryable'  => true,
                'query_var'           => 'chapters',
                'rewrite'             => $rewrite,
                'capability_type'     => 'post',
            );
            register_post_type( 'chapters', $args );
        }


} 