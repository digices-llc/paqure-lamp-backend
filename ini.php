<?php

/**
 * ini.php
 * library initialization
 *
 * @category   Database
 * @package    paqure-lamp-backend
 * @author     Roderic Linguri <linguri@digices.com>
 * @copyright  2016 Digices LLC
 * @license    https://github.com/digices-llc/paqure-lamp-backend/blob/master/LICENSE
 * @version    0.0.1
 * @link       https://github.com/digices-llc/paqure-php-api.git
 */

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
