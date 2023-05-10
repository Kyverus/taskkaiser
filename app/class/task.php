<?php
    require_once "../app/class/validation.php";
    require_once "../database/db.php";

    function save_task($name, $description, $type, $status, $deadline, $main_tag){
        $conn = dbconnect();

        $vname = validateData($name);
        $vdescription = validateData($description);
        $vtype = validateData($type);
        $vstatus= 0;
        $vdeadline = validateData($deadline);
        $vmain_tag = validateData($main_tag);

        if(!$vdeadline) $vdeadline = NULL;

        $stmt = $conn->prepare("INSERT INTO tasks(name, description, type, status, deadline, main_tag) VALUES (?,?,?,?,?,?)");
        $stmt->bind_param('ssiisi',$vname,$vdescription,$vtype,$vstatus,$vdeadline,$vmain_tag);
        
        if ($stmt->execute()) {
            $_SESSION['success'] = 'Task Created Successfully';
            
            $stmt->close();
            $conn->close(); 

            header('Location: /create-task');
            exit();
        }else{            
            $_SESSION['error'] = $stmt->error;
            
            $stmt->close();
            $conn->close(); 

            header('Location: /create-task');
            exit();
        } 

        $result = $stmt->get_result(); //might not be reached
    }

    function view_tasks(){
        $conn = dbconnect();
        $date = date("Y/m/d");
        $sql = "SELECT * FROM tasks WHERE status = 0 AND (deadline > '$date' OR deadline IS NULL)";
        $result = $conn->query($sql);

        return $result;
    }

    function view_overdue_tasks(){
        $conn = dbconnect();
        $date = date("Y/m/d");
        $sql = "SELECT * FROM tasks WHERE status = 0 AND (deadline < '$date')";
        $result = $conn->query($sql);

        return $result;
    }

    function view_completed_tasks(){
        $conn = dbconnect();

        $sql = "SELECT * FROM tasks WHERE status = 1";
        $result = $conn->query($sql);

        return $result;
    }

    function revert_task($id){
        $conn = dbconnect();
        $status = 0;

        $stmt = $conn->prepare("Update tasks SET status = ? WHERE id = ?");
		$stmt->bind_param('ii',$status,$id);

        if ($stmt->execute()) {
            $_SESSION['success'] = 'Task Completed';
            
            $stmt->close();
            $conn->close(); 

            header('Location: /view-completed-task');
            exit();
        }else{            
            $_SESSION['error'] = $stmt->error;
            
            $stmt->close();
            $conn->close(); 

            header('Location: /view-completed-task');
            exit();
        } 

        $result = $stmt->get_result(); //might not be reached
    }

    function complete_task($id){
        $conn = dbconnect();
        $status = 1;

        $stmt = $conn->prepare("Update tasks SET status = ? WHERE id = ?");
		$stmt->bind_param('ii',$status,$id);

        if ($stmt->execute()) {
            $_SESSION['success'] = 'Task Completed';
            
            $stmt->close();
            $conn->close(); 

            header('Location: /view-task');
            exit();
        }else{            
            $_SESSION['error'] = $stmt->error;
            
            $stmt->close();
            $conn->close(); 

            header('Location: /view-task');
            exit();
        } 

        $result = $stmt->get_result(); //might not be reached
    }

    function update_task($name, $description, $type, $deadline, $main_tag, $id){
        $conn = dbconnect();

        $vname = validateData($name);
        $vdescription = validateData($description);
        $vtype = validateData($type);
        $vdeadline = validateData($deadline);
        $vmain_tag = validateData($main_tag);

        if(!$vdeadline) $vdeadline = NULL;

        $stmt = $conn->prepare("UPDATE tasks SET name = ?, description = ?, type = ?, deadline = ?, main_tag = ? WHERE id = ?");
        $stmt->bind_param('ssisii',$vname,$vdescription,$vtype,$vdeadline,$vmain_tag,$id);
        
        if ($stmt->execute()) {
            $_SESSION['success'] = 'Task Updated Successfully';
            
            $stmt->close();
            $conn->close(); 

            header('Location: /view-task');
            exit();
        }else{            
            $_SESSION['error'] = $stmt->error;
            
            $stmt->close();
            $conn->close(); 

            header('Location: /edit-task?id='.$id);
            exit();
        } 

        $result = $stmt->get_result(); //might not be reached
    }

    function get_task_by_id($id){
        $conn = dbconnect();

        $stmt = $conn->prepare("SELECT * FROM tasks WHERE id = ?");
		$stmt->bind_param('i',$id);

        $stmt->execute();

        $result = $stmt->get_result();

        return $result;
    }

    function delete_task($id){
        $conn = dbconnect();

        $stmt = $conn->prepare("DELETE FROM tasks WHERE id = ?");
		$stmt->bind_param('i',$id);

        if ($stmt->execute()) {
            $_SESSION['success'] = 'Task Deleted Successfully';
            
            $stmt->close();
            $conn->close(); 

            header('Location: /view-task');
            exit();
        }else{            
            $_SESSION['error'] = $stmt->error;
            
            $stmt->close();
            $conn->close(); 

            header('Location: /view-task');
            exit();
        } 

        $result = $stmt->get_result(); //might not be reached
    }

?>