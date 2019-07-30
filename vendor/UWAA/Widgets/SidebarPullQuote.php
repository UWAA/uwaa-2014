<?php namespace UWAA\Widgets;

/**
 * UWAA Featured Tour Sidebar Widget
 * Used to pull and display pull quote material in the sidebar for Regional Pages, Tours, Events and Stories.
 */

class SidebarPullQuote extends \WP_Widget
{

    const ID    = 'uwaa-pull-quote';
    const TITLE = 'UWAA Sidebar Pull Quote';
    const DESC  = 'Display a pull quote in the sidebar on posts where that information is available.';
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



  private function extractPostInformation()
  {
        $currentPostID = get_the_ID();
        $this->quoteText = esc_html(get_post_meta($currentPostID, 'mb_pull-quote-text', true));
        $this->quoteAuthor = esc_html(get_post_meta($currentPostID, 'mb_pull-quote-attribution', true));

  }

  private function isBlockQuotePresent()
  {
    if (!empty($this->quoteText))
    {
      return true;
    }

  }



  public function widget( $args, $instance )
  {
    $this->extractPostInformation();
     if ($this->isBlockQuotePresent())
     {
        echo'<div class="'. $this::ID . ' widget">';

        $content=<<<CONTENT
   <div class="quote-text">$this->quoteText</div>
   <div class="quote-author">$this->quoteAuthor</div>

CONTENT;
        echo $content;
        echo '</div>';

  }
}

}

register_widget( 'UWAA\Widgets\SidebarPullQuote' );