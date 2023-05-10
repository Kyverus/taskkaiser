<?php
require '../app/class/task.php';

$result = view_tasks();

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
    $emptyinfo = "You dont have any current tasks - Take a rest or create tasks!";
}

if (isset($_POST['delete'])) {
    $id = $_POST["id"];
    delete_task($id);
} 

if (isset($_POST['complete'])) {
    $id = $_POST["id"];
    complete_task($id);
} 

include "../views/show_task_view.php";
?>
		