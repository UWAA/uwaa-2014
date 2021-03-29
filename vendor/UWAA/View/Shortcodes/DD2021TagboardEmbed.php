<?php namespace UWAA\View\Shortcodes;
/*
 *  Button shortcode allows for styled buttons to be added to content
 *  [button color='gold' button-type='type' url='link url' small='true']Button Text[/button]
 *  optional small attribute makes the button small.  Assume large if not present
 */

class DD2021TagboardEmbed
{


    function __construct()
    {
        add_shortcode('dawg-dash-tagboard', array($this, 'addDawgDashTagboard'));
    }




    public  function addDawgDashTagboard( $atts, $content="" ) {
        $form = '<div class="tagboard-embed" tgb-embed-id="5211"></div><script src="https://static.tagboard.com/embed/assets/js/embed.js"></script>';
        return $form;

    }

}