<?php namespace UWAA\View;



class GetCommunitySlug {

    private $postName;
    private $postID;
    private $chapterSlugs;    



     function __construct($post, $regionalTags) 
    {
        $this->postName = $post->post_name;
        $this->postID = $post->ID;
        $this->chapterSlugs = $regionalTags;

        
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


}