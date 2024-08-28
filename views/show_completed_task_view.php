<?php 
$PageTitle = "View Completed Tasks"; 
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
		if($emptyinfo){
    ?>
        <div class="alert alert-info alert-dismissible fade show" role="alert">
                <strong>Message: </strong> <?=$emptyinfo?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php
		}
	?>
</div>

<div class="container">
<?php
if ($completed_tasks) {
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
    foreach($completed_tasks as $task){ 
?>

        <tr>
            <td><?= $task['id']; ?></td>
            <td><?= $task['name']; ?></td>
            <td><?= $task['description']; ?></td>
            <td><?= $task['type']; ?></td>
            <td><?= $task['deadline']; ?></td>
            <td><?= $task['main_tag']; ?></td>
            <td>
                <form method="post" style="display:inline">
                    <input type="hidden" name="task_id" value="<?=$task['id']; ?>">
                    <button class="btn btn-warning" href="#" type="submit" value="task_revert" name="task_revert">Revert</button>&nbsp;
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