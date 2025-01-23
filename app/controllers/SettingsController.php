<?php
    require_once '../app/models/Tag.php';
    require_once '../app/models/Task.php';
    require_once '../app/models/Color.php';
    require_once "../app/controllers/TagController.php";

    class SettingsController {
        static function show_settings(){
            $tags = TagController::show_tags();
            $success = SettingsController::check_success();
            $errors = SettingsController::check_errors();

            if (isset($_POST['toggle_theme'])) {
                $path = 'data/settings.json';
                $readJSON = file_get_contents($path);
                $settings = json_decode($readJSON, true);
                $theme = "dark";

                if($settings["theme"] == "dark"){
                    $theme = "light";
                }

                $newSettings = ["theme"=>$theme, "language"=>$settings["language"], "autodelete"=>$settings["autodelete"] ];
                $writeJSON = json_encode($newSettings, JSON_PRETTY_PRINT);
                $fp = fopen($path, 'w');
                $result = fwrite($fp, $writeJSON);
                fclose($fp);

                if (!$result) {
                    $_SESSION['error'] = "Error occured: Something went wrong";
                    headerRefresh(0);
                    exit();
                }
            } 

            if (isset($_POST['auto_delete'])) {
                $path = 'data/settings.json';
                $readJSON = file_get_contents($path);
                $settings = json_decode($readJSON, true);
                $autodelete = false;

                if(!$settings["autodelete"]){
                    $autodelete = true;
                }

                $newSettings = ["theme"=>$settings["theme"], "language"=>$settings["language"], "autodelete"=>$autodelete];
                $writeJSON = json_encode($newSettings, JSON_PRETTY_PRINT);
                $fp = fopen($path, 'w');
                $result = fwrite($fp, $writeJSON);
                fclose($fp);

                if (!$result) {
                    $_SESSION['error'] = "Error occured: Something went wrong";
                    headerRefresh(0);
                    exit();
                }
            } 

            if (isset($_POST['tag_delete'])) {
                $id = $_POST["tag_id"];
                $result = Tag::delete($id);

                if($result){
                    $result = Task::updateTags($id, 0);
                }

                if($result) {
                    $_SESSION['success'] = 'Tag Deleted Successfully'; 
                    headerRefresh(0);
                    exit();
                }else{            
                    $_SESSION['error'] = $stmt->error;
                    headerRefresh(0);
                    exit();
                } 
            } 

            require_once "../views/settings_page_view.php";
        }

        static function show_about(){
            require_once "../views/about_page_view.php";
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