<?php
require_once "classes/Info.php";
date_default_timezone_set('Europe/Berlin');

?>

<!doctype html>
<html lang="en" style="height:100%;">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link href="style.css" rel="stylesheet" type="text/css">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <!-- FontAwesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.7.1/css/all.min.css" integrity="sha512-3M00D/rn8n+2ZVXBO9Hib0GKNpkm8MSUU/e2VNthDyBYxKWG+BftNYYcuEjXlyrSO637tidzMBXfE7sQm0INUg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <title><?=Info::pageTitle()?></title>
    </head>
    
    <body class="bg-secondary" style="height:100%;">
        <nav class="navbar navbar-expand-lg navbar-dark sticky-top" style="background-color: #1D6A80">
        
        <div class="container-xl">
            <a class="navbar-brand font-weight-bold" href="index.php">LTO Traffic Violation System</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav ml-auto">
                    <a class="nav-item nav-link active" href="viewRecords.php"></i><i class="fas fa-book"></i> Violation Records</a>
                    <a class="nav-item nav-link active" href="viewViolations.php"><i class="fas fa-exclamation-triangle"></i></i> Violation List</a>
                    <a class="nav-item nav-link active" href="viewDrivers.php"><i class="fas fa-address-book"></i> View Drivers</a>
                </div>
            </div>
            </div>
        </nav>