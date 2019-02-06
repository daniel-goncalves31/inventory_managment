<?php

    require_once 'db_connection.php';

    $query = "SELECT id_stock, product FROM stock ORDER BY product ASC";

    $result = mysqli_query($con, $query);

    $output = '<option value="">~~~Select a Product~~~</option>';

    while($row = mysqli_fetch_assoc($result)) {

        $output .= '<option value="'. $row['id_stock'].'">'.$row['product'].'</option>';

    }

    echo $output;

    $con->close();

?>

