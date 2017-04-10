<?php
    
    include_once 'db-connect.php';
    
    class UserDetail{
        
        private $db;
        
        private $db_table = "user_details";
        
        public function __construct(){
            $this->db = new DbConnect();
        }

        public function getUserDetailInfo($id) {

            $query = "select * from ".$this->db_table." where user_id = '$id' Limit 1";
            $result = mysqli_query($this->db->getDb(), $query);
            $emparray = mysqli_fetch_assoc($result);
            
            mysqli_close($this->db->getDb());

            return $emparray;
        }
    }
    ?>