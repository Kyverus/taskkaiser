<?php 
$PageTitle = "View Tasks"; 
include "templates/header.php" ?>

<div class="container">
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
        <td>
            <a class="btn btn-success" href="update.php?id=<?php echo $row['id']; ?>">Complete</a>&nbsp;
            <a class="btn btn-info" href="update.php?id=<?php echo $row['id']; ?>">Edit</a>&nbsp;
            <a class="btn btn-danger" href="delete.php?id=<?php echo $row['id']; ?>">Delete</a>
        </td>
    </tr>

<?php 
    } 
}
?>

</table>
</div>

<?php include "templates/footer.php" ?>