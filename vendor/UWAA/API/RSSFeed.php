<?php namespace UWAA\API;


class RSSFeed
{

    private $eventFields;
    private $benefitFields;
    private $newsFields;
    private $regionalTagList;
    private $UI;


    public function __construct($regionalTags, $UI) {

        $this->regionalTagList = $regionalTags->getRegionalTags();
        $this->UI = $UI;


        $this->benefitFields = array(
            'fields' => array(
                'mb_benefit_promotion'
                ),
            'hasTaxonomy' => true,
            'taxonomyName' => array(
                'benefits'                          
                ),
            'hasGeotag' => true
            );

        $this->eventFields = array(
            'fields' => array(
                'mb_start_date',
                'mb_event_time',
                'mb_event_location'
                ),
            'hasTaxonomy' => false,
            'hasGeotag' => true            
            );

        // add_action('rss2_item', array($this, 'addFeedAugmentations'));
        add_action('rss2_item', array($this, 'addFeaturedPostThumbnailToFeed'));
        add_action('rss2_ns', array($this, 'addUWAANamespaceToFeed'));
    
    }

    public function addFeedAugmentations() {        
        $this->augmentFeed('benefits', $this->benefitFields['fields'], $this->benefitFields['hasTaxonomy'], $this->benefitFields['taxonomyName'], $this->benefitFields['hasGeotag']);
        $this->augmentFeed('events', $this->eventFields['fields'], $this->eventFields['hasTaxonomy'], null , $this->eventFields['hasGeotag'] );
    }

    public function addUWAANamespaceToFeed()
    {
        echo "xmlns:uwaa_app=\"http://depts.washington.edu/alumni/appfeed/namespace/\"\n";        
    }

    private function augmentFeed($postType, $metaValues, $hasTaxonomy = false, $taxonomyName = null, $hasGeotag = false)
    {        

        

        if ($this->isPostType($postType) == true)
        {            
            $this->addMetaValuesToFeed($metaValues);
               
        }

        if ($hasTaxonomy == true) {

            $this->addTaxonomyValuesToFeed($taxonomyName);

            if ($hasGeotag == true) {  //Very, very confused as to why this needs to be nested.

                $terms = get_the_terms(get_the_id(), 'app_geotag');               
            
    
                $this->addGeoTagsToFeed($terms);
                $this->addRegionalLogoToFeed($terms);
            }

        }


        return;
    }

    public function addFeaturedPostThumbnailToFeed()
    {
        $id = get_the_id();                
        if( has_post_thumbnail( $id ) ) {
            $imageID = get_post_thumbnail_id( $id );
            $url = \UWAA\View\UI::returnPostFeaturedImageURL($imageID, 'thumbnail-large' );
            echo "<uwaa_app:itemImage><![CDATA[{$url}]]></uwaa_app:itemImage>\n";

        }
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
                echo "<uwaa_app:{$element}><![CDATA[{$value}]]></uwaa_app:{$element}>\n";
                
            }
        }
    }

    private function addTaxonomyValuesToFeed($taxonomyNames) {
        foreach ($taxonomyNames as $category) {
            $sortingTerms = get_the_terms(get_the_id(), $category);

            if(is_array($sortingTerms)) {
                foreach ($sortingTerms as $term) {
                    echo "<uwaa_app:sorting><![CDATA[{$term->name}]]></uwaa_app:sorting>\n";    
                }
                unset($terms);
            }
        }


    }

    private function addRegionalLogoToFeed($geoTags) {


        if(!in_array($geoTags[0]->slug, $this->regionalTagList)){
            $this->addDefaultRegionalThumbnail();   
        }

        if(is_array($geoTags) && count($geoTags === 1)) {                              
            $imageURL = "http://depts.washington.edu/alumni/appfeed/images/regionallogos/" . $geoTags[0]->slug . "-app-thumbnail.jpg";
            $imageTitle = ucfirst($geoTags[0]->name) . " Huskies Logo";    
                      
            $imageItem = <<<ITEM
               <uwaa_app:geoimage>
               <url>$imageURL</url>
               <title>$imageTitle</title>
                   </uwaa_app:geoimage>
ITEM;
        echo $imageItem;
        return;                    
        }        


    }

    private function addDefaultRegionalThumbnail() {

        $defaultImageURL = "http://depts.washington.edu/alumni/appfeed/images/regionallogos/default-app-thumbnail.jpg";
        $defaultImageTitle = ucfirst($geoTags[0]->name) . " Huskies Logo";    
                               

        $defaultImageItem = <<<ITEM

            <uwaa_app:geoimage>
                <url>$defaultImageURL</url>
                <title>$defaultImageTitle</title>
            </uwaa_app:geoimage>
ITEM;
                    echo $defaultImageItem;

    }


    private function addGeoTagsToFeed($terms) {
            
            
            if(is_array($terms)) {                                
                foreach ($terms as $term) {                    
                    echo "<uwaa_app:geotag><![CDATA[{$term->name}]]></uwaa_app:geotag>\n";    
                }
            }
        
           
    }



}
