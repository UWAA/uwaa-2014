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
                      'mb_event_time',
                      'mb_event_location',
                      'mb_80_character_excerpt',
                      'mb_thumbnail_subtitle',
                      ),
                  'hasTaxonomy' => false,
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

              add_action('rss2_item', array($this, 'addFeedAugmentations'));
              add_action('rss2_item', array($this, 'addFeaturedPostThumbnailToFeed'));
              add_action('rss2_item', array($this, 'addPostTypeDeclarationToFeed'));
              add_action('rss2_ns', array($this, 'addUWAANamespaceToFeed'));

          }

          public function addFeedAugmentations() {
              $this->augmentFeed('benefits', $this->benefitFields['fields'], $this->benefitFields['hasTaxonomy'], $this->benefitFields['taxonomyName'], $this->benefitFields['hasGeotag']);
              $this->augmentFeed('events', $this->eventFields['fields'], $this->eventFields['hasTaxonomy'], null , $this->eventFields['hasGeotag'] );
              $this->augmentFeed('post', $this->newsFields['fields']);
              $this->augmentFeed('tours', $this->toursFields['fields'], $this->toursFields['hasTaxonomy'], $this->toursFields['taxonomyName']);
              $this->augmentFeed('membergrams', $this->membergramFields['fields']);
              $this->augmentFeed('tpcmembergrams', $this->tpcMembergramFields['fields']);
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


                      $this->addGeoTagsToFeed($terms);
                      $this->addRegionalLogoToFeed($terms);
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
                  $url = \UWAA\View\UI::returnPostFeaturedImageURL($imageID, 'thumbnail-large' );
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

              foreach($metaValues as $value)
              {

                  if ($content = get_post_meta(get_the_id() , $value, true))
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

                      if ($element == 'membergram_cta_link') {
                          $element = 'membergram_cta_link';
                      }

                      echo "<uwaa_app:{$element}><![CDATA[{$content}]]></uwaa_app:{$element}>\n";

                  }
              }

              if('mb_start_date' != '' and 'mb_end_date' != ''){
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

              if(is_array($geoTags) && count($geoTags == 1)) {
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
