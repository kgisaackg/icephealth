<?php require_once 'registerController.php';
    if(!isset($_SESSION['patientId'])){
        header('location: index.php');
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/patient.css">
    <link rel="stylesheet" href="assets/css/register.css">
    <title>HCSC</title>
</head>

<body>
    <nav class="navbar navbar-dark sticky-top bg-primary flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="#">HCSC</a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse"
            data-target="#sidebarMenu" aria-controls="sidebarMenu" data-target="#navbarTogglerDemo01"
            aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <ul class="navbar-nav px-3">
            <li class="nav-item text-nowrap">
                <a class="nav-link" href="patient.php?logout=1">Sign out</a>
            </li>
        </ul>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="sidebar-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="patient.php">
                                Patient
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="appointmentDelete.php">
                                Appointment
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                Booking
                            </a>
                        </li>
                    </ul>
            </nav>

            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">