<?php namespace UWAA\View;

class UI
{

    //TODO  Make this not horrible.  An actual interface?  
    function __construct() 
    {
        $this->initShortcodes();
        add_action( 'admin_head', array($this, 'addAdminMenuIcons'));
    }

    //TODO abstract this we only sends data for Isotope to chew on and render, as opposed to building HTML here. 

    public function buildSortingToolbar($taxonomyName){
        
        echo '<p><input type="text" id="quicksearch" placeholder="Search Tours" /></p>';

        echo '<div id="filters" class="button-group">';



        //This builds a clear-filters button  (passes a blank filter to Isotope)
        echo '<button class="button btn filter-button" data-filter="">Clear Filters</button>';
        $terms = get_terms("$taxonomyName");
        if ( !empty( $terms ) && !is_wp_error( $terms ) ) :
            foreach ( $terms as $term ) {
                echo sprintf('<button class="button btn filter-button" data-filter=".%s">%s</button>', strtolower($term->slug), $term->name);
        }
        echo '</div>';
        echo '<button class="button btn list-button">List View</button>';
        echo '<button class="button btn tile-button">Tile View</button>';
        
        
        endif;
    }

    private function initShortcodes(){
        new Shortcodes\Button();
    }

    public function getPostFeaturedImageURL($id, $size)
    {
        
        $url = wp_get_attachment_image_src($id, $size);
        echo($url[0]);
    }

      public function returnPostFeaturedImageURL($id, $size)
    {
        
        $url = wp_get_attachment_image_src($id, $size);
        return($url[0]);
    }

    
    //Duplication in the Widget class.  Extract some of this WordPress data-handling stuff elsewhere.
    public function buildPostThumbnailBrowser($args, $numberOfThumbnails, $order)
    {
        $args = $args;

        $query = new \WP_query($args);

        return $query;
        

    }

    private function renderPostThumbnailBrowser($query)
    {
        
    while ( $query->have_posts() ) : $query->the_post();
      if ($this->currentPostID == get_the_ID() ) {
        continue;
      }
        $this->postTitle = strip_tags(get_the_title());
        $this->postURL = get_permalink();
        $this->postCalloutText = strip_tags(get_post_meta(get_the_ID(), 'mb_thumbnail_callout', true));
        $this->postCalloutText = strip_tags(get_post_meta(get_the_ID(), 'mb_cosmetic_date', true));
        $this->postSidebarImage = $this->UI->returnPostFeaturedImageURL(get_post_thumbnail_id(get_the_ID()), 'postExcerptRowOfFive');        
        
    endwhile;

    wp_reset_postdata();



    }


    public function addAdminMenuIcons() 
    {
        ?>
        <style>
        #adminmenu .menu-icon-tours div.wp-menu-image:before {
            content: '\f319';
        }


        #adminmenu .menu-icon-benefits div.wp-menu-image:before {
        content: '\f313';
        }

        #adminmenu .menu-icon-events div.wp-menu-image:before {
            content: "\f508";
        }

         #adminmenu .menu-icon-chapters div.wp-menu-image:before {
            content: "\f231";
        }
        

    <?php
    }


} 