<?php
    abstract class Db
    {
        private static $conn = null;

        public static function getInstance()
        {
            if (isset(self::$conn)) {
                return self::$conn;
            } else {
                //self::$conn = new PDO('mysql:host=localhost; dbname=db_kvm', 'root', 'root'); // -> voor Tom - lokaal
                self::$conn = new PDO('mysql:host=localhost; dbname=db_kvm', 'root', ''); // -> voor Roel -lokaal
                
                //self::$conn = new PDO('mysql:host=roelifant.com.mysql; dbname=roelifant_com', 'roelifant_com', 'SEeZ2LNE'); // -> online
                return self::$conn;
            }
        }
    }
