<?php 
$PageTitle = "View Tasks"; 
include "templates/header.php" ?>

<nav id="task-nav" class="fixed-top bg-dark bg-body-tertiary " data-bs-theme="dark">
    <div class="container-fluid">
        <div class="d-flex flex-grow-1 py-2 position-relative justify-content-center" role="group">
            <a class="menu-link" href="/view-task?status=1">Completed</a>
            <a class="menu-link" href="/view-task?status=0">Ongoing</a>
            <a class="menu-link" href="/view-task?status=2">Overdue</a>
            <a class="position-absolute end-0 top-0" type="button" data-bs-toggle="collapse" data-bs-target="#search-collapse" aria-controls="search-collapse" aria-expanded="false" aria-label="Toggle navigation">
                <img class="menu-icon d-inline-block align-middle mt-3 me-1" src="assets/icons/menu/search.svg"/>
            </a>
        </div>
        <div class="collapse w-100 block" id="search-collapse">
            <div class="d-flex pt-2 pb-3" role="search">
                <input class="form-control me-2" id="search_input" type="search" placeholder="Search" aria-label="Search">
                <button class="btn" id="search-button" onclick="search()">Search</button>
            </div>
        </div>
    </div>
</nav>

<div class="floating-button rounded-circle">
    <a href="/create-task">
        <img class="floating-button-icon align-middle m-2" src="assets/icons/tasks/task-list-add.svg"/>
    </a>
</div>


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
        $task_border = "";
        $deadline_bg = "";

        if($task['status'] == 1){
            $task_border = " border border-2 border-success";
            $deadline_bg = " bg-success";
        }

        if($task['status'] == 2){
            $task_border = " border border-2 border-danger";
            $deadline_bg = " bg-danger";
        }

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
                $type_name = $type['name'];
                break;
            }
        } 
?>
    <div class="<?='task-item d-flex w-100 px-2 py-3 my-4 rounded-4'.$task_border ?>" key="<?=$task['id']?>">
        <div class="d-flex ps-2 pe-4 align-items-center">
            <span class="btn border-2 btn-outline-info rounded-pill" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-title="<?='Type: '.$type_name?>" data-bs-placement="left" data-bs-content="<?=$task['description']?>"> 
            <?php
                switch($task['type']){
                    case 1:
                        ?> <img class="task-icon d-inline-block align-middle" src="assets/icons/tasks/clipboard2-check.svg"/> <?php
                        break;
                    case 2:
                        ?> <img class="task-icon d-inline-block align-middle" src="assets/icons/tasks/clock.svg"/> <?php
                        break;
                    case 3:
                        ?> <img class="task-icon d-inline-block align-middle" src="assets/icons/tasks/repeat.svg"/> <?php
                        break;
                    case 4:
                        ?> <img class="task-icon d-inline-block align-middle" src="assets/icons/tasks/calendar-check.svg"/> <?php
                        break;
                }
            ?>
            </span>  
        </div>
        <div class="flex-grow-1 text-white">
            <div>
                <span class="me-2"> <?= $task['name']; ?> <span> 
            </div>
            <div>
                <span class="badge rounded-pill" style="background-color:<?=$tag_color['name']?>"><?=$task_tag['name']; ?></span> 
                <?php
                    if($task['deadline'] != ""){
                        ?> <span class="<?='px-2 text-center'.$deadline_bg?>"><?= $task['deadline'] ?></span> <?php
                    }
                ?>
                
            </div>
        </div>
        <form method="post" class="d-flex align-items-center">
            <input type="hidden" name="task_id" value="<?=$task['id']; ?>">

            <span class="mx-1 btn border-2 btn-outline-info" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-title="Task Description" data-bs-content="<?=$task['description']?>"> 
                <img class="task-icon d-inline-block align-middle" src="assets/icons/tasks/info-circle.svg"/> 
            </span>   

            <?php 
                switch($task['status']){
                    case 0:
                        ?>  <button class="mx-1 btn border-2 btn-outline-success" href="#" type="submit" value="task_complete" name="task_complete">
                                <img class="task-icon d-inline-block align-middle" src="assets/icons/tasks/check-circle.svg"/> 
                                <!-- Complete -->
                            </button><?php
                        break;
                    case 1:
                        ?>  <button class="mx-1 btn border-2 btn-outline-warning" href="#" type="submit" value="task_revert" name="task_revert"> 
                                <img class="task-icon d-inline-block align-middle" src="assets/icons/tasks/x-circle.svg"/> 
                                <!-- Revert -->
                            </button><?php
                        break;
                }
            ?>
            <a class="mx-1 btn border-2 btn-outline-warning" href="/edit-task?id=<?php echo $task['id']; ?>">
                <img class="task-icon d-inline-block align-middle" src="assets/icons/tasks/pencil-square.svg"/> 
                <!-- Edit -->
            </a>

            <button class="mx-1 btn border-2 btn-outline-danger" href="#" type="submit" value="task_delete" name="task_delete">
                <img class="task-icon d-inline-block align-middle" src="assets/icons/tasks/trash.svg"/>
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

