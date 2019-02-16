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
    
    <title>CRUD</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

    <!-- Normalize CSS -->
    <link rel="stylesheet" href="plugins/normalize_css/normalize.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!-- DataTable -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4-4.1.1/jszip-2.5.0/dt-1.10.18/b-1.5.4/b-colvis-1.5.4/b-flash-1.5.4/b-html5-1.5.4/b-print-1.5.4/r-2.2.2/datatables.min.css"/>

    <!-- Parsley CSS -->
    <link rel="stylesheet" href="plugins/parsley/parsley.css">

    <!-- Jquery Confirm -->
    <link rel="stylesheet" href="plugins/confirmjs/confirmjs.min.css">

    <!-- Croppie -->
    <link rel="stylesheet" href="plugins/croppie/croppie.css">

    <!-- Boostrap Select -->
    <link rel="stylesheet" href="plugins/boostrap_select/bootstrap_select.min.css">
    
    <!-- Style -->
    <link rel="stylesheet" href="css/menu.css">

</head>
<body>

    <div id="horizontal-menu">
        
    </div>

    <div class="menu">
        <li class="item" >
            <a href="dashboard.php" class="menu_btn"><i class="fas fa-chart-pie"></i> Dashboard</a>
        </li>
        <li class="item" >
            <a href="suppliers.php" class="menu_btn"><i class="fas fa-user-tag"></i> Suppliers</a>
        </li>
        <li class="item" >
            <a href="clients.php" class="menu_btn"><i class="fas fa-user-tie"></i> Clients</a>
        </li>
        <li class="item" >
            <a href="sellers.php" class="menu_btn"><i class="fas fa-sitemap"></i> Sellers</a>
        </li>
        <li class="item" >
            <a href="stock.php" class="menu_btn"><i class="fas fa-boxes"></i> Stock</a>
        </li>
        <li class="item" >
            <a href="purchases.php" class="menu_btn"><i class="fas fa-barcode"></i> Purchases</a>
        </li>
        <li class="item" >
            <a href="add_sale.php" class="menu_btn"><i class="fab fa-opencart"></i> Add Sale</a>
        </li>
        <li class="item" >
            <a href="#" class="menu_btn" id="logout"><i class="fas fa-sign-out-alt"></i> LogOut</a>
        </li>

        <!-- <div id="float-button">
            <i class="fas fa-bell"></i>
        </div>
        <div class="b1">
            <i class="fas fa-exclamation-triangle"></i>
        </div>
        <div class="b2">
            <i class="fas fa-birthday-cake"></i>
        </div>
        <div class="b3">
            <i class="fas fa-comments"></i>
        </div> -->

    </div> <!-- /menu -->


        
    
    

    

    

        