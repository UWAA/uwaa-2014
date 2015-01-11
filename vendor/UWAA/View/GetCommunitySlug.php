<?php namespace UWAA\View;


class GetCommunitySlug {

    private $postName;
    private $postID;
    private $chapterSlugs;    



     function __construct($post) 
    {
        $this->postName = $post->post_name;
        $this->postID = $post->ID;
        $this->getChapterSlugs();
        
    }

    
    public function isCommunitiesContent() 
    {
       if (in_array($this->postName, $this->chapterSlugs)) {
            return $this->postName;            
        }
        $contentDestination = wp_get_post_terms($this->postID, 'uwaa_content_promotion', array("fields" => "slugs"));
        
        $targetedChapter = array_intersect($contentDestination, $this->chapterSlugs);  
        
        $chapterSlug = array_pop($targetedChapter);
        return $chapterSlug;
        
    }

    public function getCommunityBrandingImage($slugOfChapter) 
    {

            $UI = new UI;
        

        $chapter = get_page_by_path($slugOfChapter, OBJECT, 'chapters' ); 
        $image = $UI->getPostFeaturedImageURL(get_post_thumbnail_id($chapter->ID), 'original');
        echo $image;
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
            'bay-area',
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