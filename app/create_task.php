<?php 	
require '../app/class/task.php';
require '../app/class/type.php';
require '../app/class/tag.php';

	$types = get_types();
	$tags = get_tags();

	$errors = array();
	$success = null;

	//SUCCESS
	if(isset($_SESSION['success']) && $_SESSION['success'] != ''){
		$success = $_SESSION['success'];
		unset($_SESSION['success']);
	}

	if(isset($_SESSION['error']) && $_SESSION['error'] != ''){
		array_push($errors,$_SESSION['error']);
		unset($_SESSION['error']);
	}

	if($_SERVER["REQUEST_METHOD"] == "POST"){
		if(empty($_POST["task_name"])|| empty($_POST["task_description"])){
			if(empty($_POST["task_name"])){
				array_push($errors,"Name Required");
			}
			if(empty($_POST["task_description"])){
				array_push($errors,"Description Required");
			}
		}else{
			$name = $_POST["task_name"];
			$description = $_POST["task_description"];
			$type = $_POST["task_type"];
			$status = 0;
			$deadline = $_POST["task_deadline"];
			$main_tag = $_POST["task_main_tag"];

			save_task($name, $description, $type, $status, $deadline, $main_tag);
		}	
	}

	require "../views/create_task_view.php";
?>