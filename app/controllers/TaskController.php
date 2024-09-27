<?php 
require_once "../app/models/validation.php";
require_once "../app/models/Color.php";
require_once '../app/models/Task.php';
require_once '../app/models/Type.php';
require_once '../app/models/Tag.php';

    class TaskController {
        static function checkOverdue(){
            return Task::setAllOverdue();
        }

        static function show_summary() {
            require_once "../views/landing_page_view.php";
        }

        static function show_tasks() {
            Task::setAllOverdue();
            $tasks = Task::findByStatus(0);
            $colors = Color::all();
            $tags = Tag::all();
            $types = Type::all();
            $empty_message_value = "You dont have any current tasks - Take a rest or create tasks!";
            $empty_message = null;
            $success = check_success();
            $errors = check_errors();
            
            if (isset($_GET['status'])) {
                $get_status = $_GET['status'];

                switch($get_status){
                    case 0:
                        $tasks = Task::findByStatus(0);
                        $empty_message_value = "You dont have any current tasks - Take a rest or create tasks!";
                        break;
                    case 1:
                        $tasks = Task::findByStatus(1);
                        $empty_message_value = "You haven't completed any task yet!"; 
                        break;
                    case 2:
                        $tasks = Task::findByStatus(2);
                        $empty_message_value = "Congratulations, You dont have any overdue tasks!";
                        break;
                }
            }

            if (isset($_GET['s'])) {
                $tasks = Task::findByKeyword($_GET['s']);
                $empty_message_value = "No Results Found!"; 
            }

            //MESSAGES
            if(!$tasks){
                $empty_message = $empty_message_value;
            }

            if (isset($_POST['task_complete'])) {
                $id = $_POST["task_id"];
                $category = "status";
                $value = 1;
                $result = Task::updateByCategory($category, $value, $id);

                if ($result) {
                    $_SESSION['success'] = 'Task Completed';
                    headerRefresh(0);
                    exit();
                }else{            
                    $_SESSION['error'] = $stmt->error;
                    headerRefresh(0);
                    exit();
                } 
            } 

            if (isset($_POST['task_revert'])){
                $id = $_POST["task_id"];
                $category = "status";
                $value = 0;
                $result = Task::updateByCategory($category, $value, $id);

                if ($result) {
                    $_SESSION['success'] = 'Task Reverted';
                    headerRefresh(0);
                    exit();
                }else{            
                    $_SESSION['error'] = $stmt->error;
                    headerRefresh(0);
                    exit();
                } 
            } 

            
            if (isset($_POST['task_delete'])) {
                $id = $_POST["task_id"];
                $result = Task::delete($id);

                if($result) {
                    $_SESSION['success'] = 'Task Deleted Successfully'; 
                    headerRefresh(0);
                    exit();
                }else{            
                    $_SESSION['error'] = $stmt->error;
                    headerRefresh(0);
                    exit();
                } 
            } 

            require_once "../views/show_task_view.php";
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