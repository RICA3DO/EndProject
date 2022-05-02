<?php 
  session_start();
  require_once 'components/db_connect.php';
  // if session is not set this will redirect to login page
  if( !isset($_SESSION['adm']) && !isset($_SESSION['user' ]) ) {
    header("Location: index.php");
    exit;
    }
  if(isset($_SESSION["user" ])){
    header("Location: home.php");
    exit;
    }

     $class = 'd-none';
     if($_GET['userID']) {
      $userID = $_GET['userID'];
      $applyRes = mysqli_query($connect, "SELECT courses.picture, courses.name, courses_joined.courses_joinedID, users.userID, users.first_name, users.last_name, users.email, courses.course_id, courses.date, courses.price
      from courses_joined 
      join courses on fk_course_id = courses.course_id
      join users on fk_userID = users.userID
      where fk_userID = {$userID}");
      $applyTable = '';
   
       if(mysqli_num_rows($applyRes) > 0) {
         while($applyRow = mysqli_fetch_array($applyRes, MYSQLI_ASSOC))
         {
           $applyTable .="
           <tr class='text-center'>
            <td><img class='img-thumbnail' src='pictures/" . $applyRow['picture'] . "' alt=" . $applyRow['name'] . "></td>
             <td>" . $applyRow['courses_joinedID'] . "</td>
             <td>" . $applyRow['userID'] . "</td>
             <td>" . $applyRow['first_name'] . " " . $applyRow['last_name'] . "</td>
             <td>" . $applyRow['email'] . "</td>
             <td>" . $applyRow['course_id'] . "</td>
             <td>" . $applyRow['name'] . "€</td>
             <td>" . $applyRow['date'] . "</td>
             <td>" . $applyRow['price'] . "</td>
           </tr>";
         };
       } else {
         $applyTable ="
             <td class=''>No course to display</td>
             <td class=''></td>
             <td class=''></td>
             <td class=''></td>
             <td class=''></td>
             <td class=''></td>
             <td class=''></td>
             <td class=''></td>
         ";
       }
     }
  $connect->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <?php require_once 'components/bootstrap.php' ?>
  <style>
    .img-thumbnail {
          width: 70px;
          height: 70px;
      }
  </style>

  <title></title>

</head>
<body>
  <header>
    <?php require_once 'components/nav2.php' ?>
  </header>

  <div class="container mt-4 mb-4">
    <div class="mb-3 text-center">
      <h2>User's Courses</h2>
    </div>
    <a href="dashboard.php" ><button class="btn bg-danger text-dark mt-1 mb-3" type="button">Back to dashboard</button></a>
    <a href="applications.php" ><button class="btn bg-info text-dark mt-1 mb-3" type="button">See all courses</button></a>
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
            <?= $applyTable; ?>
          </tbody>
        </table>
  </div>
  
</body>
</html>