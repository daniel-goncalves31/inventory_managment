<?php

    require 'db_connection.php';

    
    if(isset($_POST['id'])) {

        $id = $_POST['id'];
        $id_supplier = $_POST['supplier'];
        $product = ucfirst(trim($_POST['product']));
        $category = ucfirst(trim($_POST['category']));
        $sale_price = str_replace(',', '.', $_POST['sale_price']);
        $min_amount = $_POST['min_amount'];
        $unit = strtolower($_POST['unit']);

        //Query for check if the supplier/product is already cadastred
        $query = "SELECT id_supplier, product FROM stock WHERE id_supplier = $id_supplier AND product = '$product' AND id_stock=$id";

        //if all results match then is the same product and supplier so just update the other fields
        if(mysqli_num_rows(mysqli_query($con, $query)) > 0) {
            
            $query = "UPDATE stock SET id_supplier=?, product=?, category=?, sale_price=?, min_amount=?, unit=? WHERE id_stock=?";

            $stmt = mysqli_stmt_init($con);

            if(mysqli_stmt_prepare($stmt, $query)) {

                mysqli_stmt_bind_param($stmt, 'isssisi', $id_supplier, $product, $category, $sale_price, $min_amount, $unit,  $id);
                mysqli_stmt_execute($stmt);

                $response = 'OK';
                
            } else {
                
                $response = 'Error in database query';
            }

        } else {

            // otherwise check if the product&supplier already exists
            $query = "SELECT id_supplier, product FROM stock WHERE id_supplier = $id_supplier AND product = '$product'";

            if(mysqli_num_rows(mysqli_query($con, $query)) > 0) {
            
                $response = 'Supplier is already cadastred. Process Aborted!';
    
              // if not update  
            } else {
                
                $query = "UPDATE stock SET id_supplier=?, product=?, category=?, sale_price=?, min_amount=?, unit=? WHERE id_stock=?";
    
                $stmt = mysqli_stmt_init($con);
    
                if(mysqli_stmt_prepare($stmt, $query)) {
    
                    mysqli_stmt_bind_param($stmt, 'isssisi', $id_supplier, $product, $category, $sale_price, $min_amount, $unit,  $id);
                    mysqli_stmt_execute($stmt);
    
                    $response = 'OK';
                    
                } else {
                    
                    $response = 'Error in database query';
                }
                
            }            
        }
        
        
    } else {

        $response = 'ERROR: No data was passed';
    }

    echo ($response);

    $con->close();


?>