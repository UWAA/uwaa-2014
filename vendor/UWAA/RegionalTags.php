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
            'brazil',
            'chicago',
            'china',
            'dallas-ft-worth',
            'denver',
            'eastern-washington',
            'ft-lauderdale',
            'hong-kong',
            'honolulu',
            'houston',
            'indianapolis',
            'india',
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
            'peru',
            'puget-sound',
            'phoenix',
            'oregon',
            'reno',
            'sacramento',
            'san-antonio-south-texas',
            'san-diego',
            'singapore',
            'south-carolina',
            'spain',
            'spokane',
            'st-louis',
            'sun-valley',
            'taiwan',
            'thailand',
            'tri-cities',
            'tucson',
            'uae',
            'uk',
            'washington',
            'washington-dc',
            'wenatchee'
            );    
    
    }

    public function getRegionalTags() {    
        return $this->regionalTags;
    }
    
}
