<?php namespace UWAA\View;

class UI
{

    //TODO  Make this not horrible.  An actual interface?  
    function __construct() 
    {
        $this->initShortcodes();
        add_action( 'admin_head', array($this, 'addAdminMenuIcons'));
    }

        

    private function initShortcodes(){
        new Shortcodes\Button();
    }

    public static function getPostFeaturedImageURL($id, $size)
    {
        
        $url = wp_get_attachment_image_src($id, $size);
        echo($url[0]);
    }

      public function returnPostFeaturedImageURL($id, $size)
    {
        
        $url = wp_get_attachment_image_src($id, $size);
        return($url[0]);
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