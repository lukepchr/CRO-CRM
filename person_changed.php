<!doctype html>
<html lang="en">
<!-- Takes GET type value for "action" to decide whether to add a new record, modify or delete -->
<!-- ID of the person is required. -->
<head>


</head>
<body class="bg-light">
<div id="main" class="bg-light">
  <?php include 'top.php';?>



    <?php
    include 'header.php';
    require 'database.php';

    // pick up all the inputs from POST/GET and escape the strings.
    $firstname = $connection->real_escape_string ($_POST['firstname']);
    $lastname = $connection->real_escape_string ($_POST['lastname']);
    $accountcode = $connection->real_escape_string ($_POST['accountcode']);
    $position = $connection->real_escape_string ($_POST['position']);
    $email = $connection->real_escape_string ($_POST['email']);
    $phone = $connection->real_escape_string ($_POST['phone']);
    $action = $connection->real_escape_string ($_GET['action']);
    $id = $connection->real_escape_string ($_GET["id"]);

    if ($action == "add"){


    $sql = "INSERT INTO person (first_name, last_name, account_code, position, email, phone)
    VALUES ('$firstname', '$lastname', '$accountcode', '$position', '$email', '$phone')";

    if( $connection->query($sql) === TRUE){
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

  ?>


</p>

</div>


</div>

</body>



</html>
