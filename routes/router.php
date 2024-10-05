<?php
include "../app/controllers/TagController.php";
include "../app/controllers/TaskController.php";
include "../app/controllers/StatisticsController.php";
include "../app/controllers/SettingsController.php";

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

function route($uri) {
    switch($uri){
        case '/':
            StatisticsController::show_summary();
            break;
        case '/view-task':
            TaskController::show_tasks();
            break;
        case '/create-task':
            TaskController::create_task();
            break;
        case '/edit-task':
            TaskController::edit_task();
            break;
        case '/create-tag':
            TagController::create_tag();
            break;
        case '/edit-tag':
            TagController::edit_tag();
            break;
        case '/settings':
            SettingsController::show_settings();
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

function headerRefresh($delay){
    header("Refresh: $delay");
}

route($uri);
?>