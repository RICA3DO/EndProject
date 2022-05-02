<?php
session_start();
require_once 'components/db_connect.php';
// if session is not set this will redirect to login page
if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}
//if session user exist it shouldn't access dashboard.php
if (isset($_SESSION["user"])) {
    header("Location: home.php");
    exit;
}

$id = $_SESSION['adm'];
$status = 'adm';
$sql = "SELECT * FROM users WHERE status != '$status'";
$result = mysqli_query($connect, $sql);

//this variable will hold the body for the table
$tbody = ''; 
if ($result->num_rows > 0) {
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
        $tbody .= "<tr>
            <td><img class='img-thumbnail rounded-circle' src='pictures/" . $row['picture'] . "' alt=" . $row['first_name'] . "></td>
            <td>" . $row['first_name'] . "</td>
            <td>" . $row['last_name'] . "</td>
            <td>" . $row['phone'] . "</td>
            <td>" . $row['address'] . "</td>
            <td>" . $row['email'] . "</td>
            <td><a href='update.php?id=" . $row['userID'] . "'><button class='btn btn-warning btn-lg' title='Edit User' type='button'> Edit User<i class='fas fa-user-edit'></i></button></a>
            <a href='delete.php?id=" . $row['userID'] . "'><button class='btn btn-danger btn-lg' title='Delete User' type='button'> Delete <i class='fas fa-user-minus'></i></button></a>
            <a href='user-application.php?userID=" . $row['userID'] . "'><button class='btn btn-info btn-lg' title='User's courses' type='button'>User's Courses</button></a></td>
         </tr>";
    }
} else {
    $tbody = "<tr><td colspan='5'><center>No Data Available </center></td></tr>";
}

mysqli_close($connect);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - DashBoard</title>
    <?php require_once 'components/bootstrap.php'?>
    <style type="text/css">
      .img-thumbnail {
          width: 70px;
          height: 70px;
      }

      td {
          text-align: left;
          vertical-align: middle;
      }

      tr {
          text-align: center;
      }

      .userImage {
          width: 25%;
          height: auto;
      }
  </style>
</head>
<body>
<?php require_once 'components/nav2.php'?>

<div class="container d-flex justify-content-center">
    <div class="row">
        <img class="userImage img-thumbnail rounded-circle" src="pictures/admin.jpg" alt="admin">
        <h1 class="">Admin</h1>
        <div  class="mt-5">
        <a href="applications.php" class="btn btn-lg bg-success text-light">See all courses</a>
        </div>
        <div class="mt-5">
        <p class='h3'>All Users:</p>
        <table class='table table-striped'>
            <thead class='table-primary'>
                <tr>
                    <th>Picture</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?=$tbody?>
            </tbody>
        </table>
        </div>
    </div>
</div> 
</body>
</html>