<?php 

class Connection{
    private static $databaseHost = "localhost";
    private static $databaseUName = "root";
    private static $databasePWord = "";
    private static $databaseName = "car_inventory_system";
    private static $databasePort = "3306";//

    public static function get_databaseURL() {
        return "".self::$databaseHost.":".self::$databasePort;
    }

    public static function get_databaseHost() {
        return "".self::$databaseHost;
    }
    
    public static function get_databaseUName() {
        return "".self::$databaseUName;
    }

    public static function get_databasePWord() {
        return "".self::$databasePWord;
    }

    public static function get_databaseName() {
        return "".self::$databaseName;
    }
    
    public static function get_databasePort() {
        return "".self::$databasePort;
    }

}

?>