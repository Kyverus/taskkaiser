<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= isset($PageTitle) ? $PageTitle : "Default Title"?></title> <!-- (< ? =) is php echo in short-->
        <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"> -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link rel="icon" href="assets/icons/notebook-icon.png" type="image/x-icon"/>

        <style>
            .navbar .navbar-nav /*.nav-item:not(:last-child)*/ .nav-link{
                border-left: 2px solid white;
            }
            .navbar-item.has-dropdown.is-hoverable:hover .navbar-dropdown {
                display: block !important;
            }
        </style>
    </head>
    <body style = "padding-top: 60px" class="bg-dark">
    <?php include "navbar.php"?>