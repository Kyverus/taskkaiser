<?php 
require_once "../app/models/validation.php";
require_once '../app/models/Tag.php';
require_once '../app/models/Color.php';

    class TagController {
        static function show_tags() {
            $tags = TagController::joinInfo(Tag::all());
            return $tags;
        }

        static function joinInfo($input_tags){
            $colors = Color::all();

            $result = array_map(function($tag) use($colors){
                $tag_color = "gray";

                foreach($colors as $color){
                    if($color['id'] == $tag['color']){
                        $tag_color = $color; 
                        break;
                    }
                }  

                $tag["tag_color"] = $tag_color;
                return $tag;
            }, $input_tags);

            return $result;
        }

        static function create_tag() {
            $colors = Color::all();
            $success = TagController::check_success();
            $errors = TagController::check_errors();

            //POST
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                if(empty($_POST["tag_name"])|| empty($_POST["tag_description"])){
                    if(empty($_POST["tag_name"])){
                        array_push($errors,"Name Required");
                    }
                    if(empty($_POST["tag_description"])){
                        array_push($errors,"Description Required");
                    }
                }else{
                    //VALIDATION
                    $name = validateData($_POST["tag_name"]);
                    $description = validateData($_POST["tag_description"]);
                    $color = validateData( $_POST["tag_color"]);

                    $result = Tag::save($name, $description, $color);

                    if ($result) {
                        $_SESSION['success'] = 'Tag Created Successfully';
                        header("Location: /settings");
                        exit();
                    }else{            
                        $_SESSION['error'] = $stmt->error;
                        header("Location: /settings");
                        exit();
                    } 
                }	
            }

            require_once "../views/create_tag_view.php";
        }

        static function edit_tag(){
            $colors = Color::all();
            $errors = TagController::check_errors();
    
            if (isset($_POST['tag_update'])) {
                if(empty($_POST["tag_name"])|| empty($_POST["tag_description"])){
                    if(empty($_POST["tag_name"])){
                        array_push($errors,"Name Required");
                    }
                    if(empty($_POST["tag_description"])){
                        array_push($errors,"Description Required");
                    }
                }else{
                    $id = $_POST["tag_id"];
                    $name = validateData($_POST["tag_name"]);
                    $description = validateData($_POST["tag_description"]);
                    $color = validateData($_POST["tag_color"]);
            
                    $result = Tag::updateAll($name, $description, $color, $id);
    
                    if ($result) {
                        $_SESSION['success'] = 'Tag Updated Successfully';
                        header("Location: /settings");
                        exit();
                    }else{            
                        $_SESSION['error'] = "THERE IS ERROR";
                        header("Location: /edit-tag");
                        exit();
                    } 
                }	
            } 
    
            if (isset($_GET['id'])) {
                $result = Tag::findById($_GET['id']);
    
                if ($result) { 
                    $tag_name = $result['name'];
                    $tag_description = $result['description'];
                    $tag_color = $result['color'];
    
                    $tag_id = $result['id'];
                }
            }
            require "../views/edit_tag_view.php";
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