<?php

    require_once 'db_connection.php';

    $query = "SELECT id, name, cpf_cnpj FROM suppliers";

    $result = mysqli_query($con, $query);

    $output = '<option value="">~~~Select a Supplier~~~</option>';

    while($row = mysqli_fetch_assoc($result)) {

        $output .= '<option value="'. $row['id'].'">'.$row['name'].' - - - -  '. $row['cpf_cnpj'].'</option>';

    }

    echo $output;

    $con->close();

?>

