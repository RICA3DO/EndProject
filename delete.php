<?php
session_start();
require_once 'components/db_connect.php';

if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
  header("Location: index.php");
  exit;
}
if (isset($_SESSION["user"])) {
  header("Location: home.php");
  exit;
}
$class = 'd-none';
if ($_GET['id']) {
  $id = $_GET['id'];
  $sql = "SELECT * FROM users WHERE userID = {$id}";
  $result = mysqli_query($connect, $sql);
  $data = mysqli_fetch_assoc($result);
  if (mysqli_num_rows($result) == 1) {
      $f_name = $data['first_name'];
      $l_name = $data['last_name'];
      $email = $data['email'];
      $phone = $data['phone'];
      $picture = $data['picture'];
      $address = $data['address'];
      $password = $data['password'];
  }
}
if ($_POST) {
  $id = $_POST['id'];
  $picture = $_POST['picture'];
  ($picture == "user.png") ?: unlink("pictures/$picture");

  $sql = "DELETE FROM users WHERE userID = {$id}";
  if ($connect->query($sql) === TRUE) {
      $class = "alert alert-success";
      $message = "Successfully Deleted!";
      header("refresh:3;url=dashboard.php");
  } else {
      $class = "alert alert-danger";
      $message = "The entry was not deleted due to: <br>" . $connect->error;
  }
}

mysqli_close($connect);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Delete User</title>
  <?php require_once 'components/bootstrap.php' ?>
  <style type="text/css">
      fieldset {
          margin: auto;
          margin-top: 100px;
          width: 70%;
      }

      .img-thumbnail {
          width: 70px !important;
          height: 70px !important;
      }
  </style>
</head>

<body>
<?php require_once 'components/nav.php'?>

  <div class="<?php echo $class; ?>" role="alert">
      <p><?php echo ($message) ?? ''; ?></p>
  </div>
  <fieldset>
      <legend class='h2 mb-3'>Delete request <img class='img-thumbnail rounded-circle' src='pictures/<?php echo $picture ?>' alt="<?php echo $f_name ?>"></legend>
      <h5>You have selected the data below:</h5>
      <table class="table w-75 mt-3">
          <tr>
              <td><?php echo "$f_name $l_name" ?></td>
              <td><?php echo $email ?></td>
              <td><?php echo $phone ?></td>
              <td><?php echo $address ?></td>
              <td><?php echo $password ?></td>
          </tr>
      </table>

      <h3 class="mb-4">Do you really want to delete this user?</h3>
      <form method="post">
          <input type="hidden" name="id" value="<?php echo $id ?>" />
          <input type="hidden" name="picture" value="<?php echo $picture ?>" />
          <button class="btn btn-danger" type="submit">Yes, delete it!</button>
          <a href="dashboard.php"><button class="btn btn-warning" type="button">No, go back!</button></a>
      </form>
  </fieldset>
</body>
</html>