<nav class="navbar navbar-expand-lg navbar-light bg-dark">
<div class="container-fluid">
<a class="navbar-brand text-light">Education</a>
  <div class="collapse navbar-collapse">
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item">
        <a class="nav-link active text-light" aria-current="page" href="home.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active text-light" aria-current="page" href="update.php?id=<?php echo $_SESSION['user'] ?>"> Your Profile</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active text-light" aria-current="page" href="contact.php">Contact</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active text-light" aria-current="page" href="logout.php?logout">Sign out</a>
      </li>
  </div>
  </div>
</nav>