<?php

/** Database Singleton **/
class PaqureDB extends DBO
{
    /** @property PaqureDB instance **/
    protected static $si;

    /** @method singleton accessor
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
        $this->name = 'dbname';
        $this->user = 'dbuser';
        $this->password = 'supersecretpassword';
        parent::__construct();
    }

}
