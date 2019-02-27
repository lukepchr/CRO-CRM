<?php session_start();
if(!$_SESSION[active]){
  include 'login.php';
  die();
}?>
<!doctype html>
<html lang="en">
<head> <?php include 'header.php' ?> </head>
<body class="bg-light">
<div id="main" class="bg-light">
  <?php include "top.php";
        require 'database.php';
        ?>
<div class="alert alert-primary" role="alert">
  <h4 class="alert-heading">Contacts book</h4>
  <p>All organisations</p>
</div>

<div id="form_container" class="container">

  <?php


  $sql = "SELECT * FROM account ORDER BY account_name ASC";

  $result = $connection->query($sql);

  if ($result->num_rows>0){
    while($row = $result->fetch_assoc()){
      echo
      "<a href='organisation_profile.php?id=".$row['id']."'>".
      $row["account_name"]. "</a> " .
      "<small class='text-muted'> in " . $row["city"] .
" <small><kbd>".$row["account_code"] . "</kbd></small> " ;
      echo " <a href=edit_organisation.php?id=". $row["id"] . ">[edit]</a>";
      echo " <a href=org_changed.php?action=delete&id=".$row["id"].">[delete]</a></small><br>";
    }
  }
  else {
    echo "zero results.";
  }


    $connection->close();


  ?>
<a href="add_organisation.php"><button class="btn btn-primary mt-2">Add a new organisation</button></a>
</div>

</div>
</body>


</html>
