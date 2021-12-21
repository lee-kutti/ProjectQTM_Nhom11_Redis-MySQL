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

  if ($username !== $user['username']) {
    $errors['username'] = "Invalid Username";
  }

  // If no error
  if (array_filter($errors)) {
  } else {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $hashPWD = password_hash($password, PASSWORD_DEFAULT);

    $sql = "UPDATE users SET password = '$hashPWD' WHERE username = '$username'";
    if (mysqli_query($conn, $sql)) {
      // Success
      $msg = "Password changed successfully.";
      // Returns user to the login.php page after 1 second
      header("refresh:1;url=login.php");
    } else {
      // error
      echo 'Query Error: ' . mysqli_error($conn);
    }
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
    <h4 class="center">Forgot Password</h4>
    <form action="forgotpwd.php" class="white" method="POST">
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
      <label>New Password:</label>
      <input type="password" name="password" value="<?php echo $password ?>" placeholder="New Password">
      <!-- Error PHP -->
      <div class="red-text">
        <?php
        echo $errors['password'];
        ?>
      </div>

      <!-- SUBMIT BUTTON -->
      <div class="center">
        <input type="submit" name="submit" value="submit" class="btn brand z-depth-0">
        <div class="red-text">
          <?php
          echo $msg;
          ?>
        </div>
      </div>
    </form>
  </section>

  <?php include('templates/footer.php'); ?>
</body>

</html>