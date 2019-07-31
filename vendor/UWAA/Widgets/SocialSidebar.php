<?php namespace UWAA\Widgets;

/**
 * UWAA Featured Tour Sidebar Widget
 * Used to pull and display pull quote material in the sidebar for Regional Pages, Tours, Events and Stories.
 */

class SocialSidebar extends \WP_Widget
{
    const ID    = 'uwaa-social-sidebar';
    const TITLE = 'UWAA Share This Page';
    const DESC  = 'Adds a UWAA branded "Share This Page" box to the sidebar.';
    private $sharingLinks = array();
    private $title;

    //Sharing Links
    private $twitter;
    private $facebook;
    private $email;
    private $linkedin;





    function __construct()
    {
      parent::__construct(
          $id      = self::ID,
          $name    = self::TITLE,
          $options = array(
            'description' => self::DESC,
            'classname'   => self::ID
            )
          );

      $this->setSharingLinks();
  }


  private function setSharingLinks()
  {

    $this->title = urlencode(get_the_title());
    $link = urlencode(apply_filters('remove_cms' , get_permalink()));



      $this->linkedin = 'http://www.linkedin.com/shareArticle?url='. $link .'';
      $this->facebook = 'http://www.facebook.com/sharer/sharer.php?u='. $link .'';
      $this->twitter = 'http://twitter.com/share?url='. $link .' &text= '. $link .' ';
      $this->email = 'mailto:?subject='.$this->title.'&body='. $link .' ';

  }




  public function widget($args, $instance)
  {

    $this->setSharingLinks();
    $sharingLinks = $this->sharingLinks;

    $content =<<<CONTENT
<div id="sidebar-share-widget" class="widget uwaa-sidebar-share">
<h2 class="widgettitle">Share this page</h2>
<ul class="uwaa-social">
  <li><a href="$this->email" class="uwaa-share-btn email"></a></li>
  <li><a href="$this->facebook" target="_blank" class="uwaa-share-btn facebook"></a></li>
  <li><a href="$this->linkedin&title=$this->title&summary=$this->title&source=https://uw.edu/alumni" target="_blank" class="uwaa-share-btn linkedin"></a></li>
  <li><a href="$this->twitter&text=$this->title&via=UWAlum" target="_blank" class="uwaa-share-btn twitter"></a></li>
</ul>
</div>

CONTENT;


echo $content;




  }

}

register_widget( 'UWAA\Widgets\SocialSidebar' );