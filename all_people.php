<!doctype html>
<html lang="en">
<head> <?php include 'header.php' ?> </head>



<!-- Using GET method, obtain ID of the company, this will be to fill the fields for editing. -->

<?php

if($_GET['id']){
$id = $_GET['id'];


require 'database.php';

$sql = "SELECT * FROM person WHERE id =" . $id;

$result = $connection->query($sql);

if($result->num_rows>0){ // it's great but next time use the right method.
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
else {
  // do nothing!
}
?>


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

   $employer = $connection->query($sql)->fetch_object()->account_name;

echo "<small class='text-muted'>";

if ($employer){
echo " from " . $employer;
}
else{
  echo " (company missing)";
}

echo "</small> <a href=all_people.php?id=". $row["id"] . "><i class='fas fa-edit'></i></a>";


echo " <a href=person_changed.php?action=delete&id=".$row["id"]." class='removal'>
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
if ($_GET['id']){
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
