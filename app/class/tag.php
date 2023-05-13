<?php
    require_once "../app/class/validation.php";
    require_once "../database/db.php";

    function get_tags(){
        $conn = dbconnect();
        $sql = "SELECT * FROM tags";
        $result = $conn->query($sql);
    
        return $result;
    }

    function save_tag($name, $description, $color){
        $conn = dbconnect();

        $vname = validateData($name);
        $vdescription = validateData($description);
        $vcolor = validateData($color);

        $stmt = $conn->prepare("INSERT INTO tags(name, description, color) VALUES (?,?,?)");
        $stmt->bind_param('ssi',$vname,$vdescription,$vcolor);
        
        if ($stmt->execute()) {
            $_SESSION['success'] = 'Tag Created Successfully';
            
            $stmt->close();
            $conn->close(); 

            header('Location: /create-tag');
            exit();
        }else{            
            $_SESSION['error'] = $stmt->error;
            
            $stmt->close();
            $conn->close(); 

            header('Location: /create-tag');
            exit();
        } 

        $result = $stmt->get_result(); //might not be reached
    }
?>

