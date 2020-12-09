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
            $zoom = '</div>'; //ends 'body-copy 
            $zoom .= '<div class="zoom-slides row">';
     while( have_rows('zoom-slides') ): the_row(); 
         $image = get_sub_field('zoom-background');
            $fullsizeURL = wp_get_attachment_image_url( $image['ID'], 'full' );
            $mediumURL = wp_get_attachment_image( $image['ID'], 'medium' );
            $zoom .= '<div class="col-xs-6 col-sm-4">';
            $zoom .= '<a href="'.$fullsizeURL.'">';
            $zoom .= $mediumURL;
            $zoom .= '</a>';
            $zoom .= do_shortcode( '[uwaa-button url="'.$fullsizeURL.'" color="purple" type="slant-right"]Download[/uwaa-button]');
            $zoom .= '</div>';

            // Download Button
            
    endwhile;

    $zoom .= '</div><div class="uw-body-copy">';
    
    endif;

    return $zoom;

    }

}