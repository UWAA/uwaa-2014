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
        add_shortcode('factboxes_old', array($this, 'factBoxHandler_old'));        
        add_shortcode('factboxes-wrapper', array($this, 'factBoxWrapperHandler'));
        add_shortcode('factbox', array($this, 'factBoxHandler'));        
    }

    public function factBoxHandler_old($atts, $content)
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


     public function factBoxWrapperHandler($atts, $content)
    {
        return   '<div class="fact-row">'.do_shortcode($content).'</div>';        
    }

      public function factBoxHandler($atts, $content)
    {
        $a = shortcode_atts( array(
            'title' => 'Title for the factbox',
            'content' => 'Fact content'
        ), $atts );        

           $content = "<div class=\"fact-box col-sm-3\"><div class=\"fact-container\"><h2>{$a['title']}</h2><p>{$a['content']}</p></div></div>";

           return $content;
    }


}


