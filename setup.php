<?php

/**
 * setup.php
 * Application Setup Script
 *
 * @category   Database
 * @package    paqure-lamp-backend
 * @author     Roderic Linguri <linguri@digices.com>
 * @copyright  2016 Digices LLC
 * @license    https://github.com/digices-llc/paqure-lamp-backend/blob/master/LICENSE
 * @version    0.0.1
 * @link       https://github.com/digices-llc/paqure-php-api.git
 */

require_once (__DIR__.DIRECTORY_SEPARATOR.'ini.php');

$at = AppTable::sharedInstance();
$at->createTable();
$at->insertArray(array('Paqure', 0, 0, 1, 2016, 'Digices LLC'));

$dt = DeviceTable::sharedInstance();
$dt->createTable();
$dt->insertArray(array('public', 'public', 'en-US', md5('public'), date('U'), date('U'), 2));

$ut = UserTable::sharedInstance();
$ut->createTable();
$ut->insertArray(array('anonymous',sha1('none'),'anonymous@digices.com','Anonymous','User',99,2));
