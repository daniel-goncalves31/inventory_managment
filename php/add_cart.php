<?php

    require_once 'db_connection.php';

    if(isset($_POST['id'])) {

        $response = array();

        $id = $_POST['id'];

        $query = "SELECT product, sale_price, amount, min_amount, image FROM stock WHERE id_stock = $id";

        $result = mysqli_query($con, $query);

        if($row = mysqli_fetch_assoc($result)) {

            $max_quantity = $row['amount'] - $row['min_amount'];

            //Put a image tooltip in the product name
            $product = '<span class="product-image" data-toggle="tooltip" data-placement="top" title="<img src=\'data:image/jpg;base64,' . base64_encode($row['image']) . '\' />">' . $row['product'];

            $response['resp'] = 'OK';
            $response['content'] = 
            "<tr>
                <td>" . $product . "</td>
                <td id='price'> $ " . $row['sale_price'] . "</td>
                <td>
                    <input class='input-group' id='qt' type='number' min='1' max='" . $max_quantity . "' value='1' onchange='quantityAndTotalHandle($(this))'/>
                </td>
                <td id='total'>$ " . $row['sale_price'] . "</td>
                <td>
                    <center>
                        <button class='btn btn-danger' onclick='removeRow($(this))'>
                            <i class='fas fa-times'></i>
                        </button>
                    </center>
                </td>
            </tr>";

        } else {
            $response['resp'] = 'Item not found';
        }

    } else {
        $response['resp'] = 'Id was no passed!';
    }

    echo json_encode($response);

    $con->close();
?>