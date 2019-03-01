<?php session_start();
if(!$_SESSION[active]){
  include 'login.php';
  die();
}?>
<!doctype html>
<html lang="en">
<head>

<?php



include 'header.php';

  require 'database.php';
  $message = $_POST["post"];
  $keepcode = $_GET["account_code"];
  $return = $_GET["return"];
  $message = $connection->real_escape_string ($message);
  $timestamp = date("Y-m-d, h:i");
 ?>
</head>

<body class="bg-light">

<?php


  if($message<>"")
  {
    $sql = "INSERT INTO posts ".
    "(memo, time_created, account_code) ".
    "VALUES ('$message','$timestamp','$keepcode');";
    $note = "posted";

  }

  if($_GET["action"]== "delete"){
    $id = $_GET['id'];
    $sql = "DELETE FROM posts WHERE id = '$id'";
    $note= "removed";
  }

  if ($sql<>""){

  if($connection->query($sql)){
  echo "<div id='alert' class='alert-success position-fixed'>Success, a message was $note. <small>($sql)</small></div>";
  $success=true;
  }
  else{
  echo $connection->error;
  echo "<div id='alert' class='alert-warning position-fixed'>Message not $note! <small>($sql)</small></div>";
  $success=false;
  }

  // little script to delete the notification.
  echo '
    <script>
      $("#alert").fadeOut(3000);
    </script>
  ';

  }

  if ($_GET["return"]){
    echo "<script>
      window.location.replace('organisation_profile.php?id=$return&note=$note&success=$success');
      </script>";
  }
?>



<div id="main" >
  <?php
        include 'top.php';
        require 'database.php';
        ?>

        <div class="alert alert-primary" role="alert">
          <h4 class="alert-heading">What's new?</h4>
          <p>
            Good <?php
        $hour = date("H");
        if ($hour > 18){
          echo "evening";
        }
        else if($hour > 12 ){
          echo "afternoon";
        }
        else {
          echo "morning";
        }
         ?>, welcome to the news feed. It's <?php echo $now = date("l, jS \of F"); ?>.
          </p>
        </div>



<div id="mainfeed" class="container col-md-5 float-left">

  <div class="form-group clearfix">
      <form id="newpost" class="form-group" action="index.php" method="POST">

      <textarea rows="3" cols="50" name="post" class="form-control" required ></textarea>

      <button type="submit" class="btn btn-primary mt-1 mb-3 float-right"><i class="fas fa-paper-plane"></i> Send</button>
  </div>


    <?php

    $sql = "SELECT * FROM posts ORDER BY id DESC;";

      $result = $connection->query($sql);

      if ($result->num_rows>0){
        while($row = $result->fetch_assoc()){
          $acc= $row['account_code'];
          $subsql = "SELECT * FROM account WHERE account_code = '$acc';";
          $subresult = $connection->query($subsql);
          $row2 = $subresult->fetch_assoc();

          echo '<div class ="card border-dark mb-3"
          style="box-shadow: 4px 4px 4px 2px rgba(0,0,0,0.15);">'.
          '<div class="card-header">'."<small class='text-muted'><i>";

          if($row2['account_name'] <> ""){
            echo "A note regarding <a href='organisation_profile.php?id=".$row2['id']."'>".$row2['account_name']."</a>, posted ";
          }
          echo $row["time_created"]. "</i></div></small>
          <div 'card-body text-dark'>

          <p class='card-text'
            style='margin: 10px 20px'>".$row["memo"]."</p>" .
          '<a href="index.php?action=delete&id='.$row["id"].'">
          <button type="button" class="close" aria-label="Delete"
            style="position: absolute; top:-1px; right: 3px; outline: none">
          <span aria-hidden="true">&times;</span>
            </button> </a>'.
          "</div></div></small>";
    }

    }
    ?>

</div>
</div>

</body>

</html>
