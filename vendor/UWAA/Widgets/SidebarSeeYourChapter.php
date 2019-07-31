<?php namespace UWAA\Widgets;

/**
 * UWAA Featured Tour Sidebar Widget
 * Used to pull and display pull quote material in the sidebar for Regional Pages, Tours, Events and Stories.
 */

class SidebarSeeYourChapter extends \WP_Widget
{

    const ID    = 'uwaa-dont-see-chapter';
    const TITLE = 'UWAA Sidebar "See Your Chapter';
    const DESC  = 'Adds the "Don\'t See your chapter, box for communities pages.';
    // private $content;

  //Data from the post object to be used in our promoted post.
    private $quoteText;
    private $quoteAuthor;


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
      $this->UI = new \UWAA\View\UI;

  }







  public function widget($args, $instance )
  {


        $content=<<<CONTENT
<div id="no-chapter-widget" class="widget widget_text">
  <h2 class="widgettitle">Don't see your community?</h2>
  <div class="uwaa-btn-wrapper"><a class="uwaa-btn btn-slant-right btn-purple" href="mailto:alumni2@uw.edu&subject=Online%20Chapter%20Inquiry">Let Us Know!</a></div>
</div>

CONTENT;
        echo $content;


  }


}

register_widget( 'UWAA\Widgets\SidebarSeeYourChapter' );