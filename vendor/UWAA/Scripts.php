<?php namespace UWAA;
/**
 * This is where all the JS files are registered
 *    Modified version of the UW-2014 Script loader.  Yanking out jquery, child theme stuff as they already call it.  Mirronring 
 *    their approach to loading admin and public and site scripts.  
 *    Also loading our scripts in the footer...
 */

class Scripts
{

  public $SCRIPTS;
  public $SUPPORT_SCRIPTS;


  function __construct()
  {

    $this->SCRIPTS = array_merge( array(
      
      'site'   => array (
        'id'      => 'uwaa.site',
        'url'     => get_bloginfo('stylesheet_directory') . '/js/uwaa.site' . $this->dev_script() . '.js',
        'deps'    => array(),
        'version' => '1.0.3',
        'in_footer' => true,
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

    $this->SUPPORT_SCRIPTS = array_merge( array(
      
      'isotope'   => array (
        'id'      => 'isotope',
        'url'     => get_bloginfo('stylesheet_directory') . '/js/libraries/isotope/dist/isotope.pkgd.js',
        'deps'    => array('jquery'),
        'version' => '2.0.1',
        'in_footer' => true,
        'admin'   => false
      ),

      'isotopeInit' => array (
        'id'      => 'isotopeInit',
        'url'     => get_bloginfo('stylesheet_directory') . '/js/support/isotopeInit' . $this->min_script() . '.js',
        'deps'    => array('isotope'),
        'version' => '1.0',
        'admin'   => false
      ),
    

    ));

    add_action( 'wp_enqueue_scripts', array( $this, 'uwaa_register_default_scripts' ) );
    add_action( 'wp_enqueue_scripts', array( $this, 'uwaa_register_support_scripts' ) );
    add_action( 'wp_enqueue_scripts', array( $this, 'uwaa_enqueue_default_scripts' ) );
    add_action( 'admin_enqueue_scripts', array( $this, 'uwaa_enqueue_admin_scripts' ) );

  }

  function uwaa_register_default_scripts()
  {
      
      foreach ( $this->SCRIPTS as $script )
      {
        $script = (object) $script;

        wp_register_script(
          $script->id,
          $script->url,
          $script->deps,
          $script->version,
          $script->in_footer
        );

      }

  }

  //Used to register, but not necessarily Enqueue certain scripts unless needed.  Scripts can be loaded on specific templates as necessary.

  public function uwaa_register_support_scripts()
  {
      
      foreach ( $this->SUPPORT_SCRIPTS as $script )
      {
        $script = (object) $script;

        wp_register_script(
          $script->id,
          $script->url,
          $script->deps,
          $script->version,
          $script->in_footer
        );

      }

  }

  function uwaa_enqueue_default_scripts()
  {
      foreach ( $this->SCRIPTS as $script )
      {
        $script = (object) $script;

        if ( ! $script->admin )
          wp_enqueue_script( $script->id );
      }
  }

  function uwaa_enqueue_admin_scripts()
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

  public function dev_script()
  {
    return is_user_logged_in() ? '.dev' : '';
  }

  public function min_script()
  {
    return !is_user_logged_in() ? '.min' : '';
  }

}
