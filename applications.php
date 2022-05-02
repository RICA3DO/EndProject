<!-- Display all Courses on a single web page and the admin should be able to see them -->

<?php
  session_start();

  require_once 'components/db_connect.php';

  #session check allowing only logged-in users to see the content
  if(!isset($_SESSION['adm']) && !isset ($_SESSION['user']) ) {
    header("Location: index.php");
    exit;
  }
  $tbody = '';

  $courseQuery = mysqli_query($connect, "SELECT courses_joined.courses_joinedID, courses.course_id, courses.picture, courses.name, courses.price, courses.date, users.userID, users.first_name, users.last_name, users.email
          from courses
          inner join courses_joined
          on fk_course_id = courses.course_id
          inner join users
          on fk_userID = users.userID;");

  if(mysqli_num_rows($courseQuery)  > 0) {
    while($courseRow = mysqli_fetch_array($courseQuery, MYSQLI_ASSOC))
    {
      $tbody .= "
        <tr class='text-center'>
        <td><img class='img-thumbnail' src='pictures/" . $courseRow['picture'] . "' alt=" . $courseRow['name'] . "></td>
          <td>" . $courseRow['courses_joinedID'] . "</td>
          <td>" . $courseRow['userID'] . "</td>
          <td>" . $courseRow['first_name'] . " " . $courseRow['last_name'] . "</td>
          <td>" . $courseRow['email'] . "</td>
          <td>" . $courseRow['course_id'] . "</td>
          <td>" . $courseRow['name'] . "€</td>
          <td>" . $courseRow['date'] . "</td>
          <td>" . $courseRow['price'] . "</td>
        </tr>";
    }
  } else $tbody = '<div class="row g-2 mb-3">No courses to display<div>';

  $connect->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- CSS & fonts -->
  <?php require_once 'components/bootstrap.php' ?>
  <style>
    .img-thumbnail {
          width: 70px;
          height: 70px;
      }
  </style>

  <title>Courses</title>

</head>
<body>
  <header>
    <!-- navbar -->
    <?php require_once 'components/nav2.php' ?>

  </header>

  <div class="container mt-4 mb-4">
    <div class="mb-3 text-center">
      <h2>All Courses</h2>
    </div>
    <a href="dashboard.php" ><button class="btn bg-success text-light mt-1 mb-3" type="button">Back to dashboard</button></a>
        <table class="table">
          <thead class="bg-green text-dark">
            <tr>
              <th>Picture</th>
              <th>Application id</th>
              <th>User id</th>
              <th>User name</th>
              <th>Email</th>
              <th>Course id</th>
              <th>Course name</th>
              <th>Date</th>
              <th>Price</th>
            </tr>
          </thead>
          <tbody>
            <?= $tbody ?>
          </tbody>
        </table>
  </div>
  
</body>
</html>