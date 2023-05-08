<?php
require_once "../database/db.php";

$sql = "SELECT * FROM tasks";

$result = $conn->query($sql);

include "../views/show_task_view.php";
?>