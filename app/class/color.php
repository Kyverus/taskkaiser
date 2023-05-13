<?php
    require_once "../app/class/validation.php";
    require_once "../database/db.php";

    function get_colors(){
        $conn = dbconnect();
        $sql = "SELECT * FROM colors";
        $result = $conn->query($sql);
    
        return $result;
    }
?>