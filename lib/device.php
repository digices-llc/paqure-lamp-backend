<?php

/**
 * app.php
 * url to parse POST request from application
 *
 * @category   API
 * @package    paqure-lamp-backend
 * @author     Roderic Linguri <linguri@digices.com>
 * @copyright  2016 Digices LLC
 * @license    https://github.com/digices-llc/paqure-lamp-backend/blob/master/LICENSE
 * @version    0.0.1
 * @link       https://github.com/digices-llc/paqure-lamp-backend.git
 */

class DeviceTable extends Table
{

    /** @property DeviceTable singleton */
    protected static $si;

    /**
     * constructor
     */
    public function __construct()
    {
        $this->dbo = PaqureDB::sharedInstance();
        $this->tableName = 'device';

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
        $sql = 'CREATE TABLE IF NOT EXISTS `device` (
               `id` int(10) NOT NULL AUTO_INCREMENT,
               `label` varchar(40) NOT NULL,
               `identifier` varchar(40) NOT NULL,
               `locale` varchar(40) NOT NULL,
               `token` varchar(40) NOT NULL,
               `created` int(10) NOT NULL,
               `modified` int(10) NOT NULL,
               `status` int(1) NOT NULL,
               PRIMARY KEY (`id`),
               UNIQUE KEY `identifier` (`identifier`)
               ) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;';

        $this->dbo->executeSQL($sql);
    }

    /**
     * fetch single row based on identifier
     * @param $identifier
     * @return mixed|bool
     */
    public function fetchRowFromIdentifier($identifier) {
        $sql = 'SELECT * FROM  `'.$this->tableName.'` WHERE `identifier` = \''.$identifier.'\' LIMIT 1;';
        if ($rows = $this->dbo->fetchRows($sql)) {
            return $rows[0];
        } else {
            return false;
        }
    }

    /**
     * insert a new device and return id
     * @param $device
     * @param $locale
     * @return mixed|bool
     */
    public function newDevice($device, $locale)
    {
        $values = array('',$device,$locale,md5($device),date('U'),date('U'),2);
        $this->insertArray($values);
        return $this->fetchRowFromId($this->dbo->lastInsertId());
    }

    /**
     * update label, locale and modification date
     * @param $id
     * @param $label
     * @param $locale
     * @return int
     */
    public function updateDevice($id, $label, $locale) {

        $date = intval(date('U'));

        $sql = 'UPDATE  `device` SET  `label` =  \''.addslashes($label).'\', `locale` =  \''.addslashes($locale).'\', `modified` = '.$date.' WHERE  `id` = '.$id.' ;';

        if ($res = $this->dbo->executeSQL($sql)) {
            return $date;
        } else {
            return 0;
        }

    }

}