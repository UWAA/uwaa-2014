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
        $form = '
        <div class="embed-header" style="padding: 30px; padding-bottom: 130px; background: #2E2253; clip-path: polygon(0 0, 100% 0, 100% 100%, 0 calc(100% - 100px));">
  <h1 style="font-family: \'Lucida Grande\', sans-serif; font-size: 30px; font-weight: 500; line-height: 1.2; margin: 0; margin-bottom: 15px; color: #AE9E74;">SNAP A PIC, SUPPORT A STUDENT</h1>
  <p style="font-family: \'Open Sans\', sans-serif; font-size: 14px; font-weight: 500; line-height: 1.5; margin: 0; color: #FFFFFE;">UWAA is joining with AT&T to assist students in need. Now through April 18, share a Dawg Dash photo on Facebook, Instagram or Twitter with <strong>#DawgDashCares</strong> and AT&T will donate $100 to the UW Food Pantry. Tag AT&T in your photo and the donation doubles.</p>
</div><div class="tagboard-embed" tgb-embed-id="5211"></div><script src="https://static.tagboard.com/embed/assets/js/embed.js"></script>';

        return $form;

    }

}