<?php
session_start();
if(!isset($_SESSION["user"]) && !isset($_SESSION["adm"])){
    header("Location: ../index.php");
    exit;
}
if(isset($_SESSION["user"])){
    header("Location: ../home.php");
    exit;
}
require_once '../components/db_connect.php';
$sql = "SELECT * FROM courses";
$result = mysqli_query($connect ,$sql);
$tbody='';
if(mysqli_num_rows($result)  > 0) {     
    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){         
        $tbody .= "<tr>
            <td><img  src='../pictures/" .$row['picture']."' class='card-img-top'</td>
            <td>" .$row['name']."</td> 
            <td>" .$row['availability']."</td>
            <td>" .$row['description']."</td>
            <td>" .$row['price']."</td>
            <td>" .$row['date']."</td>
            <td>
            <a href='update.php?course_id=" .$row['course_id']."'><button class='btn btn-warning btn-md mt-5' title='Edit Course' type='button'>Edit<i class='far fa-edit'></i></button></a>
            <a href='delete.php?course_id=" .$row['course_id']."'><button class='btn btn-danger btn-md mt-5' title='Delete Course' type='button'>Delete<i class='fas fa-trash'></i></button></a>
            <a href='details.php?name=" .$row['name']."'><button class='btn btn-success btn-md mt-5' title='More info' type='button'>Details<i class='fas fa-trash'></i></button></a></td>
            </tr>";
    };
} else {
    $tbody =  "<tr><td colspan='6'><center>No Data Available </center></td></tr>";
}

mysqli_close($connect);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Education | Admin</title>
        <link rel="stylesheet" href="">
        <?php require_once '../components/bootstrap.php'?>
      </head>
    <body>
    <?php require_once '../components/nav3.php'?>

        <div class="container text-center">  
        <h4 class="mt-5 mb-5 display-2 text-center" > All Courses</h4> 
            <a href= "create.php"><button class='btn btn-info mb-5'type="button" >Add new Course</button></a>
            <div class="container">
            
            <table class='table bg-dark text-light'>
                <thead class='table-primary'>
                    <tr>
                        <th>Picture</th>
                        <th>Name</th>
                        <th>Availability</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Date</th>
                        <th>Options</th>
                    </tr>
                </thead>
                <tbody>
                    <?= $tbody;?>
                </tbody>
            </table>
            </div>
        </div>
    </body>
</html>