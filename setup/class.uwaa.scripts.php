<?php
/**
 * This is where all the JS files are registered
 *    Modified version of the UW-2014 Script loader.  Yanking out jquery, child theme stuff as they already call it.  Mirronring 
 *    their approach to loading admin and public and site scripts.  
 *    Since we are using sourcemaps in this child theme, the '.dev' functionality is also removed.
 */

class UWAA_Scripts
{

  public $SCRIPTS;


  function __construct()
  {

    $this->SCRIPTS = array_merge( array(
      
      'site'   => array (
        'id'      => 'uwaa.site',
        'url'     => get_bloginfo('stylesheet_directory') . '/js/site.min.js',
        'deps'    => array(),
        'version' => '1.0.3',
        'admin'   => false
      ),

      'admin' => array (
        'id'      => 'uwaa.wp.admin',
        'url'     => get_bloginfo('stylesheet_directory') . '/js/admin/admin.js',
        'deps'    => array(),
        'version' => '1.0',
        'admin'   => true
      ),
    

    ));

    add_action( 'wp_enqueue_scripts', array( $this, 'uw_register_default_scripts' ) );
    add_action( 'wp_enqueue_scripts', array( $this, 'uw_enqueue_default_scripts' ) );
    add_action( 'admin_enqueue_scripts', array( $this, 'uw_enqueue_admin_scripts' ) );

  }

  function uw_register_default_scripts()
  {
      
      foreach ( $this->SCRIPTS as $script )
      {
        $script = (object) $script;

        wp_register_script(
          $script->id,
          $script->url,
          $script->deps,
          $script->version
        );

      }

  }

  function uw_enqueue_default_scripts()
  {
      foreach ( $this->SCRIPTS as $script )
      {
        $script = (object) $script;

        if ( ! $script->admin )
          wp_enqueue_script( $script->id );
      }
  }

  function uw_enqueue_admin_scripts()
  {
      if ( ! is_admin() )
        return;

      foreach ( $this->SCRIPTS as $script )
      {
        $script = (object) $script;

        if ( $script->admin )
        {

          wp_register_script(
            $script->id,
            $script->url,
            $script->deps,
            $script->version
          );

          wp_enqueue_script( $script->id );

        }
      }

  }

}
