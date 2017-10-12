<?php namespace UWAA\View\Shortcodes;
/*
 *  Button shortcode allows for styled buttons to be added to content
 *  [button color='gold' button-type='type' url='link url' small='true']Button Text[/button]
 *  optional small attribute makes the button small.  Assume large if not present
 */

class AddMap
{


    function __construct()
    {
        add_shortcode('add-map', array($this, 'addMap'));
    }




    public  function addMap( $atts, $content="" ) {
        $map = '
<h3>Find your Husky community</h3>
<div id="map-container">
    <div id="map">
     <div id="loader">
        <div class="spinner"></div>
    </div>





    </div>
</div>';

        return $map;

    }

}