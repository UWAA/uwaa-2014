<?php

/*
 *  This is the UWAA object that contains all the classes for our added back-end functionality
 *  All classes should be accessible by UWAA::ClassName
 */

class UWAA
{

    function __construct()
    {
        $this->includes();
        $this->initialize();
    }

    private function includes()
    {
        require_once('class.uwaa.cpt.php');
        require_once('class.uwaa.scripts.php');
      
    }

    private function initialize()
    {
        $this->CPT = new UWAA_CustomPostTypes; //Holds UWAA Custom Posts Types
        $this->Scripts = new UWAA_Scripts;  //Loads UWAA child-theme specific scripts
    }
}
