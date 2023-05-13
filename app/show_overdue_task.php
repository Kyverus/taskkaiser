<?php
require '../app/class/task.php';

$overdue_tasks = get_overdue_tasks();

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
if($overdue_tasks->num_rows == 0){
    $emptyinfo = "Congratulations, You dont have any overdue tasks!";
}

if (isset($_POST['task_delete'])) {
    $id = $_POST["task_id"];
    delete_task($id);
} 

include "../views/show_overdue_task_view.php";
?>
		