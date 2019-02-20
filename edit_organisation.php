<!doctype html>
<html lang="en">
<head> <?php include 'header.php' ?> </head>

<body class="bg-light">

<div id="main" class="bg-light">
  <?php include "top.php";
        require 'database.php';
        ?>
<div class="alert alert-primary" role="alert">
  <h4 class="alert-heading">Modify organisation details...</h4>
  <p>Please enter the details below and click submit to go ahead.</p>
</div>

<div class="container ml-5">
<!-- GET the account code to look for -->

<?php

$id = $_GET['id'];

require 'database.php';

$sql = "SELECT * FROM account WHERE id = '" . $id . "';";

$result = $connection->query($sql);

if($result->num_rows>0){ // it's great but next time use the right method.
  while($row = $result->fetch_assoc()){

    $accountcode = $row["account_code"];
    $accountname = $row["account_name"];
    $address = $row["address"];
    $city = $row["city"];
    $postcode = $row["postcode"];
    $website = $row["website"];
    $phone = $row["phone"];

  }
}


?>


<form name = "edit_person" method="POST" action = "org_changed.php?action=edit&id=<?php echo $id; ?>">
<div id="form_container">

  <label for ="accountname">Organisation name:</label>
<input name="accountname" value="<?php echo $accountname ?>" class="form-control" id="accountname" type="text" required>

  <label for ="address">Street address:</label>
<input name="address" value="<?php echo $address ?>" class="form-control" id="address" type="text" required>

  <label for ="city">City:</label>
<input name="city" value="<?php echo $city ?>" class="form-control" id="city" type="text" required>

  <label for ="postcode">Postcode:</label>
<input name="postcode" value="<?php echo $postcode ?>" class="form-control" id="postcode" type="text" required>

  <label for ="website">Website:</label>
<input name="website" value="<?php echo $website ?>" class="form-control" id="website" type="text" required>

  <label for ="phone">Phone:</label>
<input name="phone" value="<?php echo $phone ?>" class="form-control" id="phone" type="number" required>

<label for ="accountcode">Account code:</label>
<input name="accountcode" value="<?php echo $accountcode ?>" class="form-control" id="accountcode" type="text" required>

</div>

<div class= "row mt-3">
<input type="submit" class="btn btn-primary" id="button">
<a href="all_organisations.php" class="btn btn-warning" id="button">Cancel</a></div>

</form>
</div>
</div>
</body>



</html>
