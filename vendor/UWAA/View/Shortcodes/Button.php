<?php namespace UWAA\View\Shortcodes;
/*
 *  Button shortcode allows for styled buttons to be added to content
 *  [button color='gold' button-type='type' url='link url' small='true']Button Text[/button]
 *  optional small attribute makes the button small.  Assume large if not present
 */

class Button
{

    private static $types = array('slant-right', 'slant-left');

    function __construct()
    {
        add_shortcode('uwaa-button', array($this, 'button_handler'));        
    }

    public function button_handler($atts, $content)
    {
        $attributes = (object) $atts;

        $classes = array('uwaa-btn');

        $btnColors = shortcode_atts( array(
            'color' => 'none',
        ), $atts );       
 

        $color = 'btn-' . $btnColors['color'];
                   
        if(empty($content)){
            echo 'No text in this button';
            return;
        }      

        if (isset($attributes->type)){
            $type = strtolower($attributes->type);
            if (in_array($type, $this::$types)){
                array_push($classes, 'btn-' . $type);
            }
        }

        $url = '#';
        if (isset($attributes->url)){
            $url = $attributes->url;
        }

        if (property_exists($attributes, 'small')){
            array_push($classes, 'btn-sm');
        }

        $target = '';
        if (property_exists($attributes, 'new')){
            $target = "target=\"_blank\"";
        }

        $class_string = implode($classes, ' ');        
        return sprintf('<div class="uwaa-btn-wrapper"><a class="%s %s" href="%s" %s>%s</a></div>', $class_string, $color, $url, $target, $content);
    }
}


