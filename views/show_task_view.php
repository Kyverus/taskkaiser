<?php 
$PageTitle = "View Tasks"; 
include "templates/header.php" ?>

<div class="alert-display">
	<?php
		if($success){
	?>
		<div class="alert alert-success alert-dismissible fade show" role="alert">
				<strong>Success: </strong> <?=$success?>
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>
	<?php
		}
		
	?>
	<?php
		if($errors){
			foreach($errors as $error){ 
	?>
				<div class="alert alert-danger alert-dismissible fade show" role= "alert">
					<strong>Error: </strong> <?=$error?>
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>
	<?php
			}
		}
	?>
    <?php
		if($empty_message){
    ?>
        <div class="alert alert-info alert-dismissible fade show" role="alert">
                <strong>Message: </strong> <?=$empty_message?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php
		}
	?>
</div>

<div class="container">
<?php
if ($tasks) {
?>
    <div class="task-list my-3">
<?php
    foreach($tasks as $task){ 
        $type_name = "none";
        $task_tag = "none";
        $tag_color = "gray";

        foreach($tags as $tag){
            if($tag['id'] == $task['main_tag']){
                $task_tag = $tag;
                foreach($colors as $color){
                    if($color['id'] == $tag['color']){
                        $tag_color = $color; 
                        break;
                    }
                }   
                break;
            }
        }     

        foreach($types as $type){
            if($type['id'] == $task['type']){
                break;
            }
        } 
?>
    <div class="task-item d-flex w-100 px-2 py-3 my-4 rounded-4 " key="<?=$task['id']?>">
        <div class="d-flex ps-2 pe-4 align-items-center">
            <span class="btn border-2 btn-outline-info rounded-pill" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-title="Task Description" data-bs-placement="left" data-bs-content="<?=$task['description']?>"> 
                <img class="task-icon d-inline-block align-middle" src="assets/icons/clipboard2-check.svg"/> 
            </span>  
        </div>
        <div class="flex-grow-1 text-white">
            <div>
                <span class="me-2"> <?= $task['name']; ?> <span> 
                <span class="text-center"><?= ($task['deadline'] == "") ? "" : $task['deadline'] ?></span>
            </div>
            <span> <?=$type['name']; ?> </span>
            <span class="badge rounded-pill" style="background-color:<?=$tag_color['name']?>"><?=$task_tag['name']; ?></span> 
        </div>
        <form method="post" class="d-flex align-items-center">
            <input type="hidden" name="task_id" value="<?=$task['id']; ?>">

            <span class="mx-1 btn border-2 btn-outline-info" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-title="Task Description" data-bs-content="<?=$task['description']?>"> 
                <img class="task-icon d-inline-block align-middle" src="assets/icons/info-circle.svg"/> 
            </span>   

            <?php 
                switch($task['status']){
                    case 0:
                        ?>  <button class="mx-1 btn border-2 btn-outline-success" href="#" type="submit" value="task_complete" name="task_complete">
                                <img class="task-icon d-inline-block align-middle" src="assets/icons/check-circle.svg"/> 
                                <!-- Complete -->
                            </button><?php
                        break;
                    case 1:
                        ?>  <button class="mx-1 btn border-2 btn-outline-warning" href="#" type="submit" value="task_revert" name="task_revert"> 
                                <img class="task-icon d-inline-block align-middle" src="assets/icons/x-circle.svg"/> 
                                <!-- Revert -->
                            </button><?php
                        break;
                }
            ?>
            <a class="mx-1 btn border-2 btn-outline-warning" href="/edit-task?id=<?php echo $task['id']; ?>">
                <img class="task-icon d-inline-block align-middle" src="assets/icons/pencil-square.svg"/> 
                <!-- Edit -->
            </a>

            <button class="mx-1 btn border-2 btn-outline-danger" href="#" type="submit" value="task_delete" name="task_delete">
                <img class="task-icon d-inline-block align-middle" src="assets/icons/trash.svg"/>
                <!-- Delete -->
            </button>
        </form>
    </div>
<?php 
    }
?>
    </div>
<?php 
}
?>
</div>

<?php include "templates/footer.php" ?>