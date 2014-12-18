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

            return get_template_part('assets/regionLogo', $logoFile); 

        }

        echo "<h1>I am placeholder content.  We should have a fallback, generic regional logo</h1>";

    }

    private function getChapterSlugs()
    {
        $this->chapterSlugs = array (
            'new-york-city',
            'los-angeles'
            );
    }



}