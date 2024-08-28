<?php
require '../app/class/task.php';

$tasks = get_tasks();

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
if(!$tasks){
    $emptyinfo = "You dont have any current tasks - Take a rest or create tasks!";
}

if (isset($_POST['task_delete'])) {
    $id = $_POST["task_id"];
    delete_task($id);
} 

if (isset($_POST['task_complete'])) {
    $id = $_POST["task_id"];
    complete_task($id);
} 

include "../views/show_task_view.php";
?>
		