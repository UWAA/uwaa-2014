<?php namespace UWAA\API;


class RSSFeed
{

    private $eventFields;
    private $benefitFields;
    private $newsFields;


    public function __construct() {

        $this->benefitFields = array(
            'mb_benefit_promotion'
            );

        add_action('rss2_item', array($this, 'addFeedAugmentations'));
    
    }

    public function addFeedAugmentations() {        
        $this->augmentFeed('benefits', $this->benefitFields);
    }

    private function augmentFeed($postType, $metaValues)
    {        
        if ($this->isPostType($postType) == true)
        {            
            $this->addMetaValuesToFeed($metaValues);
        }
        return;
    }

    private function isPostType($postType) {

        

        if (get_post_type() == $postType) {            
            
            return true;
        }

        return false;
    }


    private function addMetaValuesToFeed($metaValues) {
        foreach($metaValues as $field) 
        {
            
            if ($value = get_post_meta(get_the_id() , $field,true))
            {
                
                $element = str_replace('mb_', '', $field);
                echo "<{$element}><![CDATA[{$value}]]></{$element}>\n";
                
            }
        }
    }



}
