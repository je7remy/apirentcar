<?php

include_once 'singleton.php';

class Database{

    function getConnection()
    {
    
        $dbConnection = null;
    
        try {
            $dbConnection = Singleton::getInstance()->conn ;

        } catch (PDOException $e) {
            $dbConnection = null;
        }
    
        return $dbConnection;
    }
}


?>

