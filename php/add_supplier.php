<?php

    require_once 'db_connection.php';

    if(isset($_POST['name'])) {

        $name = $_POST['name'];
        $cpf_cnpj = $_POST['cpf_cnpj'];
        $email = $_POST['email'];
        $status = $_POST['status'];

        $query = "SELECT cpf_cnpj FROM suppliers WHERE cpf_cnpj = '$cpf_cnpj'";

        $result = mysqli_query($con, $query);

        if(mysqli_num_rows($result) > 0) {

            $response = 'User already registered. Process Aborted!';

        } else {

            $query = "INSERT INTO suppliers(name, cpf_cnpj, email, status) VALUES(?, ?, ?, ?)";

            $stmt = mysqli_stmt_init($con);

            if(mysqli_stmt_prepare($stmt, $query)) {

                mysqli_stmt_bind_param($stmt, "sssi", $name, $cpf_cnpj, $email, $status);
                mysqli_stmt_execute($stmt);
    
                $response = 'OK';

            } else {

                $response = "Database query error";
            }
        }

    } else {

        $response = 'ERROR: No data was passed';

    }

    echo json_encode($response);

    $con->close();
?>