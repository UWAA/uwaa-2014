<?php namespace UWAA\View\Shortcodes;

//TODO - Putting a pin in this, probably easier way to do this...
class MembershipOptions
{

    

    function __construct()
    {
       add_shortcode('membership-options', array($this, 'factBoxHandler'));
       add_shortcode('membership-options-wrapper', array($this, 'membershipOptionsWrapperHandler'));
    }    


    public function membershipOptionsWrapperHandler($atts, $content)
    {
        return   '<div class="membership-options-row">'.do_shortcode($content).'</div>';        
    }

    

      public function factBoxHandler($atts, $content)
    {
        $a = shortcode_atts( array(
            'type' => 'Type of Membership',
            'link' => 'Link to Convio Store'
        ), $atts );        

           $content = "<a href=\"{$a['link']}\" title=\"Link to {$a['type']} Order Page\"><div class=\"fact-box col-sm-3\"><div class=\"fact-container\"><h2>{$a['title']}</h2><p>{$a['content']}</p></div></div></a>";

           return $content;
    }


}


