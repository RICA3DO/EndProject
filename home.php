<?php
session_start();
require_once 'components/db_connect.php';

if (isset($_SESSION['adm'])) {
  header("Location: dashboard.php");
  exit;
}
if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
  header("Location: index.php");
  exit;
}

$res = mysqli_query($connect, "SELECT * FROM users WHERE userID =" . $_SESSION['user']);
$row = mysqli_fetch_array($res, MYSQLI_ASSOC);

$sql = "SELECT * FROM courses";

$result = mysqli_query($connect, $sql);
$tbody = '';
if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    $tbody .= "<tr>
                <td><img src='pictures/" . $row['picture'] . "' class='card-img-top' alt='...'></td>
                <td>" . $row['name'] . "</td> 
                <td>" . $row['availability'] . "</td>
                <td>" . $row['description'] . "</td>
                <td>" . $row['price'] . "</td>
                <td>" . $row['date'] . "</td>
                <td>
                <form action='home.php' method='post'>
                <input type='hidden' name='course_id' class='form-control' value=".$row['course_id']."/>
                <button class='btn btn-lg btn-success' name='submitb' type='submit'>Join this Course</a></button>
                </form>
                </td>";
  }
} else {
  $tbody = "<tr><td colspan='5'><center>No Data Available</center></td></tr>";
}

if(isset($_POST['submitb'])) {
  $course_id = $_POST['course_id'];
  $userID = $_SESSION['user'];
  $sql = "INSERT INTO courses_joined (fk_course_id, fk_userID) VALUES ('$course_id', '$userID')";
  if($connect->query($sql) === true){
    $msg = 'Congrats, you joined the course!';
    echo "<script type='text/javascript'>alert('$msg');</script>";
  } else {
    $msg = 'Something went wrong, try again later';
    echo "<script type='text/javascript'>alert('$msg');</script>";
  }
}

mysqli_close($connect);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Welcome</title>
  <?php require_once 'components/bootstrap.php' ?>
</head>

<body>
  <?php require_once 'components/nav1.php' ?>

  <div class="container">
    <p class='mt-5 mb-5 display-2 text-center'>Courses</p>
    <div class="d-flex justify-content-start mt-4 mb-3">
      <a href="home.php" class="btn btn-outline-success btn-lg ">Show all courses </a>
    </div>
    <table class='table bg-dark text-light'>
      <thead class='table-secondary'>
        <tr>
          <th class='h3'>Picture</th>
          <th class='h3'>Name</th>
          <th class='h3'>Availability</th>
          <th class='h3'>Description</th>
          <th class='h3'>Price</th>
          <th class='h3'>Date</th>
          <th class='h3'>Options</th>
        </tr>
      </thead>
      <tbody>
        <?= $tbody; ?>
      </tbody>
    </table>
  </div>
</body>

</html>