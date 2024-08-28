<?php
    require_once "../app/class/validation.php";
    require_once "../database/db.php";

    function get_tags(){
        $query = "SELECT * FROM tags";
        $result = PDO_FetchAll($query);
        return $result;
    }

    function save_tag($name, $description, $color){

        $vname = validateData($name);
        $vdescription = validateData($description);
        $vcolor = validateData($color);

        $query = "INSERT INTO tags(name, description, color) VALUES (:name,:description,:color)";
        $param = array("name"=> $vname, "description"=> $vdescription, "color" => $vcolor);
        
        if (PDO_EXECUTE($query, $param)) {
            $_SESSION['success'] = 'Tag Created Successfully';
            redirect_to('/create-tag');
            exit();
        }else{            
            $_SESSION['error'] = $stmt->error;
            redirect_to('/create-tag');
            exit();
        } 
    }
?>

