<?php 
	session_start();
	require_once "../database/db.php";

		//SUCCESS
		if(isset($_SESSION['success']) && $_SESSION['success'] != ''){
			echo "	<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">
						<strong>Success: </strong> ". $_SESSION['success'] ."
						<button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" aria-label=\"Close\"></button>
						</div>";

			unset($_SESSION['success']);
		}
	
		//DATA VALIDATION
		$name = $type = $deadline = "";

		if($_SERVER["REQUEST_METHOD"] == "POST"){
			if(empty($_POST["name"])){
				echo "	<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">
						<strong>Error: </strong> Name Required.
						<button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" aria-label=\"Close\"></button>
						</div>";
			}elseif(empty($_POST["type"])){
				echo "	<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">
						<strong>Error: </strong> Type Required.
						<button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" aria-label=\"Close\"></button>
						</div>";
			}else{
				$name = validateData($_POST["name"]);
				$description = validateData($_POST["description"]);
				$type = validateData($_POST["type"]);
				$status = "Incomplete";
				$deadline = validateData($_POST["deadline"]);
				
				$sql = "INSERT INTO `tasks`(`name`, `description`, `type`, `status`, `deadline`) VALUES ('$name','$description','$type','$status','$deadline')";

				$result = $conn->query($sql);
				
				if ($result == TRUE) {
					$_SESSION['success'] = 'Record Created Successfully';
					header('Location: /create-task');
				}else{
					echo "	<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">
						<strong>Error: </strong> " . $sql . "<br>". $conn->error . "
						<button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" aria-label=\"Close\"></button>
						</div>";

					echo "Error:". $sql . "<br>". $conn->error;

				} 
				$conn->close(); 

			}	
		}

		function validateData($data){
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}

        require "../views/create_task_view.php"
	?>