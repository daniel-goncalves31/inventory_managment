<?php

    require 'db_connection.php';

    
    if(isset($_POST['id'])) {

        $id = $_POST['id'];
        $name = $_POST['name'];
        $cpf_cnpj = $_POST['cpf_cnpj'];
        $email = $_POST['email'];
        $status = $_POST['status'];

        //Query for check if the cpf/cnpj has changed
        $query = "SELECT cpf_cnpj FROM suppliers WHERE cpf_cnpj = '$cpf_cnpj' AND id = $id";

        // if not changed then update
        if(mysqli_num_rows(mysqli_query($con, $query)) > 0) {

            $query = "UPDATE suppliers SET name=?, cpf_cnpj=?, email=?, status=? WHERE id = ?";

            $stmt = mysqli_stmt_init($con);
    
            if(mysqli_stmt_prepare($stmt, $query)) {
    
                mysqli_stmt_bind_param($stmt, 'sssii', $name, $cpf_cnpj, $email, $status, $id);
                mysqli_stmt_execute($stmt);
    
                $response = 'OK';
                
              
            } else {
                
                $response = 'Error in database query';
            }

            // if changed then verify if the new cpf/cnpj is unique
        } else {

            $query = "SELECT cpf_cnpj FROM suppliers WHERE cpf_cnpj = '$cpf_cnpj'";

            if(mysqli_num_rows(mysqli_query($con, $query)) > 0) {
                
                $response = 'Supplier is already cadastred. Process Aborted!';

            } else {
                
                $query = "UPDATE suppliers SET name=?, cpf_cnpj=?, email=?, status=? WHERE id = ?";

                $stmt = mysqli_stmt_init($con);

                if(mysqli_stmt_prepare($stmt, $query)) {

                    mysqli_stmt_bind_param($stmt, 'sssii', $name, $cpf_cnpj, $email, $status, $id);
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

    echo json_encode($response);

    $con->close();

    function update($con){
        

    }

?>