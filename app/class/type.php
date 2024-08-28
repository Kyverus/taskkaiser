<?php
    require_once "../app/class/validation.php";
    require_once "../database/db.php";

    function get_types(){
        $query = "SELECT * FROM types";
        $result = PDO_FetchAll($query);
        return $result;
    }
?>