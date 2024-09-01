<?php
    require_once "../database/db.php";

    class Type {
        static function all(){
            $query = "SELECT * FROM types";
            $result = PDO_FetchAll($query);
            return $result;
        }
    }
?>