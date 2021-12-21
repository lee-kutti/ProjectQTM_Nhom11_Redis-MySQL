<?php
include('config/db_connect.php');

// Write query for all patients
$sql = 'SELECT * from patients ORDER BY created_at';

// Make query and get results
$result = mysqli_query($conn, $sql);

// Fetch the resulting rows as an array
// Returns it as an associative array
$patients = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Free result from memory
mysqli_free_result($result);
// Close connection
mysqli_close($conn);

?>

<!DOCTYPE html>
<html>
<?php include('templates/header.php'); ?>
<!-- If Logged In -->
<?php if (/*$_SESSION['username'] == 'admin' && */$_SESSION['loggedIn'] == true) { ?>
  <h4 class="center grey-text">Patients</h4>
  <div class="container">
    <div class="row">
      <?php foreach ($patients as $patient) : ?>
        <div class="col s6 md3">
          <div class="card z-depth-0">
            <img src="img/patient.svg" class="patient" alt="Patient Image">
            <div class="card-content center">
              <h6>Patient <?php echo htmlspecialchars($patient['id']) ?></h6>
              <ul>
                <li>ID: <?php echo htmlspecialchars($patient['id']) ?></li>
                <li>Name: <?php echo htmlspecialchars($patient['name']) ?></li>
                <li>Gender: <?php echo htmlspecialchars($patient['gender']) ?></li>
                <li>Phone: <?php echo htmlspecialchars($patient['phone']) ?></li>
                <li>Email: <?php echo htmlspecialchars($patient['email']) ?></li>
              </ul>
            </div>
            <div class="card-action right-align">
              <a href="details.php?id=<?php echo $patient['id'] ?>" class="brand-text">More Information</a>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
<?php } else { ?>
  <!-- If not logged in -->
  <h4 class="center grey-text">Please Log In to view Patients</h4>
<?php } ?>
<?php include('templates/footer.php'); ?>

</html>