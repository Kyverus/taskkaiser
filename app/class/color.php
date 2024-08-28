<?php
    require_once "../app/class/validation.php";
    require_once "../database/db.php";

    function get_colors(){
        $query = "SELECT * FROM colors";
        $result = PDO_FetchAll($query);
        return $result;
    }
?>