<?php namespace UWAA\View\Shortcodes;
use \UWAA\View\ThumbnailBrowser\Thumbnail\VirtualWarmupBenefitGrid;
/*
 *  Button shortcode allows for styled buttons to be added to content
 *  [button color='gold' button-type='type' url='link url' small='true']Button Text[/button]
 *  optional small attribute makes the button small.  Assume large if not present
 */

class BenefitGrid
{


    function __construct()
    {
        add_shortcode('benefit-grid', array($this, 'addBenefitGrid'));
        
    }


    


    public  function addBenefitGrid( $atts, $content="" ) {        

        $thumbnailRow = new \UWAA\View\ThumbnailBrowser\ThumbnailBrowser;

        $content = $thumbnailRow->makeThumbnails(new VirtualWarmupBenefitGrid);
        

    return $content;

    }

}