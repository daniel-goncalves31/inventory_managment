<?php

    require_once 'db_connection.php';

    if(isset($_POST['name'])) {

        $name = $_POST['name'];
        $cpf = $_POST['cpf'];
        $salary = $_POST['salary'];
        $hir_date = $_POST['hir_date'];
        $status = $_POST['status'];

        $salary = str_replace(',','.',$salary);

        $query = "SELECT cpf FROM sellers WHERE cpf = '$cpf'";

        $result = mysqli_query($con, $query);

        if(mysqli_num_rows($result) > 0) {

            $response = 'User already registered. Process Aborted!';

        } else {

            $query = "INSERT INTO sellers(name, cpf, salary, hir_date, status) VALUES(?, ?, ?, ?, ?)";

            $stmt = mysqli_stmt_init($con);

            if(mysqli_stmt_prepare($stmt, $query)) {

                mysqli_stmt_bind_param($stmt, "ssssi", $name, $cpf, $salary, $hir_date, $status);
                mysqli_stmt_execute($stmt);
    
                $response = 'OK';

            } else {

                $response = "Database query error";
            }
        }

    } else {

        $response = 'ERROR: No data was passed';

    }

    echo $response;

    $con->close();
?>