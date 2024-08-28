<?php 
require '../app/class/task.php';
require '../app/class/type.php';
require '../app/class/tag.php';

    $types = get_types();
    $tags = get_tags();

    $errors = array();

    if(isset($_SESSION['error']) && $_SESSION['error'] != ''){
        array_push($errors,$_SESSION['error']);
        unset($_SESSION['error']);
    }

    if (isset($_POST['task_update'])) {
        if(empty($_POST["task_name"])|| empty($_POST["task_description"])){
            if(empty($_POST["task_name"])){
                array_push($errors,"Name Required");
            }
            if(empty($_POST["task_description"])){
                array_push($errors,"Description Required");
            }
        }else{
            $id = $_POST["task_id"];
            $name = $_POST["task_name"];
            $description = $_POST["task_description"];
            $type = $_POST["task_type"];
            $deadline = $_POST["task_deadline"];
            $main_tag = $_POST["task_main_tag"];
    
            update_task($name, $description, $type, $deadline, $main_tag, $id);
        }	
    } 

    if (isset($_GET['id'])) {
        $result = get_task_by_id($_GET['id']);

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