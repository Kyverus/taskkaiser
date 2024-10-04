<?php
require_once '../app/models/Task.php';
require_once '../app/models/Type.php';

    class StatisticsController {
        static function show_summary() {
            $taskCount = StatisticsController::getTasksInfo();
            require_once "../views/statistics_page_view.php";
        }

        static function getTasksInfo(){
            $tasks = Task::all();

            $result = (object) [
                'total' => count($tasks),
                'ongoing' => 0,
                'completed' => 0,
                'overdue' => 0,
                'normal' => 0,
                'timed' => 0,
                'repeatable' => 0,
                'daily' => 0
            ];
        
            foreach($tasks as $task){
                switch($task["status"]){
                    case 0:
                        $result->ongoing++;
                        break;
                    case 1:
                        $result->completed++;
                        break;
                    case 2:
                        $result->overdue++;
                        break;
                }
                switch($task["type"]){
                    case 1:
                        $result->normal++;
                        break;
                    case 2:
                        $result->timed++;
                        break;
                    case 3:
                        $result->repeatable++;
                        break;
                    case 4:
                        $result->daily++;
                        break;
                }
            }

            return $result;
        }
    }
?>