<?php

    require_once "config.php";
    
    class UserDetail{
        
        public function __construct(){
        }

        public function getUserDetailInfo($id) {
            $db = new PDO("mysql:host=" . DB_HOST . ";dbname=". DB_NAME .";charset=UTF8", DB_USER, DB_PASSWORD);
            $db->exec("set fullname utf8");
            $db->exec("set gender utf8");
            $db->exec("set address utf8");

            $stmt = $db->prepare("SELECT * from user_details where user_id=:id LIMIT 1");

            $stmt->execute(array(':id' => $id));

            $emparray = $stmt->fetch(PDO::FETCH_ASSOC);

            return $emparray;
        }
    }
    