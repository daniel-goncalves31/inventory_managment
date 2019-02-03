<?php

    require_once 'db_connection.php';

    if(isset($_POST['supplier'])) {

        $id_supplier = $_POST['supplier'];
        $product = ucfirst(trim($_POST['product']));
        $category = ucfirst(trim($_POST['category']));
        $sale_price = str_replace(',', '.', $_POST['sale_price']);
        $amount = $_POST['amount'];
        $min_amount = $_POST['min_amount'];
        $unit = strtolower($_POST['unit']);
        $date = $_POST['date'];
        
        $image = $_POST['image'];
        list($type, $image) = explode(';', $image);
        list(, $image)      = explode(',', $image);
        $image = base64_decode($image);

        $query = "INSERT INTO stock(id_supplier, product, category, sale_price, amount, min_amount, unit, image) VALUES(?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = mysqli_stmt_init($con);

        if(mysqli_stmt_prepare($stmt, $query)) {

            mysqli_stmt_bind_param($stmt, "isssiiss", $id_supplier, $product, $category, $sale_price, $amount, $min_amount, $unit, $image);
            mysqli_stmt_execute($stmt);
            
            // ****** Inserting the values in the purchases database *******
            $query = "INSERT INTO purchases(id_product, price, date, amount) VALUES (?, ?, ?, ?)";
            
            // ID of the stock insert query
            $id_stock = mysqli_insert_id($con);
            
            if(mysqli_stmt_prepare($stmt, $query)) {
                
                mysqli_stmt_bind_param($stmt, "issi", $id_stock, $sale_price, $date, $amount);
                mysqli_stmt_execute($stmt); 
                
                $response = 'OK';
    
            } else {

                $response = "Database pruchase query error";
            }

        } else {

            $response = "Database stock query error";
        }
        

    } else {

        $response = 'ERROR: No data was passed';

    }

    echo $response;

    $con->close();
?>