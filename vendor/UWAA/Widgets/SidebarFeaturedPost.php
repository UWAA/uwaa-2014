<?php namespace UWAA\Widgets;

/**
 * UWAA Featured Tour Sidebar Widget
 * Currently a placeholder.  This will be updated to pull in featured image and content from 
 * Other sections of the site.  
 */


class SidebarFeaturedPost extends \WP_Widget
{

  const ID    = 'uwaa-sidebar-feature';
  const TITLE = 'UWAA Sidebar Featured Post';
  const DESC  = 'Display featured posts in the the sidebar.';
  private $content;

  //Data from the post object to be used in our promoted post.  
  private $postTitle;
  private $postThumbnailUrl;
  private $postCalloutText;
  private $postURL;
  private $currentPostInfo;
  private $postSidebarImage;
  private $postExcerpt;
  private $contentPromotionDestinations;
  private $UI;
  private $postParent;
  

  function __construct()
  {
      parent::WP_Widget(
      $id      = self::ID,
      $name    = self::TITLE,
      $options = array(
        'description' => self::DESC,
        'classname'   => self::ID
      )
    );
      $this->UI = new \UWAA\View\UI;
      
  }

  
  private function setCurrentPostInformation() 
  {
    //Parse our WordPress template formatting to get another potential match for content.
    
     

    $this->currentPostInfo = array(
      'id' => get_the_ID(),
      'title' => get_the_title(),
      'slug' => basename(get_permalink()),
      'templateType' => ''
      );

    if (is_page_template()) 
    {
    $rawSlug = preg_match('/(?<=\/).*?(?=-)/', get_page_template_slug(), $matchedSlug);
    
    $this->currentPostInfo['templateType'] = $matchedSlug[0];
      
    }  
  
  }

   private function isCustomPostType()
  {
    $postType = get_post_type($this->currentPostInfo['id']);

    switch($postType) {
      
      case 'tours':
        return 'travel';
        break;
      
      case 'benefits':
        return 'membership';
        break;
      
      case 'chapters':
        return 'communities';
        break;

        //return the parent's ID
      default:
        return '';
    }



  }




  private function buildContentPromotionList() {

    $terms = get_terms('uwaa_content_promotion');

    if ( !empty( $terms ) && !is_wp_error( $terms ) ) :
         foreach ( $terms as $term ) {
              $this->siteContentPromotionDestinations[] = strtolower($term->slug);
          }     
    endif; 


  }

  private function getPromotedContent() {    
    
    $postTitle = strtolower($this->currentPostInfo['slug']);
    $this->buildContentPromotionList();
    $thisPostsContentSection = $this->isCustomPostType();    

    //See if the current post is in the list of potential places we are sending content to.    
    
    if (in_array($postTitle, $this->siteContentPromotionDestinations)) {
      echo "Using title match"; //debug
      return $postTitle;
      

    } elseif (in_array(strtolower($thisPostsContentSection), $this->siteContentPromotionDestinations)) {
      echo "Using post-type match";
      return $thisPostsContentSection;
    
    } elseif (in_array(strtolower($this->currentPostInfo['templateType']) , $this->siteContentPromotionDestinations)) {
      echo "Using parent match";  //debug
      return $this->currentPostInfo['templateType'];
    } 

    //If the post is not explicitly targeted, check for content going toward it's section, otherwise find sitewide content.
    return 'sitewide';

  }

  private function getPostsToDisplay() {

    $promotedContentSource = $this->getPromotedContent();
    
    $args = array (
      // 'post_type' => array(
      //   'tours',
      //   'events',
      //   'benefits',
      //   'post'
      //   ),
      'post_type' => 'any',
      'posts_per_page' => 1, 
      'orderby' => 'rand',
      // 'tag' => 'Home'
      
      'tax_query' => array(
        // 'relation' => 'AND',
        // array(
        //   'taxonomy' => 'destinations',
        //   'field'    => 'name',
        //   'terms'    => array( 'asia')
        // ),
        array(
          'taxonomy' => 'uwaa_content_promotion',
          'field'    => 'slug',
          'terms'    => array( $promotedContentSource)

          )
      ) //End tax query    
      );

    $query = new \WP_Query($args);
    if ($query) {
      $this->extractPostInformation($query);
    }

    

  
  }



  private function extractPostInformation($query) 
  {

    while ( $query->have_posts() ) : $query->the_post();
      if ($this->currentPostInfo['id'] == get_the_ID() ) {
        continue;
      }
        $this->postTitle = strip_tags(get_the_title());
        $this->postURL = get_permalink();
        $this->postExcerpt = get_the_excerpt();
        $this->postCalloutText = strip_tags(get_post_meta(get_the_ID(), 'mb_thumbnail_callout', true));
        $this->postSidebarImage = $this->UI->returnPostFeaturedImageURL(get_post_thumbnail_id(get_the_ID()), 'post-thumbnail');
        
    endwhile;

    wp_reset_postdata();    
  }

   private function renderCallout(){
    if ($this->postCalloutText){
      return '<span>'.$this->postCalloutText.'</span>';
    }
    return;
   }

  public function widget( $args, $instance )
  {
     $this->setCurrentPostInformation();
     $this->getPostsToDisplay();
     $callout = $this->renderCallout();

    // extract( $args );
    // extract( $instance );
    // TODO This will be built with a an argument passed from the widget backend perhaps.
   
//Build this out with real data from the tours, and bind templating so that it only pull what is needed.  Consider putting that code elsewhere.
    //DI for the needed variables....
  
   echo'<div class="uwaa-featured-tour widget">';
   
                  
   // $this->content .= get_template_part( 'partials/featured-sidebar-post.php' );
   
   // 
   

echo <<<CONTENT
   <div class="post-thumbnail-slide">
   <a href="$this->postURL">
    <div class="image-frame">   
   <img src="$this->postSidebarImage" />
   $callout
   </div>
   <div class="copy">
   <h4>$this->postTitle<h4>
   <h5>$this->postExcerpt</h5>
   </div>
   </div>

CONTENT;


echo '</div>';
}


 
}


register_widget( 'UWAA\Widgets\SidebarFeaturedPost' );
