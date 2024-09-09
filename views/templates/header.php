<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= isset($PageTitle) ? $PageTitle : "Default Title"?></title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="assets/custom-css/app.css" rel="stylesheet">
        <link rel="icon" href="assets/icons/notebook-icon.png" type="image/x-icon"/>
    </head>
    <body style = "padding-top: 60px" class="app-bg-dark">
    <?php include "navbar.php"?>