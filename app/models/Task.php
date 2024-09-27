<?php
    require_once "../database/db.php";

    class Task {
        static function setAllOverdue(){
            $date = date("Y-m-d");
            $query = "UPDATE tasks SET status = 2 WHERE deadline < :date";
            $param = array("date"=> $date);
            return PDO_EXECUTE($query, $param);    
        }
        static function all(){
            $date = date("Y-m-d");
            $query = "SELECT * FROM tasks";
            $result = PDO_FetchAll($query);
            return $result;
        }
        static function findByKeyword($keyword){
            $word = "%" . $keyword . "%";
            $query = "SELECT * FROM tasks WHERE (name LIKE :word) OR (description LIKE :word)";
            $param = array("word"=> $word);
            $result = PDO_FetchAll($query, $param);
            return $result;
        }

        static function findByStatus($status){
            $query = "SELECT * FROM tasks WHERE status = :status";
            $param = array("status"=> $status);
            $result = PDO_FetchAll($query, $param);
            return $result;
        }
    
        static function findById($id){
            $query = "SELECT * FROM tasks WHERE id = :id";
            $param = array("id"=> $id);
            $result = PDO_FetchRow($query, $param);
            return $result;
        }
    
        static function save($name, $description, $type, $status, $deadline, $main_tag){
    
            $vname = validateData($name);
            $vdescription = validateData($description);
            $vtype = validateData($type);
            $vstatus= 0;
            $vdeadline = validateData($deadline);
            $vmain_tag = validateData($main_tag);
    
            if(!$vdeadline) $vdeadline = NULL;
    
            $query = "INSERT INTO tasks(name, description, type, status, deadline, main_tag) VALUES (:name,:description,:type,:status,:deadline,:main_tag)";
            $param = array("name"=>$vname, "description"=>$vdescription, "type"=>$vtype, "status"=> $status, "deadline"=> $vdeadline, "main_tag"=>$vmain_tag);
            
            return PDO_EXECUTE($query, $param);
        }
    
        static function updateAll($name, $description, $type, $deadline, $main_tag, $id){
    
            $query = "UPDATE tasks SET name = :name, description = :description, type = :type, deadline = :deadline, main_tag = :main_tag WHERE id = :id";
            $param = array("name"=>$name, "description"=>$description, "type"=>$type,"deadline"=> $deadline, "main_tag"=>$main_tag, "id"=>$id);

            return PDO_EXECUTE($query, $param);    
        }

        static function updateByCategory($category, $value, $id) {
            $query = "";
            switch($category) {
                case 'name':
                    $query = "UPDATE tasks SET name = :value WHERE id = :id";
                    break;
                case 'description':
                    $query = "UPDATE tasks SET description = :value WHERE id = :id";
                    break;
                case 'type':
                    $query = "UPDATE tasks SET type = :value WHERE id = :id";
                    break;
                case 'status':
                    $query = "UPDATE tasks SET status = :value WHERE id = :id";
                    break;
                case 'deadline':
                    $query = "UPDATE tasks SET deadline = :value WHERE id = :id";
                    break;
                case 'main_tag':
                    $query = "UPDATE tasks SET main_tag = :value WHERE id = :id";
                    break;
                default:
                    return;
            }
            $param = array("value" => $value, "id"=> $id);
            
            return PDO_EXECUTE($query, $param);
        }
    
        static function delete($id){
    
            $query = "DELETE FROM tasks WHERE id = :id";
            $param = array("id"=> $id);
            
            return PDO_EXECUTE($query, $param);   
        }

        static function errorInfo(){
            return PDO_ErrorInfo();
        }
    }
   
?>