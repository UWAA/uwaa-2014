<?php namespace UWAA\API;
      class DateTime {}

      class RSSFeed
      {

          private $eventFields;
          private $benefitFields;
          private $newsFields;
          private $toursFields;
          private $regionalTagList;
          private $tpcMembergramFields;        



          public function __construct($regionalTags) {

              $this->regionalTagList = $regionalTags->getRegionalTags();



              $this->benefitFields = array(
                  'fields' => array(
                      'mb_benefit_promotion',
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
                      'mb_end_date',
                      'mb_event_time',
                      'mb_event_location',
                      'mb_80_character_excerpt',
                      'mb_thumbnail_subtitle',
                      'mb_cvent_event_id'
                      ),
                  'hasTaxonomy' => true,
                  'taxonomyName' => array(
                      'events'
                  ),
                  'hasGeotag' => true
              );

              $this->newsFields = array(
                  'fields' => array(
                      'mb_thumbnail_subtitle',  //Known as a content head.
                      'mb_80_character_excerpt'
                      ),
                  'hasTaxonomy' => false,
                  'hasGeotag' => false
              );


              $this->toursFields = array(
                 'fields' => array(
                     'mb_80_character_excerpt',
                     'mb_start_date',
                     'mb_end_date',
                     'mb_cosmetic_date'
                     ),
                 'hasTaxonomy' => true,
                 'taxonomyName' => array(
                      'destinations'
                  ),
                 'hasGeotag' => false
             );


               $this->tpcMembergramFields = array(
                'fields' => array(
                  'mb_membergram_cta_link'
                ),
                 'hasTaxonomy' => false,
                 'taxonomyName' => false,                  
                 'hasGeotag' => false,
                 'declarePostType' => true
             );

              $this->membergramFields = array(
                'fields' => array(
                  'mb_membergram_cta_link'
                ),
                 'hasTaxonomy' => false,
                 'taxonomyName' => false,                  
                 'hasGeotag' => false,                 
             );

             $this->appLinksFields = array(
                  'fields' => array(
                      'mb_thumbnail_subtitle',  //Known as a content head.
                      'mb_80_character_excerpt'
                      ),
                  'hasTaxonomy' => false,
                  'hasGeotag' => false
              );

              add_action('request', array($this, 'removePrivateItemsFromFeed'));
              add_action('pre_get_posts', array($this, 'removeEventsWithNoDateFromFeed'));
              add_action('rss2_item', array($this, 'addFeedAugmentations'));
              add_action('rss2_item', array($this, 'addFeaturedPostThumbnailToFeed'));
              add_action('rss2_item', array($this, 'addPostTypeDeclarationToFeed'));
              add_action('rss2_ns', array($this, 'addUWAANamespaceToFeed'));

          }

          public function removeEventsWithNoDateFromFeed($query) {
            
           
            
            if (!is_admin() && $query->is_feed() && $query->query['post_type'] == 'events' ) {
                
                 $appendedMeta = array(
                        'key'     => 'mb_start_date',
                        'value'   => '',
                        'compare' => '!='
                );
            
                
                $query->set('meta_key', 'mb_start_date');
                $query->set('orderby', 'ASC');
                $query->set('meta_query', array($appendedMeta));                
                return $query;
            }
            
            return $query;
          }

          public function removePrivateItemsFromFeed($request){

            $categories = get_categories();
            $exclusionID = array();

            foreach ($categories as $category => $term) {
                if($term->slug == 'exclude-from-search') {
                    $exclusionID[]= $term->term_id;
                }
            }

            if (isset($request["feed"])) {
                $request['category__not_in'] = $exclusionID;
                return $request;
           }


            
            return $request;
          }

          public function addFeedAugmentations() {

        if(isset($_REQUEST['post_type'])){
            switch ($_REQUEST['post_type']) {
                case 'events':
                    $this->augmentFeed('events', $this->eventFields['fields'], $this->eventFields['hasTaxonomy'], $this->eventFields['taxonomyName'] , $this->eventFields['hasGeotag'] );
                    break;
                case 'benefits':
                    $this->augmentFeed('benefits', $this->benefitFields['fields'], $this->benefitFields['hasTaxonomy'], $this->benefitFields['taxonomyName'], $this->benefitFields['hasGeotag']);
                break;

                case 'post':
                    $this->augmentFeed('post', $this->newsFields['fields']);
                break;

                case 'tours':
                    $this->augmentFeed('tours', $this->toursFields['fields'], $this->toursFields['hasTaxonomy'], $this->toursFields['taxonomyName']);                
                break;

                case 'membergrams':
                    $this->augmentFeed('membergrams', $this->membergramFields['fields']);
                break;

                case 'tpcmembergrams':
                    $this->augmentFeed('tpcmembergrams', $this->tpcMembergramFields['fields']);
                case 'tpcmembergrams':
                    $this->augmentFeed('applinks', $this->appLinksFields['fields']);
                break;
                

                default:
                    return;
                    break;
            }
        }
              
              
              
              
              
          }

          public function addUWAANamespaceToFeed()
          {
              echo "xmlns:uwaa_app=\"http://depts.washington.edu/alumni/appfeed/namespace/\"\n";
          }

          private function augmentFeed($postType, $metaValues, $hasTaxonomy = false, $taxonomyName = null, $hasGeotag = false )
          {

              $postType = $this->isPostType($postType);
              if ($postType == true)
              {
                  $this->addMetaValuesToFeed($metaValues);

              }

              if ($hasTaxonomy == true) {

                  $this->addTaxonomyValuesToFeed($taxonomyName);

                  if ($hasGeotag == true) {  //Very, very confused as to why this needs to be nested.

                      $terms = get_the_terms(get_the_id(), 'app_geotag');
                        
                        if ($terms) {  //Needed if the editor forgets to add Geotags. Supresses errors.
                            $this->addGeoTagsToFeed($terms);
                            $this->addRegionalLogoToFeed($terms);
                        }


                      
                  }

              }              


              return;
          }

          public function addPostTypeDeclarationToFeed()
          {
              $id = get_the_id();
              $posttype = get_post_type($id);
              if( $posttype == 'tpcmembergrams' ) {
                  echo "<uwaa_app:declarePostType><![CDATA[{$posttype}]]></uwaa_app:declarePostType>\n";

              }
          }



          public function addFeaturedPostThumbnailToFeed()
          {
              $id = get_the_id();
              if( has_post_thumbnail( $id ) ) {
                  $imageID = get_post_thumbnail_id( $id );
                  $uiclass = new \UWAA\View\UI;
                  //$url = \UWAA\View\UI::returnAppImageURL($imageID);  
                  $url = $uiclass->returnAppImageURL($imageID);                
                  echo "<uwaa_app:itemImage><![CDATA[{$url}]]></uwaa_app:itemImage>\n";

              }
          }

          private function isPostType($postType) {

              if (get_post_type(get_the_id()) == $postType) {

                  return TRUE;
              }

              return false;
          }


          private function addMetaValuesToFeed($metaValues) {

            if (in_array('mb_benefit_promotion', $metaValues)) {
                   
                      $link = get_permalink( get_the_id());
                      $printedLink = '[uwaa-button url="' . $link . '" color="purple" type="slant-right" new="true"]Learn More[/uwaa-button]';
                      echo "<uwaa_app:benefit_promotion><![CDATA[{$printedLink}]]></uwaa_app:benefit_promotion>\n";

                } else {

                    foreach($metaValues as $value)
                    
                    {
                

                        if ($content = get_post_meta(get_the_id() , $value, true) )
                        
                        {

                            $element = htmlspecialchars(trim(str_replace('mb_', ' ', $value)));

                            if ($element == '80_character_excerpt') {
                                $element = 'excerpt';
                            }

                            if ($element == 'thumbnail_subtitle') {
                                $element = 'content_head';
                            }

                            if ($element == 'start_date') {
                                $element = 'start_date';
                            }

                            if ($element == 'end_date') {
                                $element = 'end_date';
                            }

                            if ($element == 'cosmetic_date') {
                                $element = 'cosmetic_date';
                            }

                            if ($element == 'membergram_cta_link') {
                                $element = 'membergram_cta_link';
                            }

                            echo "<uwaa_app:{$element}><![CDATA[{$content}]]></uwaa_app:{$element}>\n";

                        }
                        
                    }

                }
            

              if(in_array('mb_start_date', $metaValues) && in_array('mb_end_date', $metaValues) ){
                  $metaStart = get_post_meta(get_the_id() , 'mb_start_date', true);
                  $metaEnd = get_post_meta(get_the_id() , 'mb_end_date', true);
                  $start = new \DateTime($metaStart);
                  $end = new \DateTime($metaEnd);
                  $interval = $start->diff($end);

                  echo "<uwaa_app:tour_duration><![CDATA[{$interval->d}]]></uwaa_app:tour_duration>\n";
              }
          }

          private function addTaxonomyValuesToFeed($taxonomyNames) {
              foreach ($taxonomyNames as $category) {
                  $sortingTerms = get_the_terms(get_the_id(), $category);

                  if(is_array($sortingTerms)) {
                      foreach ($sortingTerms as $term) {
                          echo "<uwaa_app:sorting><![CDATA[". ucwords($term->name) . "]]></uwaa_app:sorting>\n";
                      }
                      unset($terms);
                  }
              }


          }

          private function addRegionalLogoToFeed($geoTags) {


              if(!in_array($geoTags[0]->slug, $this->regionalTagList) && is_array($geoTags)){
                  $this->addFeaturedPostThumbnailToFeed();
                  return;
              }

              if(is_array($geoTags) && (count($geoTags) == 1)) {
                  $imageURL = "http://depts.washington.edu/alumni/appfeed/images/regionallogos/" . $geoTags[0]->slug . "-app-thumbnail.png";
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

              $defaultImageURL = "http://depts.washington.edu/alumni/appfeed/images/regionallogos/default-app-thumbnail.png";
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
                      echo "<uwaa_app:geotag><![CDATA[{$term->slug}]]></uwaa_app:geotag>\n";
                  }
              }
              return;

          }



      }
