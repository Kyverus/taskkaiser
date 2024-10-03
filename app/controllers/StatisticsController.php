<?php
require_once '../app/models/Task.php';
require_once '../app/models/Type.php';

    class StatisticsController {
        static function show_summary() {
            $totalTasks = StatisticsController::getTasksInfo();
            require_once "../views/statistics_page_view.php";
        }

        static function getTasksInfo(){
            $tasks = Task::all();
            $total = count($tasks);
            $ongoing = 0;
            $completed = 0;
            $overdue = 0;
            
            foreach($tasks as $task){
                switch($task["status"]){
                    case 0:
                        $ongoing++;
                        break;
                    case 1:
                        $completed++;
                        break;
                    case 2:
                        $overdue++;
                        break;
                }
            }

            return (object) [
                'total' => $total,
                'ongoing' => $ongoing,
                'completed' => $completed,
                'overdue' => $overdue,
            ];  
        }
    }
?>