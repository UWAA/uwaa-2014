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
                'name'                => 'TPC Appergrams',
                'singular_name'       => 'TPC Appergram',
                'menu_name'           => 'TPC Appergrams',
                'parent_item_colon'   => 'Parent Item:',
                'all_items'           => 'All TPC Appergrams',
                'view_item'           => 'View TPC Appergram Details',
                'add_new_item'        => 'Add New TPC Appergram',
                'add_new'             => 'Add TPC Appergram',
                'edit_item'           => 'Edit TPC Appergram',
                'update_item'         => 'Update TPC Appergram',
                'search_items'        => 'Search TPC Appergrams',
                'not_found'           => 'No TPC Appergram Found',
                'not_found_in_trash'  => 'No TPC Appergram found in Trash',
            );


            $args = array(
                'label'               => 'tpcmembergrams',
                'description'         => 'TPC Appergrams are posts that directly fire notifications to authenticated TPC members in the UWAA member app.',
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