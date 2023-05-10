<?php 
$PageTitle = "View Overdue Tasks"; 
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
<table class="table table-dark">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Description</th>
        <th>Type</th>
        <th>Deadline</th>
        <th>Tags</th>
        <!-- <th>Action</th> -->
    </tr>

<?php 

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()){ 
?>

    <tr>
        <td><?= $row['id']; ?></td>
        <td><?= $row['name']; ?></td>
        <td><?= $row['description']; ?></td>
        <td><?= $row['type']; ?></td>
        <td><?= $row['deadline']; ?></td>
        <td><?= $row['main_tag']; ?></td>
        <!-- <td>
            <form method="post" style="display:inline">
                <input type="hidden" name="id" value="<?=$row['id']; ?>">
                <button class="btn btn-warning" href="#" type="submit" value="revert" name="revert">Revert</button>&nbsp;
            </form>
        </td> -->
    </tr>

<?php 
    } 
}
?>

</table>
</div>

<?php include "templates/footer.php" ?>