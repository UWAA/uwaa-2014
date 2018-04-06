<?php namespace UWAA\CustomPostTypes;
//Note that the post was set up as "membergrams," but the label is "appergrams" for human users.

class Membergrams
{
    function __construct()
    {
        add_action( 'init', array($this, 'setup_membergrams_posts'), 1 );

    }

        public static function setup_membergrams_posts()
        {
            $labels = array(
                'name'                => 'Appergrams',
                'singular_name'       => 'Appergram',
                'menu_name'           => 'Appergrams',
                'parent_item_colon'   => 'Parent Item:',
                'all_items'           => 'All Appergrams',
                'view_item'           => 'View Appergram Details',
                'add_new_item'        => 'Add New Appergram',
                'add_new'             => 'Add Appergram',
                'edit_item'           => 'Edit Appergram',
                'update_item'         => 'Update Appergram',
                'search_items'        => 'Search Appergrams',
                'not_found'           => 'No Appergram Found',
                'not_found_in_trash'  => 'No Appergram found in Trash',
            );

            $args = array(
                'label'               => 'membergrams',
                'description'         => 'Appergrams are posts that directly fire notifications in the UWAA member app.',
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