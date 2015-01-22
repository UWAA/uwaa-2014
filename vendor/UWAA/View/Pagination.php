<?php namespace UWAA\View;

class Pagination {

    private $postType;
    private $arrayOfPosts;
    private $currentID;
    private $previousID;
    private $nextID;
    



     function __construct($postType, $currentID) 
    {
        $this->postType = $postType;
        $this->currentID = $currentID;
        $this->generateArrayOfPosts();
        $this->getNextAndPreviousPostIDs();
        $this->renderPaginationButtons();

    }


    public function renderPaginationButtons()
    {
        if (!empty($this->previousID)){
            echo $this->createButton($this->previousID, 'Previous');
        }
        
        echo $this->createOverviewTemplate;


         if (!empty($this->nextID)){
            echo $this->createButton($this->nextID, 'Next');
        }



    }

    private function createButton($ID, $text = '') {
            
        $title = get_the_title($ID);
        $link = get_permalink($ID);

        $content = '<a href="' . $link .'" title="' . $title . ' ">' . $text . '</a>';


        return $content;
    }

    //TODO
    private function createOverviewTemplate() 
    {
        return '';
    }


    private function generateArrayOfPosts() 
    {
    
        $args = array (
            'post_type' => $this->postType,
            'orderby' => 'meta_value',      
            'order' => 'ASC',
            'meta_key' => 'mb_start_date',
            'meta_query' => array(
                
                'key' => 'mb_start_date',
                'type' => 'DATE',
                'value' => date("Y-m-d"), 
                'compare' => '>=', 
            ),      
            'posts_per_page' => -1,
      );

        $rawPosts = get_posts($args);
        

        $this->arrayOfPosts = array();

        foreach ($rawPosts as $post) {
            $this->arrayOfPosts[] += $post->ID;
        }
      
 
    }

    private function getNextAndPreviousPostIDs() 
    {
        $current = array_search($this->currentID, $this->arrayOfPosts);

        $this->previousID = $this->arrayOfPosts[$current-1];
        $this->nextID = $this->arrayOfPosts[$current+1];
        
    }

    private function determineOverviewButtonDestination()
    {

    }

    






}