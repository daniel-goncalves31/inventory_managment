<?php

    require_once 'db_connection.php';

    // query for get and order the products by the status
    $query = 'SELECT * FROM stock ORDER BY (amount - min_amount) ASC';

    $result = mysqli_query($con, $query);

    $output = array('data' => array());

    //variable to store the number of the row in the datatable
    $i = 0;

    while( $row = mysqli_fetch_array($result)) {

        // if the amount is more than 130% of the minimum amount then it will be ok
        // if the amount is only greater than the amount than waill be warning
        // else will be danger
        if($row['amount'] > ($row['min_amount'] * 1.3)) {
            $status = '<center><span class="badge badge-success">OK</span></center>';
        } elseif($row['amount'] > $row['min_amount']){
            $status = '<center><span class="badge badge-warning">Low Stock</span></center>';
        } else {
            $status = '<center><span class="badge badge-danger">Critic</span></center>';
        }

        //on select row
        $buttons = '
        <div class="btn-group d-flex justify-content-center">
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modalEdit" onclick="openEditModal(' . $row['id_stock'] . ',' . $i .')">
                <i class="fas fa-pencil-alt"></i>
            </button>
            <button type="button" class="btn btn-danger" onclick="del(' . $row['id_stock']. ')">
                <i class="fas fa-times"></i>
            </button>
        </div>';

        //Get supplier name
        $query = "SELECT name FROM suppliers WHERE id = $row[1]";
        $var = mysqli_query($con, $query);
        $supplier_name = $var ? $var->fetch_assoc()['name'] : 'Supplier Deleted';

        //get and convert date format
        $query = "SELECT MAX(date) as 'LastDate' FROM purchases WHERE id_product = $row[0]";
        $var = mysqli_query($con, $query);
        $date = $var->fetch_assoc()['LastDate'];
        $date = strtotime(str_replace('-','/',$date));
        $date_formated = date('d/m/Y', $date);

        $sale_price = '$ ' . $row[4];

        $i++;

        $output['data'][] = array(
            $supplier_name,
            $row[2],
            $row[3],
            $date_formated,
            $sale_price,
            $row[5] . ' ' . $row[7],
            $row[6] . ' ' . $row[7],
            $status,
            $buttons
        );
    }

    echo json_encode($output);

    $con->close();
?>