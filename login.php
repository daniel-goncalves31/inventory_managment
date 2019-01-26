<?php

  // Initialize the session
  session_start();

  // verify if the user is already logged
  if(isset($_SESSION['user_id'])) {
    
    // if yes, he'll be redirect to the dashboard page
    header('Location: dashboard.php');
  }


?>

<!doctype html>
<html lang="en">

<head>
  <title>Inventory Managment</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
    crossorigin="anonymous">
  
    <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

  <!-- Plugins -->
  <!-- Pace -->
  <link rel="stylesheet" href="plugins/pace/pace.min.css">
  <!-- Parsley -->
  <link rel="stylesheet" href="plugins/parsley/parsley.css">
  <!-- Style -->
  <link rel="stylesheet" href="css/login.css">

</head>

<body>

  <div class="loginbox">
    <div class="glass">
      <img src="images/user.png" class="user">
      <h3>Sign In</h3>
      <form id="login_form">
        <div class="inputbox">
          <input type="text" name="username" placeholder="Username" required>
          <span><i class="fas fa-user" aria-hidden="true"></i></span>
        </div>
        <div class="inputbox">
          <input type="password" name="password" placeholder="Password" required>
          <span><i class="fas fa-lock"></i></span>
        </div>
        <input id="btn_login" type="submit" value="Login">
      </form>
    </div>
  </div>

  <!-- jQuery then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
    crossorigin="anonymous"></script>

  <!-- Plugins -->
  <!-- Parsley -->
  <script src="http://parsleyjs.org/dist/parsley.min.js"></script>
  <!-- Pace -->
  <script src="plugins/pace/pace.min.js"></script>

  <script>
  
    $(document).ready(function(){

      $('#login_form').parsley()

      $('#login_form').on('submit', function(event){

        event.preventDefault()

        if($('#login_form').parsley().isValid()) {
          
          $.ajax({
            url: 'php/login_process.php',
            method: 'POST',
            data: $(this).serialize(),
            beforeSend: function() {
              $('#btn_login').attr('disabled', 'disabled')
              $('#btn_login').val('Submitting...')
            },
            success: function(response) {
              if(response == 'ok') {

                window.location.href = 'dashboard.php'

              } else {
                alert(response)
              }

              $('#btn_login').attr('disabled', false)
              $('#btn_login').val('Login')
              
            },
            error: function(response) {

              alert(response)

              $('#btn_login').attr('disabled', false)
              $('#btn_login').val('Login')
            }

          }) // /ajax

        } // /if

      })// /on.submit

    }) // /document.ready
  
  </script>

</body>

</html>