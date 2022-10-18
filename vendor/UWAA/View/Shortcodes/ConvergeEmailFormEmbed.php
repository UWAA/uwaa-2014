<?php namespace UWAA\View\Shortcodes;
/*
 *  Button shortcode allows for styled buttons to be added to content
 *  [button color='gold' button-type='type' url='link url' small='true']Button Text[/button]
 *  optional small attribute makes the button small.  Assume large if not present
 */

class ConvergeEmailFormEmbed
{


    function __construct()
    {
        add_shortcode('converge-email-embed', array($this, 'addDawgDashTagboard'));
    }




    public  function addDawgDashTagboard( $atts, $content="" ) {
        $form = '<script src="//explore.uw.edu/js/forms2/js/forms2.min.js"></script> <form id="mktoForm_1096"></form> <script>MktoForms2.loadForm("//explore.uw.edu", "131-AQO-225", 1096);</script>';
        return $form;

    }

}