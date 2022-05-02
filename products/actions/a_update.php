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
    $course_id = $_POST['course_id'];
    $name = $_POST["name"];
    $picture = $_POST["picture"];
    $availability = $_POST["availability"];
    $description = $_POST["description"];
    $price = $_POST["price"];
    $date = $_POST["date"];

    //variable for upload pictures errors is initialized
    $uploadError = '';

    $picture = file_upload($_FILES['picture'], 'courses'); //file_upload() called  
    if ($picture->error === 0) {
        ($_POST["picture"] == "user.png") ?: unlink("../../pictures/$_POST[picture]");
        $sql = "UPDATE courses SET name = '$name', picture = '$picture->fileName',availability = '$availability', price = '$price', date = '$date', description = '$description' WHERE course_id = {$course_id}";
    } else {
        $sql = "UPDATE courses SET name = '$name', availability = '$availability', price = '$price', date = '$date', description = '$description' WHERE course_id = {$course_id}";
    }
    if (mysqli_query($connect, $sql) === TRUE) {
        $class = "success";
        $message = "The record was successfully updated";
        $uploadError = ($picture->error != 0) ? $picture->ErrorMessage : '';
    } else {
        $class = "danger";
        $message = "Error while updating record : <br>" . mysqli_connect_error();
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
    <div class="container">
        <div class="mt-3 mb-3">
            <h1>Update request response</h1>
        </div>
        <div class="alert alert-<?php echo $class; ?>" role="alert">
            <p><?php echo ($message) ?? ''; ?></p>
            <p><?php echo ($uploadError) ?? ''; ?></p>
            <a href='../update.php?course_id=<?= $course_id; ?>'><button class="btn btn-warning" type='button'>Back</button></a>
            <a href='../index.php'><button class="btn btn-success" type='button'>Home</button></a>
        </div>
    </div>
</body>

</html>