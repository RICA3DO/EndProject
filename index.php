<?php
session_start();
require_once 'components/db_connect.php';


if (isset($_SESSION['user']) != "") {
  header("Location: home.php");
  exit;
}
if (isset($_SESSION['adm']) != "") {
  header("Location: dashboard.php"); 
}

$error = false;
$email = $password = $emailError = $passError = '';

if (isset($_POST['btn-login'])) {

 
  $email = trim($_POST['email']);
  $email = strip_tags($email);
  $email = htmlspecialchars($email);

  $pass = trim($_POST['pass']);
  $pass = strip_tags($pass);
  $pass = htmlspecialchars($pass);

  if (empty($email)) {
      $error = true;
      $emailError = "Please enter your email address.";
  } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $error = true;
      $emailError = "Please enter valid email address.";
  }

  if (empty($pass)) {
      $error = true;
      $passError = "Please enter your password.";
  }

 
  if (!$error) {

      $password = hash('sha256', $pass); 

      $sql = "SELECT userID, first_name, password, status FROM users WHERE email = '$email'";
      $result = mysqli_query($connect, $sql);
      $row = $result->fetch_assoc();
      $count = mysqli_num_rows($result);
      
      if ($count == 1 && $row['password'] == $password) {
          if ($row['status'] == 'adm') {
              $_SESSION['adm'] = $row['userID'];
              header("Location: dashboard.php");
          } else {
              $_SESSION['user'] = $row['userID'];
              header("Location: home.php");
          }
      } else {
          $errMSG = "Incorrect Credentials, Try again...";
      }
  }
}

mysqli_close($connect);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login & Registration System</title>
  <?php require_once 'components/bootstrap.php' ?>
</head>

<body>
<?php require_once 'components/nav.php'?>

  <div class="container">
      <form class="w-75" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
          <h2>Login</h2>
          <hr />
          <?php
          if (isset($errMSG)) {
              echo $errMSG;
          }
          ?>

          <input type="email" autocomplete="off" name="email" class="form-control" placeholder="Your Email" value="<?php echo $email; ?>" maxlength="40" />
          <span class="text-danger"><?php echo $emailError; ?></span>

          <input type="password" name="pass" class="form-control" placeholder="Your Password" maxlength="15" />
          <span class="text-danger"><?php echo $passError; ?></span>
          <hr />
          <button class="btn btn-block btn-primary" type="submit" name="btn-login">Sign In</button>
          <a class="d-flex" href="register.php">Not registered yet? Click here</a>
      </form>
  </div>
</body>
</html>