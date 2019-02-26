<?php
  session_start();
?>
<!doctype html>
<html lang="en">
<header>
<?php
include 'header.php';
?>
</header>

<body class="bg-light">

  <?php include 'top.php'; ?>

<div id="main">

  <?php

    include 'database.php';
    $login = $_POST['login'];
    $password = $_POST['password'];

    if($login AND $password){
    // check login and password with the database.
    $sql = "SELECT * FROM user WHERE user = '$login';";

    if(!$connection->query($sql)->fetch_object()->user)
      {
        echo
            '<div class="alert alert-warning" role="alert">
            <h4 class="alert-heading">Log-in</h4>
            <p>User does not exist!</p>';
          }

      else{
        $sql = "SELECT * FROM user WHERE user = '$login' AND password = '$password'";

        if($connection->query($sql)->fetch_object()->user){

          $_SESSION['active'] = true;
          echo
              '<div class="alert alert-success" role="alert">
              <h4 class="alert-heading">Log-in</h4>
              <p>Successfully logged in.</p>';
            }

        else {
          echo
              '<div class="alert alert-warning" role="alert">
              <h4 class="alert-heading">Log-in</h4>
              <p>Incorrect password.</p>';
            }
            $connection->close();
          }
      }


  else{

// otherwise ask to enter credentials (the default view)
echo
    '<div class="alert alert-primary" role="alert">
    <h4 class="alert-heading">Log-in</h4>
    <p>Please use your credentials to access this application.</p>';
  }

    ?>



  </div>


  <div class="container col-md-2 align-center mt-5">
    <form action="#" method="POST">
      <div class="col">

<div class= "form-group">
  <label for="login">Login:</label>
  <input type="text" autocomplete="username" class="col form-control" name="login" required>
</div>
<div class="form-group">
        <label for="password">Password:</label>
        <input type="password"  class="col form-control" name= "password" autocomplete="current-password" required>
</div>
        <input type ="submit"  class="col form-control btn btn-primary" name="submit">
      </div>
    </form>

  </div>

</div>
</body>
</html>
