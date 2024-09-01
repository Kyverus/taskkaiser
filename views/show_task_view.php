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
        <th>ID</th>
        <th>Name</th>
        <th>Description</th>
        <th>Type</th>
        <th>Deadline</th>
        <th>Tags</th>
        <th>Action</th>
    </tr>

<?php 
    foreach($tasks as $task){ 
?>

    <tr>
        <td><?= $task['id']; ?></td>
        <td><?= $task['name']; ?></td>
        <td><?= $task['description']; ?></td>
        <?php 
            foreach($types as $type){
                if($type['id'] == $task['type']){
                    ?> <td> <?=$type['name']; ?> </td> <?php
                    break;
                }
            } 
        ?>
        <td><?= $task['deadline']; ?></td>
        <?php 
            foreach($tags as $tag){
                if($tag['id'] == $task['main_tag']){
                    ?> <td> <?=$tag['name']; ?> </td> <?php
                    break;
                }
            } 
        ?>
        <td>
            <form method="post" style="display:inline">
                <input type="hidden" name="task_id" value="<?=$task['id']; ?>">
                <?php 
                    switch($task['status']){
                        case 0:
                            ?> <button class="btn btn-success" href="#" type="submit" value="task_complete" name="task_complete">Complete</button>&nbsp; <?php
                            break;
                        case 1:
                            ?> <button class="btn btn-warning" href="#" type="submit" value="task_revert" name="task_revert">Revert</button>&nbsp; <?php
                            break;
                    }
                ?>
                <a class="btn btn-info" href="/edit-task?id=<?php echo $task['id']; ?>">Edit</a>&nbsp;
                <button class="btn btn-danger" href="#" type="submit" value="task_delete" name="task_delete">Delete</button>
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