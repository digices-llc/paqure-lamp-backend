<?php

/**
 * app.php
 * db-table singleton
 *
 * @category   Database
 * @package    paqure-lamp-backend
 * @author     Roderic Linguri <linguri@digices.com>
 * @copyright  2016 Digices LLC
 * @license    https://github.com/digices-llc/paqure-lamp-backend/blob/master/LICENSE
 * @version    0.0.1
 * @link       https://github.com/digices-llc/paqure-php-api.git
 */

class AppTable extends Table
{
    /** @property PaqureDB **/
    protected $dbo;

    /** @property str **/
    protected $tableName;

    /** @property AppTable **/
    protected static $si;

    /** @method constructor **/
    public function __construct()
    {
        $this->dbo = PaqureDB::sharedInstance();
        $this->tableName = 'app';
    }

    /** @method singleton accessor
      * @return AppTable instance
      **/
    public static function sharedInstance()
    {
        if (!isset(self::$si)) {
            self::$si = new self();
        }
        return self::$si;
    }

    /** @method create the mysql table **/
    public function createTable()
    {
        $sql = 'CREATE TABLE IF NOT EXISTS `app` (
               `id` int(10) NOT NULL AUTO_INCREMENT,
               `name` varchar(40) NOT NULL,
               `major` int(3) NOT NULL,
               `minor` int(3) NOT NULL,
               `fix` int(3) NOT NULL,
               `copyright` int(4) NOT NULL,
               `company` varchar(40) NOT NULL,
               PRIMARY KEY (`id`),
               UNIQUE KEY `name` (`name`)
               ) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;';
        $this->dbo->executeSQL($sql);
    }

}
