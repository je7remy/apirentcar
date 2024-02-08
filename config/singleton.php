<?php

class Singleton{
 

    private $host = "localhost";
    private $db_name = "rentcar";
    private $username = "root";
    public  $conn ;
    private $password = "";
	private static $instance;

    
 
	public function __construct()
	{
        $this->conn = null;
 
        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $exception){
            wh_log( date("y-m-d H:i:s"). ' - '.   'Connection error db '. $db_name );
            wh_log( $ $exception->getMessage()   );
        }
 
	}

        public static function getInstance()
        {
        try{
            if (!isset(self::$instance)) {
                $object = __CLASS__;
                self::$instance = new $object;
            }
        }catch(Exception $exception){
            wh_log( date("y-m-d H:i:s"). ' - '.   'Connection error db '. $db_name );
            wh_log( $ $exception->getMessage()   );
        } 
        
        return self::$instance;
    } 
}
?>