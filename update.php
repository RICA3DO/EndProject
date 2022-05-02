<?php
session_start();
require_once 'components/db_connect.php';
require_once 'components/file_upload.php';
// if session is not set this will redirect to login page
if( !isset($_SESSION['adm']) && !isset($_SESSION['user']) ) {
    header("Location: index.php");
    exit;
   }
   
//fetch and populate form
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM users WHERE userID = {$id}";
    $result = mysqli_query($connect, $sql);
    if (mysqli_num_rows($result) == 1) {
        $data = mysqli_fetch_assoc($result);
        $f_name = $data['first_name'];
        $l_name = $data['last_name'];
        $email = $data['email'];
        $phone = $data['phone'];
        $address = $data['address'];
        $picture = $data['picture'];
    }   
}

//update
$class = 'd-none';
if (isset($_POST["submit"])) {
    $f_name = $_POST['first_name'];
    $l_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $id = $_POST['userID'];
    //variable for upload pictures errors is initialized
    $uploadError = '';    
    $pictureArray = file_upload($_FILES['picture']); //file_upload() called
    $picture = $pictureArray->fileName;
    if ($pictureArray->error === 0) {       
        ($_POST["picture"] == "user.png") ?: unlink("pictures/{$_POST["picture"]}");
        $sql = "UPDATE users SET first_name = '$f_name', last_name = '$l_name', email = '$email', phone = '$phone', address = '$address', picture = '$pictureArray->fileName' WHERE userID = {$id}";
    } else {
        $sql = "UPDATE users SET first_name = '$f_name', last_name = '$l_name', email = '$email', phone = '$phone', address = '$address' WHERE userID = {$id}";
    }
    if (mysqli_query($connect, $sql) === true) {     
        $class = "alert alert-success";
        $message = "The record was successfully updated";
        $uploadError = ($pictureArray->error != 0) ? $pictureArray->ErrorMessage : '';
        header("refresh:3;url=update.php?id={$id}");
    } else {
        $class = "alert alert-danger";
        $message = "Error while updating record : <br>" . $connect->error;
        $uploadError = ($pictureArray->error != 0) ? $pictureArray->ErrorMessage : '';
        header("refresh:3;url=update.php?id={$id}");
    }
}

mysqli_close($connect);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Edit User</title>
   <?php require_once 'components/bootstrap.php'?>
   <style type="text/css">
      .img-thumbnail {
          width: 100px !important;
          height: 100px !important;
      }
  </style>
  
</head>
<body>
<?php require_once 'components/nav2.php'?>

<div class="container">
    <div class="<?php echo $class; ?>" role="alert">
        <p><?php echo ($message) ?? ''; ?></p>
        <p><?php echo ($uploadError) ?? ''; ?></p>       
    </div>
        <div class="mb-4 text-center">
        <h2>Update your Profile: <?php echo $f_name ?></h2>        
        <img class='img-thumbnail rounded-circle' src='pictures/<?php echo $data['picture'] ?>' alt="<?php echo $f_name ?>">
        </div>
        <div class="d-flex justify-content-center">
        <form method="post" enctype="multipart/form-data">
            <table class=" table">
                <tr>
                    <th>First Name</th>
                    <td><input class="form-control" type="text"  name="first_name" placeholder ="First Name" value="<?php echo $f_name ?>"  /></td>
                </tr>
                <tr>
                    <th>Last Name</th>
                    <td><input class="form-control" type= "text" name="last_name"  placeholder="Last Name" value ="<?php echo $l_name ?>" /></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><input class="form-control" type="email" name="email" placeholder= "Email" value= "<?php echo $email ?>" /></td>
                </tr>
                <tr>
                    <th>Phone</th>
                    <td><input class="form-control" type="text" name="phone" placeholder= "Phone" value= "<?php echo $phone ?>" /></td>
                </tr>
                <tr>
                    <th>Address</th>
                    <td><input class="form-control" type="text" name="address" placeholder= "Address" value= "<?php echo $address ?>" /></td>
                </tr>
                <tr>
                    <th>Picture</th>
                    <td><input class="form-control" type="file" name="picture" /></td>
                </tr>
                <tr>
                    <input type= "hidden" name= "userID" value= "<?php echo $data['userID'] ?>" />
                    <input type= "hidden" name= "picture" value= "<?php echo $picture ?>" />
                    <td><button name="submit" class="btn btn-success" type= "submit">Save Changes</button></td>
                    <td><a href= "<?php echo $backBtn?>"><button class="btn btn-warning" type="button">Back</button></a></td>
                </tr>
            </table>
        </form>  
        </div>  
</div>
</body>
</html>