<?php
    $path = 'data/settings.json';
    $readJSON = file_get_contents($path);
    $settings = json_decode($readJSON, true);
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
        <script>
            window.onload = function () {
                const settings = <?php echo json_encode($settings) ?>;
                if(settings.theme == "dark"){
                    document.body.classList.add("app-dark");
                    document.body.classList.remove("app-light");
                }else{
                    document.body.classList.add("app-light");
                    document.body.classList.remove("app-dark");
                }
            }
        </script>
    </head>
    <body class="app-dark">