<?php

//JETPACK, HASHIN!
add_filter( 'jetpack_development_mode', '__return_true' );




try {    
    
    if (! @include_once(__DIR__. '/vendor/UWAA/.env.php'))
    {
        throw new Exception ("a .env.php file is required for some features of this theme.");
    }
    require_once(__DIR__. '/vendor/UWAA/.env.php');

} catch (Exception $e) {
    echo "Error Message:" . $e->getMessage();
}

//Autoloads all of the UWAA classes, as they follow autoloading standards.  Classes can be called using that \UWAA\Path\To\Class->Method syntax
require_once(__DIR__ . '/vendor/autoload.php');



//Instatiates site-wite classes.  
if (!isset($UWAA)){
    $UWAA = new UWAA\UWAA($wp);
}