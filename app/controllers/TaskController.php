<?php 
require_once "../app/models/validation.php";
require_once '../app/models/Task.php';
require_once '../app/models/Type.php';
require_once '../app/models/Tag.php';

    class TaskController {
        
        static function show_tasks() {
            $tasks = Task::all();
            $success = check_success();
            $errors = check_errors();
            $emptyinfo = null;

            //MESSAGES
            if(!$tasks){
                $emptyinfo = "You dont have any current tasks - Take a rest or create tasks!";
            }

            if (isset($_POST['task_delete'])) {
                $id = $_POST["task_id"];
                $result = Task::delete($id);

                if($result) {
                    $_SESSION['success'] = 'Task Deleted Successfully';
                    header("Location: /view-task");
                    exit();
                }else{            
                    $_SESSION['error'] = $stmt->error;
                    header("Location: /view-task");
                    exit();
                } 
            } 

            if (isset($_POST['task_complete'])) {
                $id = $_POST["task_id"];
                $category = "status";
                $value = 1;
                $result = Task::updateByCategory($category, $value, $id);

                if ($result) {
                    $_SESSION['success'] = 'Task Completed';
                    header("Location: /view-task");
                    exit();
                }else{            
                    $_SESSION['error'] = $stmt->error;
                    header("Location: /view-task");
                    exit();
                } 
            } 

            require_once "../views/show_task_view.php";
        }

        static function show_completed_tasks(){
            $completed_tasks = Task::allCompleted();

            $errors = array();
            $success = check_success();
            $errors = check_errors();

            if(!$completed_tasks){
                $emptyinfo = "You haven't completed any task yet!";
            }

            if (isset($_POST['task_revert'])) {
                $category = "status";
                $value = 1;
                $result = Task::updateByCategory($category, $value, $id);

                if ($result) {
                    $_SESSION['success'] = 'Task Completed';
                    header("Location: /view-completed-task");
                    exit();
                }else{            
                    $_SESSION['error'] = $stmt->error;
                    header("Location: /view-completed-task");
                    exit();
                } 
            } 

            require_once "../views/show_completed_task_view.php";
        }

        static function show_overdue_tasks(){
            $overdue_tasks = Task::allOverdue();
            $success = check_success();
            $errors = check_errors();
            $emptyinfo = null;

            if(!$overdue_tasks){
                $emptyinfo = "Congratulations, You dont have any overdue tasks!";
            }

            if (isset($_POST['task_delete'])) {
                $id = $_POST["task_id"];
                $result = Task::delete($id);

                if($result) {
                    $_SESSION['success'] = 'Task Deleted Successfully';
                    header("Location: /view-overdue-task");
                    exit();
                }else{            
                    $_SESSION['error'] = $stmt->error;
                    header("Location: /view-overdue-task");
                    exit();
                } 
            } 

            require_once "../views/show_overdue_task_view.php";
        }

        static function create_task() {
            $types = Type::all();
            $tags = Tag::all();
            $success = check_success();
            $errors = check_errors();
        
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                if(empty($_POST["task_name"])|| empty($_POST["task_description"])){
                    if(empty($_POST["task_name"])){
                        array_push($errors,"Name Required");
                    }
                    if(empty($_POST["task_description"])){
                        array_push($errors,"Description Required");
                    }
                }else{
                    $name = validateData($_POST["task_name"]);
                    $description = validateData($_POST["task_description"]);
                    $type = validateData($_POST["task_type"]);
                    $status = 0;
                    $deadline = validateData($_POST["task_deadline"]);
                    $main_tag = validateData($_POST["task_main_tag"]);
            
                    if(!$deadline) $deadline = NULL;
        
                    $result = Task::save($name, $description, $type, $status, $deadline, $main_tag);

                    if ($result) {
                        $_SESSION['success'] = 'Task Created Successfully';
                        header("Location: /view-task");
                        exit();
                    }else{            
                        $_SESSION['error'] = $stmt->error;
                        header("Location: /view-task");
                        exit();
                    } 
                }	
            }
        
            require "../views/create_task_view.php";
        }

        static function edit_task(){
            $types = Type::all();
            $tags = Tag::all();
            $errors = check_errors();
        
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
                    $name = validateData($_POST["task_name"]);
                    $description = validateData($_POST["task_description"]);
                    $type = validateData($_POST["task_type"]);
                    $deadline = validateData($_POST["task_deadline"]);
                    $main_tag = validateData($_POST["task_main_tag"]);
            
                    if(!$deadline) $deadline = NULL;
            
                    $result = Task::updateAll($name, $description, $type, $deadline, $main_tag, $id);

                    if ($result) {
                        $_SESSION['success'] = 'Task Updated Successfully';
                        header("Location: /view-task");
                        exit();
                    }else{            
                        $_SESSION['error'] = "THERE IS ERROR";
                        header("Location: /edit-task");
                        exit();
                    } 
                }	
            } 
        
            if (isset($_GET['id'])) {
                $result = Task::findById($_GET['id']);

                if ($result) { 
                    $task_name = $result['name'];
                    $task_description = $result['description'];
                    $task_type = $result['type'];
                    $task_deadline  = $result['deadline'];
    
                    if($task_deadline == NULL){
                        $task_deadline = "";
                    }
        
                    $task_main_tag = $result['main_tag'];
                    $task_id = $result['id'];
                }
            }
            require "../views/edit_task_view.php";
        }

        function check_success() {
            $success = null;

            if(isset($_SESSION['success']) && $_SESSION['success'] != ''){
                $success = $_SESSION['success'];
                unset($_SESSION['success']);
            }

            return $success;
        }

        function check_errors() {
            $errors = array();

            if(isset($_SESSION['error']) && $_SESSION['error'] != ''){
                array_push($errors,$_SESSION['error']);
                unset($_SESSION['error']);
            }

            return $errors;
        }
    }
?>