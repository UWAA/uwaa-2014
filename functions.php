<?php



//Autoloads all of the UWAA classes, as they follow autoloading standards.  Classes can be called using that \UWAA\Path\To\Class::Method syntax
require_once(__DIR__ . '/vendor/autoload.php');


//Instatiates site-wite classes.  
if (!isset($UWAA)){
    new UWAA\Loader();
}

