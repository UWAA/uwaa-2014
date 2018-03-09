<?php namespace UWAA\CustomPostTypes;

class TPCMembergrams
{
    function __construct()
    {
        add_action( 'init', array($this, 'setup_tpc_membergram_posts'), 1 );

    }

        public static function setup_tpc_membergram_posts()
        {
            $labels = array(
                'name'                => 'TPC Membergrams',
                'singular_name'       => 'TPC Membergram',
                'menu_name'           => 'TPC Membergrams',
                'parent_item_colon'   => 'Parent Item:',
                'all_items'           => 'All TPC Membergrams',
                'view_item'           => 'View TPC Membergram Details',
                'add_new_item'        => 'Add New TPC Membergram',
                'add_new'             => 'Add TPC Membergram',
                'edit_item'           => 'Edit TPC Membergram',
                'update_item'         => 'Update TPC Membergram',
                'search_items'        => 'Search TPC Membergrams',
                'not_found'           => 'No TPC Membergram Found',
                'not_found_in_trash'  => 'No TPC Membergram found in Trash',
            );


            $args = array(
                'label'               => 'tpcmembergrams',
                'description'         => 'TPC Membergrams are posts that directly fire notifications to authenticated TPC members in the UWAA member app.',
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
                'menu_icon'           => 'dashicons-testimonial',
                'has_archive'         => false,
                'exclude_from_search' => true,
                'publicly_queryable'  => true,
                'query_var'           => 'tpc',
                'capability_type'     => 'post',
            );
            register_post_type( 'tpcmembergrams', $args );
        }


} 