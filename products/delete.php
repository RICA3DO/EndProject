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

if ($_GET['course_id']) {
    $id = $_GET['course_id'];
    $sql = "SELECT * FROM courses WHERE course_id = {$id}" ;
    $result = mysqli_query($connect, $sql);
    $data = mysqli_fetch_assoc($result);
    if (mysqli_num_rows($result) == 1) {
        $name = $data['name'];
        $picture = $data['picture'];
        $availability = $data['availability'];
    } else {
        header("location: error.php");
    }
    mysqli_close($connect);
} else {
    header("location: error.php");
}  
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Education | Admin</title>
        <?php require_once '../components/bootstrap.php'?>
        <style type= "text/css">
            fieldset {
                margin: auto;
                margin-top: 100px;
                width: 60% ;
            }  
                
        </style>
    </head>
    <body>
    <?php require_once '../components/nav3.php'?>
<div class="container mb-5 ">
        <fieldset>
            <legend class='h2 mb-3'>Delete from Database Request <img class='img-thumbnail rounded-circle' src='../pictures/<?php echo $picture ?>' alt="<?php echo $name ?>"></legend>
            <h5>You have selected the data below:</h5>
            <table class="table w-75 mt-3">
                 <tr>
                    <th>Name</th>
                    <td><?php echo $name?></td>
                </tr>
                <tr>
                    <th>Availability:</th>
                    <td><?php echo $availability?></td>
                </tr>

                </table>
            <h3 class="mb-4">Do you really want to delete this Course from the Database?</h3>
            <form action ="actions/a_delete.php" method="post">
                <input type="hidden" name="course_id" value="<?php echo $id ?>" />
                <input type="hidden" name="picture" value="<?php echo $picture ?>" />
                <button class="btn btn-danger" type="submit">Yes, delete it!</button>
                <a href="index.php"><button class="btn btn-warning" type="button">No, go back!</button></a>
            </form>
        </fieldset>
        </div> 
    </body>
</html>