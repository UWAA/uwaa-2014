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
      'mapbox-gl-js' => array(
        'id'      => 'mapbox-gl-js',
        'url'     => 'https://api.mapbox.com/mapbox-gl-js/v1.6.1/mapbox-gl.css',
        'deps'    => array(),
        'version' => '1.6.1',
        'admin'   => false
    ),
     'mapbox331' => array(
        'id'      => 'mapbox331',
        'url'     => 'https://api.mapbox.com/mapbox.js/v3.3.1/mapbox.css',
        'deps'    => array(),
        'version' => '3.3.1',
        'admin'   => false
    ),
      'gradpack' => array(
          'id'      => 'gradpack',
          'url'     => get_bloginfo('stylesheet_directory') . '/gradpack.css',
          'deps'    => array(),
          'version' => '',
          'admin'   => false,
          'support' => true
      ),

      'google-font-open' => array(
          'id'      => 'google-font-cinzel',
          'url'     => 'https://fonts.googleapis.com/css?family=Cinzel',
          'deps'    => array(),
          'version' => '',
          'admin'   => true
      ),
       'uwaa_admin' => array(
          'id'      => 'uwaa_admin',
          'url'     => get_bloginfo('stylesheet_directory') . '/admin.css',
          'deps'    => array(),
          'version' => '',
          'admin'   => true
      ),
      'flickity' => array(
          'id'      => 'flickity',
          'url'     => get_bloginfo('stylesheet_directory') . '/less/flickity.css',
          'deps'    => array(),
          'version' => '',
          'admin'   => false,
          'support' => true
      ),
      'holiday' => array(
          'id'      => 'holiday',
          'url'     => get_bloginfo('stylesheet_directory') . '/holiday.css',
          'deps'    => array(),
          'version' => '',
          'admin'   => false,
          'support' => true
      ),

    );

    

    add_action( 'wp_enqueue_scripts', array( $this, 'uw_register_default_styles' ) );
    add_action( 'wp_enqueue_scripts', array( $this, 'uwaa_register_support_styles' ) );
    add_action( 'admin_head', array( $this, 'uw_enqueue_admin_styles' ) );

  }

  function uwaa_register_support_styles() {
      foreach ( $this->STYLES as $style )
      {
        $style = (object) $style;

        if (array_key_exists( 'support', $style) && $style->support )
      {

        wp_register_style(
          $style->id,
          $style->url,
          $style->deps,
          $style->version
        );
      }

      }
  }

  function uw_register_default_styles()
  {
      foreach ( $this->STYLES as $style )
      {
        $style = (object) $style;

        if (!array_key_exists( 'support', $style) )
      {

        wp_enqueue_style(
          $style->id,
          $style->url,
          $style->deps,
          $style->version
        );
      }

      }

  }

  function uw_enqueue_admin_styles()
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

  }


  private function dev_stylesheet()
  {
    return is_user_logged_in() ? '.dev' : '';
  }


}