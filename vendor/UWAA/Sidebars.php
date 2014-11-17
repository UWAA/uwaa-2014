<?php namespace UWAA;


class Sidebars {

    const BEFORE_WIDGET = '<div id="%1$s" class="widget %2$s">';
    const AFTER_WIDGET  = '</div>';

   function __construct()    {
        add_action( 'widgets_init', array( $this, 'register_travel_sidebar' ) );
        add_action( 'widgets_init', array( $this, 'register_benefits_sidebar' ) );
    }  
  

    public function register_travel_sidebar()
    {
        register_sidebar(
            array(
                'name'          => 'Travel',
                'id'            => 'travel_sidebar',
                'description'   => 'Sidebar for Travel Section',
                'before_widget' => self::BEFORE_WIDGET,
                'after_widget'  => self::AFTER_WIDGET
            )           
        );        
    }

    public function register_benefits_sidebar()
    {
        register_sidebar(
            array(
                'name'          => 'Benefits',
                'id'            => 'benefits_sidebar',
                'description'   => 'Sidebar for Benefits Section',
                'before_widget' => self::BEFORE_WIDGET,
                'after_widget'  => self::AFTER_WIDGET
            )
        );
    }



}