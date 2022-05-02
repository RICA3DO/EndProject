<?php
session_start();
if (!isset($_SESSION["user"]) && !isset($_SESSION["adm"])) {
    header("Location: ../../index.php");
    exit;
}
if (isset($_SESSION["user"])) {
    header("Location: ../../home.php");
    exit;
}
require_once '../../components/db_connect.php';
require_once '../../components/file_upload.php';
if ($_POST) {
    //$course_id = $_POST['course_id'];
    $name = $_POST["name"];
    //$picture = $_POST['picture'];
    $availability = $_POST["availability"];
    $description = $_POST["description"];
    $price = $_POST["price"];
    $date = $_POST["date"];

    $uploadError = '';
    //this function exists in the service file upload.
    $picture = file_upload($_FILES['picture'], 'courses');
    if ($picture == 'none') {
        $sql = "INSERT INTO courses (name, picture, availability , description, price , date) 
                 VALUES   ('$name','$picture->fileName','$availability','$price','$date')";
    } else {
        $sql = "INSERT INTO courses (name, picture, availability , description, price, date) 
                 VALUES   ('$name','$picture->fileName','$availability','$price','$date')";
    }


    if (mysqli_query($connect, $sql) === true) {
        $class = "success";
        $message = "The entry below was successfully created <br>
            <table class='table w-50'><tr>
            <td>$name</td>
            <td>$availability</td>
            <td>$description</td>
            <td>$price</td>
            <td>$date</td>
            </tr></table><hr>";
        $uploadError = ($picture->error != 0) ? $picture->ErrorMessage : '';
    } else {
        $class = "danger";
        $message = "Error while creating record. Try again: <br>" . $connect->error;
        $uploadError = ($picture->error != 0) ? $picture->ErrorMessage : '';
    }
    mysqli_close($connect);
} else {
    header("location: ../error.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Update</title>
    <?php require_once '../../components/bootstrap.php' ?>

</head>

<body>
    <?php require_once '../../components/nav.php' ?>

    <div class="container">
        <div class="mt-3 mb-3">
            <h1>Create request response</h1>
        </div>
        <div class="alert alert-<?= $class; ?>" role="alert">
            <p><?php echo ($message) ?? ''; ?></p>
            <p><?php echo ($uploadError) ?? ''; ?></p>
            <a href='../index.php'><button class="btn btn-primary" type='button'>Home</button></a>
        </div>
    </div>
</body>

</html>
