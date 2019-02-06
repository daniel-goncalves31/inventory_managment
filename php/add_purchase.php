<?php

    require_once 'db_connection.php';

    if(isset($_POST['product'])) {

        $id_product = $_POST['product'];
        $price = trim(str_replace(',', '.', $_POST['price']));
        $date = $_POST['date'];
        $amount = $_POST['amount'];

        // get the actual value of amount of the product in stock
        $query = "SELECT amount FROM stock WHERE id_stock = $id_product";

        $result = mysqli_query($con, $query);

        if($row = mysqli_fetch_assoc($result)) {

            $actual_amount = $row['amount'];

            // insert the data into the purchase table
            $query = "INSERT INTO purchases(id_product, price, date, amount) VALUES(?, ?, ?, ?)";

            $stmt = mysqli_stmt_init($con);

            if(mysqli_stmt_prepare($stmt, $query)) {

                mysqli_stmt_bind_param($stmt, "issi", $id_product, $price, $date, $amount);
                mysqli_stmt_execute($stmt);
    
                // sum the actual value of the amount with amount purchased
                $query = "UPDATE stock SET amount=? WHERE id_stock = $id_product";

                if(mysqli_stmt_prepare($stmt, $query)) {

                    $amount += $actual_amount;
                    mysqli_stmt_bind_param($stmt, "i", $amount);
                    mysqli_stmt_execute($stmt);
        
                    $response = 'OK';
                    
    
                } else {
    
                    $response = "Database update amount query error";
                }
                

            } else {

                $response = "Database insert into purchase query error";
            }

        } else {

            $response = "Database get amount query error";
        }

    } else {

        $response = 'ERROR: No data was passed';

    }

    echo $response;

    $con->close();
?>