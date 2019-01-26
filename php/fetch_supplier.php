<?php

    require_once 'db_connection.php';

    $query = 'SELECT * FROM suppliers';

    $result = mysqli_query($con, $query);

    $output = array('data' => array());

    while( $row = mysqli_fetch_array($result)) {

        if($row['status'] == 1) {
            $status = '<span class="badge badge-success text-center">Ativo</span>';
        } else {
            $status = '<span class="badge badge-danger text-center">Inativo</span>';
        }

        $buttons = '
        <div class="btn-group">
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modalEdit" onclick="edit(' . $row['id'] .')">
                <i class="fas fa-pencil-alt"></i>
            </button>
            <button type="button" class="btn btn-danger" onclick="delete(' . $row['id']. ')">
                <i class="fas fa-times"></i>
            </button>
        </div>';

        $output['data'][] = array(
            $row['name'],
            $row['cpf_cnpj'],
            $row['email'],
            $status,
            $buttons
        );
    }

    echo json_encode($output);

    $con->close();
?>