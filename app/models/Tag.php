<?php
    require_once "../database/db.php";

    class Tag{
        static function all(){
            $query = "SELECT * FROM tags";
            $result = PDO_FetchAll($query);
            return $result;
        }

        static function findById($id) {
            $query = "SELECT * FROM tags WHERE id = :id";
            $params = array("id"=>$id);

            $result = PDO_FetchRow($query, $params);
            return $result;
        }
    
        static function save($name, $description, $color){
    
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
    }   
?>

