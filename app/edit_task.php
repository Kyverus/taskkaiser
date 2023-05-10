<?php 
	require '../app/class/task.php';

    session_start();
    $errors = array();

    if(isset($_SESSION['error']) && $_SESSION['error'] != ''){
        array_push($errors,$_SESSION['error']);
        unset($_SESSION['error']);
    }

    if (isset($_POST['update'])) {
        if(empty($_POST["name"])|| empty($_POST["description"])){
            if(empty($_POST["name"])){
                array_push($errors,"Name Required");
            }
            if(empty($_POST["description"])){
                array_push($errors,"Description Required");
            }
        }else{
            $id = $_POST["id"];
            $name = $_POST["name"];
            $description = $_POST["description"];
            $type = $_POST["type"];
            $deadline = $_POST["deadline"];
            $main_tag = $_POST["main_tag"];
    
            update_task($name, $description, $type, $deadline, $main_tag, $id);
        }	
    } 

    if (isset($_GET['id'])) {
        $result = get_task_by_id($_GET['id']);
    
        $task_id = $task_name = $task_description = $task_type = $task_deadline = $task_main_tag = ""; 

        if ($result->num_rows > 0) {
            
            while ($row = $result->fetch_assoc()) {
    
                $task_name = $row['name'];
                $task_description = $row['description'];
                $task_type = $row['type'];
                $task_deadline  = $row['deadline'];

                if($task_deadline == NULL){
                    $task_deadline = "";
                }
    
                $task_main_tag = $row['main_tag'];
                $task_id = $row['id'];

            } 
        }
    }
    require "../views/edit_task_view.php";
?>