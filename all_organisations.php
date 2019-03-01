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

// Script below is to capture various aspects of Editing
// through POST & GET and exectute on MySQLi

include 'database.php';

if($_POST['accountname'] && $_POST['accountcode']){
$accountname = $connection->real_escape_string($_POST['accountname']);
$address = $connection->real_escape_string($_POST['address']);
$city = $connection->real_escape_string($_POST['city']);
$postcode = $connection->real_escape_string($_POST['postcode']);
$website = $connection->real_escape_string($_POST['website']);
$phone = $connection->real_escape_string($_POST['phone']);
$accountcode = $connection->real_escape_string($_POST['accountcode']);

}

$action = $connection->real_escape_string($_GET['action']);
if($action!="add"){
$id = $connection->real_escape_string($_GET["id"]);
}

if ($action == "add"){
$accountcode = $_POST['accountcode'];
    $sql = "INSERT INTO account (account_name, address, city, postcode, website, phone, account_code)
    VALUES ('$accountname', '$address', '$city', '$postcode', '$website', '$phone', '$accountcode')";


    if( $connection->query($sql) === TRUE){
      $changes = true;
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
$changes = true;
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
      $changes = true;
    }

    else
    {
      echo "Error: " . $sql . "<br>" . $connection->error;


      $connection->close();
    }

}


?>

</head>
<body class="bg-light">
  <?php include "top.php";
        require 'database.php';
        ?>
<div class="alert alert-primary" role="alert">
  <h4 class="alert-heading">Contacts book</h4>
  <p>All organisations</p>
</div>
<div id="main" class="container row">

<div id="leftscreen" class="col">


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
      echo " </small> <a href=all_organisations.php?id=". $row["id"] . "><i class='fas fa-edit'></i></a>";
      echo " <a href=all_organisations.php?action=delete&id=".$row["id"]." class='removal'><i class='fas fa-trash-alt'></i></a></small><br>";
    }
  }
  else {
    echo "zero results.";
  }


    $connection->close();


  ?>

</div>

</div>

<div class="col" id="rightscreen">


<?php
if (!$changes && $_GET['id']){
  include 'edit_organisation.php';
}
else{
  include 'add_organisation.php';
}
?>

</div>

</div>

</body>


<script><!-- pop the org name into the <span> tag in the headline. -->

  let span = document.getElementById("organisation");
  span.innerHTML= "<?php echo $accountname; ?>";
  </script>

</script>

<script> // for deleting people
let locked = true;
$(".removal").click(function(event){

if (locked){
event.preventDefault();

  if(confirm("Are you sure you would like to delete this organisation? (Ok to remove)")){
    locked = false;
    $(this).unbind('click').click();
    $(this)[0].click();
  }
  else {
    locked = true;
  }
}
});
</script>


</html>
