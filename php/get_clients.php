<?php

    require_once 'db_connection.php';

    $query = "SELECT id, name FROM clients";

    $result = mysqli_query($con, $query);

    $response = "<option value=''>~~~ Select the Client ~~~ </option>";

    while($row = mysqli_fetch_assoc($result)) {
        $response .= "<option value='" . $row['id'] . "'> " . $row['name'] . " </option>";
    }


    echo $response;

    $con->close();
?>