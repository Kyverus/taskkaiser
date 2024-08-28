<?php
require '../app/class/task.php';

$completed_tasks = get_completed_tasks();

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
if(!$completed_tasks){
    $emptyinfo = "You haven't completed any task yet!";
}

if (isset($_POST['task_revert'])) {
    $id = $_POST["task_id"];
    revert_task($id);
} 



include "../views/show_completed_task_view.php";
?>