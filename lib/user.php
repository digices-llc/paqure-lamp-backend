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

class UserTable extends Table
{

    /** @property UserTable singleton */
    protected static $si;

    /**
     * constructor
     */
    public function __construct()
    {
        $this->dbo = PaqureDB::sharedInstance();
        $this->tableName = 'user';

    }

    /**
     * accessor
     * @return DeviceTable singleton
     */
    public static function sharedInstance()
    {
        if (!isset(self::$si)) {
            self::$si = new self();
        }
        return self::$si;
    }

    /**
     * create table in database
     */
    public function createTable()
    {
        $sql = 'CREATE TABLE IF NOT EXISTS `user` (
               `id` int(10) NOT NULL AUTO_INCREMENT,
               `username` varchar(40) NOT NULL,
               `hashed_password` varchar(40) NOT NULL,
               `email` varchar(80) NOT NULL,
               `first` varchar(40) NOT NULL,
               `last` varchar(40) NOT NULL,
               `age` int(3) NOT NULL,
               `status` int(1) NOT NULL,
               PRIMARY KEY (`id`),
               UNIQUE KEY `username` (`username`,`email`)
               ) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;';
        $this->dbo->executeSQL($sql);
    }

    /**
     * fetch single row based on username
     * @param string $username
     * @return mixed|bool
     */
    public function fetchRowFromUsername($username) {
        $sql = 'SELECT * FROM `'.$this->tableName.'` WHERE `username` = \''.addslashes($username).'\' LIMIT 1;';
        if ($rows = $this->dbo->fetchRows($sql)) {
            return $rows[0];
        } else {
            return false;
        }
    }


}