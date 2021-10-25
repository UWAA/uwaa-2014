<?php namespace UWAA\View\Shortcodes;
/*
 *  Button shortcode allows for styled buttons to be added to content
 *  [button color='gold' button-type='type' url='link url' small='true']Button Text[/button]
 *  optional small attribute makes the button small.  Assume large if not present
 */

class ReadMore
{

    const PRIORITY = 12;

    function __construct()
    {
        remove_filter( 'the_content', 'wpautop' );
        add_filter( 'the_content', 'wpautop' , self::PRIORITY );

        remove_filter( 'the_excerpt', 'wpautop' );
        add_filter( 'the_excerpt', 'wpautop' , self::PRIORITY );
        
        add_shortcode('uwaa-readmore', array($this, 'uwaaReadMoreHandler'));        
    }




    public function uwaaReadMoreHandler( $atts, $content="" ) {        

        $accordion_atts = shortcode_atts( array(
          'name' => '',
        ), $atts);

        if ( empty( $content ) )
            return 'No content inside the accordion element. Make sure your close your accordion element. Required stucture: [accordion][section]content[/section][/accordion]';

        $output = do_shortcode( $content );
        return sprintf( '<script src="' . get_stylesheet_directory_uri() . '/js/support/readMoreAccordion.js" type="text/javascript"></script><div id="uw-accordion-shortcode" class="uwaa-readmore-accordion"><div class="js-accordion" data-accordion-prefix-classes="uw-accordion-shortcode"><div class="js-accordion__header"></div><div class="js-accordion__panel">%s</div></div></div>',  $output );

    }
    

}