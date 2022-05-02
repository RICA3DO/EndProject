<?php
session_start();
if (!isset($_SESSION["user"]) && !isset($_SESSION["adm"])) {
    header("Location: ../index.php");
    exit;
}
if (isset($_SESSION["user"])) {
    header("Location: ../home.php");
    exit;
}
require_once '../components/db_connect.php';

if ($_GET['course_id']) {
    $course_id = $_GET['course_id'];
    $sql = "SELECT * FROM courses WHERE course_id = {$course_id}";
    $result = mysqli_query($connect, $sql);
    if (mysqli_num_rows($result) == 1) {
        $data = mysqli_fetch_assoc($result);
        $course_id = $data['course_id'];
        $name = $data['name'];
        $picture = $data['picture'];
        $availability = $data["availability"];
        $description = $data["description"];
        $price = $data["price"];
        $date = $data["date"];
    } else {
        header("location: error.php");
    }
    mysqli_close($connect);
} else {
    header("location: error.php");
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Education | Admin</title>
    <link rel="stylesheet" href="">

    <?php require_once '../components/bootstrap.php' ?>
    <style type="text/css">
        fieldset {
            margin: auto;
            width: 60%;
        }

        .img-thumbnail {
            width: 20% !important;
            height: 20% !important;
        }
    </style>
</head>

<body>
    <?php require_once '../components/nav3.php' ?>

    <fieldset>
        <legend class='h2'>Update request <img class='img-thumbnail rounded-circle' src='../pictures/<?php echo $picture ?>' alt="<?php echo $name ?>"></legend>
        <form action="actions/a_update.php" method="post" enctype="multipart/form-data">
            <table class="table">
                <tr>
                    <th>Picture</th>
                    <td><input class='form-control' type="file" name="picture" placeholder="Picture"></td>
                </tr>
                <tr>
                    <th>Name</th>
                    <td><input class='form-control' type="text" name="name" placeholder="Name" value="<?php echo $name ?>"></td>
                </tr>
                <tr>
                    <th>Availability</th>
                    <td><input class='form-control' type="text" name="availability" placeholder="Availability" value="<?php echo $availability ?>"></td>
                </tr>
                <tr>
                    <th>Description</th>
                    <td><input class='form-control' type="text" name="description" placeholder="description" value="<?php echo $description ?>"></td>
                </tr>
                <tr>
                    <th>Price</th>
                    <td><input class='form-control' type="text" name="price" placeholder="Price" value="<?php echo $price ?>"></td>
                </tr>
                <tr>
                    <th>Date</th>
                    <td><input class='form-control' type="text" name="date" placeholder="Date" value="<?php echo $date ?>"></td>
                </tr>
                <tr>
                    <input type="hidden" name="course_id" value="<?php echo $data['course_id'] ?>" />
                    <input type="hidden" name="picture" value="<?php echo $data['picture'] ?>" />
                    <td><button class="btn btn-success" type="submit">Save Changes</button></td>
                    <td><a href="index.php"><button class="btn btn-warning" type="button">Back</button></a></td>
                </tr>
            </table>
        </form>
    </fieldset>
</body>

</html>