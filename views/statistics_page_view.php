<?php 
$PageTitle = "Index";
include "templates/header.php";
?>
<div>
    <div class="position-fixed fixed-center w-100 d-flex justify-content-center shadow-sm" id="statistics-card">
        <div class="d-flex flex-column justify-content-center px-2" style="width: 400px">        
            <h4>TOTAL TASKS: <?=$taskCount->total?></h4>
            <h4>ONGOING TASKS: <?=$taskCount->ongoing?></h4>
            <h4>COMPLETED TASKS: <?=$taskCount->completed?></h4>
            <h4>OVERDUE TASKS: <?=$taskCount->overdue?></h4>  
        </div>
        <div class="d-flex align-items-center">
            <div class="w-100">
                <canvas id="type-chart" class=""></canvas>
            </div>
        </div>
    </div>
</div>
<script> 
let theme = <?php echo json_encode($settings["theme"]); ?>;
let labelColor = '#000000';
if(theme == "dark"){
    labelColor = '#ffffff';
}
let taskInfo = <?php echo json_encode($taskCount); ?>;
var colors = ['#1a8acb','#e37ef7', '#29c274','#ebbd47', '#f47c7c','#f7af7e'];

var customOptions = {
    maintainAspectRatio: false,
    plugins: {
        legend: {
            display: true,
            position:'bottom', 
            labels: {pointStyle:'circle', 
                usePointStyle:true,
                color: labelColor
            },
        },
    }
};

var typeData = {
    labels: ['Normal', 'Timed', 'Repeatable', 'Daily'],
    datasets: [
      {
        backgroundColor: colors.slice(0,4),
        borderWidth: 0,
        data: [taskInfo.normal, taskInfo.timed, taskInfo.repeatable, taskInfo.daily]
      }
    ]
};

var typeChart = document.getElementById("type-chart");
if (typeChart) {
  new Chart(typeChart, {
      type: 'doughnut',
      data: typeData,
      options: customOptions
  });
}

</script>

<?php
include "templates/footer.php" 
?>