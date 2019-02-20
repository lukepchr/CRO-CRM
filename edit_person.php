<!doctype html>
<html lang="en">
<head> <?php include 'header.php' ?> </head>
<body class="bg-light">

<div id="main" class="bg-light">
  <?php include "top.php";
        require 'database.php';
        ?>


<div class="alert alert-primary" role="alert">
  <h4 class="alert-heading">Modify person's details...</h4>
  <p>Please enter the details below and click submit to go ahead.</p>
</div>


<!-- GET the account code to look for -->

<?php

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


?>


<form name = "edit_person" method="POST" action = "person_changed.php?action=edit&id=<?php echo $id; ?>">
<div id="form_container" class="container">

  <div class="form-row">
    <div class="form-group col-md-4">
    <label for ="firstname">First name:</label>
<input name="firstname" value="<?php echo $firstname ?>" class="form-control" id="firstname" type="text" required>
</div> <div class="form-group col-md-4">
  <label for ="lastname">Last name:</label>
<input name="lastname" value="<?php echo $lastname ?>" class="form-control" id="lastname" type="text" required>
</div></div>
<div class="form-row">
<div class = "form-group col-md-4">
  <label for ="position">Position:</label>
<input name="position" value="<?php echo $position ?>" class="form-control" id="position" type="text" required>
</div>
<div class = "form-group col-md-4">


  <label for ="accountcode">Account:</label>

  <select class="custom-select form-control" name="accountcode" id="accountcode" required>
    <option value="">Select the company</option>


    <?php
    require 'database.php';
    $sql2 = "SELECT DISTINCT account_code, account_name FROM account ORDER BY account_name ASC;";

    $result2 = $connection->query($sql2);


    $count=0;
    if ($result2->num_rows>0){
      while($row2 = $result2->fetch_assoc()){
      echo "<option value='".$row2['account_code']."'>".$row2['account_name'].'</option><br>';
    }
    }
    ?>

  </select>

</div></div>

<div class="form-row">
  <div class = "form-group col-md-4">
  <label for ="email">E-mail address:</label>
<input name="email" value="<?php echo $email ?>" class="form-control" id="email" type="email" required>
</div><div class = "form-group col-md-4">  <label for ="phone">Phone:</label>
<input name="phone" value="<?php echo $phone ?>" class="form-control" id="phone" type="number" required>
</div></div>
<input type="submit" class="btn btn-primary" id="button">
<a href="all_people.php" class="btn btn-warning" id="button">Cancel</a>
</div>



</form>

<script>
$("document").ready(function(){
  let x = $("#accountcode");
  x.val("<?php echo $accountcode ?>");
})
</script>



</div>
</body>




</html>
