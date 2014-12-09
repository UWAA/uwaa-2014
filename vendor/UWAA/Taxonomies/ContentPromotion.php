<?php namespace UWAA\Taxonomies;

class ContentPromotion
{
    function __construct()
    {
        add_action( 'init', array($this, 'setup_contentPromotion_taxonomy'), 0 );
    }  

        public static function setup_contentPromotion_taxonomy() 
        {             
        $labels = array(
            'name'                       => _x( 'UWAA Content Promotion', 'Taxonomy General Name'),
            'singular_name'              => _x( 'UWAA Content Promotion', 'Taxonomy Singular Name'),
            'menu_name'                  => __( 'UWAA Content Promotion'),
            'all_items'                  => __( 'All Content Promotions'),            
            'new_item_name'              => __( 'New area to promote content'),
            'add_new_item'               => __( 'Add New Content Promotion Areas'),
            'edit_item'                  => __( 'Edit Content Promotion'),
            'update_item'                => __( 'Update Content Promotion'),
            'separate_items_with_commas' => __( 'Separate areas to promote content with commas'),
            'search_items'               => __( 'Search Content Promotion Areas'),
            'add_or_remove_items'        => __( 'Add or remove content promotion areas'),
            'choose_from_most_used'      => __( 'Choose from the most used areas to promote content'),
            'not_found'                  => __( 'Content is not being promoted to that area.'),
        );
               

        $args = array(
            'labels'                     => $labels,
            'hierarchical'               => false,
            'public'                     => true,
            'show_ui'                    => true,
            'show_admin_column'          => true,
            'show_in_nav_menus'          => true,
            'show_tagcloud'              => true,            
        );
           
            register_taxonomy( 'uwaa_content_taxonomy', array( 'posts', 'events', 'benefits', 'tours', 'chapters' ), $args );
        }

} 