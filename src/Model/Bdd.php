<?php
namespace src\Model;
use PDO;
class Bdd {
    private static $_instance = null;

    /**
     * init a PDO connection
     */
    public static function InitInstance(){
        $hostname="mysql-floriaaan.alwaysdata.net";
        $username="floriaaan_prphp";
        $password=file_get_contents('../db_pw.txt');
        $dbname="floriaaan_prphp";

        try
        {
           self::$_instance = new PDO('mysql:host='.$hostname.';dbname='.$dbname.';charset=utf8', $username, $password);
           self::$_instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch (\Exception $e)
        {
            die('Erreur : ' . $e->getMessage());
        }

    }

    /**
     * init a PDO connection if Instance is null or just return Instance if is already set
     * @return PDO
     */
    public static function GetInstance(){
        if(self::$_instance == null ){
           self::InitInstance();
        }

        return self::$_instance;
    }

}
