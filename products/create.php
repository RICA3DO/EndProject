<?php
    function checkSession($level){
        session_start();
    if(!isset($_SESSION["user"]) && !isset($_SESSION["adm"])){
        header("Location: $levelindex.php");
        exit;
    }
    if(isset($_SESSION["user"])){
        header("Location: ../home.php");
        exit;
    }
    }
    session_start();
    if(!isset($_SESSION["user"]) && !isset($_SESSION["adm"])){
        header("Location: ../index.php");
        exit;
    }
    if(isset($_SESSION["user"])){
        header("Location: ../home.php");
        exit;
    }

    require_once "../components/db_connect.php";

    $sql = "SELECT * from courses";
    $result = mysqli_query($connect, $sql);
    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $courses = "";
    foreach($rows as $row){
        $courses .= "<option value='".$row["course_id"]."'>".$row["name"]."</option>";
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php require_once '../components/bootstrap.php'?>
        <title>Education</title>
        <style>
            fieldset {
                margin: auto;
                margin-top: 100px;
                width: 60% ;
            }       
        </style>
    </head>
    <body>
    <?php require_once '../components/nav3.php'?>

        <fieldset class="fieldset">
            <legend class='h2'>Add Course</legend>
            <form action="actions/a_create.php" method= "post" enctype="multipart/form-data">
                <table class='table'>
                <tr>
                        <th>Picture</th>
                        <td><input class='form-control' type="file" name="picture"  placeholder="Course Picture" ></td>
                    </tr> 
                    <tr>
                        <th>Name</th>
                        <td><input class='form-control' type="text" name="name"  placeholder="Course Name" ></td>
                    </tr>    
                    <tr>
                        <th>Availability</th>
                        <td><input class='form-control' type="text" name= "availability" placeholder="Availability" ></td>
                    </tr>
                    <tr>
                        <th>Description</th>
                        <td><input class='form-control' type="text" name="description" placeholder="description"></td>
                    </tr>
                    <tr>
                        <th>Price</th>
                        <td><input class='form-control' type="text" name="price" placeholder="Price"></td>
                    </tr>
                    <tr>
                        <th>Date</th>
                        <td><input class='form-control' type="date" name="date" placeholder="Date"></td>
                    </tr>
                    <tr>
                        <td><button class='btn btn-success' type="submit">Add the Course</button></td>
                        <td><a href="index.php"><button class='btn btn-warning' type="button">Home</button></a></td>
                    </tr>
                </table>
            </form>
        </fieldset>
    </body>
</html>