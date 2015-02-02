<?php namespace UWAA;



class Styles
{

    public $STYLES;

  function __construct()
  {
    $this->STYLES = array(

      'mapbox' => array(
          'id'      => 'mapbox',
          'url'     => 'https://api.tiles.mapbox.com/mapbox.js/v2.1.2/mapbox.css',
          'deps'    => array(),
          'version' => '2.1.2',
          'admin'   => false
      ),
      'gradpack' => array(
          'id'      => 'gradpack',
          'url'     => get_bloginfo('stylesheet_directory') . '/gradpack.css',
          'deps'    => array(),
          'version' => '',
          'admin'   => false
      ),       

    );

    add_action( 'wp_enqueue_scripts', array( $this, 'uw_register_default_styles' ) );

  }

  function uw_register_default_styles()
  {
      foreach ( $this->STYLES as $style )
      {
        $style = (object) $style;

        wp_register_style(
          $style->id,
          $style->url,
          $style->deps,
          $style->version
        );

      }

  }


  private function dev_stylesheet()
  {
    return is_user_logged_in() ? '.dev' : '';
  }


}