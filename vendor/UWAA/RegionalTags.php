<?php namespace UWAA;

/*
*  Sets the master list of regional tags used throughout the theme.
 */

 

class RegionalTags
{

    private $regionalTags;

    public function __construct() {

       $this->regionalTags = array (
            'new-york-city',
            'southern-california',
            'anchorage',
            'albany',            
            'atlanta',
            'austin',
            'northern-california',
            'bellingham',
            'boise',
            'boston',
            'chicago',
            'china',
            'dallas-ft-worth',
            'denver',
            'ft-lauderdale',
            'hong-kong',
            'honolulu',
            'houston',
            'indianapolis',
            'indonesia',
            'japan',
            'kailua-kona',
            'korea',
            'las-vegas',
            'north-carolina',
            'omaha',
            'orange-county',
            'palm-springs',
            'philadelphia',
            'phoenix',
            'oregon',
            'reno',
            'sacramento',
            'san-antonio-south-texas',
            'san-diego',
            'singapore',
            'south-carolina',
            'spokane',
            'st-louis',
            'sun-valley',
            'taiwan',
            'thailand',
            'tri-cities',
            'tucson',
            'washington-dc',
            'wenatchee'
            );    
    
    }

    public function getRegionalTags() {    
        return $this->regionalTags;
    }
    
}
