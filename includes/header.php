<?php

// Initialize the session
session_start();

// verify if the user is already logged in
if (!isset($_SESSION['user_id'])) {

    // if not, he'll be redirected to the login page
    header("Location: login.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <title>CRUD</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <!-- DataTable -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4-4.1.1/jszip-2.5.0/dt-1.10.18/b-1.5.4/b-colvis-1.5.4/b-flash-1.5.4/b-html5-1.5.4/b-print-1.5.4/r-2.2.2/datatables.min.css"/>
    <!-- Style -->
    <link rel="stylesheet" href="css/menu.css">

</head>
<body>

    <div class="menu">
        <li class="item" id="profile">
            <a href="dashboard.php" class="menu_btn"><i class="far fa-user"></i> Dashboard</a>
        </li>
        <li class="item" id="profile">
            <a href="suppliers.php" class="menu_btn"><i class="fas fa-boxes"></i></i> Suppliers</a>
        </li>
        <li class="item" id="messages">
            <a href="#messages" class="menu_btn"><i class="far fa-envelope"></i> Messages</a>
            <div class="smenu">
                <a href="#">New Message</a>
                <a href="#">View Messages</a>
                <a href="#">Spam</a>
            </div>
        </li>
        <li class="item" id="settings">
            <a href="#settings" class="menu_btn"><i class="fas fa-cog"></i> Settings </a>
            <div class="smenu">
                <a href="#">Password</a>
                <a href="#">Language</a>
            </div>
        </li>

        <li class="item" id="logout">
            <a href="#logout" class="menu_btn"><i class="fas fa-sign-out-alt"></i> LogOut</a>
        </li>
    </div> <!-- /menu -->
        
    
    

    

    

        