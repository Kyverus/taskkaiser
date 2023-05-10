<?php
include "../config/config.php";

function dbconnect(){
    $servername = DBHOST;
    $username = DBUSER;
    $password = DBPWD;
    $dbname = DBNAME;

    //Create Connection
    $conn = new mysqli( $servername,  $username,  $password,  $dbname);

    // mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    //Check Connection
    if($conn->connect_error){
        die("Connection Failed: ".$conn->connect_error);
    }

    return $conn;
}
?>