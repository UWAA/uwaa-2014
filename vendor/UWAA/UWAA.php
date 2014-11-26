<?php namespace UWAA;

/*
 *  This is the UWAA object that contains all the classes for our added back-end functionality
 *  All classes should be accessible by \UWAA\ClassName
 */

class UWAA
{

    protected $wp;
    public $UI;

    function __construct($wp)
    {
        $this->wp = $wp;
        $this->initialize();
        
    }   

    private function initialize()
    {
            
        


        //Scripts needed on all pages of the theme, and registrations for ad-hoc scripts.

        new \UWAA\Scripts;  //Loads UWAA child-theme specific scripts
        new \UWAA\Styles;
        new \UWAA\Sidebars;
        new \UWAA\Images;



        //Custom Post Types
        new \UWAA\CustomPostTypes\Tours; //Holds UWAA Custom Posts Types
        new \UWAA\CustomPostTypes\Benefits; //Holds UWAA Custom Posts Types
        new \UWAA\CustomPostTypes\Events; //Holds UWAA Custom Posts Types


         //Custom Taxonomies
        new \UWAA\Taxonomies\Tours; //Holds custom taxonomy used for sorting tours
        //TODO  Merge taxonomies into their one class.

        //Custom Meta Boxes
        new \UWAA\CustomMetaBoxes\MetaBoxes; //Holds custom taxonomies

        //API
        new \UWAA\API\API($this->wp);  //Sets up the UWAA API for specialized feeds

        //Widgets
        new \UWAA\Widgets\SidebarFeaturedTour();


        //Front-End specific helper functions
        $this->UI = new \UWAA\View\UI;
        

        

        
        
    }
}
