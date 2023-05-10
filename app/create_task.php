<?php 	
		require '../app/class/task.php';

		session_start();
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
	
		$name = $type = $deadline = "";

		if($_SERVER["REQUEST_METHOD"] == "POST"){
			if(empty($_POST["name"])|| empty($_POST["description"])){
				if(empty($_POST["name"])){
					array_push($errors,"Name Required");
				}
				if(empty($_POST["description"])){
					array_push($errors,"Description Required");
				}
			}else{
				$name = $_POST["name"];
				$description = $_POST["description"];
				$type = $_POST["type"];
				$status = 0;
				$deadline = $_POST["deadline"];
				$main_tag = $_POST["main_tag"];

				save_task($name, $description, $type, $status, $deadline, $main_tag);
			}	
		}

        require "../views/create_task_view.php";
	?>