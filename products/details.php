<?php
require_once '../components/db_connect.php';

if ($_GET['name']) {
    $name = $_GET['name'];
    $sql = "SELECT * FROM courses WHERE name = '$name'";
    $result = mysqli_query($connect, $sql);
    $tbody = '';
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $tbody .= "<tr>
            <td><img class='img-thumbnail' src='../pictures/" . $row['picture'] . "'</td>
            <td>" .$row['name']."</td> 
            <td>" .$row['availability']."</td>
            <td>" .$row['description']."</td>
            <td>" .$row['price']."</td>
            <td>" .$row['date']."</td>
            </tr>";
        }
    } else {
        $tbody = "<tr><td colspan='5'><center>NO AVAILABLE DATA</center></td></tr>";
    }
}
mysqli_close($connect);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Details</title>
    <?php require_once '../components/bootstrap.php' ?>
    <?php require_once '../components/nav1.php' ?>
    <style type="text/css">
        .course {
            margin: auto;
        }
    </style>
</head>

<body>
    <div class="course w-50 mt-5 bg-dark">
    <table class='table text-light'>
            <thead class='table-secondary'>
                <tr>
                    <th class='h3'>Picture</th>
                    <th class='h3'>Name</th>
                    <th class='h3'>Description</th>
                    <th class='h3'>Availability</th>
                    <th class='h3'>Price</th>
                    <th class='h3'>Date</th>

            </thead>
            <tbody>
                <?= $tbody; ?>
            </tbody>
        </table>
        <div class='mb-5 d-flex justify-content-center'>
            <a href="index.php"><button class='btn btn-md btn-success' type="button">Back</button></a>
        </div>
    </div>
</body>

</html>