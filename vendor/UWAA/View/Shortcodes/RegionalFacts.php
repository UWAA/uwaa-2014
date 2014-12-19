<?php namespace UWAA\View\Shortcodes;
/*
 *  Button shortcode allows for styled buttons to be added to content
 *  [button color='gold' button-type='type' url='link url' small='true']Button Text[/button]
 *  optional small attribute makes the button small.  Assume large if not present
 */

class RegionalFacts
{

    private $facts = array();
    private $attributes;
    private $return;
    private $classes;

    function __construct()
    {
        add_shortcode('factboxes', array($this, 'factBoxHandler'));        
    }

    public function factBoxHandler($atts, $content)
    {
        $this->attributes = (object) $atts;

        $this->classes = array('fact-box', 'col-sm-3');        

       
        $this->getFacts($atts);
      

        $class_string = implode($this->classes, ' ');        

        $this->return = '<div class="fact-row">';

        $this->buildFactBoxes($class_string);

        $this->return .="</div>";

        return $this->return;
        
    }

    private function getFacts($atts)
    {
        if (!preg_grep('/^fact[\d]*/', array_keys($atts))){
            return "No Facts Specified";
        }

        $this->facts = array_values(array_flip(preg_grep('/^fact[\d]*/', array_flip($atts))));        
        
        
    }   

    private function buildFactBoxes($class_string)
    {
        foreach ($this->facts as $key => $fact) {
            $template = '<div class="%s"><div class="fact-container"><h2>Fact #%s</h2><p>%s</p></div></div>';
            
            $this->return .= sprintf($template, $class_string, ($key+1), $fact);
        }
    }
}


