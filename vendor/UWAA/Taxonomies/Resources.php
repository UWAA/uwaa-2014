<?php namespace UWAA\Taxonomies;

class Resources
{
    function __construct()
    {
        add_action( 'init', array($this, 'setup_resource_taxonomy'), 0 );
    }  

// Register Custom Taxonomy
function setup_resource_taxonomy() {

	$labels = array(
		'name'                       => _x( 'Resources', 'Taxonomy General Name', 'uwaa_resource_taxonomy' ),
		'singular_name'              => _x( 'Resource', 'Taxonomy Singular Name', 'uwaa_resource_taxonomy' ),
		'menu_name'                  => __( 'Resource Category', 'uwaa_resource_taxonomy' ),
		'all_items'                  => __( 'All Resources', 'uwaa_resource_taxonomy' ),
		'parent_item'                => __( 'Parent Resource', 'uwaa_resource_taxonomy' ),
		'parent_item_colon'          => __( 'Parent Resource:', 'uwaa_resource_taxonomy' ),
		'new_item_name'              => __( 'New Resource', 'uwaa_resource_taxonomy' ),
		'add_new_item'               => __( 'Add Resource', 'uwaa_resource_taxonomy' ),
		'edit_item'                  => __( 'Edit Resource', 'uwaa_resource_taxonomy' ),
		'update_item'                => __( 'Update Resource', 'uwaa_resource_taxonomy' ),
		'view_item'                  => __( 'View Resource', 'uwaa_resource_taxonomy' ),
		'separate_items_with_commas' => __( 'Seperate resources with commas', 'uwaa_resource_taxonomy' ),
		'add_or_remove_items'        => __( 'Add or remove resources', 'uwaa_resource_taxonomy' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'uwaa_resource_taxonomy' ),
		'popular_items'              => __( 'Popular Resource', 'uwaa_resource_taxonomy' ),
		'search_items'               => __( 'Search Resources', 'uwaa_resource_taxonomy' ),
		'not_found'                  => __( 'Not Found', 'uwaa_resource_taxonomy' ),
		'no_terms'                   => __( 'No Resources', 'uwaa_resource_taxonomy' ),
		'items_list'                 => __( 'Resources List', 'uwaa_resource_taxonomy' ),
		'items_list_navigation'      => __( 'Resource list navigation', 'uwaa_resource_taxonomy' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
    register_taxonomy( 'resources', array( 'post', 'events', 'benefits' ), $args );

}

}
