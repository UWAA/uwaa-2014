<?php namespace UWAA\CustomPostTypes;

class AppLinks
{
    function __construct()
    {
        add_action( 'init', array($this, 'setup_app_links'), 1 );

    }

        public static function setup_app_links()
        {
            $labels = array(
                'name'                => 'Links',
                'singular_name'       => 'Link',
                'menu_name'           => 'App Links',
                'parent_item_colon'   => 'Parent Item:',
                'all_items'           => 'All Links',
                'view_item'           => 'View Link Details',
                'add_new_item'        => 'Add New Link',
                'add_new'             => 'Add Link',
                'edit_item'           => 'Edit Link',
                'update_item'         => 'Update Link',
                'search_items'        => 'Search Links',
                'not_found'           => 'No Link Found',
                'not_found_in_trash'  => 'No Link found in Trash',
            );


            $args = array(
                'label'               => 'applinks',
                'description'         => 'Links appear in the "Links" area of the UWAA member app',
                'labels'              => $labels,
                'supports'            => array( 'title', 'editor', 'thumbnail', 'revisions', 'excerpt',  ),
                'taxonomies'          => array('post_tag' , 'category'),
                'hierarchical'        => false,
                'public'              => true,
                'show_ui'             => true,
                'show_in_menu'        => true,
                'show_in_nav_menus'   => false,
                'show_in_admin_bar'   => true,
                'menu_position'       => 20,
                'can_export'          => true,
                'menu_icon'           => 'dashicons-admin-links',
                'has_archive'         => false,
                'exclude_from_search' => true,
                'publicly_queryable'  => true,
                'query_var'           => 'applink',
                'capability_type'     => 'post',
            );
            register_post_type( 'applinks', $args );
        }


} 