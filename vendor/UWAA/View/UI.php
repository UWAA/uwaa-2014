<?php namespace UWAA\View;

class UI
{

    public $breadcrumbs;

    function __construct()
    {
        $this->initShortcodes();
        add_action( 'admin_head', array($this, 'addAdminMenuIcons'));
        $this->Breadcrumbs = new Breadcrumbs();
        add_filter('excerpt_length', array($this, 'setExcerptLength'), 999);

    }

    public function setExcerptLength($length)
    {
        return 40;
    }



    private function initShortcodes(){
        new Shortcodes\Button;
        new Shortcodes\FevoButton;
        new Shortcodes\RegionalFacts;
        new Shortcodes\Accordions;
        new Shortcodes\OdysseySignupButton;
        new Shortcodes\AddMap;
        new Shortcodes\AddDawgDashMap;
        new Shortcodes\ActivityLevel;
        new Shortcodes\ViewingParty;
        new Shortcodes\SloganSurvey;

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

    public function returnAppImageURL($id, $size)
    {

        $image = wp_get_attachment_metadata( $id);

        if (array_key_exists('app-event-feed-image', $image['sizes'])) {
            $url = wp_get_attachment_image_src( $id, "app-event-feed-image");
            return($url[0]);
        }

        if (array_key_exists('app-feed-image', $image['sizes'])) {
            $url = wp_get_attachment_image_src( $id, "app-feed-image");
            return($url[0]);
        }

        if (!array_key_exists('app-feed-image', $image['sizes'])) {
            $url = wp_get_attachment_image_src( $id, "thumbnail-large");
        }
        else {
            $url = wp_get_attachment_image_src($id, $size);
        }
        
        return($url[0]);
    }

    public function returnImageAltTag($id) {
        $attachmentID = get_post_thumbnail_id($id);
        $altText = get_post_meta($attachmentID, '_wp_attachment_image_alt', true);
        if (!$altText) {
                    return "Alt Text Missing";
                }
        return $altText;
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
        </style>

        <?php      

    
    }

    public function buildCommunitySidebar() {
        return new ChapterSidebarContent;
    }

    private function splitNames($name){
 
        $arr = explode(',', $name);
        $num = count($arr);
        $first_name = $middle_name = $last_name = null;

        if ($num == 2) {
            list($last_name, $first_name) = $arr;
        } else {
            list($last_name, $first_name, $middle_name) = $arr;
        }

        return (empty($first_name) || $num > 3) ? false : compact(
            'first_name', 'middle_name', 'last_name'
        );

    }

    public function makeStarAwardCards() {
        $awardees = json_decode(file_get_contents(get_stylesheet_directory() . '/awardees.json', true));

        if (is_array($awardees)) {
            shuffle($awardees);
            foreach ($awardees as $awardee) {
                // fix the gd name
                $formattedName = $this->splitNames($awardee->nominee);
                ?>
                <div class="flip-card">
            <div class="flip-card-inner">
                <div class="flip-card-front">
                    <h3 class="first"><?php echo $formattedName['first_name'] ?></h3>
                    <h3 class="last"><?php echo $formattedName['last_name'] ?></h3>
                    <h4 class="unit"><?php echo $awardee->unit ?></h4>
                </div>
                <div class="flip-card-back">
                    <p><?php echo $awardee->quote ?></p>
                </div>
            </div>
        </div>

                <?php
            }
        }
    }



} 