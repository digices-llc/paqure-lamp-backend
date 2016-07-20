<?php

// define a constant for the current directory
define ('PAQURE',__DIR__);

// alias the php directory separator constant
if (!defined ('DS')) {
    define ('DS',DIRECTORY_SEPARATOR);
}

// link this file to the OTMVC library
require_once (dirname(dirname(PAQURE)).'/frameworks/otmvc/ini.php');

// path to lib directory
$paqure_lib = new DirectoryIterator (PAQURE.DS.'lib');

// require all files that do not begin with a dot
foreach ($paqure_lib as $item) {

    $fn = $item->getfilename();
    
    if (substr ($fn,0,1) != '.') {
        require_once (PAQURE.DS.'lib'.DS.$fn);
    }

}
