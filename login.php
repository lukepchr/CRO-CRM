<?php if (session_status() == PHP_SESSION_NONE){session_start();}?>
<!doctype html>
<html lang="en">
<header>
<?php
include 'header.php';
?>
</header>

<body class="bg-light">

<div id="main">

  <?php
    if (isset($_GET['action'])){
      session_destroy ();

      echo
          '<div class="alert alert-warning" role="alert">
          <h4 class="alert-heading">Log-in</h4>
          <p>Logged out!</p></div>';
        }
else {

    include 'database.php';
    if(isset($_POST['login']) && isset($_POST['password'])){
    $login = $connection->real_escape_string($_POST['login']);
    $password = $connection->real_escape_string($_POST['password']);

    // check login and password with the database.
    $sql = "SELECT * FROM user WHERE user = '$login';";

    if(!isset($connection->query($sql)->fetch_object()->user))
      {
        echo
            '<div class="alert alert-warning" role="alert">
            <h4 class="alert-heading">Log-in</h4>
            <p>User does not exist!</p>';
          }

      else{
        $sql = "SELECT * FROM user WHERE user = '$login' AND password = '$password'";

        if(isset($connection->query($sql)->fetch_object()->user)){

          $_SESSION['active'] = true;
          $_SESSION['user']= $login;
          include 'top.php';
          echo
          '
          <div class="alert alert-primary mt-6 display-block" role="alert">
          <h4 class="alert-heading">Welcome!</h4>
          <div>
          <p>You are successfully logged in. Go to the index page to begin or choose a tab above.</p>

          <a href="index.php" class="btn btn-primary">Ok</a>

          </div>';
              die();
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
}
    ?>



  </div>


<div class="container col-md-3 center-block mx-6 card p-5 ">
  <picture>
    <img src="https://localhost/CRM/crow.png" class="img-fluid max-width: 50%" alt="CRO logo">
  </picture>

    <form action="index.php" method="POST" id="form">
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
