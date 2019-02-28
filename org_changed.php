<!doctype html>
<html lang="en">
<head>

<?php
include 'header.php';

$accountname = $connection->real_escape_string($_POST['accountname']);
$address = $connection->real_escape_string($_POST['address']);
$city = $connection->real_escape_string($_POST['city']);
$postcode = $connection->real_escape_string($_POST['postcode']);
$website = $connection->real_escape_string($_POST['website']);
$phone = $connection->real_escape_string($_POST['phone']);
$accountcode = $connection->real_escape_string($_POST['accountcode']);
$action = $connection->real_escape_string($_GET['action']);
$id = $connection->real_escape_string($_GET["id"]);
?>


<body class="bg-light">

<div id="main">
  <?php include 'top.php';
  include "database.php";?>
<div class="alert alert-info" role="alert">
  <h4 class="alert-heading">Organisation records...</h4>

  <p> <?php

if ($action == "add"){
$accountcode = $_POST['accountcode'];
    $sql = "INSERT INTO account (account_name, address, city, postcode, website, phone, account_code)
    VALUES ('$accountname', '$address', '$city', '$postcode', '$website', '$phone', '$accountcode')";


    if( $connection->query($sql) === TRUE){
      echo "New record created successfully!";
    }
    else
    {
      echo "Error!" . $connection->error;

      $connection->close();
    }
}

elseif($action == "edit"){
$sql1 = "UPDATE account SET account_name = '$accountname' WHERE id = $id;";
$sql2 = "UPDATE account SET address = '$address' WHERE id = $id;";
$sql3 = "UPDATE account SET city = '$city' WHERE id = $id;";
$sql4 = "UPDATE account SET postcode = '$postcode' WHERE id = $id;";
$sql5 = "UPDATE account SET website = '$website' WHERE id = $id;";
$sql6 = "UPDATE account SET phone = '$phone' WHERE id = $id;";
$sql7 = "UPDATE account SET account_code = '$accountcode' WHERE id = $id;";

if($connection->query($sql1) === TRUE and
  $connection->query($sql2) === TRUE and
  $connection->query($sql3) === TRUE and
  $connection->query($sql4) === TRUE and
  $connection->query($sql5) === TRUE and
  $connection->query($sql6) === TRUE and
$connection->query($sql7)=== TRUE){
echo "Profile modified successfully!";
}
else{
    echo "Error!" . $connection->error;
}
  $connection->close();


}
elseif($action== "delete"){
  $sql = "DELETE FROM account WHERE id = '$id';";
    if($connection->query($sql)===TRUE)
    {
      echo "Account deleted successfully.";
    }

    else
    {
      echo "Error: " . $sql . "<br>" . $connection->error;


      $connection->close();
    }

}
else {
  echo "sorry, not sure what to do.";
}


?>
</p>

</div>

<div> Great job so far. Do you fancy <a href="add_person.php">adding anyone else</a> or do you want to <a href="all_organisations.php">get back to the main screen</a>?</div>

</div>

</body>

</html>
