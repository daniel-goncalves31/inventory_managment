<?php

    if(isset($_POST['yes'])) {

        session_start();

        session_destroy();

        $response = 'OK';

    } else {

        $response = 'No data was Passsed';
    }

    echo $response;
?>