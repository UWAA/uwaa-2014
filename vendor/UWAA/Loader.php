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
            
        

        //Scripts needed on all pages of the theme

        new \UWAA\Scripts;  //Loads UWAA child-theme specific scripts


        //Custom Post Types
        new \UWAA\CustomPostTypes\Tours; //Holds UWAA Custom Posts Types
        new \UWAA\CustomPostTypes\Benefits; //Holds UWAA Custom Posts Types


         //Custom Taxonomies
        new \UWAA\Taxonomies\Tours; //Holds custom taxonomies

        //MAYBE Build a real API to get some of the post information...
        // new \UWAA\API\API; 
        

        
        
    }
}
