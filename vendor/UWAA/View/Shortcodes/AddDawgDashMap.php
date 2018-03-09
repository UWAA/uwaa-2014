<?php namespace UWAA\View\Shortcodes;
/*
 *  Button shortcode allows for styled buttons to be added to content
 *  [button color='gold' button-type='type' url='link url' small='true']Button Text[/button]
 *  optional small attribute makes the button small.  Assume large if not present
 */

class AddDawgDashMap
{


    function __construct()
    {
        add_shortcode('add-dawgdash-map', array($this, 'addDawgDashMap'));
    }




    public  function addDawgDashMap( $atts, $content="" ) {
        $map = '
<div id="dawgdash-map">
<a name="coursemap" class="anchor"></a>
<div id="dawgdash-map-container">
<nav id="course-ui" class="menu-ui"></nav>
<div id="dawgdash-map"></div>
</div>
</div>
';

        return $map;

    }

}