<?php 	
require '../app/class/tag.php';
require '../app/class/color.php';

	$colors = get_colors();

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

	if($_SERVER["REQUEST_METHOD"] == "POST"){
		if(empty($_POST["tag_name"])|| empty($_POST["tag_description"])){
			if(empty($_POST["tag_name"])){
				array_push($errors,"Name Required");
			}
			if(empty($_POST["tag_description"])){
				array_push($errors,"Description Required");
			}
		}else{
			$name = $_POST["tag_name"];
			$description = $_POST["tag_description"];
			$color = $_POST["tag_color"];

			save_tag($name, $description, $color);
		}	
	}

	require "../views/create_tag_view.php";
?>