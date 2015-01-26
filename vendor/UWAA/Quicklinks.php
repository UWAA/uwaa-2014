<?php namespace UWAA;

/**
 * UWAA Quicklinks
 * This will register the UW Quicklinks navigation and provide a json feed for the current quicklinks menu
 */
class QuickLinks
{

  const NAME         = 'Quick Links';
  const LOCATION     = 'quick-links';
  const ALLOWED_BLOG = 1;
 

  function parse_menu()
  {

    $defaultMenu = array(
         array(
         "title" => "MyUW",
         "url" => "http:\/\/myuw.washington.edu",
         "classes" => array(
            "icon-myuw"
                 )
          ),
          array(
              "title" => "Calendar",
              "url" => "http:\/\/uw.edu\/calendar",
              "classes" => array(
                 "icon-calendar"
                 )
          ),
          array(
              "title" => "Directories",
              "url" => "http:\/\/uw.edu\/directory\/",
              "classes" => array(
                 "icon-directories"
                 )
          ),
          array(
              "title" => "Libraries",
              "url" => "http:\/\/www.lib.washington.edu\/",
              "classes" => array(
                 "icon-libraries"
                 )
          ),
          array(
              "title" => "UW Medicine",
              "url" => "http:\/\/www.uwmedicine.org",
              "classes" => array(
                 'icon-medicine'
                 )
          ),
          array(
              "title" => "Maps",
              "url" => "http:\/\/uw.edu\/maps",
              "classes" => array(
                 "icon-maps"
                 )
          ),
          array(
              "title" => "UW Today",
              "url" => "http:\/\/www.uw.edu\/news",
              "classes" => array(
                 "icon-uwtoday"
                 )
          ),  
    );

  
    if ( $this->items )
      foreach( $this->items as $index=>$item )
      {
        // Only keep the necessary keys of the $item
        $item = array_intersect_key( (array) $item , array_fill_keys( array('ID', 'title', 'url', 'classes', 'menu_item_parent'), null ) );

        if ( ! $item['classes'][0] ) $item['classes'] = false;

        $menu[] = $item;

      }

    // return $menu ? $menu : array();
    return $defaultMenu;
  }

}


