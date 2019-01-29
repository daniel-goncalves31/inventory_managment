<?php

    require 'db_connection.php';

    
    if(isset($_POST['id'])) {

        $id = $_POST['id'];
        $name = $_POST['name'];
        $cpf = $_POST['cpf'];
        $salary = $_POST['salary'];
        $hir_date = $_POST['hir_date'];
        $status = $_POST['status'];

        $salary = str_replace(',','.',$salary);
        $salary = str_replace('R$ ','',$salary);

        //Query for check if the cpf/cnpj has changed
        $query = "SELECT cpf FROM sellers WHERE cpf = '$cpf' AND id = $id";

        // if not changed then update
        if(mysqli_num_rows(mysqli_query($con, $query)) > 0) {

            $query = "UPDATE sellers SET name=?, cpf=?, salary=?, hir_date=?, status=? WHERE id = ?";

            $stmt = mysqli_stmt_init($con);
    
            if(mysqli_stmt_prepare($stmt, $query)) {
    
                mysqli_stmt_bind_param($stmt, 'ssssii', $name, $cpf, $salary, $hir_date, $status, $id);
                mysqli_stmt_execute($stmt);
    
                $response = 'OK';
                
              
            } else {
                
                $response = 'Error in database query';
            }

            // if changed then verify if the new cpf/cnpj is unique
        } else {

            $query = "SELECT cpf FROM sellers WHERE cpf = '$cpf'";

            if(mysqli_num_rows(mysqli_query($con, $query)) > 0) {
                
                $response = 'Supplier is already cadastred. Process Aborted!';

            } else {
                
                $query = "UPDATE sellers SET name=?, cpf=?, salary=?, hir_date=?, status=? WHERE id = ?";

                $stmt = mysqli_stmt_init($con);

                if(mysqli_stmt_prepare($stmt, $query)) {

                    mysqli_stmt_bind_param($stmt, 'ssssii', $name, $cpf, $salary, $hir_date, $status, $id);
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