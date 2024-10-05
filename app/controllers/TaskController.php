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

        static function show_tasks() {
            Task::setAllOverdue();
            $tasks = TaskController::joinInfo(Task::findByStatus(0));
            $empty_message_value = "You dont have any current tasks - Take a rest or create tasks!";
            $empty_message = null;
            $success = TaskController::check_success();
            $errors = TaskController::check_errors();
            
            if (isset($_GET['status'])) {
                $get_status = $_GET['status'];

                switch($get_status){
                    case 0:
                        $tasks = TaskController::joinInfo(Task::findByStatus(0));
                        $empty_message_value = "You dont have any current tasks - Take a rest or create tasks!";
                        break;
                    case 1:
                        $tasks = TaskController::joinInfo(Task::findByStatus(1));
                        $empty_message_value = "You haven't completed any task yet!"; 
                        break;
                    case 2:
                        $tasks = TaskController::joinInfo(Task::findByStatus(2));
                        $empty_message_value = "Congratulations, You dont have any overdue tasks!";
                        break;
                }
            }

            if (isset($_GET['s'])) {
                $tasks = TaskController::joinInfo(Task::findByKeyword($_GET['s']));
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
                $repeating = false;

                if($result){
                    $checkTask = Task::findById($id);
                    if($checkTask["type"] == 3){
                        $repeating = true;
                        $result = Task::save($checkTask["name"], $checkTask["description"], $checkTask["type"], 0, $checkTask["deadline"], $checkTask["main_tag"]);
                    }
                }

                if ($result) {
                    if($repeating){
                        $_SESSION['success'] = 'Task Completed and Recreated';
                    }else{
                        $_SESSION['success'] = 'Task Completed';
                    }
                    
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
            $success = TaskController::check_success();
            $errors = TaskController::check_errors();
        
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
            $errors = TaskController::check_errors();
        
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

        static function joinInfo($input_tasks) {
            $colors = Color::all();
            $tags = Tag::all();
            $types = Type::all();

            $result = array_map(function($task) use($colors, $tags, $types){
                $type_name = "No Type";
                $task_tag = "Tagless";
                $tag_color = "gray";
                $tag_display_color = "Gray";

                foreach($tags as $tag){
                    if($tag['id'] == $task['main_tag']){
                        $task_tag = $tag["name"];
                        foreach($colors as $color){
                            if($color['id'] == $tag['color']){
                                $tag_color = $color["name"]; 
                                $tag_display_color = $color["display_name"]; 
                                break;
                            }
                        }   
                        break;
                    }
                }    
                foreach($types as $type){
                    if($type['id'] == $task['type']){
                        $type_name = $type['name'];
                        break;
                    }
                } 

                $task["type_name"] = $type_name;
                $task["task_tag"] = $task_tag;
                $task["tag_color"] = $tag_color;
                $task["tag_display_color"] = $tag_display_color;

                return $task;
            }, $input_tasks);

            return $result;
        }

        static function check_success() {
            $success = null;

            if(isset($_SESSION['success']) && $_SESSION['success'] != ''){
                $success = $_SESSION['success'];
                unset($_SESSION['success']);
            }

            return $success;
        }

        static function check_errors() {
            $errors = array();

            if(isset($_SESSION['error']) && $_SESSION['error'] != ''){
                array_push($errors,$_SESSION['error']);
                unset($_SESSION['error']);
            }

            return $errors;
        }
    }
?>