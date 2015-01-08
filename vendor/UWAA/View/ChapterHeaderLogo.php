<?php namespace UWAA\View;

class ChapterHeaderLogo {

    private $postName;
    



     function __construct($postName) 
    {
        $this->postName = $postName;
    
       
        
    }

    //
    public function isCommunitiesContent($slug) 
    {
       if (in_array($slug, $this->chapterSlugs)) {
       
       } 
    }


    public function retriveSVG() 
    {
      
            $logoFile = $this->postName . '.svg';

            return get_template_part('logos/regionLogo', $logoFile);      

        

    }




}