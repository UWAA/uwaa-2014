<?php namespace UWAA;


class Sidebars {

    const BEFORE_WIDGET = '<div id="%1$s" class="widget %2$s">';
    const AFTER_WIDGET  = '</div>';
    private $SIDEBARS;

   function __construct()    {
        add_action( 'widgets_init', array( $this, 'register_uwaa_sidebars' ) );

        $this->SIDEBARS = array_merge(array(

            'travel' => array (
                'name'          => 'Travel',
                'id'            => 'travel_sidebar',
                'description'   => 'Sidebar for Travel Section',
                'before_widget' => self::BEFORE_WIDGET,
                'after_widget'  => self::AFTER_WIDGET
                ),
            'benefits' => array (
                'name'          => 'Benefits',
                'id'            => 'benefits_sidebar',
                'description'   => 'Sidebar for Benefits Section',
                'before_widget' => self::BEFORE_WIDGET,
                'after_widget'  => self::AFTER_WIDGET
                ),
             'membership' => array (
                'name'          => 'Membership',
                'id'            => 'membership_sidebar',
                'description'   => 'Sidebar for Membership Section',
                'before_widget' => self::BEFORE_WIDGET,
                'after_widget'  => self::AFTER_WIDGET
                ),
            'communities' => array (
                'name'          => 'Communities',
                'id'            => 'communities_sidebar',
                'description'   => 'Sidebar for Communities Section',
                'before_widget' => self::BEFORE_WIDGET,
                'after_widget'  => self::AFTER_WIDGET
                ),
            'services' => array (
                'name'          => 'Services',
                'id'            => 'services_sidebar',
                'description'   => 'Sidebar for Services Section',
                'before_widget' => self::BEFORE_WIDGET,
                'after_widget'  => self::AFTER_WIDGET
                ),
            'events' => array (
                'name'          => 'Events',
                'id'            => 'events_sidebar',
                'description'   => 'Sidebar for Events Pages',
                'before_widget' => self::BEFORE_WIDGET,
                'after_widget'  => self::AFTER_WIDGET
                ),
            'common-ground' => array (
                'name'          => 'Common Ground',
                'id'            => 'common-ground_sidebar',
                'description'   => 'Sidebar for Common Ground',
                'before_widget' => self::BEFORE_WIDGET,
                'after_widget'  => self::AFTER_WIDGET
                ),

            ));
    }  
  

    public function register_uwaa_sidebars()
    {
        foreach ($this->SIDEBARS as $sidebar )
      {
        register_sidebar($sidebar);
      }      
    }
 


}