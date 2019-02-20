<!doctype html>
<html lang="en">
<!-- Takes GET type value for "action" to decide whether to add a new record, modify or delete -->
<!-- ID of the person is required. -->
<head>

<?php
include 'header.php';
require 'database.php';

$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$accountcode = $_POST['accountcode'];
$position = $_POST['position'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$action = $_GET['action'];
$id = $_GET["id"];

if ($action == "add"){


$sql = "INSERT INTO person (first_name, last_name, account_code, position, email, phone)
VALUES ('$firstname', '$lastname', '$accountcode', '$position', '$email', '$phone')";

?>

</head>
<body>
<div id="main" >
  <?php
  require 'database.php'; ?>
<div class="alert alert-success" role="alert">
  <h4 class="alert-heading">Add new person to a company...</h4>

  <p> <?php if( $connection->query($sql) === TRUE){
    echo "New record created successfully!";
  }
  else
  {
    echo "Error: " . $sql . "<br>" . $connection->error;


    $connection->close();
  }
}

elseif($action == "edit"){

// SQL query more or less:
$sql1 = "UPDATE `person` SET `first_name` = '$firstname' WHERE `id` = $id;";
$sql2 = "UPDATE `person` SET `last_name` = '$lastname' WHERE `id` = $id;";
$sql3 = "UPDATE `person` SET `account_code` = '$accountcode' WHERE `id` = $id;";
$sql4 = "UPDATE `person` SET `position` = '$position' WHERE `id` = $id;";
$sql5 = "UPDATE `person` SET `email` = '$email' WHERE `id` = $id;";
$sql6 = "UPDATE `person` SET `phone` = '$phone' WHERE `id` = $id;";
  ?>


  <div id="main" class="bg-light">
<?php include 'top.php'; ?>
  <div class="alert alert-info" role="alert">
    <h4 class="alert-heading">Modify person's details...</h4>

    <p> <?php if(
      $connection->query($sql1) === TRUE and
        $connection->query($sql2) === TRUE and
        $connection->query($sql3) === TRUE and
        $connection->query($sql4) === TRUE and
        $connection->query($sql5) === TRUE and
        $connection->query($sql6) === TRUE){
      echo "Profile modified successfully!";
    }
}

elseif($action == "delete"){
  $sql = "DELETE FROM person WHERE id = $id;";
    if($connection->query($sql)===TRUE)
    {
      echo "Person deleted successfully.";
    }

    else
    {
      echo "Error: " . $sql . "<br>" . $connection->error;


      $connection->close();
    }
}



else {


  echo "ERROR, no action specified. What did you want to do?";
}

  ?></p>

</div>

<div class="container ml-5"> Great job so far. Do you fancy <a href="add_person.php">adding anyone</a> or do you want to <a href="all_people.php">get back to the main screen?</a>?</div>


</div>

</body>



</html>
