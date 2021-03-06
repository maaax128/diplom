<?php
class Connect
{
    static $di = null;

    public static function get()
    {
        if (! self::$di) {
            self::$di = new connect();
        }

        $db = self::$di->config();

        try {
            $dbconnect = new PDO($db['driver'].":host=" . $db['host'] . ";dbname=" . $db['dbname'].';charset=UTF8;',$db['user'], $db['pass']);

        } catch (PDOException $e) {
            die('Database error: '.$e->getMessage().'<br/>');
        }

        return $dbconnect;
    }
    public function config()
    {
        $settings = require __DIR__.'/../config/settings.php';
        $db = $settings['local_db'];
        return $db;
    }
    public function db()
    {
        $db = $this->config();
        try {
            $db = new PDO($db['driver'].":host=" . $db['host'] .";charset=UTF8;". ";dbname=" . $db['dbname'],$db['user'], $db['pass']);

        } catch (PDOException $e) {
            die('Database error: '.$e->getMessage().'<br/>');
        }
        return $db;
    }
}