<?php

include('config/db_connect.php');
include('config/redis_connect.php');

$id = "";
$errors = array('id' => "");

if (isset($_POST['submit'])) {
  // ID
  if (empty($_POST['id'])) {
    $errors['id'] = "Patient ID is required <br>";
  } else {
    $id = $_POST['id'];
    // Validate name
    if (!preg_match("/^[0-9]+$/", $id)) {
      $errors['id'] =  "Patient ID must be numbers only.";
    } else {

      //check redis
      $data = $redis->exists($id);
      if (!$data) {
        $id = mysqli_real_escape_string($conn, $_POST['id']);
        $sql = "SELECT * FROM patients WHERE id = $id";

        // Get the query result
        $result = mysqli_query($conn, $sql);

        // Fetch Result in array format
        $data = mysqli_fetch_assoc($result);
      } //else {
      //   //$patient = $data;
      //   //$redis->expire($id, 60);
      // }
    
      if ($data) {
        $errors['id'] =  "";
      } else {
        $errors['id'] = "No such patient found in database.";
      }
    }
  }

  if (array_filter($errors)) {
  } else {
    // mysqli_real_escape_string protects from malicious SQL codes.
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    // Redirect to details page with patient information with the ID.
    header("Location: details.php?id=$id");
  }
}
?>

<!DOCTYPE html>
<html>
<?php include('templates/header.php'); ?>
<?php if (/*$_SESSION['username'] == 'admin' &&*/ $_SESSION['loggedIn'] == true) { ?>
  <section class="container grey-text">
    <h4 class="center">Search patient</h4>
    <form action="search.php" class="white" method="POST">
      <!-- Patient ID Input -->
      <label>Patient ID:</label>
      <input type="text" name="id" value="<?php echo $id ?>">
      <!-- Error PHP -->
      <div class="red-text">
        <?php
        echo $errors['id'];
        ?>
      </div>
      <!-- SUBMIT BUTTON -->
      <div class="center">
        <input type="submit" name="submit" value="submit" class="btn brand z-depth-0">
      </div>
    </form>
  </section>
<?php } else { ?>
  <h4 class="center grey-text">Please Log In to search patients</h4>
<?php } ?>

<?php include('templates/footer.php'); ?>

</html>