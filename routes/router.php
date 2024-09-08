<?php
include "../app/controllers/TagController.php";
include "../app/controllers/TaskController.php";

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

function route($uri) {
    switch($uri){
        case '/':
            TaskController::show_summary();
            break;
        case '/view-task':
            TaskController::show_tasks();
            break;
        case '/view-overdue-task':
            TaskController::show_overdue_tasks();
            break;
        case '/view-completed-task':
            TaskController::show_completed_tasks();
            break;
        case '/create-task':
            TaskController::create_task();
            break;
        case '/create-tag':
            TagController::create_tag();
            break;
        case '/edit-task':
            TaskController::edit_task();
            break;
        default:
            abort();
    }
}

function abort($code = 404){
     http_response_code($code);
     require_once "../views/{$code}.php";
     die();
}


route($uri);
?>