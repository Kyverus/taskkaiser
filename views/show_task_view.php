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
<table class="table table-dark">
    <tr>
        <th style="width:43%">Name</th>
        <th style="width:10%">Type</th>
        <th style="width:12%">Deadline</th>
        <th style="width:10%">Tags</th>
        <th style="width:25%"></th>
    </tr>

<?php 
    foreach($tasks as $task){ 
?>
    <tr key="<?=$task['id']?>">
        <td><?= $task['name']; ?> 
    </td>
        <?php 
            foreach($types as $type){
                if($type['id'] == $task['type']){
                    ?> <td> <?=$type['name']; ?> </td> <?php
                    break;
                }
            } 
        ?>
        <td class="text-center"><?= ($task['deadline'] == "") ? "-" : $task['deadline'] ?></td>
        <?php 
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
        ?>
        <td> 
            <span class="badge rounded-pill" style="background-color:<?=$tag_color['name']?>"><?=$task_tag['name']; ?></span> 
        </td>
        <td>
            <form method="post" style="display:inline">
                <input type="hidden" name="task_id" value="<?=$task['id']; ?>">
                <span class="btn border text-white border-3 border-info" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-title="Task Description" data-bs-content="<?=$task['description']?>"> 
                    <img src="assets/icons/info-circle.svg"/> 
                </span>
                <?php 
                    switch($task['status']){
                        case 0:
                            ?>  <button class="btn border text-white border-3 border-success" href="#" type="submit" value="task_complete" name="task_complete">
                                    <img src="assets/icons/check-circle.svg"/> 
                                    <!-- Complete -->
                                </button><?php
                            break;
                        case 1:
                            ?>  <button class="btn border text-white border-3 border-warning" href="#" type="submit" value="task_revert" name="task_revert"> 
                                    <img src="assets/icons/x-circle.svg"/> 
                                    <!-- Revert -->
                                </button><?php
                            break;
                    }
                ?>
                <a class="btn border text-white border-3  border-warning" href="/edit-task?id=<?php echo $task['id']; ?>">
                    <img src="assets/icons/pencil-square.svg"/> 
                    <!-- Edit -->
                </a>

                <button class="btn border text-white border-3  border-danger" href="#" type="submit" value="task_delete" name="task_delete">
                    <img src="assets/icons/trash.svg"/>
                    <!-- Delete -->
                </button>
            </form>
        </td>
    </tr>

<?php 
    }
?>
    </table>
<?php 
}
?>
</div>

<?php include "templates/footer.php" ?>