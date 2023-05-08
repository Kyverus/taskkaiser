<?php
include "../config/config.php";

$servername = DBHOST;
$username = DBUSER;
$password = DBPWD;
$dbname = DBNAME;

//Create Connection
$conn = new mysqli($servername, $username, $password, $dbname);

//Check Connection
if($conn->connect_error){
    die("Connection Failed: ".$conn->connect_error);
}
?>