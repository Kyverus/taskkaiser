<?php
// include "../config/config.php";
include "_pdo.php";

$db_file = "../database/taskkaiser.db";
PDO_Connect("sqlite:" . $db_file);


function saveData($query, $params=null){

}

function getData($query, $config = 0, $params=null) {
    switch($config){
        case 0: // FETCH ALL
            $result = PDO_FetchAll($query);
            break;
        case 1: // FETCH ASSOC
        case 2: // FETCH ROW
        default:
            $result = null;
    }

    return $result;
}

function updateData($query, $params=null) {

}
?>