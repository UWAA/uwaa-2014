<?php namespace UWAA\View\Shortcodes;
/*
 *  Button shortcode allows for styled buttons to be added to content
 *  [button color='gold' button-type='type' url='link url' small='true']Button Text[/button]
 *  optional small attribute makes the button small.  Assume large if not present
 */

class SloganSurvey
{


    function __construct()
    {
        add_shortcode('add-poll', array($this, 'addpoll'));
    }




    public  function addpoll( $atts, $content="" ) {
        $poll = '
            <script type="text/javascript">document.write("<scr"+"ipt type=\"text/javascript\" src=\"//www.surveygizmo.com/s3/polljs/5129262-957BEQA1JL3FJEF330BQNOGXI2SC1F?__no_style=true&cookie="+document.cookie.match(/sg-response-5129262/gi)+"\"></scr"+"ipt>");</script>';
        return $poll;

    }

}