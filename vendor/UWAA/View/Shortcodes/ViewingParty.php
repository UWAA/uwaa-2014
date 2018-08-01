<?php namespace UWAA\View\Shortcodes;
/*
 *  Button shortcode allows for styled buttons to be added to content
 *  [button color='gold' button-type='type' url='link url' small='true']Button Text[/button]
 *  optional small attribute makes the button small.  Assume large if not present
 */

class ViewingParty
{


    function __construct()
    {
        add_shortcode('viewing-party-embed', array($this, 'addForm'));
    }




    public  function addForm( $atts, $content="" ) {
        $form = '

        <div class="wufoo-vp-code">
    <!-- This embed code may be restricted to use on a single domain, see documentation at: https://help.surveygizmo.com/help/iframe-embed#limit-permitted-domains-for-embeds -->
<iframe src="https://www.surveygizmo.com/s3/4393280/Viewing-Party-Check-in" frameborder="0" width="auto" height="1500"></iframe>
    </div>
';

        return $form;

    }

}