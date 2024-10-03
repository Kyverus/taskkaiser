<?php 
$PageTitle = "Index";
include "templates/header.php";
?>
<div>
    <div class="position-fixed fixed-center w-100 bg-danger">
        <div>        
            <h3>TOTAL TASKS: <?=$totalTasks->total?></h3>
            <h3>ONGOING TASKS: <?=$totalTasks->ongoing?></h3>
            <h3>COMPLETED TASKS: <?=$totalTasks->completed?></h3>
            <h3>OVERDUE TASKS: <?=$totalTasks->overdue?></h3>  
        </div>
    </div>
</div>
<?php

include "templates/footer.php" 
?>