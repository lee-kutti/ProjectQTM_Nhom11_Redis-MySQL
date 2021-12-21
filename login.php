<?php
include('config/db_connect.php');

$username = $password = "";
$errors = array('username' => "", 'password' => "");

if (isset($_POST['submit'])) {
  // Check Username
  if (empty($_POST['username'])) {
    $errors['username'] = "Username is required <br>";
  } else {
    $username = $_POST['username'];
  }
  // Checks empty password
  if (empty($_POST['password'])) {
    $errors['password'] = "Password is required <br>";
  } else {
    $password = $_POST['password'];
  }

  // Retrieving User Data.
  $sql = "SELECT * FROM users WHERE username = '$username'";
  $result = mysqli_query($conn, $sql);
  $user = mysqli_fetch_assoc($result);

  // Check if password matches with hashed password in database.
  if (password_verify($password, $user['password'])) {
    if (array_filter($errors)) {
    } else {
      session_start();
      $_SESSION['loggedIn'] = true;
      $_SESSION['username'] = $username;
      echo session_id();
      header('Location: index.php');
    }
  } else {
    $errors['password'] = "Incorrect Password";
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Log In</title>
</head>

<body>
  <?php include('templates/header.php'); ?>
  <section class="container grey-text">
    <h4 class="center">Log In</h4>
    <form action="login.php" class="white" method="POST">
      <!-- Username Input -->
      <label>Username:</label>
      <input type="text" name="username" value="<?php echo $username ?>" placeholder="Username">
      <!-- Error PHP -->
      <div class="red-text">
        <?php
        echo $errors['username'];
        ?>
      </div>

      <!-- Password Input -->
      <label>Password:</label>
      <input type="password" name="password" value="<?php echo $password ?>" placeholder="Password">
      <!-- Error PHP -->
      <div class="red-text">
        <?php
        echo $errors['password'];
        ?>
      </div>

      <!-- SUBMIT BUTTON -->
      <div class="center">
        <input type="submit" name="submit" value="submit" class="btn brand z-depth-0">
      </div>
    </form>
  </section>

  <?php include('templates/footer.php'); ?>
</body>

</html>