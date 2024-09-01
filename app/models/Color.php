<?php
    require_once "../database/db.php";

    class Color {
        static function all(){
            $query = "SELECT * FROM colors";
            $result = PDO_FetchAll($query);
            return $result;
        }
    }
?>