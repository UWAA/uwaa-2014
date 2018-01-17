<?php namespace UWAA\View\Shortcodes;
/*
 *  Button shortcode allows for styled buttons to be added to content
 *  [button color='gold' button-type='type' url='link url' small='true']Button Text[/button]
 *  optional small attribute makes the button small.  Assume large if not present
 */

class ActivityLevel
{

    

    function __construct()
    {
        add_shortcode('activity-level', array($this, 'activity_code_handler'));
    }

    public function activity_code_handler($atts, $content)
    {
        $attributes = (object) $atts;

        $classes = array('activity-level');

        if (property_exists($attributes, 'level'))
		{
            $result = "";


			switch ($attributes->level)
			{
				case "1":
                    $result = "Easy";
					break;
				case "2":
                    $result = "Moderate";
					break;
				case "3":
                    $result = "Active";
					break;
				case "4":
                    $result = "Highly Active";
					break;
				default:
                    $result = "No Level Specified";
			}
            
        }

        $activityLevelInt = $attributes->level;
        $themeDirectory = get_stylesheet_directory_uri();
      	$activityIcon = "<img src='".$themeDirectory."/assets/Tours_ActivityLevel_Icon.svg'>";
          $activityLabel = $result;




        return ('<div class="activity-level" data-toggle="modal" data-target="#activity-modal">'.str_repeat($activityIcon, $activityLevelInt).'<br />Activity Level: ' .$activityLabel. '</div>');

    }
}


