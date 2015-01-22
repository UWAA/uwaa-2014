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
        $this->renderPaginationControls();

    }


    public function renderPaginationControls()
    {
        
        $renderedPaginationControls = '<div class="pagination-buttons">';




        if (!empty($this->previousID)){
            $renderedPaginationControls .= $this->createButton($this->previousID, 'Prev');
        }
        
        $renderedPaginationControls .= $this->createOverviewButton();


         if (!empty($this->nextID)){
            $renderedPaginationControls .= $this->createButton($this->nextID, 'Next');
        }

        $renderedPaginationControls .= '</div>';

        echo $renderedPaginationControls;


    }

    private function createTitle() {

        $title = ($this->postType == 'post' ? 'Stories' : $this->postType);

        $content = <<<CONTENT
            <div class="pagination-title">See More $title</div>
CONTENT;

        return $content;

    }


    private function createButton($ID, $text = '') {
            
        $title = get_the_title($ID);
        $link = get_permalink($ID);

        $content = <<<CONTENT
        <a href="$link" title="$title">
            <div class="button $text-button">
                <div class="icon $text"></div>
                <div class="label">$text</div>
            </div></a>
CONTENT;


        return $content;
    }

    private function createOverviewButton()
    {
        $link = $this->getOverviewButtonDestination();

        $content = <<<CONTENT
        <a href="$link">        
            <div class="button grid-button">            
                <div class="icon grid"></div>
                <div class="label">Overview</div>            
            </div>
        </a>
CONTENT;

    return $content;

    }   

     private function getOverviewButtonDestination()
    {
       $homeURL = home_url('/');
        switch ($this->postType) {
            case 'events':
               return ''. $homeURL .'events';
            break;
            
            case 'tours':               
               return ''. $homeURL .'travel/upcoming-tours';
            break;
            
            case 'benefits':              
                return ''. $homeURL .'membership/benefits';
            break;
                return ''. $homeURL .'stories';
            default:
                
               
            break;
        }       

    }

    private function generateArrayOfPosts() 
    {
    
        switch ($this->postType) {
            case 'events':
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
            break;
            
            case 'tours':
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
            break;
            
            case 'benefits':
                $args = array (
                    'post_type' => $this->postType,
                    'orderby' => 'title',      
                    'order' => 'ASC',                    
                    'posts_per_page' => -1,
                );
            break;
            
            default:
                $args = array (
                    'post_type' => $this->postType,                  
                    'posts_per_page' => -1,
                );
                break;
        }       

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

   

    






}