<?php 

$localhost = "localhost";
$username = "root";
$password = "";
$dbname = "end_project_ricardo";


$connect = mysqli_connect($localhost, $username, $password, $dbname);


//if (!$connect) {
//    die("Connection failed: " . mysqli_connect_error());
//};