<?php

   require_once 'db_connection.php';

    if(isset($_FILES['file'])) {

        // path of the file
        $filename = $_FILES['file']['tmp_name'];
        
        // variables for store the number of success and errors
        $success = 0;
        $error = 0;

        // open the file
        $file = fopen($filename, 'r');

        while(($row = fgetcsv($file, 1000, ';')) !== FALSE) {

            $query = "INSERT INTO clients(name, cpf_cnpj, reg_date, email, status) VALUES (?, ?, ?, ?, ?)";

            $stmt = mysqli_stmt_init($con);
    
            if(mysqli_stmt_prepare($stmt, $query)) {
    
                mysqli_stmt_bind_param($stmt, 'ssssi', $row[0], $row[1], $row[2], $row[3], $row[4]);
                mysqli_stmt_execute($stmt);
    
                $success++;
                
            } else {

                $error++;
                
            }
            
        }

        $response = 'Total rows inserted: <strong>' . $success . '</strong>.<br/> Error: <strong>' . $error . '</strong>';

        fclose($file);

        
    } else {

      $response = 'No file path was passed!';
    }

    echo $response;

    $con->close()

?>