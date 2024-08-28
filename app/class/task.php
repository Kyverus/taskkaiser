<?php
    require_once "../app/class/validation.php";
    require_once "../database/db.php";

    function get_tasks(){
        $date = date("Y/m/d");
        $query = "SELECT * FROM tasks WHERE status = 0 AND (deadline > '$date' OR deadline IS NULL)";
        $result = PDO_FetchAll($query);
        return $result;
    }

    function get_overdue_tasks(){
        $date = date("Y/m/d");
        $query = "SELECT * FROM tasks WHERE status = 0 AND (deadline < '$date')";
        $result = PDO_FetchAll($query);

        return $result;
    }

    function get_completed_tasks(){
        $query = "SELECT * FROM tasks WHERE status = 1";
        $result = PDO_FetchAll($query);

        return $result;
    }

    function get_task_by_id($id){
        $query = "SELECT * FROM tasks WHERE id = :id";
        $param = array("id"=> $id);
        $result = PDO_FetchAll($query, $param);
        return $result;
    }

    function complete_task($id){
        $status = 1;

        $query = "Update tasks SET status = :status WHERE id = :id";
        $param = array("status"=> $status, "id"=> $id);

        if (PDO_EXECUTE($query, $param)) {
            $_SESSION['success'] = 'Task Completed';
            redirect_to('/view-task');
            exit();
        }else{            
            $_SESSION['error'] = $stmt->error;
            redirect_to('/view-task');
            exit();
        } 
    }

    function revert_task($id){
        $status = 0;

        $query = "Update tasks SET status = :status WHERE id = :id";
        $param = array("status"=> $status, "id"=> $id);

        if (PDO_EXECUTE($query, $param)) {
            $_SESSION['success'] = 'Task Reverted';
            redirect_to('/view-completed-task');
            exit();
        }else{            
            $_SESSION['error'] = $stmt->error;
            redirect_to('/view-completed-task');
            exit();
        } 
    }

    function save_task($name, $description, $type, $status, $deadline, $main_tag){

        $vname = validateData($name);
        $vdescription = validateData($description);
        $vtype = validateData($type);
        $vstatus= 0;
        $vdeadline = validateData($deadline);
        $vmain_tag = validateData($main_tag);

        if(!$vdeadline) $vdeadline = NULL;

        $query = "INSERT INTO tasks(name, description, type, status, deadline, main_tag) VALUES (:name,:description,:type,:status,:deadline,:main_tag)";
        $param = array("name"=>$vname, "description"=>$vdescription, "type"=>$vtype, "status"=> $status, "deadline"=> $vdeadline, "main_tag"=>$vmain_tag);
        
        if (PDO_EXECUTE($query, $param)) {
            $_SESSION['success'] = 'Task Created Successfully';
            redirect_to('/show-task');
            exit();
        }else{            
            $_SESSION['error'] = $stmt->error;
            redirect_to('/show-task');
            exit();
        } 
    }

    function update_task($name, $description, $type, $deadline, $main_tag, $id){

        $vname = validateData($name);
        $vdescription = validateData($description);
        $vtype = validateData($type);
        $vdeadline = validateData($deadline);
        $vmain_tag = validateData($main_tag);

        if(!$vdeadline) $vdeadline = NULL;

        $query = "UPDATE tasks SET name = :name, description = :description, type = :type, deadline = :deadline, main_tag = :main_tag WHERE id = :id";
        $param = array("name"=>$vname, "description"=>$vdescription, "type"=>$vtype,"deadline"=> $vdeadline, "main_tag"=>$vmain_tag, "id"=>$id);
        
        if (PDO_EXECUTE($query, $param)) {
            $_SESSION['success'] = 'Task Updated Successfully';
            redirect_to('/view-task');
            exit();
        }else{            
            $_SESSION['error'] = $stmt->error;
            redirect_to('/edit-task?id='.$id);
            exit();
        } 
    }

    function delete_task($id){

        $query = "DELETE FROM tasks WHERE id = :id";
        $param = array("id"=> $id);

        if (PDO_EXECUTE($query, $param)) {
            $_SESSION['success'] = 'Task Deleted Successfully';
            redirect_to('/view-task');
            exit();
        }else{            
            $_SESSION['error'] = $stmt->error;
            redirect_to('/view-task');
            exit();
        } 

    }
?>