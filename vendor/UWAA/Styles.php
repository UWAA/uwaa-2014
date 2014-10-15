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

    );

    add_action( 'wp_enqueue_scripts', array( $this, 'uw_register_default_styles' ) );
    // add_action( 'wp_enqueue_scripts', array( $this, 'uw_enqueue_default_styles' ) );
    // add_action( 'admin_head', array( $this, 'uw_enqueue_admin_styles' ) );

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

/*  function uw_enqueue_default_styles()
  {
      wp_enqueue_style( 'uw-master' );
      foreach ( $this->STYLES as $style )
      {
        $style = (object) $style;

        if ( array_key_exists( 'child', $style )
              && $style->child && ! $this->is_child_theme() )
          continue;

        wp_enqueue_style( $style->id );

      }

  }*/

 /* function uw_enqueue_admin_styles()
  {
    if ( ! is_admin() )
      return;

    foreach ( $this->STYLES as $style )
    {

      $style = (object) $style;

      if ( array_key_exists( 'admin', $style)
            && $style->admin )
      {
        wp_register_style(
          $style->id,
          $style->url,
          $style->deps,
          $style->version
        );

        wp_enqueue_style( $style->id );
      }

    }

  }*/



  private function dev_stylesheet()
  {
    return is_user_logged_in() ? '.dev' : '';
  }


}