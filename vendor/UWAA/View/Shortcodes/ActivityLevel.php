<?php namespace UWAA\View\Shortcodes;
/*
 *  Button shortcode allows for styled buttons to be added to content
 *  [button color='gold' button-type='type' url='link url' small='true']Button Text[/button]
 *  optional small attribute makes the button small.  Assume large if not present
 */

class ActivityLevel
{

    private static $types = array('activity-level');

    function __construct()
    {
        add_shortcode('activity-level', array($this, 'activity_code_handler'));
    }

    public function activity_code_handler($atts, $content)
    {
        $attributes = (object) $atts;

        $classes = array('activity-level');

        if (property_exists($attributes, 'activity-level'))
		{
            $result = "";

			switch ($attributes.level)
			{
				case "1":
					$result = "activity-level-one";
					break;
				case "2":
					$result = "activity-level-two";
					break;
				case "3":
					$result = "activity-level-three";
					break;
				case "4":
					$result = "activity-level-four";
					break;
				default:
			}
           array_push($classes, $result);
        }


        $class_string = implode($classes, ' ');
        return ('<div class=" ' .$class_string. ' "></div>');
    }
}


