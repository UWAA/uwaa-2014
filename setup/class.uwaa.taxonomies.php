<?php

/*
 *  This object creates all of the custom post types for our child theme.
  */


class UWAA_CustomTaxonomies
{


    function __construct()
    {
        $this->includes();
        $this->initialize();
    }

    private function includes()
    {
        require_once('class.uwaa.taxonomy.tours.php');
    }

    private function initialize()
    {
        $this->tours_posts = new UWAA_Tours_Taxonomy();
        
    }
}





/**
* 
*/

