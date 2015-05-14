<?php namespace UWAA\View\Shortcodes;
/*
 *  Shortcode for adding a customized button to send pre-populated fields to Odyssey Tours sign-up pages.
 *  [button color='gold' button-type='type' url='link url' small='true']Button Text[/button]
 *  optional small attribute makes the button small.  Assume large if not present
 */

class OdysseySignupButton
{

    private static $types = array('slant-right', 'slant-left');

    function __construct()
    {
        add_shortcode('uwaa-odyssey-button', array($this, 'button_handler'));        
    }

    public function button_handler($atts, $content)
    {
        $attributes = (object) $atts;

        $classes = array('uwaa-btn');

        $btnColors = shortcode_atts( array(
            'color' => 'none',
        ), $atts );       
 

        $color = 'btn-' . $btnColors['color'];
                   
            

        if (isset($attributes->type)){
            $type = strtolower($attributes->type);
            if (in_array($type, $this::$types)){
                array_push($classes, 'btn-' . $type);
            }
        }

        $url = get_bloginfo('url') . '/travel/odysseys-signup?tourName=' . get_the_title() . '&tourURL=' . get_permalink() . '&tourDepartureDate=' . get_post_meta(get_the_id(), 'mb_start_date', true); ;

        if (property_exists($attributes, 'small')){
            array_push($classes, 'btn-sm');
        }

        $target = '';
        if (property_exists($attributes, 'new')){
            $target = "target=\"_blank\"";
        }

        $class_string = implode($classes, ' ');        

         if(empty($content)){
            return sprintf('<div class="uwaa-btn-wrapper"><a class="%s %s" href="%s" %s>book trip</a></div>', $class_string, $color, $url, $target);            
            return;
        } 
        return sprintf('<div class="uwaa-btn-wrapper"><a class="%s %s" href="%s" %s>%s</a></div>', $class_string, $color, $url, $target, $content);
    }
}


