<?php

    require_once 'db_connection.php';

    if(isset($_POST['id'])) {

        $id = $_POST['id'];

        $query = "DELETE FROM sellers WHERE id = ?";

        $stmt = mysqli_stmt_init($con);

        if(mysqli_stmt_prepare($stmt, $query)) {

            mysqli_stmt_bind_param($stmt, 'i', $id);
            mysqli_execute($stmt);

            $response = 'OK';

        } else {

            $response = 'Error in database query execution';
        }

    } else {

        $response = 'No ID was passed';
    }

    echo ($response);

    $con->close();

?>