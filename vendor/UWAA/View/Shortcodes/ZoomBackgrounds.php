<?php namespace UWAA\View\Shortcodes;
/*
 *  Button shortcode allows for styled buttons to be added to content
 *  [button color='gold' button-type='type' url='link url' small='true']Button Text[/button]
 *  optional small attribute makes the button small.  Assume large if not present
 */

class ZoomBackgrounds
{


    function __construct()
    {
        add_shortcode('zoom-backgrounds', array($this, 'addZoom'));
        
    }


    


    public  function addZoom( $atts, $content="" ) {        

        $id = get_the_ID();

        if( have_rows('zoom-slides', $id) ):
            $zoom = '<div class="zoom-slides">';
     while( have_rows('zoom-slides') ): the_row(); 
         $image = get_sub_field('zoom-background');
            $fullsizeURL = wp_get_attachment_image_url( $image['ID'], 'full' );
            $mediumURL = wp_get_attachment_image( $image['ID'], 'medium' );
            $zoom .= '<a href="'.$fullsizeURL.'">';
            $zoom .= $mediumURL;
            $zoom .= '</a>';
            
    endwhile;

    $zoom .= '</div>';
    
    endif;

    return $zoom;

    }

}