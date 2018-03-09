<?php namespace UWAA\Taxonomies;

class RenameTags
{
    function __construct()
    {
        add_action( 'init', array($this, 'relabel_tags'), 0 );
    }  

        public static function relabel_tags() 
        {  

        global $wp_taxonomies;           
        $wp_taxonomies['post_tag']->labels = (object)array(
            'name'                       => _x( 'UWAA Search Tags' , 'Taxonomy General Name'),
            'singular_name'              => _x( 'UWAA Search Tag' , 'Taxonomy Singular Name'),
            'menu_name'                  => __( 'UWAA Search Tags'),
            'all_items'                  => __( 'All UWAA Search Tags'),
            'new_item_name'              => __( 'New UWAA Search Tag Name'),
            'add_new_item'               => __( 'Add New UWAA Search Tag'),
            'edit_item'                  => __( 'Edit  UWAA Search Tag'),
            'update_item'                => __( 'Update  UWAA Search Tag'),
            'separate_items_with_commas' => __( 'Separate UWAA Search Tags with commas'),
            'search_items'               => __( 'Search UWAA Search Tags'),
            'add_or_remove_items'        => __( 'Add or remove seach tags'),
            'choose_from_most_used'      => __( 'Choose from the most used UWAA Search Tags'),
            'not_found'                  => __( 'UWAA Search Tag not found'),
            'popular_items'              => __('Popular UWAA Search Tags'),
        );     

    
           
            $wp_taxonomies['post_tag']->label = 'UWAA Search Tags';
        }

} 