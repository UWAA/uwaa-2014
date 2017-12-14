<?php namespace UWAA\CustomPostTypes;

class Membergrams
{
    function __construct()
    {
        add_action( 'init', array($this, 'setup_membergrams_posts'), 1 );

    }

        public static function setup_membergrams_posts()
        {
            $labels = array(
                'name'                => 'Membergrams',
                'singular_name'       => 'Membergram',
                'menu_name'           => 'Membergrams',
                'parent_item_colon'   => 'Parent Item:',
                'all_items'           => 'All Membergrams',
                'view_item'           => 'View Membergram Details',
                'add_new_item'        => 'Add New Membergram',
                'add_new'             => 'Add Membergram',
                'edit_item'           => 'Edit Membergram',
                'update_item'         => 'Update Membergram',
                'search_items'        => 'Search Membergrams',
                'not_found'           => 'No Membergram Found',
                'not_found_in_trash'  => 'No Membergram found in Trash',
            );

            $args = array(
                'label'               => 'membergrams',
                'description'         => 'Membergrams are posts that directly fire notifications in the UWAA member app.',
                'labels'              => $labels,
                'supports'            => array( 'title', 'editor', 'thumbnail', 'revisions', 'excerpt',  ),
                'taxonomies'          => array( 'post_tag' , 'category'),
                'hierarchical'        => false,
                'public'              => true,
                'show_ui'             => true,
                'show_in_menu'        => true,
                'show_in_nav_menus'   => false,
                'show_in_admin_bar'   => true,
                'menu_position'       => 20,
                'can_export'          => true,
                'menu_icon'           => 'dashicons-testimonial',
                'has_archive'         => false,
                'exclude_from_search' => true,
                'publicly_queryable'  => TRUE,
                'query_var'           => 'membergram',
                'rewrite'             => false,
                'capability_type'     => 'post',
            );
            register_post_type( 'membergrams', $args );
        }


} 