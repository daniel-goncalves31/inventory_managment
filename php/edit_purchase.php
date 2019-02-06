<?php

require 'db_connection.php';

if (isset($_POST['id'])) {

    $id = $_POST['id'];
    $id_product = $_POST['product'];
    $price = trim(str_replace(',', '.', $_POST['price']));
    $date = $_POST['date'];
    $amount = $_POST['amount'];

    // 1 - get the old amount value from purchases table
    $query = "SELECT amount FROM purchases WHERE id_purchase=$id";

    $result = mysqli_query($con, $query);

    if ($row = mysqli_fetch_row($result)) {

        $older_amount = $row[0];

        // 2 - get the actual amount value from stock
        $query = "SELECT amount FROM stock WHERE id_stock=$id_product";

        $result = mysqli_query($con, $query);

        if ($row = mysqli_fetch_row($result)) {

            $actual_amount = $row[0];

            // 3 - update the purchases table with the new values
            $query = 'UPDATE purchases SET id_product=?, price=?, date=?, amount=? WHERE id_purchase=?';

            $stmt = mysqli_stmt_init($con);

            if (mysqli_stmt_prepare($stmt, $query)) {

                mysqli_stmt_bind_param($stmt, 'issii', $id_product, $price, $date, $amount, $id);
                mysqli_stmt_execute($stmt);

                // 4 - update the amount value of stock table
                $query = "UPDATE stock SET amount=? WHERE id_stock=?";

                if (mysqli_stmt_prepare($stmt, $query)) {

                    $amount = $actual_amount + $amount - $older_amount;

                    mysqli_stmt_bind_param($stmt, 'ii', $amount, $id_product);
                    mysqli_stmt_execute($stmt);
    
                    $response = 'OK';
    
                } else {
    
                    $response = 'Error in database query UPDATE purchases';
                }

            } else {

                $response = 'Error in database query UPDATE purchases';
            }

        } else {

            $response = 'Database error in query select amount from stock';
        }

    } else {

        $response = 'Database error in query select old amount from purchases';
    }

} else {

    $response = 'ERROR: No data was passed';
}

echo $response;

$con->close();