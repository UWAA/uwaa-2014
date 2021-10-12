<?php namespace UWAA\View\Shortcodes;
/*
 *  Button shortcode allows for styled buttons to be added to content
 *  [button color='gold' button-type='type' videoID='link url' small='true']Button Text[/button]
 *  optional small attribute makes the button small.  Assume large if not present
 */

class WistiaEmbed
{

    

    function __construct()
    {
        add_shortcode('uwaa-wistia-embed', array($this, 'embed_handler'));        
    }

    public function embed_handler($atts, $content)
    {
        $attributes = (object) $atts;

        $classes = array('uwaa-wistia-embed');
                    
    
        $css = '';
        if (isset($attributes->css)){
            $css = $attributes->css;
        }

        
        if (isset($attributes->classes)){
            array_push($classes, $attributes->classes);
        }

        $videoID = '#';
        if (isset($attributes->videoid)){
            $videoID = $attributes->videoid;
        }


        $class_string = implode($classes, ' ');  

        $returnValue = '<div class="'.$class_string.'" style="'.$css.'"><script src="https://fast.wistia.com/embed/medias/'.$videoID.'.jsonp" async></script><script src="https://fast.wistia.com/assets/external/E-v1.js" async></script><div class="wistia_responsive_padding" style="padding:56.25% 0 0 0;position:relative;"><div class="wistia_responsive_wrapper" style="height:100%;left:0;position:absolute;top:0;width:100%;"><span class="wistia_embed wistia_async_'.$videoID.' popover=true popoverAnimateThumbnail=true videoFoam=true" style="display:inline-block;height:100%;position:relative;width:100%">&nbsp;</span></div></div></div>';

        
        return $returnValue;
    }
}


