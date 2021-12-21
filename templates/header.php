<?php
session_start();
?>

<head>
  <title>Patient Management System</title>

  <!-- Compiled and minified CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

  <!-- Compiled and minified JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

  <style type="text/css">
    .brand {
      background: #00ccff !important;
    }

    .brand-text {
      color: #00ccff !important;
    }

    form {
      max-width: 460px;
      margin: 20px auto;
      padding: 20px;
    }

    .patient {
      width: 100px;
      margin: 40px auto -30px;
      display: block;
      position: relative;
      top: -30px;
    }
  </style>
</head>

<body class="grey lighten-4">
  <nav class="white z-depth-0">
    <div class="container">
      <a href="index.php" class="brand-logo brand-text">Patient Management System</a>
      <ul id="nav-mobile" class="right hide-on-small-and-down">
        <!-- If logged in only display these buttons. -->
        <?php if (/*$_SESSION['username'] == 'admin' && */$_SESSION['loggedIn'] == true) { ?>
          <li><a href="add.php" class="btn brand z-depth-0">Add a Patient</a></li>
          <li><a href="search.php" class="btn brand z-depth-0">Search Patient</a></li>
          <li><a href="logout.php" class="btn brand z-depth-0">Log Out</a></li>
        <?php } else { ?>
          <!-- Hide log in button if logged in. -->
          <li><a href="login.php" class="btn brand z-depth-0">Log In</a></li>
          <li><a href="forgotpwd.php" class="btn brand z-depth-0">Forgot Password</a></li>
        <?php } ?>
      </ul>
    </div>
  </nav>