<!doctype html>
<html lang="en">
<head> <?php include 'header.php' ?> </head>
<body class="bg-light">
<div id="main">
  <?php include "top.php";
        require 'database.php';
        ?>
<div class="alert alert-primary" role="alert">
  <h4 class="alert-heading">Contacts book</h4>
  <p>Individuals from all organisations.</p>
</div>

<div id="form_container" class="container">

  <?php


  $sql = "SELECT * FROM person ORDER BY last_name ASC";

  $result = $connection->query($sql);

  if ($result->num_rows>0){
    while($row = $result->fetch_assoc()){
      echo $row["first_name"]. " " . $row["last_name"];


      $sql = "SELECT account_name FROM account WHERE account_code ='" . $row['account_code']. "';";

   $employer = $connection->query($sql)->fetch_object()->account_name;

echo "<small class='text-muted'>";

if ($employer){
echo " from " . $employer;
}
else{
  echo " (company missing)";
}

echo " <a href=edit_person.php?id=". $row["id"] . ">[edit]</a>";
echo " <a href=person_changed.php?action=delete&id=".$row["id"].">[delete]</a></small><br>";


} // end of the associative fetch
  }
  else {
    echo "zero results.";
  }

  $connection->close();


  ?>
<a href="add_person.php"><button class="btn btn-primary mt-2">Add a new person</button></a>
</div>
</div>
</body>


</html>
