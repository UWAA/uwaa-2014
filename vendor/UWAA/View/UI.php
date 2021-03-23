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
        new Shortcodes\ZoomBackgrounds;
        new Shortcodes\BenefitGrid;
        new Shortcodes\FootballSponsorLockup;
        new Shortcodes\DD2021TagboardEmbed;

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

    public function returnAppImageURL($id)
    {

        $image = wp_get_attachment_metadata($id);

        if ($image) {

            if ($image['height'] == 428 && $image['width'] == 630) {
                $url = wp_get_attachment_image_src( $id, "full");
                return($url[0]);
            }
            
            
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
                return($url[0]);
            }
            else {
                return;
            }            
        }

        
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

    public function makeStarAwardWinnerCards($season) {
        $winners = json_decode(file_get_contents(get_stylesheet_directory() . '/'.$season.'winners.json', true));        

        if (is_array($winners)) {
            shuffle($winners);
            foreach ($winners as $winner) {
                // fix the gd name
                $formattedName = $this->splitNames($winner->nominee);
                ?>
                <a href="#modal-<?php echo strtolower(trim($formattedName['first_name'])) ?>">
                <div class="flip-card winner-flip-card">
            <div class="flip-card-inner">
                <div class="flip-card-front dashicons-before dashicons-star-empty">
                    <h3 class="first"><?php echo ($formattedName['first_name'] == false) ? $winner->nominee : $formattedName['first_name'] ?></h3>
                    <h3 class="last"><?php echo $formattedName['last_name'] ?></h3>
                    <h4 class="unit"><?php echo $winner->unit ?></h4>
                </div>               
            </div>
        </div>
        </a>

        <div class="modal zoom-out" id="modal-<?php echo strtolower(trim($formattedName['first_name'])) ?>">
		    <div class="modal-overlay">
			    <a href="#close"></a>
            </div>
            
		    <div class="modal-container">
    			<div class="modal-container__header">
	    			<div class="modal-container__header-close">
		    			<a href="#close"><span class="icon-close">&times;</span> <span class="hide-text">Close</span></a>
			    	</div>
			    </div>

			    <div class="modal-container__content">
                    <h3 class="modal-container__content-title"><?php echo $formattedName['first_name'] . ' ' . $formattedName['last_name']  ?></h3>                
				    <p><?php echo $winner->quote ?></p>
			    </div>
		    </div>        
        </div>

                <?php
            }
        }
    }
    

    public function makeStarAwardCards($season = 'spring') {
        $awardees = json_decode(file_get_contents(get_stylesheet_directory() . '/'.$season.'awardees.json', true));

        if (is_array($awardees)) {
            shuffle($awardees);
            foreach ($awardees as $awardee) {
                // fix the gd name
                $formattedName = $this->splitNames($awardee->nominee);
                ?>
                <div class="flip-card">
            <div class="flip-card-inner">
                <div class="flip-card-front">
                    <h3 class="first"><?php echo ($formattedName['first_name'] == false) ? $awardee->nominee : $formattedName['first_name'] ?></h3>
                    <h3 class="last"><?php echo $formattedName['last_name'] ?></h3>
                    <h4 class="unit"><?php echo $awardee->unit ?></h4>
                </div>
                <div class="flip-card-back">
                    <p class="reverse-name"><?php echo $formattedName['first_name'] . ' ' . $formattedName['last_name']  ?></p>
                    <p><?php echo $awardee->quote ?></p>
                </div>
            </div>
        </div>

                <?php
            }
        }
    }



} 