<?php

/**
 * dbo.php
 * database singleton class
 *
 * @category   Database
 * @package    paqure-lamp-backend
 * @author     Roderic Linguri <linguri@digices.com>
 * @copyright  2016 Digices LLC
 * @license    https://github.com/digices-llc/paqure-lamp-backend/blob/master/LICENSE
 * @version    0.0.1
 * @link       https://github.com/digices-llc/paqure-php-api.git
 */

/** Database Singleton **/
class PaqureDB extends DBO
{
    /** @property PaqureDB instance **/
    protected static $si;

    /** @method accessor
      * @return PaqureDB instance
      **/
    public static function sharedInstance()
    {
        if (!isset(self::$si)) {
            self::$si = new self();
        }
        return self::$si;
    }

    /** @method constructor
      * @TODO edit values to reflect correct values to connect to mysql
      **/
    public function __construct()
    {
        $this->name = DBNAME;
        $this->user = DBUSER;
        $this->password = DPPASS;
        parent::__construct();
    }

}
