<?php
class DBConnection{
    public static function get_connection(){
        $configs = parse_ini_file($_SERVER['PWD'] .'/config.ini');
        $db = new SQLite3($configs["db_name"]);
        return $db;
    }
}

