<?php

include('config/db_connect.php');
include('config/redis_connect.php');

// Delete POST
if (isset($_POST['delete'])) {
  // Protects from malicious code
  $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);

  $sql = "DELETE FROM patients WHERE id = $id_to_delete";

  if (mysqli_query($conn, $sql)) {
    // Success

    //remove from Redis 
    //if ($redis->exsists($id_to_delete))
    //{
    $redis->delete($id_to_delete);
    //}

    header('Location: index.php');
  } else {
    echo "Query error: " . mysqli_error($conn);
  }
}

// Check GET request ID param
if (isset($_GET['id'])) {
  $id = $_GET['id'];

  //measure time
  $start_time = microtime(true);
  //get from redis
  $value = $redis->get($id);

  if (!$value) { // not in redis

    $source = "Redis miss (MySQL)";
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    // Make sql
    $sql = "SELECT * FROM patients WHERE id = $id";

    // Get the query result
    $result = mysqli_query($conn, $sql);

    // Fetch Result in array format
    $patient = mysqli_fetch_assoc($result);

    $id = htmlspecialchars($patient['id']);
    $name = htmlspecialchars($patient['name']);
    $gender = htmlspecialchars($patient['gender']);
    $dob = htmlspecialchars($patient['dob']);
    $age = htmlspecialchars($patient['age']);
    $phone = htmlspecialchars($patient['phone']);
    $email = htmlspecialchars($patient['email']);
    $others = htmlspecialchars($patient['others']);

    //$id_echo = $patient['id'];

    //$value = $patient['name'] . "@@@@" . $patient['gender'] . "@@@@" . $patient['dob'] . "@@@@" . $patient['age'] . "@@@@" . $patient['phone'] . "@@@@" . $patient['email'] ."@@@@" . $patient['others'];
    $value = $name . "@@@@" . $gender . "@@@@" . $dob . "@@@@" . $age . "@@@@" . $phone . "@@@@" . $email . "@@@@" . $others;

    $redis->set($id, $value);
    $redis->expire($id, 100);

    // Free memory
    mysqli_free_result($result);
    // Close connection
    mysqli_close($conn);
  } else {
    $patient = "in redis";

    $source = "Redis";

    //$value = $redis->get($id);

    $name = explode('@@@@', $value)[0];
    $gender = explode('@@@@', $value)[1];
    $dob = explode('@@@@', $value)[2];
    $age = explode('@@@@', $value)[3];
    $phone = explode('@@@@', $value)[4];
    $email = explode('@@@@', $value)[5];
    $others = explode('@@@@', $value)[6];

    $redis->expire($id, 150);
  }

  //calculate time
  $stop_time = microtime(true);
  $time = $stop_time - $start_time;
}

?>

<!DOCTYPE html>

<body>
  <?php include('templates/header.php'); ?>

  <?php if (/*$_SESSION['username'] == 'admin' && */$_SESSION['loggedIn'] == true) { ?>
    <div class="container center">
      <?php if ($patient != null) : ?>
        <h4>Patient Details (<?php echo $source . ": " . $time . "sec)"; ?></h4>
        <h5>Patient ID: <?php echo $id; ?></h5>
        <p>Name: <?php echo $name; ?></p>
        <p>Gender: <?php echo $gender; ?></p>
        <p>Date Of Birth: <?php echo $dob; ?></p>
        <p>Age: <?php echo $age; ?></p>
        <p>Phone Number: <?php echo $phone; ?></p>
        <p>Email: <?php echo $email; ?></p>
        <p>Other Information: <br><?php echo $others; ?></p>

        <ul id="nav-mobile" class="hide-on-small-and-down">
          <a href="edit.php?id=<?php echo $id ?>" class="btn brand">Edit Patient</a>
        </ul>
        <form action="details.php" method="POST">
          <input type="hidden" name="id_to_delete" value="<?php echo $id ?>">
          <input type="submit" name="delete" value="Delete" class="btn brand z-depth-0">
        </form>

      <?php else : ?>
        <h5>No such patient exsists !</h5>
      <?php endif; ?>
    </div>
  <?php } else { ?>
    <!-- If not logged in -->
    <h4 class="center grey-text">Please Log In to view Patient details</h4>
  <?php } ?>

  <?php include('templates/footer.php'); ?>

</body>

</html>