<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <?php include_once 'components/bootstrap.php';?>
    <title>Education</title>
</head>
<body>
    <header>
        <?php include_once 'components/nav1.php';  ?>
    </header>
<main>
	<div class="row d-flex justify-content-center">
   
      <div class="col-md-5 col-md-offset-3">
      <h3 class="mt-5">Contact Form:</h3>
      <h5 class="mt-5">Please fill out this form for suggestions or other inquiries, thank you.</h5>
          <form class="form-horizontal " action="" method="post">
            <div class="form-group">
              <label class="col-md-3 control-label mt-5" for="name">Name</label>
              <div class="col-md-9">
                <input id="name" name="name" type="text" placeholder="Your name" class="form-control">
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-3 control-label mt-3" for="email">Your E-mail</label>
              <div class="col-md-9">
                <input id="email" name="email" type="text" placeholder="Your email" class="form-control">
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-3 control-label mt-3" for="message">Your message</label>
              <div class="col-md-9">
                <textarea class="form-control" id="message" name="message" placeholder="Enter your message here...." rows="3"></textarea>
              </div>
            </div>
            <div class="form-group">
              <div class="col-md-9 mt-3 mb-3">
                <button type="submit" class="btn btn-info btn-lg ">Submit</button>
              </div>
            </div>
          </form>
  	</div>
  </div>
</main>  
    </body>
</html>