<?php

    require_once 'db_connection.php';

    $query = 'SELECT * FROM purchases';

    $result = mysqli_query($con, $query);

    $output = array('data' => array());

    //variable to store the number of the row in the datatable
    $i = 0;

    while( $row = mysqli_fetch_row($result)) {

        $buttons = '
        <div class="btn-group d-flex justify-content-center">
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modalEdit" onclick="openEditModal(' . $row[0] . ',' . $i .')">
                <i class="fas fa-pencil-alt"></i>
            </button>
            <button type="button" class="btn btn-danger" onclick="del(' . $row[0]. ')">
                <i class="fas fa-times"></i>
            </button>
        </div>';

        // Query to get the supplier name the unit and the product
        $query = "SELECT stock.product AS 'product', suppliers.name AS 'supplier', stock.unit as unit 
        FROM suppliers INNER JOIN ( stock INNER JOIN purchases ON stock.id_stock = purchases.id_product)
        ON suppliers.id = stock.id_supplier WHERE stock.id_stock = $row[1]";

        $var = mysqli_query($con, $query);
        $array = mysqli_fetch_assoc($var);
        $supplier_name = $array['supplier'];
        $product = $array['product'];
        $unit = $array['unit'];

        //get and convert date format
        $date = strtotime(str_replace('-','/',$row[3]));
        $date_formated = date('d/m/Y', $date);

        $i++;

        $output['data'][] = array(
            $product,
            $supplier_name,
            $date_formated,
            '$ ' . $row[2],
            $row[4] . ' ' . $unit,
            '$ ' . ($row[2] * $row[4]),
            $buttons
        );
    }

    echo json_encode($output);

    $con->close();
?>