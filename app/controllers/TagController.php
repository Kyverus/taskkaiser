<?php 
require_once "../app/models/validation.php";
require_once '../app/models/Tag.php';
require_once '../app/models/Color.php';

    class TagController {
        static function show_tags() {

            $tags = Tag::all();
            require_once "../views/show_tags_view.php";
        }

        static function create_tag() {
            $colors = Color::all();
            $success = check_success();
            $errors = check_errors();

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

                    Tag::save($name, $description, $color);
                }	
            }

            require_once "../views/create_tag_view.php";
        }
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
?>