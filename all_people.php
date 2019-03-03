<?php session_start();
if(!$_SESSION['active']){
  include 'login.php';
  die();
}?>
<!doctype html>
<html lang="en">
<head> <?php include 'header.php';

require 'database.php';

// pick up all the inputs from POST/GET and escape the strings.
if(isset($_POST['firstname'], $_POST['lastname'], $_POST['accountcode'],
$_POST['position'] , $_POST['email'] , $_POST['phone'])){
$firstname = $connection->real_escape_string ($_POST['firstname']);
$lastname = $connection->real_escape_string ($_POST['lastname']);
$accountcode = $connection->real_escape_string ($_POST['accountcode']);
$position = $connection->real_escape_string ($_POST['position']);
$email = $connection->real_escape_string ($_POST['email']);
$phone = $connection->real_escape_string ($_POST['phone']);
}


if(isset($_GET['id'])){

  $id = $connection->real_escape_string ($_GET["id"]);
}

if(isset($_GET['action'])){
$action = $connection->real_escape_string ($_GET['action']);


if ($action == "add"){

$sql = "INSERT INTO person (first_name, last_name, account_code, position, email, phone)
VALUES ('$firstname', '$lastname', '$accountcode', '$position', '$email', '$phone')";

if( $connection->query($sql) === TRUE){
echo "New record created successfully!";
$changes = true;
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
  $changes = true;
}
}

elseif($action == "delete"){
$sql = "DELETE FROM person WHERE id = $id;";
if($connection->query($sql)===TRUE)
{
  echo "Person deleted successfully.";
  $changes = true;
}

else
{
  echo "Error: " . $sql . "<br>" . $connection->error;


  $connection->close();
}
}
} // end of the action dependant block

// begin rendering of the data on the website


if(isset($_GET['id'])){

require 'database.php';
$id = $connection->real_escape_string($_GET['id']);



$sql = "SELECT * FROM person WHERE id =" . $id;

$result = $connection->query($sql);

if($result){
  while($row = $result->fetch_assoc()){

    $firstname = $row["first_name"];
    $lastname = $row["last_name"];
    $accountcode = $row["account_code"];
    $position = $row["position"];
    $email = $row["email"];
    $phone = $row["phone"];

  }
}

}

?>
</head>

<body class="bg-light">
<div id="main">
  <?php include "top.php";
        require 'database.php';
        ?>
<div class="alert alert-primary" role="alert">
  <h4 class="alert-heading">Contacts book</h4>
  <p>Individuals from all organisations.</p>
</div>

<div id="form_container" style="line-height: 1.5em;" class="container row">

<div class="col">
  <?php


  $sql = "SELECT * FROM person ORDER BY last_name ASC";

  $result = $connection->query($sql);

  if ($result->num_rows>0){
    while($row = $result->fetch_assoc()){
      echo "<div style='display: inline;' id='p".$row['id']."'>". $row["first_name"]. " " . $row["last_name"]."</div>";


      $sql = "SELECT account_name FROM account WHERE account_code ='" . $row['account_code']. "';";


    if (isset($connection->query($sql)->fetch_object()->account_name)){
      $employer = $connection->query($sql)->fetch_object()->account_name;
    }

echo "<small class='text-muted'>";

if ($employer){
echo " from " . $employer;
}
else{
  echo " (company missing)";
}

// display the Edit icon
echo "</small> <a href=all_people.php?id=". $row["id"] . "><i class='fas fa-edit'></i></a>";

// display the Delete icon
echo " <a href=all_people.php?action=delete&id=".$row["id"]." class='removal'>
<i class='fas fa-trash-alt'></i>
</a><br>";


} // end of the associative fetch
  }
  else {
    echo "zero results.";
  }

  $connection->close();


  ?>

</div>
<div class="col" id="rightscreen">


<?php
if (isset($_GET['id'])){
  include 'edit_person.php';
}
else{
  include 'add_person.php';
}
?>

</div>
</div>
</div>
</body>

<script><!-- pop the person name into the <span> tag in the headline. -->

  let span = document.getElementById("person");
  span.innerHTML= "<?php echo $firstname." ".$lastname; ?>";
  </script>

</script>

<script> // for deleting people
let locked = true;
$(".removal").click(function(event){

if (locked){
event.preventDefault();

  if(confirm("Are you sure you would like to delete this person? (Ok to remove)")){
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
