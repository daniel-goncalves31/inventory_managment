<?php

    require_once 'db_connection.php';

    $query = "SELECT id, name, cpf_cnpj FROM suppliers";

    $result = mysqli_query($con, $query);

    $output = array();

    while($row = mysqli_fetch_object($result)) {

        $output[] = $row;

    }

    echo json_encode($output);

    $con->close();

?>

