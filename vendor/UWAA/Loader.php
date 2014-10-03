<?php namespace UWAA;

/*
 *  This is the UWAA object that contains all the classes for our added back-end functionality
 *  All classes should be accessible by UWAA::ClassName
 */

class Loader
{

    function __construct()
    {
        $this->initialize();
    }

   

    private function initialize()
    {
            
        //Front-End specific helper functions
        // new \UWAA\View\Isotope;


        //Scripts needed on all pages of the theme

        new \UWAA\Scripts;  //Loads UWAA child-theme specific scripts


        //Custom Post Types
        new \UWAA\CustomPostTypes\Tours; //Holds UWAA Custom Posts Types
        new \UWAA\CustomPostTypes\Benefits; //Holds UWAA Custom Posts Types


         //Custom Taxonomies
        new \UWAA\Taxonomies\Tours; //Holds custom taxonomies

        //API
        new \UWAA\API\API;  //Sets up the UWAA API for specialized feeds

        //Custom Post Metadata
        new \UWAA\CustomPostData\Mapping;
        

        
        
    }
}
