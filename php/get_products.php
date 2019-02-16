<?php

    require_once 'db_connection.php';

    $query = "SELECT id_stock, product, image, amount, min_amount FROM stock ORDER BY product ASC";

    $result = mysqli_query($con, $query);

    $output = '';

    //if true then it was called by the add_sale.php, else it was called by the purchases.php
    if(isset($_POST['sale'])) {

        while($row = mysqli_fetch_assoc($result)) {

            $available_amount = $row['amount'] - $row['min_amount'];

            $isDisabled = '';

            if($available_amount < 1) $isDisabled = 'disabled';

            $output .= '<option ' . $isDisabled . ' value="'. $row['id_stock'].'">'.$row['product'].'</option>';

        }
        
    } else {
    
        $output = '<option value="">~~~Select a Product~~~</option>';

        while($row = mysqli_fetch_assoc($result)) {

            $output .= '<option value="'. $row['id_stock'].'">'.$row['product'].'</option>';

        }
    }

    echo $output;

    $con->close();

?>

