<?php namespace UWAA\View;

class ChapterHeaderLogo {

    private $postName;
    private $chapterSlugs;



     function __construct($postName) 
    {
        $this->postName = $postName;
        // var_dump($this->postName);
        $this->getChapterSlugs();
        $this->retriveSVG();
    }


    private function retriveSVG() 
    {
        if (in_array($this->postName, $this->chapterSlugs)) {
            $logoFile = $this->postName . '.svg';

            return get_template_part('logos/regionLogo', $logoFile); 

        }

        echo "<h1>I am placeholder content.  We should have a fallback, generic regional logo</h1>";

    }

    private function getChapterSlugs()
    {
        $this->chapterSlugs = array (
            'new-york-city',
            'los-angeles',
            'anchorage',
            'albany',
            'anchorage',
            'atlanta',
            'austin',
            'bayarea',
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
            'northcarolina',
            'omaha',
            'orange-county',
            'palm-springs',
            'philadelphia',
            'phoenix',
            'portland',
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
            'wenatchee',
            );
    }



}