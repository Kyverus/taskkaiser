<?php
    $path = 'data/settings.json';
    $readJSON = file_get_contents($path);
    $settings = json_decode($readJSON, true);
    $body_theme = "app-light";
    if($settings["theme"] == "dark"){
        $body_theme = "app-dark";
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= isset($PageTitle) ? $PageTitle : "Default Title"?></title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="assets/custom-css/app.css" rel="stylesheet">
        <link href="assets/custom-css/lightmode.css" rel="stylesheet">
        <link href="assets/custom-css/darkmode.css" rel="stylesheet">
        <link rel="icon" href="assets/icons/notebook-icon.png" type="image/x-icon"/>
        <script src="js/chart.umd.js"></script>
        <script src='/data/settings.json'></script>
    </head>
    <body class="<?=$body_theme?>">