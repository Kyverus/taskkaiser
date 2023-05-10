<?php
require '../app/class/task.php';

$result = view_completed_tasks();

session_start();
$errors = array();
$success = null;
$emptyinfo = null;


//SUCCESS
if(isset($_SESSION['success']) && $_SESSION['success'] != ''){
    $success = $_SESSION['success'];
    unset($_SESSION['success']);
}

//ERRORS
if(isset($_SESSION['error']) && $_SESSION['error'] != ''){
    array_push($errors,$_SESSION['error']);
    unset($_SESSION['error']);
}

//MESSAGES
if($result->num_rows == 0){
    $emptyinfo = "You haven't completed any task yet!";
}

if (isset($_POST['revert'])) {
    $id = $_POST["id"];
    revert_task($id);
} 



include "../views/show_completed_task_view.php";
?>