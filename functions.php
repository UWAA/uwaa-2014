<?php

//JETPACK, HASHIN!

require_once(__DIR__. '/vendor/UWAA/.env.php');



//Autoloads all of the UWAA classes, as they follow autoloading standards.  Classes can be called using that \UWAA\Path\To\Class->Method syntax
require_once(__DIR__ . '/vendor/autoload.php');



//Instatiates site-wite classes.  
if (!isset($UWAA)){
    $UWAA = new UWAA\UWAA($wp);
}

// hook the translation filters
add_filter(  'gettext',  'change_post_to_story'  );
add_filter(  'ngettext',  'change_post_to_story'  );

function change_post_to_story( $translated ) {
     $translated = str_ireplace(  'Posts',  'Stories',  $translated );  // ireplace is PHP5 only     
     return $translated;
}