<?php
    require_once "../database/db.php";

    class Task {
        static function all(){
            $date = date("Y-m-d");
            $query = "SELECT * FROM tasks WHERE status = 0 AND (deadline > :date OR deadline IS NULL)";
            $param = array("date"=> $date);
            $result = PDO_FetchAll($query, $param);
            return $result;
        }
    
        static function allOverdue(){
            $date = date("Y-m-d");
            $query = "SELECT * FROM tasks WHERE status = 0 AND (deadline < :date)";
            $param = array("date"=> $date);
            $result = PDO_FetchAll($query, $param);
    
            return $result;
        }
    
        static function allCompleted(){
            $query = "SELECT * FROM tasks WHERE status = 1";
            $result = PDO_FetchAll($query);
    
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
            $query = "Update tasks SET :category = :value WHERE id = :id";
            $param = array("category"=> $category, "value" => $value, "id"=> $id);
            
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