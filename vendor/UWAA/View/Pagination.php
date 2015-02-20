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
        
        $renderedPaginationControls = '<div class="pagination-wrapper"><div class="pagination-buttons">';

        $renderedPaginationControls .= $this->createTitle();

        if (!empty($this->previousID)){
            $renderedPaginationControls .= $this->createButton($this->previousID, 'Prev');
        }
        
        $renderedPaginationControls .= $this->createOverviewButton();


         if (!empty($this->nextID)){
            $renderedPaginationControls .= $this->createButton($this->nextID, 'Next');
        }

        $renderedPaginationControls .= '</div></div>';

        echo $renderedPaginationControls;


    }

    private function createTitle() {

        $title = esc_html(($this->postType == 'post' ? 'Stories' : $this->postType));

        $content = <<<CONTENT
            <div class="pagination-title">See More<br />$title</div>
CONTENT;

        return $content;

    }


    private function createButton($ID, $text = '') {
            
        $title = get_the_title($ID);
        $link = "" . get_permalink($ID) ."#pagination-top";
        $class = strtolower($text);

        $content = <<<CONTENT
            <div class="button $class-button">
            <a href="$link" title="$title">
                <div class="icon $class"></div>
                <div class="label">$text</div>
            </a></div>
CONTENT;


        return $content;
    }

    private function createOverviewButton()
    {
        $link = $this->getOverviewButtonDestination();

        $content = <<<CONTENT
        <div class="button grid-button">            
            <a href="$link"> 
                <div class="icon grid"></div>
                <div class="label">Overview</div>            
            </a>
        </div>
        
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
                
            default:
                return ''. $homeURL .'stories';
               
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
                        'relation' => 'AND',
                        array(
                            'key' => 'mb_start_date',
                            'type' => 'DATE',
                            'value' => date("Y-m-d"), 
                            'compare' => '>='
                            ),
                        array(
                            'relation' => 'OR',
                            array(
                                'key' => 'mb_isPreliminaryTour',
                                'value' => 'preliminary',
                                'compare' => '!='
                                ),
                            array(
                                'key' => 'mb_isPreliminaryTour',                                
                                'compare' => 'NOT EXISTS'
                                ),
                            
                            ),
                    ),      
                    'posts_per_page' => -1,
                  );
            break;

            // 'preliminary' => get_post_meta($post->ID, 'mb_isPreliminaryTour', true),
            
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
                    'category' => '-187',
                    'posts_per_page' => -1,
                    'orderby' => 'title',      
                    'order' => 'ASC',                    
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