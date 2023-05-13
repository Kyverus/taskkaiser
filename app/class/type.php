<?php
    require_once "../app/class/validation.php";
    require_once "../database/db.php";

    function get_types(){
        $conn = dbconnect();
        $sql = "SELECT * FROM types";
        $result = $conn->query($sql);
    
        return $result;
    }
?>